<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <sup>ppdb</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Siswa
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSiswa"
           aria-expanded="true" aria-controls="collapseSiswa">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Pengelolaan Siswa</span>
        </a>
        <!-- Submenu Pengelolaan Siswa -->
        <div id="collapseSiswa" class="collapse" aria-labelledby="headingSiswa" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Submenu Pengelolaan Siswa:</h6>
                <a class="collapse-item" href="{{ route('admin.students.index') }}">Daftar Siswa</a>
                <a class="collapse-item" href="{{ route('admin.documents.index') }}">Verifikasi Dokumen</a>
                <a class="collapse-item" href="{{ route('admin.students.create')}}">Tambah Siswa</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Orang Tua
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.parents.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengelolaan Orang Tua</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Pengumuman
    </div>

        <!-- Nav Item - User Information -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.announcements.index') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Pengumuman</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Nilai Ujian
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.exams.index') }}">
            <i class="fas fa-fw fa-edit"></i>
            <span>Nilai Ujian</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Periode
    </div>


    <!-- Nav Item - User Information -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.periods.index') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Periode</span>
        </a>
    </li>

      {{-- Divider --}}
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen User
    </div>

    <!-- Nav Item - User Information -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Daftar User</span>
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
