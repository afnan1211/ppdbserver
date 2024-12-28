<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard Siswa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Informasi
    </div>

    <!-- Nav Item - Pengumuman Pondok -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.announcements.index') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Pengumuman Pondok</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Siswa
    </div>

    <!-- Nav Item - Isi Data Diri -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.biodata.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Diri</span>
        </a>
    </li>

    <!-- Nav Item - Cetak Data Diri -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.documents.index') }}">
            <i class="fas fa-fw fa-print"></i>
            <span>Cetak Data Diri</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Ujian Masuk
    </div>

    <!-- Nav Item - Pengumuman Hasil Ujian -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.exam.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Pengumuman Hasil Ujian</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
