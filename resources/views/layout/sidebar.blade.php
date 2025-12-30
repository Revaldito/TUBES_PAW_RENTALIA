{{-- Bungkus seluruh div sidebar dengan cek role admin --}}
@auth
    @if(auth()->user()->role === 'admin')
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand mx-4 mb-3">
                {{-- Mengubah warna teks Rentalia --}}
                <h3 style="color: #2563eb;">Rentalia</h3>
            </a>

            {{-- USER INFO (ADMIN) --}}
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}"
                         alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white
                                 position-absolute end-0 bottom-0 p-1"></div>
                </div>

                <div class="ms-3">
                    <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                    <span class="text-muted">{{ auth()->user()->role }}</span>
                </div>
            </div>

            {{-- MENU KHUSUS ADMIN --}}
            <div class="navbar-nav w-100 sidebar-custom">
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                </a>

                <a href="{{ route('users') }}" 
                   class="nav-item nav-link {{ request()->routeIs('users') ? 'active' : '' }}">
                    <i class="fa fa-users me-2"></i>Data Users
                </a>

                <a href="{{ route('mobil') }}" 
                   class="nav-item nav-link {{ request()->routeIs('mobil') ? 'active' : '' }}">
                    <i class="fa fa-car me-2"></i>Data Mobil
                </a>

                <a href="{{ route('admin.laporan') }}" 
                   class="nav-item nav-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                    <i class="fa fa-file-invoice-dollar me-2"></i>Kelola Transaksi
                </a>

                <a href="{{ route('laporan') }}" 
                   class="nav-item nav-link {{ request()->routeIs('laporan') ? 'active' : '' }}">
                    <i class="fa fa-clipboard-list me-2"></i>Laporan Transaksi
                </a>
            </div>
        </nav>
    </div>

    <style>
        /* Menyesuaikan warna teks dan ikon menu saat ACTIVE */
        .sidebar .navbar-nav .nav-link.active {
            color: #2563eb !important; /* Biru Banner */
            background: #ffffff !important;
            border-color: #2563eb !important;
        }

        /* Menyesuaikan warna ikon saat menu ACTIVE */
        .sidebar .navbar-nav .nav-link.active i {
            color: #2563eb !important;
        }

        /* Efek hover menu */
        .sidebar .navbar-nav .nav-link:hover {
            color: #2563eb !important;
            background: #ffffff !important;
        }

        /* Warna teks Rentalia di brand */
        .text-primary {
            color: #2563eb !important;
        }
    </style>
    @endif
@endauth