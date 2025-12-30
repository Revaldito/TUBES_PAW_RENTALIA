<?php

namespace App\Livewire;

use App\Models\Mobil;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    // Properti untuk menangkap input dari view
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $filterMerk = '';
    public $filterKapasitas = '';
    public $filterHarga = '';

    // Reset halaman ke nomor 1 setiap kali ada perubahan filter/search
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterMerk() { $this->resetPage(); }
    public function updatingFilterKapasitas() { $this->resetPage(); }
    public function updatingFilterHarga() { $this->resetPage(); }

    public function render()
    {
        $query = Mobil::query();

        // 1. Logika Search (Merk atau Nama Mobil)
        if ($this->search) {
            $query->where('Merk', 'like', '%' . $this->search . '%');
        }

        // 2. Logika Filter Merk
        if (!empty($this->filterMerk)) {
        // Menggunakan 'like' dengan % di belakang agar mencari kata depan saja
        $query->where('Merk', 'like', $this->filterMerk . '%');
        }

        // 3. Logika Filter Kapasitas (Jumlah Kursi)
        if ($this->filterKapasitas) {
            $query->where('Kapasitas', $this->filterKapasitas);
        }

        // 4. Logika Filter Harga (Rentang Harga)
        if ($this->filterHarga) {
            if ($this->filterHarga == 'murah') {
                $query->where('Harga', '<', 350000);
            } elseif ($this->filterHarga == 'menengah') {
                $query->where('Harga', '>=', 350000)
                      ->where('Harga', '<=', 500000);
            } elseif ($this->filterHarga == 'mahal') {
                $query->where('Harga', '>', 500000);
            }
        }

        // Ambil data untuk Preview Search di Navbar (Maksimal 5)
        $searchResults = [];
        if (strlen($this->search) > 2) {
            $searchResults = Mobil::where('Merk', 'like', '%' . $this->search . '%')
                                  ->take(5)
                                  ->get();
        }

        return view('livewire.home', [
            'mobils' => $query->paginate(8), // Sesuaikan jumlah pagination
            'searchResults' => $searchResults
        ])->layout('layout.template');
    }
}