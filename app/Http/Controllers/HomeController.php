<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
public function index()
{
    $mobil = \App\Models\Mobil::count();
    $mobil_ready = $mobil; 
    $mobil_rented = \App\Models\Transaksi::where('Status', 'Sedang Disewa')->count();
    $transaksi = \App\Models\Transaksi::where('Status', 'Selesai')->sum('Total');
    $user = \App\Models\User::where('role', 'customers')->count();
    $pending = \App\Models\Transaksi::where('Status', 'Menunggu Pembayaran')->count();

    $mobil_terlaris = \App\Models\Transaksi::select('mobil_id', \DB::raw('count(*) as total_sewa'))
        ->where('Status', 'Selesai')
        ->groupBy('mobil_id')
        ->orderBy('total_sewa', 'desc')
        ->with(['mobil' => function($query) {
            $query->withTrashed();
        }])
        ->take(3)
        ->get();

    return view('home', compact(
        'transaksi', 
        'user', 
        'mobil', 
        'mobil_ready', 
        'mobil_rented', 
        'pending',
    ));
}

    public function dashboard()
    {
        $mobil = Mobil::where('status', 'tersedia')->get();

        return view('dashboard', compact('mobils'));
    }
}
