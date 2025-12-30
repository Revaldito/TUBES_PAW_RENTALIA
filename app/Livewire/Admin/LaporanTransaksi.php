<?php

namespace App\Livewire\Admin;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class LaporanTransaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function konfirmasi($id) 
{
    $transaksi = \App\Models\Transaksi::find($id);
    if ($transaksi && $transaksi->Status === 'Menunggu Pembayaran') {
        $transaksi->update(['Status' => 'Sedang Disewa']); // Gunakan teks spasi
        session()->flash('message', 'Pembayaran dikonfirmasi.');
    }
}

public function selesaikan($id) 
{
    $transaksi = \App\Models\Transaksi::find($id);
    if ($transaksi && $transaksi->Status === 'Sedang Disewa') {
        $transaksi->update(['Status' => 'Selesai']);
        if($transaksi->mobil) {
            $transaksi->mobil->update(['status' => 'Tersedia']);
        }
        session()->flash('message', 'Transaksi selesai.');
    }
}

    public function batalkan($id)
    {
        $transaksi = Transaksi::find($id);
        
        if ($transaksi && ($transaksi->Status == 'MENUNGGU_PEMBAYARAN' || $transaksi->Status == 'PROSES')) {
            $transaksi->update([
                'Status' => 'BATAL'
            ]);
            session()->flash('message', 'Transaksi #' . $id . ' telah dibatalkan manual.');
        }
    }

    public function render()
    {
        // PEMBERSIH OTOMATIS: Membatalkan transaksi yang kadaluarsa
        Transaksi::where('Status', 'MENUNGGU_PEMBAYARAN')
            ->where('expired_at', '<', Carbon::now('Asia/Jakarta'))
            ->update(['Status' => 'BATAL']);

        return view('livewire.admin.laporan-transaksi', [
            'transaksis' => Transaksi::with(['user', 'mobil'])->latest()->paginate(10)
        ])->layout('layout.livewire'); 
    }
}