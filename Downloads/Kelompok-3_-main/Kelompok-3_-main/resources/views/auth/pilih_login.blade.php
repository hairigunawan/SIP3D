<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pilih Login | SIP3D</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      scroll-behavior: smooth;
    }

    body {
      font-family: "Poppins", sans-serif;
      min-height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background: radial-gradient(circle at top left, #c7d2fe, #e0e7ff, #fdf2f8);
      background-attachment: fixed;
      overflow: hidden;
    }

    /* Floating gradient light */
    .aurora {
      position: absolute;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(157, 106, 255, 0.35), transparent 70%);
      filter: blur(100px);
      top: -100px;
      left: -150px;
      animation: moveAurora 10s infinite alternate ease-in-out;
    }
    .aurora2 {
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(255, 182, 193, 0.35), transparent 70%);
      filter: blur(100px);
      bottom: -100px;
      right: -100px;
      animation: moveAurora 12s infinite alternate ease-in-out;
    }

    @keyframes moveAurora {
      from { transform: translate(0, 0) scale(1); }
      to { transform: translate(60px, -40px) scale(1.1); }
    }

    .container {
      z-index: 2;
      text-align: center;
      backdrop-filter: blur(25px);
      background: rgba(255, 255, 255, 0.35);
      border-radius: 30px;
      padding: 50px 40px;
      box-shadow: 0 20px 50px rgba(0,0,0,0.1);
      animation: fadeIn 1.2s ease;
      width: 90%;
      max-width: 950px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .logo {
      width: 90px;
      border-radius: 50%;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      animation: floatLogo 4s ease-in-out infinite alternate;
    }

    @keyframes floatLogo {
      from { transform: translateY(0); }
      to { transform: translateY(-10px); }
    }

    .title {
      font-weight: 700;
      color: #1e1b4b;
      font-size: 34px;
      letter-spacing: 1px;
    }

    .subtitle {
      color: #475569;
      font-size: 16px;
      margin-bottom: 40px;
    }

    .card {
      border: none;
      border-radius: 25px;
      padding: 35px 25px;
      transition: all 0.4s ease;
      background: rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(20px);
      box-shadow: 0 6px 25px rgba(0,0,0,0.08);
      cursor: pointer;
      transform: translateY(0);
    }

    .card:hover {
      transform: translateY(-10px) scale(1.03);
      background: rgba(255,255,255,0.7);
      box-shadow: 0 15px 35px rgba(100, 100, 255, 0.25);
    }

    .card i {
      font-size: 2.8rem;
      margin-bottom: 14px;
    }

    .card h5 {
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 8px;
    }

    .card p {
      font-size: 14px;
      color: #64748b;
      min-height: 40px;
    }

    .btn {
      border-radius: 25px;
      padding: 10px 0;
      font-weight: 500;
      transition: 0.3s ease;
    }

    .btn:hover {
      transform: scale(1.07);
    }

    footer {
      margin-top: 45px;
      color: #334155;
      font-size: 14px;
      opacity: 0.9;
    }

  </style>
</head>
<body>
  <div class="aurora"></div>
  <div class="aurora2"></div>

  <div class="container">
    <img src="{{ asset('images/logo-sip3d.png') }}" alt="Logo SIP3D" class="logo">
    <h2 class="title">SIP3D</h2>
    <p class="subtitle">Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen</p>
    <p class="mb-4 text-secondary">Pilih jenis akun untuk masuk ke sistem</p>

    <div class="row justify-content-center g-4">

      <div class="col-md-3 col-sm-6">
        <div class="card">
          <i class="bi bi-person-gear text-danger"></i>
          <h5>Admin</h5>
          <p>Kelola seluruh data sistem dan pengguna</p>
          <a href="{{ route('login.admin') }}" class="btn btn-outline-danger w-100">Login Admin</a>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="card">
          <i class="bi bi-mortarboard text-primary"></i>
          <h5>Dosen</h5>
          <p>Kelola penelitian, pengabdian, dan prestasi</p>
          <a href="{{ route('login.dosen') }}" class="btn btn-outline-primary w-100">Login Dosen</a>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="card">
          <i class="bi bi-book text-success"></i>
          <h5>Mahasiswa</h5>
          <p>Lihat informasi penelitian dan pengabdian</p>
          <a href="{{ route('login.mahasiswa') }}" class="btn btn-outline-success w-100">Login Mahasiswa</a>
        </div>
      </div>

    </div>

    <footer>
      © 2025 <strong>SIP3D</strong> | Powered by <strong>RINODER</strong>
    </footer>
  </div>
</body>
</html>
