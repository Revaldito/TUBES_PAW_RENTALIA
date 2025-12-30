@extends('layout.template')

@section('title', 'Rentalia')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        @forelse($mobils as $mobil)
        <div class="col-md-4">
            <div class="bg-light rounded p-4 h-100 d-flex flex-column shadow-sm">

                <img src="{{ asset('storage/mobil/' . $mobil->Foto) }}"
                     class="img-fluid rounded mb-3"
                     style="height:200px; width:100%; object-fit:cover;"
                     alt="{{ $mobil->Merk }}">

                <h5 class="mb-1 fw-bold">{{ $mobil->Merk }}</h5>
                <small class="text-muted d-block mb-3">
                    {{ $mobil->Jenis }} • {{ $mobil->Kapasitas }} Kursi
                </small>

                <div class="mt-auto">
                    <p class="mb-0 small text-muted">Harga / Hari</p>
                    <h6 class="text-primary fw-bold">@rupiah($mobil->Harga)</h6>

                    <div class="mb-3">
                        <span class="badge bg-success">Tersedia</span>
                    </div>

                    @if(auth()->check())
                        <a href="{{ route('transaksi.create', $mobil->id) }}" class="btn btn-primary w-100 fw-bold rounded-pill">
                            <i class="fa fa-car me-2"></i>Sewa Mobil
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 fw-bold rounded-pill">
                            Login untuk Sewa
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light rounded p-5">
                <i class="fa fa-car-side fa-3x text-muted mb-3"></i>
                <p class="mb-0 text-muted">Maaf, saat ini mobil belum tersedia.</p>
            </div>
        </div>
        @endforelse

    </div>
</div>
@endsection