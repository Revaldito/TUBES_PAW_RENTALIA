<div> 
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm fixed-top p-0 w-100">
        <div class="container-fluid px-4 py-2"> 
            <a href="{{ route('home') }}" class="navbar-brand">
                {{-- Mengubah warna titik logo menjadi biru banner --}}
                <h4 class="m-0 fw-bold" style="letter-spacing: -1px;">RENTALIA<span style="color: #2563eb;">.</span></h4>
            </a>
            
            <button type="button" class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarCollapse">
                {{-- SEARCH BOX: Tetap sesuai struktur --}}
                
                <div class="navbar-nav ms-auto align-items-center">
                    @auth
                        @if(auth()->user()->role !== 'admin')
                            <a href="{{ route('home') }}" class="nav-item nav-link py-1 px-3 mx-1 small fw-bold text-dark">Home</a>
                            
                            @if(auth()->user()->role === 'customers')
                                <a href="{{ route('customer.riwayat') }}" class="nav-item nav-link py-1 px-3 mx-1 small fw-bold text-dark">Lihat Transaksi</a>
                            @endif
                        @endif

                        {{-- USER PROFILE DROPDOWN --}}
                        <div class="nav-item dropdown ms-2">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center p-0" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-2" src="{{ asset('assets/img/user.jpg') }}" style="width: 28px; height: 28px; object-fit: cover; border: 1px solid #eee;">
                                <div class="d-flex flex-column text-start">
                                    <span class="small fw-bold text-dark lh-1" style="font-size: 0.8rem;">{{ auth()->user()->name }}</span>
                                    <span class="text-muted" style="font-size: 0.65rem;">{{ ucfirst(auth()->user()->role) }}</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end border-0 shadow m-0 mt-2 p-2" style="font-size: 0.85rem; border-radius: 10px;">
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger rounded">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="d-flex align-items-center ms-lg-3">
                            <a href="{{ route('login') }}" class="nav-item nav-link py-1 px-3 small fw-bold text-dark">Login</a>
                            {{-- Mengubah background-color tombol Register menjadi biru banner --}}
                            <a href="{{ route('register') }}" class="btn btn-sm rounded-pill px-4 ms-2 fw-bold text-white" style="font-size: 0.75rem; background-color: #2563eb;">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <style>
        .form-control:focus { box-shadow: none; background-color: transparent; }
        
        /* Mengubah warna hover link nav-link menjadi biru banner */
        .nav-link { transition: color 0.2s; }
        .nav-link:hover { color: #2563eb !important; }
        
        .navbar {
            z-index: 1030;
        }

        /* Memperbaiki tampilan dropdown agar tidak terpotong */
        .dropdown-menu {
            min-width: 150px;
        }
    </style>
</div>