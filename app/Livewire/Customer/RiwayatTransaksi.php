<?php

namespace App\Livewire\Customer;

use App\Models\Transaksi;
use Livewire\Component;

class RiwayatTransaksi extends Component
{
    public function checkExpiredTransactions()
    {
        Transaksi::where('Status', 'Menunggu Pembayaran')
            ->where('user_id', auth()->id())
            ->where('expired_at', '<', Carbon::now())
            ->update(['Status' => 'Dibatalkan']);
    }
    public function render()
    {
        return view('livewire.customer.riwayat-transaksi', [
            'riwayats' => Transaksi::with('mobil')
                ->where('user_id', auth()->id()) // Ambil punya dia saja
                ->latest()
                ->get(),
        ])->layout('layout.livewire');
    }
}