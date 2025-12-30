<div class="container-fluid pt-3"> <div class="row">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tambah Mobil</h6>
                <form>
                    <div class="mb-3">
                        <label for="Plat_nomor" class="form-label">Plat Nomor</label>
                        <input type="text" class="form-control" wire:model="Plat_nomor" id="Plat_nomor">
                        @error('Plat_nomor')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="Merk" class="form-label">Merk</label>
                        <input type="text" class="form-control" wire:model="Merk" id="Merk">
                        @error('Merk')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="Jenis" class="form-label">Jenis Mobil</label>
                        <select class="form-select" wire:model="Jenis">
                            <option value="">--Pilih--</option>
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                            <option value="LCGC">LCGC</option>
                            <option value="MPV">MPV</option>
                        </select>
                        @error('Jenis')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="Kapasitas" class="form-label">Kapasitas</label>
                        <input type="text" class="form-control" wire:model="Kapasitas" id="kapasitas">
                        @error('Kapasitas')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="Harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" wire:model="Harga" id="Harga">
                        @error('Harga')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="Foto" class="form-label">Foto Mobil</label>
                        <input type="file" class="form-control" wire:model="Foto" id="Foto">
                        @error('Foto')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="button" wire:click="store" class="btn btn-primary py-2">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>