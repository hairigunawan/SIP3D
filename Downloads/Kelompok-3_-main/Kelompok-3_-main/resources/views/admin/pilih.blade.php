<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Login - SIP3D</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            text-align: center;
            width: 350px;
        }
        .login-box h3 {
            margin-bottom: 10px;
            font-weight: 700;
            color: #1e3a8a;
        }
        .subtitle {
            color: #475569;
            font-size: 14px;
            margin-bottom: 25px;
        }
        .btn-role {
            display: block;
            margin: 10px 0;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
            color: white;
        }
        .btn-role:hover {
            transform: scale(1.05);
        }
        .footer {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3>SIP3D</h3>
        <p class="subtitle">Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen</p>

        <a href="{{ route('login.admin') }}" class="btn btn-danger btn-role w-100">
            👨‍💼 Login sebagai Admin
        </a>
        <a href="{{ route('login.dosen') }}" class="btn btn-primary btn-role w-100">
            👨‍🏫 Login sebagai Dosen
        </a>
        <a href="{{ route('login.mahasiswa') }}" class="btn btn-success btn-role w-100">
            🎓 Login sebagai Mahasiswa
        </a>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="footer">
            &copy; {{ date('Y') }} <strong>SIP3D</strong> — Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen
        </div>
    </div>
</body>
</html>
