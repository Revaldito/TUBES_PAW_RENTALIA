<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center px-4">
        <h4 class="m-0 text-primary">Rentalia</h4>
    </a>
    
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon" style="font-size: 0.8rem;"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto align-items-center">
            <form class="d-flex me-3" style="max-width: 250px;">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control border-0 bg-light" 
                           placeholder="Cari mobil..." 
                           style="border-radius: 15px 0 0 15px; font-size: 0.85rem;">
                    <button class="btn btn-light border-0 bg-light" type="submit" 
                            style="border-radius: 0 15px 15px 0;">
                        <i class="fa fa-search text-primary" style="font-size: 0.8rem;"></i>
                    </button>
                </div>
            </form>

            <a href="/" class="nav-item nav-link py-3 px-3 {{ request()->is('/') ? 'active' : '' }}" style="font-size: 0.9rem;">Home</a>
            
            @auth
                @if(auth()->user()->role === 'customers')
                    <a href="{{ route('dashboard') }}" 
                       class="nav-item nav-link py-3 px-3 {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" 
                       style="font-size: 0.9rem;">Dashboard</a>
                @endif

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center px-4" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-2" src="{{ asset('assets/img/user.jpg') }}" 
                             alt="" style="width: 25px; height: 25px; object-fit: cover;">
                        <small class="fw-bold">{{ auth()->user()->name }}</small>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-bottom m-0">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item small">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-item nav-link py-3 px-4" style="font-size: 0.9rem;">Login</a>
            @endauth
        </div>
    </div>
</nav>
