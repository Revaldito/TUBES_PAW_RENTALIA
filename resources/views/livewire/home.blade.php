@section('title', 'Home Rentalia')

<div>
    {{-- SEARCH BOX NAVBAR --}}
    <div class="search-container-navbar d-none d-lg-block">
        <div class="position-relative">
            <div class="input-group shadow-sm rounded-pill bg-light overflow-hidden" style="width: 400px; border: 1px solid #f0f0f0;">
                <span class="input-group-text border-0 bg-transparent ps-3">
                    <i class="fa fa-search text-muted small"></i>
                </span>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       class="form-control border-0 bg-transparent py-2 px-1" 
                       placeholder="Cari merk mobil..."
                       style="font-size: 0.85rem; box-shadow: none;">
            </div>

            @if(count($searchResults ?? []) > 0)
                <div class="position-absolute w-100 bg-white shadow-lg rounded-4 mt-2 overflow-hidden border" style="z-index: 9999;">
                    <div class="list-group list-group-flush">
                        @foreach($searchResults as $m)
                            <button wire:click="$set('search', '{{ $m->Merk }}')" 
                                    class="list-group-item list-group-item-action border-0 d-flex align-items-center py-2 text-start">
                                <img src="{{ asset('storage/mobil/' . $m->Foto) }}" width="40" height="30" class="rounded me-3" style="object-fit: cover;">
                                <div>
                                    <div class="small fw-bold text-dark mb-0">{{ $m->Merk }}</div>
                                    <div class="fw-bold" style="font-size: 10px; color: #2563eb;">Rp {{ number_format($m->Harga, 0, ',', '.') }}</div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- KONTEN HALAMAN UTAMA --}}
    <div class="container-fluid px-0">

        {{-- PREMIUM BANNER SECTION (REVISI FULL WIDTH) --}}
        <div class="row g-0 mb-5">
            <div class="col-12">
                {{-- mx-lg-5 dan rounded-4 dihapus agar mentok kanan-kiri --}}
                <div class="position-relative overflow-hidden w-100" 
                     style="background: #0f172a; min-height: 400px; margin-top: -15px;">
                    
                    {{-- Efek Ambient Latar Belakang --}}
                    <div class="position-absolute w-100 h-100" style="background: radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.15) 0%, transparent 50%); z-index: 1;"></div>

                    {{-- Container ini menjaga teks tetap rapi di tengah meski background full --}}
                    <div class="container">
                        <div class="row align-items-center" style="min-height: 400px;">
                            
                            {{-- TEKS BANNER --}}
                            <div class="col-lg-6 text-white position-relative" style="z-index: 5;">
                                <span class="badge rounded-pill mb-3 px-3 py-2 text-uppercase" 
                                      style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); letter-spacing: 2px; font-size: 0.65rem; color: #60a5fa;">
                                    @auth Welcome Back @else Luxury Rental Experience @endauth
                                </span>
                                
                                <h1 class="fw-bold mb-3" style="font-size: 3rem; letter-spacing: -1.5px; line-height: 1.1; color: #e2e8f0;">
                                    @auth
                                        Halo, <span class="text-gradient">{{ auth()->user()->name }}</span>.
                                    @else
                                        Sewa Mobil <span class="text-gradient">Impian Anda</span>.
                                    @endauth
                                </h1>

                                <p class="fs-5 opacity-75 mb-4 fw-light" style="max-width: 500px;">
                                    @auth
                                        Temukan armada terbaik untuk perjalanan eksklusif Anda hari ini.
                                    @else
                                        Nikmati pengalaman berkendara dengan mobil impian anda dengan pilihan armada terbaru dan terlengkap di <span class="fw-bold">RENTALIA</span>.
                                    @endauth
                                </p>

                                @guest
                                    <div class="d-flex gap-3">
                                        <a href="/login" class="btn rounded-pill px-4 py-2 fw-bold shadow-sm" style="background-color: #2563eb; border-color: #2563eb; color: white;">Mulai Sekarang</a>
                                        <a href="#katalog" class="btn btn-outline-light rounded-pill px-4 py-2 fw-bold">Lihat Armada</a>
                                    </div>
                                @endguest
                            </div>
                            
                            {{-- MEDIA BANNER --}}
                            <div class="col-lg-6 d-none d-lg-block text-end position-relative">
                                <img src="{{ asset('storage/mobil/banner.png') }}" 
                                     style="width: 100%; max-width: 600px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.6)); z-index: 10; position: relative;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-4" id="katalog">
            {{-- FILTER BAR --}}
            <div class="row mb-5 g-3 align-items-end justify-content-center" style="margin-top: -50px; position: relative; z-index: 20;">
                <div class="col-md-10">
                    <div class="bg-white p-4 rounded-4 shadow-lg border-0">
                        <div class="row g-3">
                            <div class="col-md-4 border-end">
                                <label class="small text-muted fw-bold mb-2 text-uppercase">
                                    <i class="fa fa-car me-2" style="color: #2563eb;"></i>Merk Mobil
                                </label>
                                <select wire:model.live="filterMerk" class="form-select border-0 bg-light rounded-pill">
                                    <option value="">Semua Merk</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Honda">Honda</option>
                                    <option value="Suzuki">Suzuki</option>
                                    <option value="Daihatsu">Daihatsu</option>
                                    <option value="Mitsubishi">Mitsubishi</option>
                                </select>
                            </div>

                            <div class="col-md-4 border-end">
                                <label class="small text-muted fw-bold mb-2 text-uppercase">
                                    <i class="fa fa-users me-2" style="color: #2563eb;"></i>Kapasitas
                                </label>
                                <select wire:model.live="filterKapasitas" class="form-select border-0 bg-light rounded-pill">
                                    <option value="">Semua Kursi</option>
                                    <option value="4">4 Kursi</option>
                                    <option value="5">5 Kursi</option>
                                    <option value="7">7 Kursi</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="small text-muted fw-bold mb-2 text-uppercase">
                                    <i class="fa fa-tag me-2" style="color: #2563eb;"></i>Harga / Hari
                                </label>
                                <select wire:model.live="filterHarga" class="form-select border-0 bg-light rounded-pill">
                                    <option value="">Semua Harga</option>
                                    <option value="murah">< Rp 350rb</option>
                                    <option value="menengah">Rp 350rb - 500rb</option>
                                    <option value="mahal">> Rp 500rb</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GRID KATALOG --}}
            <div class="row g-4">
                @forelse($mobils as $mobil)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                            <div class="position-relative">
                                <div style="height: 180px; width: 100%; overflow: hidden; background-color: #f8f9fa;">
                                    <img src="{{ asset('storage/mobil/' . $mobil->Foto) }}" class="w-100 h-100" style="object-fit: contain;">
                                </div>
                                <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-white text-dark shadow-sm px-3 py-2 small fw-bold">
                                    {{ $mobil->Jenis }}
                                </span>
                            </div>
                            
                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="fw-bold mb-1">{{ $mobil->Merk }}</h5>
                                <p class="text-muted small mb-3">
                                    <i class="fa fa-users me-1" style="color: #2563eb;"></i> {{ $mobil->Kapasitas }} Kursi
                                </p>
                                
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold mb-0" style="color: #2563eb;">Rp {{ number_format($mobil->Harga, 0, ',', '.') }}</h6>
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Tersedia</span>
                                    </div>
                                    <a href="{{ route('transaksi.create', $mobil->id) }}" class="btn w-100 rounded-pill fw-bold py-2 shadow-sm" style="background-color: #2563eb; border-color: #2563eb; color: white;">
                                        Sewa Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h5 class="text-muted">Mobil tidak ditemukan</h5>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-5 mb-5 d-flex flex-column align-items-center">
                <div class="pagination-dot-style">
                    {{ $mobils->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .search-container-navbar { position: fixed; top: 12px; left: 180px; z-index: 1050; }
        .text-gradient {
            background: linear-gradient(to right, #60a5fa, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .card-hover { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
        .card-hover:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; }

        .pagination-dot-style nav > div:first-child { display: none !important; }
        .pagination-dot-style .pagination {
            display: flex !important; gap: 12px; background: white; padding: 10px 20px;
            border-radius: 50px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;
        }
        .pagination-dot-style .page-item .page-link {
            width: 35px; height: 35px; border-radius: 50% !important; display: flex;
            align-items: center; justify-content: center; border: none; background: #f8f9fa;
            color: #888; font-weight: 700; font-size: 13px; transition: 0.3s;
        }
        .pagination-dot-style .page-item.active .page-link {
            background-color: #2563eb !important; color: white !important; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }
        
        .btn:hover {
            filter: brightness(90%);
            transition: 0.2s;
        }
    </style>
</div>