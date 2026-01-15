<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #fafafa; }
    .login-card { width: 400px; border-radius: 12px; }
    .student-icon {
      background-color: #16a34a;
      width: 80px; height: 80px; border-radius: 50%;
      display:flex; align-items:center; justify-content:center;
      margin:0 auto 18px; color:#fff; font-size:36px;
    }
    .btn-google {
      background: #fff; border: 1px solid #e6e6e6; border-radius: 8px;
      padding: 10px 12px; width:100%; max-width:320px;
      display:flex; align-items:center; gap:10px; justify-content:center; margin:0 auto 12px;
    }
    .btn-google img { width:18px; height:18px; }
    .divider-or { max-width:320px; margin:10px auto 18px; display:flex; align-items:center; gap:8px; }
    .divider-or hr { flex:1; border-top:1px solid #e6e6e6; margin:0; }
    .divider-or small { color:#9aa0a6; }
    .btn-student { background:#16a34a; color:white; font-weight:600; border-radius:8px; }
    .btn-student:hover { background:#138a3e; }
  </style>
</head>
<body class="d-flex vh-100 justify-content-center align-items-center">

  <div class="card login-card shadow p-4">
    <div class="student-icon">
      <i class="bi bi-mortarboard-fill"></i>
    </div>

    <h4 class="text-center fw-bold">Student Login</h4>
    <p class="text-center text-muted mb-3">SIP2D - Student Portal</p>

    {{-- Show error flash --}}
    @if(session('error'))
      <div class="alert alert-danger py-2">{{ session('error') }}</div>
    @endif

    {{-- GOOGLE LOGIN BUTTON (role = mahasiswa) --}}
    <div class="text-center">
      <a href="{{ route('login.google.redirect', ['role' => 'mahasiswa']) }}" class="btn-google" role="button">
        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
        <span class="fw-medium">Sign in with Google</span>
      </a>
    </div>

    {{-- divider --}}
    <div class="divider-or">
      <hr><small>or</small><hr>
    </div>

    @if($errors->any())
      <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.mahasiswa.post') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">E-mail <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password <span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
      </div>

      <button type="submit" class="btn btn-student w-100 py-2">Login</button>
    </form>

    <div class="text-center mt-3">
      <small>Lupa password? <a href="#" class="text-success text-decoration-none">Reset di sini</a></small>
    </div>
  </div>

</body>
</html>
