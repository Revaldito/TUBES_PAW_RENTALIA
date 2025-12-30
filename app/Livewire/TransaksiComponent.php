<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Mobil;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransaksiComponent extends Component
{
    public Mobil $mobil;
    public $Nama, $No_telp, $Alamat;
    public $Lama_sewa, $Tanggal_pesan;
    public $Total = 0;
    public $bookedDates = []; // Properti baru untuk menyimpan tanggal yang sudah dipesan

    public $isShowPayment = false;
    public $transaksiId;
    public $sisaWaktu = "10:00";

    public function mount(Mobil $mobil)
    {
        $this->mobil = $mobil;
        $this->Nama = auth()->user()->name;

        // AMBIL SEMUA TANGGAL YANG SUDAH DIPESAN UNTUK MOBIL INI
        $transaksiAktif = Transaksi::where('mobil_id', $this->mobil->id)
            ->whereIn('Status', ['Menunggu Pembayaran', 'Sedang Disewa', 'Selesai'])
            ->get();

        foreach ($transaksiAktif as $t) {
            $mulai = Carbon::parse($t->Tanggal_pesan);
            for ($i = 0; $i < $t->Lama_sewa; $i++) {
                $this->bookedDates[] = $mulai->copy()->addDays($i)->format('Y-m-d');
            }
        }
        // Urutkan tanggal agar rapi saat ditampilkan
        sort($this->bookedDates);
    }

    public function hitung()
    {
        $this->Total = (int)($this->Lama_sewa ?? 0) * $this->mobil->Harga;
    }

    public function updateTimer()
    {
        if ($this->isShowPayment && $this->transaksiId) {
            $transaksi = Transaksi::find($this->transaksiId);
            
            if ($transaksi && $transaksi->Status === 'Menunggu Pembayaran') {
                $expiredAt = Carbon::parse($transaksi->expired_at)->timestamp;
                $now = Carbon::now('Asia/Jakarta')->timestamp;

                $diffInSeconds = $expiredAt - $now;

                if ($diffInSeconds <= 0) {
                    $this->sisaWaktu = "00:00";
                    $transaksi->update(['Status' => 'Dibatalkan']);
                } else {
                    $menit = floor($diffInSeconds / 60);
                    $detik = $diffInSeconds % 60;
                    $this->sisaWaktu = sprintf('%02d:%02d', $menit, $detik);
                }
            } else {
                $this->sisaWaktu = "00:00";
            }
        }
    }

    public function store()
    {
        $this->validate([
            'Nama'=>'required',
            'No_telp'=>'required',
            'Alamat'=>'required',
            'Lama_sewa'=>'required|numeric|min:1',
            'Tanggal_pesan'=>'required|date',
        ]);

        $tglMulaiBaru = Carbon::parse($this->Tanggal_pesan);
        $tglSelesaiBaru = $tglMulaiBaru->copy()->addDays($this->Lama_sewa - 1);

        $isBooked = Transaksi::where('mobil_id', $this->mobil->id)
            ->whereIn('Status', ['Menunggu Pembayaran', 'Sedang Disewa'])
            ->where(function ($query) use ($tglMulaiBaru, $tglSelesaiBaru) {
                $query->where(function ($q) use ($tglMulaiBaru, $tglSelesaiBaru) {
                    $q->whereBetween('Tanggal_pesan', [
                        $tglMulaiBaru->toDateString(), 
                        $tglSelesaiBaru->toDateString()
                    ]);
                })
                ->orWhere(function ($q) use ($tglMulaiBaru, $tglSelesaiBaru) {
                    $q->whereRaw("DATE_ADD(Tanggal_pesan, INTERVAL (Lama_sewa - 1) DAY) BETWEEN ? AND ?", [
                        $tglMulaiBaru->toDateString(), 
                        $tglSelesaiBaru->toDateString()
                    ]);
                });
            })
            ->exists();

        if ($isBooked) {
            session()->flash('error', 'Maaf, mobil ini sudah dipesan pada rentang tanggal tersebut.');
            return;
        }

        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'mobil_id' => $this->mobil->id,
            'Nama' => $this->Nama,
            'No_telp' => $this->No_telp,
            'Alamat' => $this->Alamat,
            'Lama_sewa' => $this->Lama_sewa,
            'Tanggal_pesan' => $this->Tanggal_pesan,
            'Total' => $this->Total,
            'Status' => 'Menunggu Pembayaran',
            'expired_at' => now('Asia/Jakarta')->addMinutes(10),
            'qris_code' => 'QRIS-' . strtoupper(Str::random(10)),
        ]);

        $this->transaksiId = $transaksi->id;
        $this->isShowPayment = true;
    }

    public function render()
    {
        return view('livewire.transaksi-component')
            ->layout('layout.livewire');
    }
}