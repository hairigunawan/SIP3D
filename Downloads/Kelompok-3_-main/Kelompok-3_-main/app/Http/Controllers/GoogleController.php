<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google (simpan intent role di session bila ada)
     * Contoh URL:
     * /auth/google/redirect/admin
     * /auth/google/redirect/dosen
     */
    public function redirect(Request $request, $role = null)
    {
        if ($role) {
            $request->session()->put('login_intent', $role);
        } else {
            $request->session()->forget('login_intent');
        }

        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Callback dari Google
     */
    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login.pilih')
                ->withErrors(['google' => 'Gagal login dengan Google.']);
        }

        // Ambil intent login
        $intent = $request->session()->pull('login_intent');

        // Cari user berdasarkan email
        $user = User::where('email', $googleUser->getEmail())->first();

        /**
         * =========================================
         * JIKA USER SUDAH ADA
         * =========================================
         */
        if ($user) {

            // Jika ada intent dan tidak sama dengan role user → konfirmasi
            if ($intent && $user->role !== $intent) {

                $request->session()->put('google_temp_user', [
                    'email' => $user->email,
                ]);

                $request->session()->put('current_role', $user->role);
                $request->session()->put('intent_role', $intent);

                return redirect()->route('login.google.confirm_role');
            }

            // 🔥 FIX UTAMA: pastikan active_role selalu di-set
            Auth::login($user);
            session(['active_role' => $user->role]);

            return $this->redirectByActiveRole();
        }

        /**
         * =========================================
         * JIKA USER BARU
         * =========================================
         */
        $roleToAssign = $intent ?? 'mahasiswa';

        $user = User::create([
            'name'     => $googleUser->getName(),
            'email'    => $googleUser->getEmail(),
            'password' => bcrypt('googlelogin123'),
            'role'     => $roleToAssign,
        ]);

        Auth::login($user);
        session(['active_role' => $user->role]);

        return $this->redirectByActiveRole();
    }

    /**
     * Halaman konfirmasi role
     */
    public function confirmRole(Request $request)
    {
        $currentRole = $request->session()->get('current_role');
        $intent = $request->session()->get('intent_role');

        if (!$currentRole || !$intent) {
            return redirect()->route('login.pilih');
        }

        return view('auth.confirm_role', compact('currentRole', 'intent'));
    }

    /**
     * Lanjutkan setelah user memilih role
     */
    public function confirmRoleContinue(Request $request)
    {
        $temp = $request->session()->get('google_temp_user');
        $currentRole = $request->session()->get('current_role');
        $intent = $request->session()->get('intent_role');

        if (!$temp || !isset($temp['email'])) {
            return redirect()->route('login.pilih')
                ->withErrors(['google' => 'Sesi login tidak valid.']);
        }

        $user = User::where('email', $temp['email'])->first();
        if (!$user) {
            return redirect()->route('login.pilih')
                ->withErrors(['google' => 'Akun tidak ditemukan.']);
        }

        Auth::login($user);

        $choose = $request->input('choose'); // current | intent

        if ($choose === 'intent' && $intent) {
            session(['active_role' => $intent]);
        } else {
            session(['active_role' => $currentRole ?? $user->role]);
        }

        // Bersihkan session sementara
        $request->session()->forget([
            'google_temp_user',
            'current_role',
            'intent_role',
            'login_intent',
        ]);

        return $this->redirectByActiveRole();
    }

    /**
     * Batalkan konfirmasi
     */
    public function confirmRoleCancel(Request $request)
    {
        $request->session()->forget([
            'google_temp_user',
            'current_role',
            'intent_role',
            'login_intent',
        ]);

        return redirect()->route('login.pilih');
    }

    /**
     * =========================================
     * 🔥 HELPER FINAL (ANTI SALAH ROLE)
     * =========================================
     */
    protected function redirectByActiveRole()
    {
        $role = session('active_role', Auth::user()->role);

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'dosen':
                return redirect()->route('dosen.dashboard');

            default:
                return redirect()->route('mahasiswa.dashboard');
        }
    }
}
