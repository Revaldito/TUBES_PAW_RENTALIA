<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function create(Mobil $mobil)
    {
        return view('transaksi.create', compact('mobil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required',
            'Nama' => 'required',
            'No_telp' => 'required',
            'Alamat' => 'required',
            'Lama_sewa' => 'required|numeric|min:1',
            'Tanggal_pesan' => 'required|date',
        ]);

        $mobil = Mobil::findOrFail($request->mobil_id);

        Transaksi::create([
            'user_id' => Auth::id(),
            'mobil_id' => $mobil->id,
            'Nama' => $request->Nama,
            'No_telp' => $request->No_telp,
            'Alamat' => $request->Alamat,
            'Lama_sewa' => $request->Lama_sewa,
            'Tanggal_pesan' => $request->Tanggal_pesan,
            'Total' => $request->Lama_sewa * $mobil->Harga,
            'Status' => 'PROSES',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Transaksi berhasil dibuat');
    }

}