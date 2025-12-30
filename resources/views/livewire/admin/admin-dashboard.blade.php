@auth
@if(auth()->user()->role === 'admin')
@section('title', 'Admin Rentalia')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        {{-- Statistik Utama --}}
        <div class="col-sm-6 col-xl-4">
            <div class="bg-white rounded d-flex align-items-center justify-content-between p-4 shadow-sm border-start border-primary border-4">
                {{-- Ikon disesuaikan ke biru banner --}}
                <i class="fa fa-dollar-sign fa-3x" style="color: #2563eb;"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 text-muted fw-bold small text-uppercase">Total Transaksi</p>
                    <h5 class="mb-0 fw-bold">@rupiah($transaksi)</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="bg-white rounded d-flex align-items-center justify-content-between p-4 shadow-sm border-start border-primary border-4">
                <i class="fa fa-car fa-3x" style="color: #2563eb;"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 text-muted fw-bold small text-uppercase">Mobil</p>
                    <h5 class="mb-0 fw-bold">{{ $mobil }} Unit</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="bg-white rounded d-flex align-items-center justify-content-between p-4 shadow-sm border-start border-primary border-4">
                <i class="fa fa-users fa-3x" style="color: #2563eb;"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 text-muted fw-bold small text-uppercase">Users</p>
                    <h5 class="mb-0 fw-bold">{{ $user }} Orang</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        {{-- Tombol Navigasi Cepat --}}
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('mobil') }}" class="btn btn-custom-outline-blue w-100 p-3 shadow-sm fw-bold">
                <i class="fa fa-plus-circle me-2"></i>Tambah Mobil
            </a>
        </div>
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('admin.laporan') }}" class="btn btn-custom-outline-blue w-100 p-3 shadow-sm fw-bold">
                <i class="fa fa-tasks me-2"></i>Kelola Transaksi
            </a>
        </div>
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('laporan') }}" class="btn btn-custom-blue w-100 p-3 shadow-sm fw-bold text-white">
                <i class="fa fa-file-pdf me-2"></i>Laporan Cetak
            </a>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4 mb-4">
    <div class="bg-white text-center rounded p-4 shadow-sm border">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0 fw-bold"><i class="fa fa-history me-2" style="color: #2563eb;"></i>5 Transaksi Terbaru</h6>
            <a href="{{ route('admin.laporan') }}" class="btn btn-sm fw-bold" style="color: #2563eb; text-decoration: none;">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-hover mb-0">
                <thead class="bg-light">
                    <tr class="text-dark">
                        <th scope="col" class="py-3">Customer</th>
                        <th scope="col" class="py-3">Mobil</th>
                        <th scope="col" class="py-3">Total</th>
                        <th scope="col" class="py-3">Status</th>
                        <th scope="col" class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $item)
                    <tr>
                        <td class="fw-bold">{{ $item->Nama }}</td>
                        <td>{{ $item->mobil->Merk }}</td>
                        <td class="fw-bold" style="color: #2563eb;">@rupiah($item->Total)</td>
                        <td>
                            @if($item->Status == 'MENUNGGU_PEMBAYARAN')
                                <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                            @elseif($item->Status == 'PROSES')
                                <span class="badge px-3 py-2" style="background-color: #2563eb;">Disewa</span>
                            @else
                                <span class="badge bg-success px-3 py-2">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-light border shadow-sm" href="{{ route('admin.laporan') }}">
                                <i class="fa fa-eye" style="color: #2563eb;"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada transaksi terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Custom Styling untuk menyamakan dengan warna Banner */
    .btn-custom-blue {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        transition: 0.3s;
    }
    .btn-custom-blue:hover {
        background-color: #1d4ed8 !important;
        transform: translateY(-2px);
    }
    .btn-custom-outline-blue {
        color: #2563eb !important;
        border: 2px solid #2563eb !important;
        background-color: transparent;
        transition: 0.3s;
    }
    .btn-custom-outline-blue:hover {
        background-color: #2563eb !important;
        color: white !important;
        transform: translateY(-2px);
    }
    .border-primary {
        border-color: #2563eb !important;
    }
</style>
@endif
@endauth