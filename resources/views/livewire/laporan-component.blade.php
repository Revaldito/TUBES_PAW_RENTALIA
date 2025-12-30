@section('title', 'Admin Rentalia')
<div>
    <div class="container-fluid pt-4 px-4">   
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    @if (session()->has('success'))
                         <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                         </div>
                    @endif
                    
                    <h6 class="mb-4">Laporan Transaksi</h6>
                    
                    <div class="row align-items-center mb-4">
                        <div class="col-md-4">
                            <input type="date" wire:model="tanggal1" class="form-control" placeholder="Tanggal">
                        </div>
                        <div class="col-auto text-center px-0">
                            <span>Sampai dengan</span>
                        </div>
                        <div class="col-md-4">
                            <input type="date" wire:model="tanggal2" class="form-control" placeholder="S/d Tanggal">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary px-3" wire:click="cari">Filter</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Plat Nomor</th>
                                    <th scope="col">Nama Pemesan</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tanggal Pemesanan</th>
                                    <th scope="col">Lama Pemesanan</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi as $data)
                                <tr>
                                    <th scope="row">{{ ($transaksi->currentPage() - 1) * $transaksi->perPage() + $loop->iteration }}</th>
                                    <td>{{ $data->mobil->Plat_nomor ?? '-' }}</td>
                                    <td>{{ $data->Nama }}</td>
                                    <td>{{ $data->Alamat }}</td>
                                    <td>{{ $data->Tanggal_pesan ? \Carbon\Carbon::parse($data->Tanggal_pesan)->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $data->Lama_sewa }} Hari</td>
                                    <td>@rupiah($data->Total)</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Data Laporan Belum Ada!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Showing {{ $transaksi->firstItem() ?? 0 }} to {{ $transaksi->lastItem() ?? 0 }} of {{ $transaksi->total() }} results
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" wire:click="exportpdf">
                                <i class="fa fa-file-pdf me-2"></i>Export PDF
                            </button>
                            <div class="custom-admin-pagination">
                                {{ $transaksi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-admin-pagination nav > div:first-child { 
            display: none !important; 
        }
        .custom-admin-pagination svg { 
            width: 18px !important; 
            height: 18px !important; 
        }

        .custom-admin-pagination .pagination {
            display: flex !important;
            gap: 5px;
            margin: 0;
            list-style: none;
        }

        .custom-admin-pagination .page-item .page-link,
        .custom-admin-pagination .page-item span {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important; /* Membuat bentuk bulat sempurna */
            border: 1px solid #dee2e6;
            background-color: #fff;
            color: #007bff;
            font-size: 12px;
            font-weight: 600;
            padding: 0;
            transition: all 0.2s;
        }

        /* Style untuk halaman aktif (biru) */
        .custom-admin-pagination .page-item.active span,
        .custom-admin-pagination .page-item.active .page-link {
            background-color: #007bff !important;
            border-color: #007bff !important;
            color: #fff !important;
        }

        .custom-admin-pagination .page-item.disabled .page-link {
            color: #ccc;
            background-color: #f8f9fa;
        }

        .custom-admin-pagination .page-item:hover .page-link:not(.active) {
            background-color: #e9ecef;
        }
    </style>
</div>