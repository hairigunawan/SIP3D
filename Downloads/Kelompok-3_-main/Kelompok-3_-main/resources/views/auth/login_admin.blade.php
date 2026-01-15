<!-- resources/views/auth/login_admin.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin | SIP3D</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #e0f2fe, #dbeafe);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Poppins", sans-serif;
    }
    .login-container {
      background: #fff;
      width: 420px;
      padding: 36px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      text-align: center;
    }
    .icon-admin {
      background-color: #dc2626;
      width: 80px; height: 80px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 38px; margin: 0 auto 18px;
      box-shadow: 0 4px 10px rgba(220,38,38,0.35);
    }
    h3 { font-weight:700; color:#1e3a8a; }
    .subtitle { color:#64748b; font-size:14px; margin-bottom:20px; }
    .btn-google { border:1px solid #ddd; border-radius:8px; background:white; font-weight:500; }
    .divider { position:relative; text-align:center; margin:18px 0; color:#94a3b8; }
    .divider::before, .divider::after { content:""; position:absolute; top:50%; width:40%; height:1px; background:#ccc; }
    .divider::before { left:0 } .divider::after { right:0 }
    .divider span { background:white; padding:0 10px; }
    .footer { margin-top:18px; font-size:0.85rem; color:#6b7280; }
    .form-control.is-invalid { box-shadow: none; }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="icon-admin"><i class="bi bi-person-fill-lock"></i></div>
    <h3>Login Admin</h3>
    <p class="subtitle">SIP3D — Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen</p>

    <!-- Notifikasi sukses / error session -->
    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Tombol Login dengan Google -->
    <a href="{{ route('login.google.redirect') }}" class="btn btn-google w-100 py-2 mb-3 d-flex align-items-center justify-content-center">
      <img src="https://developers.google.com/identity/images/g-logo.png" width="20" class="me-2" alt="G">
      Masuk dengan Google
    </a>

    <div class="divider"><span>atau</span></div>

    <!-- Form Login Manual -->
    <form method="POST" action="{{ route('login.admin.post') }}">
      @csrf

      <div class="mb-3 text-start">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input id="email" type="email" name="email"
               value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Masukkan email" required autofocus>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3 text-start">
        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
        <input id="password" type="password" name="password"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="Masukkan password" required>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary py-2">Masuk sebagai Admin</button>
      </div>
    </form>

    <div class="footer mt-3">
      <small>Lupa password? <a href="#">Reset di sini</a></small>
    </div>
  </div>
</body>
</html>
