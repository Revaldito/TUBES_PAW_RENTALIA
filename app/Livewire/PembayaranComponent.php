<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use Carbon\Carbon;

class PembayaranComponent extends Component
{
    public $transaksi;
    public $sisaWaktu = "";

    public function mount($id)
    {
        $this->transaksi = Transaksi::findOrFail($id);
    }

    public function updateTimer()
    {
        $expired = Carbon::parse($this->transaksi->expired_at);
        $sekarang = now();

        if ($sekarang->greaterThan($expired)) {
            $this->sisaWaktu = "EXPIRED";
            if ($this->transaksi->Status !== 'BATAL') {
                $this->transaksi->update(['Status' => 'BATAL']);
            }
        } else {
            $diff = $sekarang->diff($expired);
            $this->sisaWaktu = $diff->format('%I:%S');
        }
    }

    public function render()
    {
        return view('livewire.pembayaran-component')
            ->layout('layout.livewire');
    }
}