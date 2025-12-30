@section('title', 'Admin Rentalia')
<div>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0">Daftar Transaksi Customer</h5>
            </div>

            {{-- Pesan Sukses --}}
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Mobil</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $index => $item)
                        <tr>
                            <td>{{ $transaksis->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->Tanggal_pesan)->format('d/m/Y') }}</td>
                            <td>
                                <strong>{{ $item->Nama }}</strong><br>
                                <small class="text-muted">{{ $item->No_telp }}</small>
                            </td>
                            <td>{{ $item->mobil->Merk ?? 'N/A' }}</td>
                            <td>Rp {{ number_format((float)$item->Total, 0, ',', '.') }}</td>
                            <td>
                                {{-- REVISI: Samakan dengan teks di Database --}}
                                @if($item->Status === 'Menunggu Pembayaran')
                                    <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                @elseif($item->Status === 'Sedang Disewa')
                                    <span class="badge bg-primary">Sedang Disewa</span>
                                @elseif($item->Status === 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($item->Status === 'Dibatalkan')
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @else
                                    <span class="badge bg-secondary">{{ $item->Status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    @if($item->Status === 'Menunggu Pembayaran')
                                        <button wire:click="konfirmasi({{ $item->id }})" class="btn btn-sm btn-success">
                                            <i class="fa fa-check me-1"></i> Konfirmasi
                                        </button>
                                    @elseif($item->Status === 'Sedang Disewa')
                                        <button wire:click="selesaikan({{ $item->id }})" class="btn btn-sm btn-info text-white">
                                            <i class="fa fa-flag-checkered me-1"></i> Selesaikan
                                        </button>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $transaksis->links() }}
            </div>
        </div>
    </div>
</div>