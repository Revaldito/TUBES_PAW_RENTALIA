<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class LihatTransaksi extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('lihat-transaksi')]
    public function render()
    {
        $data['transaksis'] = Transaksi::latest()->paginate(10);
        return view('livewire.lihat-transaksi', $data);
    }

    public function konfirmasi($id) 
{
    $transaksi = \App\Models\Transaksi::find($id);
    if ($transaksi && $transaksi->Status === 'Menunggu Pembayaran') {
        $transaksi->update(['Status' => 'Sedang Disewa']); // Update alur 1
        session()->flash('message', 'Pembayaran dikonfirmasi. Status: Sedang Disewa.');
    }
}

public function selesaikan($id) 
{
    $transaksi = \App\Models\Transaksi::find($id);
    if ($transaksi && $transaksi->Status === 'Sedang Disewa') {
        $transaksi->update(['Status' => 'Selesai']); // Update alur 2
        
        if($transaksi->mobil) {
            $transaksi->mobil->update(['status' => 'Tersedia']); // Mobil kembali tersedia
        }
        session()->flash('message', 'Sewa selesai. Mobil siap disewakan kembali.');
    }
}
}