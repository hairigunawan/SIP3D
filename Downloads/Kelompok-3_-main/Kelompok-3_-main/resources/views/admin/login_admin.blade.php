<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - SIP2D</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #e9f0ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            width: 400px;
            border-radius: 20px;
        }
        .login-icon {
            background-color: #e3f0ff;
            color: #0d6efd;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin: 0 auto 15px;
        }
        .btn-login {
            background-color: #0d6efd;
            border: none;
            font-weight: 600;
        }
        .btn-login:hover {
            background-color: #0045cc;
        }
        .form-label span {
            color: red;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-lg p-4 login-card">
    <div class="text-center">
        <div class="login-icon">
            <i class="bi bi-person-circle"></i>
        </div>
        <h4 class="fw-bold">Login Administrator</h4>
        <p class="text-muted" style="font-size: 14px;">
            SIP2D - Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen
        </p>
    </div>

    {{-- ALERT --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- LOGIN GOOGLE ADMIN --}}
    <a href="{{ url('/auth/google/redirect/admin') }}"
       class="btn btn-light w-100 border d-flex align-items-center justify-content-center gap-2 mt-3">
        <img src="https://developers.google.com/identity/images/g-logo.png" width="18">
        <span class="fw-semibold">Masuk dengan Google (Admin)</span>
    </a>

    <div class="text-center text-muted my-3" style="font-size:13px;">
        atau login menggunakan akun sistem
    </div>

    {{-- LOGIN MANUAL ADMIN --}}
    <form action="{{ route('login.admin.post') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email <span>*</span></label>
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="admin@sip3d.ac.id"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password <span>*</span></label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Masukkan password"
                   required>
        </div>

        <button type="submit" class="btn btn-login text-white w-100 py-2">
            Masuk sebagai Administrator
        </button>

        <div class="text-center mt-3">
            <a href="#" class="text-decoration-none small">
                Lupa password? <b>Reset di sini</b>
            </a>
        </div>

        <div class="text-center mt-2">
            <a href="{{ route('login.pilih') }}" class="text-decoration-none small">
                ← Kembali ke Pilihan Login
            </a>
        </div>
    </form>
</div>

</body>
</html>
