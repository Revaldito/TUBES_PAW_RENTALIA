@section('title', 'Rentalia')

<div class="container-fluid py-4 ps-0 pe-4">
    <div class="bg-white rounded-end shadow-sm p-4 border-start-0">
        <h6 class="fw-bold mb-4 text-primary"><i class="fa fa-list me-2"></i>Riwayat Transaksi Saya</h6>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size: 0.85rem;">
                <thead class="bg-light">
                    <tr>
                        <th>Tanggal Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Mobil</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item->Tanggal_pesan)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $item->Lama_sewa }} Hari</span>
                        </td>
                        <td>
                            <span class="fw-bold d-block">{{ $item->mobil->Merk }}</span>
                            <small class="text-muted">{{ $item->mobil->Jenis }}</small>
                        </td>
                        <td class="fw-bold text-primary">Rp {{ number_format($item->Total, 0, ',', '.') }}</td>
                        <td>
                            @if($item->Status == 'Menunggu Pembayaran')
                                <span class="badge rounded-pill bg-warning text-dark">Menunggu Pembayaran</span>
                            @elseif($item->Status == 'Sedang Disewa')
                                <span class="badge rounded-pill bg-info">Sedang Disewa</span>
                            @elseif($item->Status == 'Selesai')
                                <span class="badge rounded-pill bg-success">Selesai</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fa fa-receipt fa-3x mb-3 d-block opacity-25"></i>
                            Belum ada riwayat transaksi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>