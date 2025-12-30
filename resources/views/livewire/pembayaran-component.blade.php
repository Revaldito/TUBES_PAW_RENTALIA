<div class="d-flex align-items-center justify-content-center" style="min-height: 90vh;" wire:poll.1s="updateTimer">
    <div class="row justify-content-center w-100">
        <div class="col-11 col-sm-8 col-md-5 col-lg-4"> 
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                <div class="bg-primary py-3 text-center text-white">
                    <small class="d-block opacity-75">ID Transaksi</small>
                    <h6 class="mb-0 fw-bold">#TRX-{{ $transaksi->id }}</h6>
                </div>

                <div class="card-body p-4 text-center">
                    
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Selesaikan Dalam</small>
                        @if($sisaWaktu === '00:00')
                            <h4 class="text-danger fw-bold mb-0">WAKTU HABIS</h4>
                        @else
                            <h3 class="fw-bold text-dark font-monospace mb-0" style="letter-spacing: 1px;">
                                {{ $sisaWaktu }}
                            </h3>
                        @endif
                    </div>

                    <div class="p-2 bg-light rounded-4 mb-3 border border-dashed d-inline-block shadow-sm">
                        <div class="position-relative">
                            <img src="{{ asset('img/qris_cipung.jpeg') }}" 
                                 alt="Scan QRIS" 
                                 class="img-fluid rounded-3" 
                                 style="max-width: 180px; height: auto; display: block;">
                            
                            @if($sisaWaktu === '00:00')
                                <div class="position-absolute top-0 start-0 w-100 h-100 rounded-3 d-flex align-items-center justify-content-center" 
                                     style="background: rgba(255,255,255,0.85); backdrop-filter: blur(2px);">
                                    <span class="badge bg-danger shadow-sm">KADALUARSA</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="px-2 mb-4">
                        <p class="small text-muted mb-3" style="font-size: 0.75rem;">
                            Silakan scan QRIS di atas melalui aplikasi e-wallet atau m-banking Anda.
                        </p>
                        <div class="d-flex justify-content-between align-items-center bg-white border p-2 rounded-3">
                            <span class="text-muted small">Total Tagihan:</span>
                            <span class="fw-bold text-primary">@rupiah($transaksi->Total)</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary py-2 fw-bold rounded-3 shadow-sm" style="font-size: 0.9rem;" onclick="window.location.reload()">
                            SAYA SUDAH BAYAR
                        </button>
                        <a href="/" class="btn btn-sm btn-link text-muted text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>

                <div class="card-footer bg-white border-0 text-center pb-3">
                    <div class="d-flex justify-content-center gap-2 opacity-50">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>