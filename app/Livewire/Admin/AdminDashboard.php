<?php

namespace App\Livewire\Admin;

use App\Models\Transaksi;
use App\Models\Mobil;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalTransaksi' => Transaksi::sum('Total'),
            'totalMobil'     => Mobil::count(),
            'totalUser'      => User::count(),
            // Mengambil 5 transaksi terbaru beserta data mobilnya
            'transaksiTerbaru' => Transaksi::with('mobil')->latest()->take(5)->get(),
        ])->layout('layout.livewire');
    }
}