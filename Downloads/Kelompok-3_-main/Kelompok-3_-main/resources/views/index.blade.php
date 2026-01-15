<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP2D - Kelola Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
        }
        .admin-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .admin-info i {
            font-size: 18px;
            color: #0d6efd;
        }

        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .table th {
            background-color: #f1f5f9;
        }
        .btn-add {
            background-color: #0d6efd;
            color: white;
            font-weight: 600;
            border-radius: 10px;
        }
        .btn-add:hover {
            background-color: #0b5ed7;
        }
        .status-active {
            background-color: #d1e7dd;
            color: #0f5132;
            font-size: 13px;
            border-radius: 20px;
            padding: 4px 12px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .search-box {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 8px 12px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar px-4 py-2 mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIP2D - Kelola Dosen</a>
            <div class="admin-info">
                <i class="bi bi-person-circle"></i>
                <span>Administrator</span>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Data Dosen</h5>
                <div class="d-flex gap-2">
                    <input type="text" class="search-box" placeholder="Cari dosen...">
                    <button class="btn btn-add"><i class="bi bi-plus-circle"></i> Tambah Dosen</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="text-center fw-semibold">
                        <tr>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Fakultas</th>
                            <th>Prodi</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>0123456789</td>
                            <td>Dr. Ahmad Wijaya, M.Kom</td>
                            <td>ahmad.wijaya@univ.ac.id</td>
                            <td>Teknik</td>
                            <td>Informatika</td>
                            <td>Lektor</td>
                            <td><span class="status-active">Aktif</span></td>
                            <td>
                                <a href="#" class="text-primary me-2"><i class="bi bi-pencil-square"></i></a>
                                <a href="#" class="text-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>0987654321</td>
                            <td>Prof. Dr. Siti Nurhaliza, M.T</td>
                            <td>siti.nurhaliza@univ.ac.id</td>
                            <td>Teknik</td>
                            <td>Elektro</td>
                            <td>Guru Besar</td>
                            <td><span class="status-active">Aktif</span></td>
                            <td>
                                <a href="#" class="text-primary me-2"><i class="bi bi-pencil-square"></i></a>
                                <a href="#" class="text-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1122334455</td>
                            <td>Dr. Budi Santoso, M.Sc</td>
                            <td>budi.santoso@univ.ac.id</td>
                            <td>MIPA</td>
                            <td>Matematika</td>
                            <td>Lektor Kepala</td>
                            <td><span class="status-active">Aktif</span></td>
                            <td>
                                <a href="#" class="text-primary me-2"><i class="bi bi-pencil-square"></i></a>
                                <a href="#" class="text-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
