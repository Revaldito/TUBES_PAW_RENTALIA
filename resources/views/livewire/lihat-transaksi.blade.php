<tbody>
    @foreach($transaksis as $index => $item)
    <tr>
        <td>{{ $transaksis->firstItem() + $index }}</td>
        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
        <td><strong>{{ $item->Nama }}</strong><br><small>{{ $item->No_telp }}</small></td>
        <td>{{ $item->mobil->Merk ?? 'N/A' }}</td>
        <td>Rp {{ number_format((float)$item->Total, 0, ',', '.') }}</td>
        <td>

            @if($item->Status === 'Menunggu Pembayaran')
                <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
            @elseif($item->Status === 'Sedang Disewa')
                <span class="badge bg-primary">Sedang Disewa</span>
            @elseif($item->Status === 'Selesai')
                <span class="badge bg-success">Selesai</span>
            @else
                <span class="badge bg-secondary">{{ $item->Status }}</span>
            @endif
        </td>
        <td class="text-center">
            @if($item->Status === 'Menunggu Pembayaran')
                <button wire:click="konfirmasi({{ $item->id }})" class="btn btn-sm btn-success">Konfirmasi</button>
            @elseif($item->Status === 'Sedang Disewa')
                <button wire:click="selesaikan({{ $item->id }})" class="btn btn-sm btn-info text-white">Selesaikan</button>
            @else
                <span class="text-muted">-</span>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>