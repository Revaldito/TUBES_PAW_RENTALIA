<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class LaporanComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $tanggal1, $tanggal2;

    #[On('lihat-laporan')]
    public function render()
    {
        if ($this->tanggal2 != "") {
            $data['transaksi'] = Transaksi::where('Status', 'SELESAI')
                ->whereBetween('Tanggal_pesan', [$this->tanggal1, $this->tanggal2])
                ->paginate(10);
        } else {
            $data['transaksi'] = Transaksi::where('Status', 'SELESAI')
                ->paginate(10);
        }

        return view('livewire.laporan-component', $data);
    }

    public function cari()
    {
        $this->dispatch('lihat-laporan');
    }

    public function exportpdf()
    {
        if($this->tanggal2 !=""){
           $data['transaksi'] = Transaksi::where('Status', 'SELESAI')
                ->whereBetween('Tanggal_pesan', [$this->tanggal1, $this->tanggal2])
                ->get();
        // generate PDF
        $pdf = Pdf::loadView('laporan.export', $data)->output();

        return response()->streamDownload(
            fn()=> print($pdf),
            " Laporan Transaksi " . $this->tanggal1 .' s-d '.$this->tanggal2 . ".pdf"
        ); 

        }
        else{
           $data['transaksi'] = Transaksi::where('Status', 'SELESAI')->get();

        // generate PDF
        $pdf = Pdf::loadView('laporan.export', $data)->output();

        return response()->streamDownload(
            fn()=> print($pdf),
            "Laporan Transaksi.pdf"
        );  
        }
        // ambil data transaksi
        $data['transaksi'] = Transaksi::where('Status', 'SELESAI')->get();

        // generate PDF
        $pdf = Pdf::loadView('laporan.export', $data)->output();

        return response()->streamDownload(
            fn()=> print($pdf),
            "Laporan Transaksi.pdf"
        ); 
    }
}
