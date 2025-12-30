@extends('layout.template')

@section('title', 'Buat Transaksi')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">

                <h5 class="mb-3">Sewa Mobil – {{ $mobil->Merk }}</h5>

                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">

                    <div class="mb-3">
                        <label>Nama Pemesan</label>
                        <input type="text" name="Nama" class="form-control"
                               value="{{ auth()->user()->name }}">
                    </div>

                    <div class="mb-3">
                        <label>Nomor Telepon</label>
                        <input type="text" name="No_telp" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" name="Alamat" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Lama Sewa (Hari)</label>
                        <input type="number" name="Lama_sewa" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Sewa</label>
                        <input type="date" name="Tanggal_pesan" class="form-control">
                    </div>

                    <button class="btn btn-primary w-100">
                        Konfirmasi Sewa
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection