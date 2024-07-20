<div class="sidebar sidebar-main sidebar-expand-lg align-self-start">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                <div>
                    <button type="button"
                        class="btn btn-light btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button"
                        class="btn btn-light btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->

        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="ph-command"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('incident.dashboard') }}" class="nav-link">
                        <i class="ph-fingerprint"></i>
                        <span>Incident</span>
                    </a>
                </li>

                @can('Admin permission')
                    <li class="nav-item">
                        <a href="{{ route('material.dashboard') }}" class="nav-link">
                            <i class="ph-package"></i>
                            <span>Material Serpo</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('basecamp.dashboard') }}" class="nav-link">
                            <i class="ph-house-line"></i>
                            <span>Basecamp Serpo</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('perusahaan.dashboard') }}" class="nav-link">
                            <i class="ph-buildings"></i>
                            <span>Perusahaan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pengguna.dashboard') }}" class="nav-link">
                            <i class="ph-user-plus"></i>
                            <span>Tambah Pengguna</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}" class="nav-link">
                            <i class="ph-lock"></i>
                            <span>Permission</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('role.index') }}" class="nav-link">
                            <i class="ph-key"></i>
                            <span>Role</span>
                        </a>
                    </li>
                @endcan

                @can('Laporan permission')
                    <li class="nav-item">
                        <a href="{{ route('laporan.index') }}" class="nav-link">
                            <i class="ph-file-xls"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
