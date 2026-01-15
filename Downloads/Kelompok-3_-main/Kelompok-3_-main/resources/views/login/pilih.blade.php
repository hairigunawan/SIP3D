<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SIP3D | Select Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <style>
    * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
    html,body { height: 100%; margin: 0; padding: 0; }

    body {
      background: linear-gradient(135deg, #e0e7ff 0%, #f5f3ff 40%, #f0f9ff 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      /* jangan overflow: hidden supaya bisa scroll di layar kecil */
    }

    .gradient-bg {
      position: absolute;
      width: 150%;
      height: 150%;
      background: radial-gradient(circle at 20% 30%, #a5b4fc 0%, transparent 70%),
                  radial-gradient(circle at 80% 80%, #93c5fd 0%, transparent 70%),
                  radial-gradient(circle at 50% 60%, #c7d2fe 0%, transparent 60%);
      filter: blur(120px);
      top: -25%;
      left: -25%;
      z-index: 0;
      animation: moveBg 12s ease-in-out infinite alternate;
    }
    @keyframes moveBg { 0%{transform:translate(0,0)} 100%{transform:translate(-40px,40px)} }

    .container-login {
      position: relative;
      z-index: 2;
      text-align: center;
      color: #1e3a8a;
      padding: 36px;
      width: 92%;
      max-width: 1100px;
      border-radius: 22px;
      background: rgba(255,255,255,0.65);
      box-shadow: 0 18px 40px rgba(16,24,40,0.08);
      backdrop-filter: blur(6px);
      margin: 24px;
    }

    h1 {
      font-weight: 700;
      font-size: 2.6rem;
      background: linear-gradient(90deg, #6366f1, #60a5fa, #818cf8);
      -webkit-background-clip: text;
      color: transparent;
      margin-bottom: 6px;
    }

    p.lead {
      color: #64748b;
      margin-bottom: 28px;
      font-size: 1.02rem;
    }

    /* card area */
    .card-group-custom {
      display: flex;
      gap: 28px;
      justify-content: center;
      align-items: stretch;     /* penting supaya kartu sama tinggi */
      flex-wrap: wrap;
      margin-top: 6px;
    }

    .card-login {
      width: 270px;
      max-width: calc(33% - 20px);
      display: flex;
      flex-direction: column;
      justify-content: space-between; /* push tombol ke bawah */
      padding: 30px 22px;
      border-radius: 18px;
      background: rgba(255,255,255,0.6);
      backdrop-filter: blur(8px);
      box-shadow: 0 10px 30px rgba(99,102,241,0.09);
      transition: transform .35s ease, box-shadow .35s ease;
      border: 1px solid rgba(255,255,255,0.45);
      text-align: center;
      min-height: 260px; /* memastikan tinggi minimal */
      box-sizing: border-box;
    }

    .card-login:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 18px 40px rgba(99,102,241,0.18); }

    .card-login .icon {
      font-size: 40px;
      margin-bottom: 12px;
      height: 52px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-login h4 { font-weight: 600; color: #1e3a8a; margin-bottom: 6px; }
    .card-login p { font-size: .92rem; color: #6b7280; margin-bottom: 18px; }

    .btn-login {
      display: inline-block;
      border-radius: 30px;
      padding: 10px 26px;
      font-weight: 600;
      border: none;
      text-decoration: none;
      transition: all .25s ease;
      min-width: 160px;
    }

    .btn-admin { background: #f87171; color: #fff; }
    .btn-admin:hover { background:#ef4444; box-shadow: 0 0 20px rgba(239,68,68,0.28); }

    .btn-lecturer { background: #60a5fa; color: #fff; }
    .btn-lecturer:hover { background:#3b82f6; box-shadow: 0 0 20px rgba(59,130,246,0.28); }

    .btn-student { background: #34d399; color: #fff; }
    .btn-student:hover { background:#10b981; box-shadow: 0 0 20px rgba(16,185,129,0.28); }

    footer {
      margin-top: 18px;
      font-size: 14px;
      color: #64748b;
    }

    /* Responsive tweaks */
    @media (max-width: 980px) {
      .card-login { max-width: 320px; width: 100%; min-height: 260px; }
      .card-group-custom { gap:18px; }
    }
    @media (max-width: 560px) {
      .container-login { padding: 22px; }
      h1 { font-size: 2.1rem; }
      p.lead { margin-bottom: 20px; }
    }

  </style>
</head>
<body>
  <div class="gradient-bg" aria-hidden="true"></div>

  <div class="container-login">
    <h1>SIP3D</h1>
    <p class="lead">Information System for Lecturer Community Service, Research, and Achievements</p>

    <div class="card-group-custom">
      <div class="card-login">
        <div>
          <div class="icon"><i class="fas fa-user-cog" style="color:#ef4444"></i></div>
          <h4>Admin</h4>
          <p>Manage all system and user data</p>
        </div>
        <div>
          <!-- ganti href sesuai route aplikasi laravelmu -->
          <a href="{{ route('login.admin') }}" class="btn btn-login btn-admin">Admin Login</a>
        </div>
      </div>

      <div class="card-login">
        <div>
          <div class="icon"><i class="fas fa-graduation-cap" style="color:#3b82f6"></i></div>
          <h4>Lecturer</h4>
          <p>Manage research, service, and achievements</p>
        </div>
        <div>
          <a href="{{ route('login.dosen') }}" class="btn btn-login btn-lecturer">Lecturer Login</a>
        </div>
      </div>

      <div class="card-login">
        <div>
          <div class="icon"><i class="fas fa-book-open" style="color:#10b981"></i></div>
          <h4>Student</h4>
          <p>View research and community service information</p>
        </div>
        <div>
          <a href="{{ route('login.mahasiswa') }}" class="btn btn-login btn-student">Student Login</a>
        </div>
      </div>
    </div>

    <footer>&copy; 2025 SIP3D | Sistem Informasi Dosen | Politala</footer>
  </div>
</body>
</html>
