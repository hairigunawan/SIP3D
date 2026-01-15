<!DOCTYPE html>
<html>
<head>
    <title>Edit Penelitian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h1>Edit Penelitian</h1>

    <form action="{{ route('research.update', $research->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" value="{{ $research->judul }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $research->deskripsi }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('research.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
