<?php

namespace App\Livewire;

use App\Models\Mobil;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MobilComponent extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $addPage, $editPage = false;
    public $Plat_nomor, $Merk, $Jenis, $Kapasitas, $Harga, $Foto, $id;

    public $data_lama_foto;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data['mobil']=Mobil::paginate(10);
        return view('livewire.mobil-component', $data);
    }

    public function create()
    {
        $this->addPage = true;
    }

    public function store()
    {
        $this->validate([
            'Plat_nomor' => 'required',
            'Merk' => 'required',
            'Jenis' => 'required',
            'Kapasitas'=> 'required',
            'Harga' => 'required',
            'Foto' => 'required|image'
        ], [
            'Plat_nomor.required' => 'Plat Nomor Tidak Boleh Kosong!',
            'Merk.required' => 'Merk Tidak Boleh Kosong!',
            'Jenis.required' => 'Jenis Tidak Boleh Kosong!',
            'Kapasitas.required' => 'Kapasitas Tidak Boleh Kosong!',
            'Harga.required' => 'Harga Tidak Boleh Kosong!',
            'Foto.required' => 'Foto Tidak Boleh Kosong!',
            'Foto.image' => 'Foto harus format image!'
        ]);

        $this->Foto->storeAs('mobil', $this->Foto->hashName(), 'public');
        Mobil::create([
            'user_id' => auth()->user()->id,
            'Plat_nomor' => $this->Plat_nomor,
            'Merk' => $this->Merk,
            'Jenis' => $this->Jenis,
            'Kapasitas' => $this->Kapasitas,
            'Harga' => $this->Harga,
            'Foto' => $this->Foto->hashName()
        ]);
        session()->flash('success', 'Berhasil menambahkan data mobil!');
        
        $this->reset();
        $this->dispatch('close-offcanvas'); // Menutup offcanvas setelah simpan
    }

    public function edit($id)
    {
        $this->editPage = true;
        $this->id = $id;
        $Mobil = Mobil::find($id);
        $this->Plat_nomor = $Mobil->Plat_nomor;
        $this->Merk = $Mobil->Merk;
        $this->Jenis = $Mobil->Jenis;
        $this->Kapasitas = $Mobil->Kapasitas;
        $this->Harga = $Mobil->Harga;
        
        // ISI VARIABEL INI agar muncul di view edit
        $this->data_lama_foto = $Mobil->Foto; 
    }

    public function update()
    {
        $Mobil = Mobil::find($this->id);
        if (empty($this->Foto)) {
            $Mobil->update([
                'user_id' => auth()->user()->id,
                'Plat_nomor' => $this->Plat_nomor,
                'Merk' => $this->Merk,
                'Jenis' => $this->Jenis,
                'Kapasitas' => $this->Kapasitas,
                'Harga' => $this->Harga,
            ]);
        } else {
            // Hapus foto lama jika ada
            if (file_exists(public_path('storage/mobil/' . $Mobil->Foto))) {
                unlink(public_path('storage/mobil/' . $Mobil->Foto));
            }
            
            $this->Foto->storeAs('mobil', $this->Foto->hashName(), 'public');
            $Mobil->update([
                'user_id' => auth()->user()->id,
                'Plat_nomor' => $this->Plat_nomor,
                'Merk' => $this->Merk,
                'Jenis' => $this->Jenis,
                'Kapasitas' => $this->Kapasitas,
                'Harga' => $this->Harga,
                'Foto' => $this->Foto->hashName()
            ]);
        }
        
        session()->flash('success', 'Data mobil Berhasil Di Update!');
        
        $this->reset();
        $this->dispatch('close-offcanvas'); // Menutup offcanvas setelah update
    }

    public function destroy($id)
    {
        $Mobil=Mobil::find($id);
        if (file_exists(public_path('storage/mobil/' . $Mobil->Foto))) {
            unlink(public_path('storage/mobil/' . $Mobil->Foto));
        }
        $Mobil->delete();
        session()->flash('success', 'Behasil Dihapus!');
        $this->reset();
    }
}