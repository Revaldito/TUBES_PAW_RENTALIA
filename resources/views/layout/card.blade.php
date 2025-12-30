@auth
@if(auth()->user()->role === 'admin')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm">
                <i class="fa fa-wallet fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 small fw-bold text-muted text-uppercase">Pendapatan</p>
                    <h6 class="mb-0 fw-bold">@rupiah($transaksi)</h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm">
                <i class="fa fa-car fa-3x text-success"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 small fw-bold text-muted text-uppercase">Total Mobil</p>
                    <h6 class="mb-0 fw-bold">{{ $mobil }} Unit</h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm">
                <i class="fa fa-users fa-3x text-info"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 small fw-bold text-muted text-uppercase">Customer</p>
                    <h6 class="mb-0 fw-bold">{{ $user }} Customer</h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-white border-start border-warning border-5 rounded d-flex align-items-center justify-content-between p-4 shadow-sm">
                <i class="fa fa-clock fa-3x text-warning"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 small fw-bold text-muted text-uppercase">Pending </p>
                    <h6 class="mb-0 fw-bold">{{ $pending ?? 0 }} Transaksi</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded p-4 shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 fw-bold">Status Armada</h6>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="small">Mobil Tersedia</span>
                        <span class="small fw-bold text-success">{{ $mobil_ready }}</span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ $mobil > 0 ? ($mobil_ready / $mobil) * 100 : 0 }}%;"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="small">Sedang Disewa</span>
                        <span class="small fw-bold text-danger">{{ $mobil_rented }}</span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-danger" role="progressbar" 
                            style="width: {{ $mobil > 0 ? ($mobil_rented / $mobil) * 100 : 0 }}%;"
                            aria-valuenow="{{ $mobil_rented }}" 
                            aria-valuemin="0" 
                            aria-valuemax="{{ $mobil }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded p-4 shadow-sm h-100 text-center d-flex flex-column justify-content-center">
                <h6 class="mb-3 fw-bold">Aksi Cepat Admin</h6>
                <div class="d-flex justify-content-center gap-2">
                    <a href="/mobil" class="btn btn-sm btn-primary rounded-pill px-3"><i class="fa fa-plus me-1"></i> Tambah Mobil</a>
                    <a href="/laporan-transaksi" class="btn btn-sm btn-outline-dark rounded-pill px-3"><i class="fa fa-print me-1"></i> Cetak Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endauth