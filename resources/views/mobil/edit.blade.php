<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Update Mobil</h6>
                <form>
                    <div class="mb-4 text-center">
                        <label class="form-label d-block small fw-bold text-muted">Foto Saat Ini</label>
                        @if($Foto && !is_string($Foto))
                            <img src="{{ $Foto->temporaryUrl() }}" class="img-fluid rounded shadow-sm" style="max-height: 150px; border: 2px solid #0d6efd;">
                        @elseif($data_lama_foto)
                            <img src="{{ asset('storage/mobil/'. $data_lama_foto) }}" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                        @else
                            <div class="py-3 bg-white border rounded small text-muted">Tidak ada foto</div>
                        @endif
                    </div>

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
                        <label for="Foto" class="form-label">Ganti Foto Mobil (Opsional)</label>
                        <input type="file" class="form-control" wire:model="Foto" id="Foto">
                        <div wire:loading wire:target="Foto" class="text-primary small mt-1">Mengunggah...</div>
                        @error('Foto')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="button" wire:click="update" class="btn btn-primary py-2 fw-bold">Update Data Mobil</button>
                        <button type="button" 
                                class="btn btn-outline-secondary py-2" 
                                data-bs-dismiss="offcanvas" 
                                wire:click="$set('editPage', false)">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>