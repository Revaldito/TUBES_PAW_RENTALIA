<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Mobil</h6>
                    <button wire:click="create" class="btn btn-primary rounded-pill px-4">
                        <i class="fa fa-plus me-2"></i>Tambah
                    </button>
                </div>
                {{-- TABLE --}}
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Plat Nomor</th>
                                <th>Merk</th>
                                <th>Jenis</th>
                                <th>Kapasitas</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mobil as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->Plat_nomor }}</td>
                                    <td>{{ $data->Merk }}</td>
                                    <td>{{ $data->Jenis }}</td>
                                    <td>{{ $data->Kapasitas }}</td>
                                    <td>@rupiah($data->Harga)</td>
                                    <td>
                                        <img src="{{ asset('storage/mobil/' . $data->Foto) }}"
                                             style="width:80px" class="rounded shadow">
                                    </td>
                                    <td>
                                        <button wire:click="edit({{ $data->id }})"
                                            class="btn btn-info btn-sm text-white">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button wire:click="destroy({{ $data->id }})"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Data Mobil Belum Ada
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $mobil->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- OFFCANVAS --}}
    <div class="offcanvas offcanvas-end {{ $addPage || $editPage ? 'show' : '' }}"
        style="visibility: {{ $addPage || $editPage ? 'visible' : 'hidden' }}; width:450px">

        <div class="offcanvas-header border-bottom">
            <h5>{{ $addPage ? 'Tambah Data Mobil' : 'Update Data Mobil' }}</h5>
            <button class="btn-close"
                wire:click="$set('addPage', false); $set('editPage', false)">
            </button>
        </div>

        <div class="offcanvas-body">
            @if ($addPage)
                @include('mobil.create')
            @endif

            @if ($editPage)
                @include('mobil.edit')
            @endif
        </div>
    </div>

    @if ($addPage || $editPage)
        <div class="offcanvas-backdrop fade show"
            wire:click="$set('addPage', false); $set('editPage', false)">
        </div>
    @endif
</div>
