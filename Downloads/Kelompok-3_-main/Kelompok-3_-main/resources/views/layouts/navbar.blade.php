<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand fw-bold text-uppercase" href="{{ url('/') }}">
      <i class="bi bi-journal-bookmark-fill me-2"></i>SIP3D
    </a>

    <!-- Toggle (for mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('lecturers.index') }}">Dosen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('students.index') }}">Mahasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('research.index') }}">Penelitian</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('services.index') }}">Pengabdian</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('achievements.index') }}">Prestasi</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
