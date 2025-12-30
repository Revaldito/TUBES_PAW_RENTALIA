@section('title', 'Transaksi')

<div class="container-fluid pt-4 px-4" wire:poll.1s="updateTimer">
    <div class="row g-4">
        <div class="col-xl-7">
            <div class="bg-light rounded p-4 h-100 shadow-sm">
                <h5 class="mb-4">Informasi Pemesan</h5>
                
                @if(!$isShowPayment)
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="fa fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form wire:submit.prevent="store">
                        <div class="mb-3">
                            <label class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" wire:model="Nama" placeholder="Masukkan nama lengkap">
                            @error('Nama') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No Telepon</label>
                                <input type="text" class="form-control" wire:model="No_telp" placeholder="Contoh: 0812xxxx">
                                @error('No_telp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Sewa</label>
                                <input type="date" class="form-control" wire:model="Tanggal_pesan" min="{{ date('Y-m-d') }}">
                                @error('Tanggal_pesan') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <input type="text" class="form-control" wire:model="Alamat">
                            @error('Alamat') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Lama Sewa (Hari)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" wire:model="Lama_sewa" wire:input="hitung" min="1">
                                <span class="input-group-text">Hari</span>
                            </div>
                            @error('Lama_sewa') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="bg-white p-3 rounded border mb-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Estimasi Total Pembayaran:</span>
                                <h4 class="mb-0 text-primary fw-bold">@rupiah($Total)</h4>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                            <i class="fa fa-check-circle me-2"></i> Konfirmasi Sewa Sekarang
                        </button>
                    </form>
                @else
                    {{-- Bagian Tampilan Payment Sesuai Kode Asli Anda --}}
                    <div class="text-center py-5">
                        @if($sisaWaktu === '00:00')
                            <div class="mb-4">
                                <i class="fa fa-times-circle text-danger" style="font-size: 5rem;"></i>
                            </div>
                            <h4 class="fw-bold text-danger">Waktu Pembayaran Habis!</h4>
                            <p class="text-muted">Pesanan Anda telah dibatalkan otomatis karena melebihi batas waktu 10 menit.</p>
                            <hr class="my-4">
                            <a href="/" class="btn btn-primary shadow-sm">
                                <i class="fa fa-car me-2"></i> Cari Mobil Lain
                            </a>
                        @else
                            <div class="mb-4">
                                <i class="fa fa-check-circle text-success" style="font-size: 5rem;"></i>
                            </div>
                            <h4 class="fw-bold">Pesanan Berhasil Dibuat!</h4>
                            <p class="text-muted">Silakan selesaikan pembayaran melalui QRIS agar admin dapat memproses sewa Anda.</p>
                            <hr class="my-4">
                            <button class="btn btn-outline-primary" onclick="window.location.reload()">
                                <i class="fa fa-sync me-2"></i> Cek Status Pembayaran
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                @if(!$isShowPayment)
                    <img src="{{ asset('storage/mobil/' . $mobil->Foto) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body bg-light p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="card-title mb-0 fw-bold">{{ $mobil->Merk }}</h4>
                            <span class="badge bg-success">Tersedia</span>
                        </div>
                        <p class="text-muted mb-3 small"><i class="fa fa-car me-1"></i> {{ $mobil->Jenis }} • <i class="fa fa-users me-1"></i> {{ $mobil->Kapasitas }} Kursi</p>
                        
                        {{-- PENAMBAHAN INFO TANGGAL BOOKING --}}
                        <div class="mb-3 p-3 bg-white rounded border border-warning shadow-sm">
                            <h6 class="fw-bold small mb-2 text-uppercase text-danger"><i class="fa fa-calendar-times me-1"></i> Tanggal Sudah Dipesan:</h6>
                            <div style="max-height: 80px; overflow-y: auto;">
                                @forelse($bookedDates as $date)
                                    <span class="badge bg-danger mb-1">{{ \Carbon\Carbon::parse($date)->format('d M') }}</span>
                                @empty
                                    <span class="text-success small">Belum ada pesanan, silakan pilih tanggal mana saja.</span>
                                @endforelse
                            </div>
                        </div>

                        <div class="p-3 bg-white rounded border">
                            <h6 class="fw-bold small mb-2 text-uppercase">Ringkasan Sewa:</h6>
                            <div class="d-flex justify-content-between small mb-1">
                                <span>Harga Sewa</span>
                                <span>@rupiah($mobil->Harga) x {{ $Lama_sewa ?? 0 }} Hari</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold border-top pt-2 mt-2">
                                <span>Total Tagihan</span>
                                <span class="text-primary">@rupiah($Total)</span>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Bagian Tampilan Payment Sesuai Kode Asli Anda --}}
                    <div class="{{ $sisaWaktu === '00:00' ? 'bg-secondary' : 'bg-primary' }} p-3 text-center text-white">
                        <small class="opacity-75">ID Transaksi</small>
                        <h6 class="mb-0 fw-bold">#TRX-{{ $transaksiId }}</h6>
                    </div>
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">
                                {{ $sisaWaktu === '00:00' ? 'Status Pembayaran' : 'Selesaikan Dalam' }}
                            </small>
                            <h3 class="fw-bold {{ $sisaWaktu === '00:00' ? 'text-danger' : 'text-dark' }} font-monospace mb-0">
                                {{ $sisaWaktu }}
                            </h3>
                        </div>
                        <div class="p-2 bg-light rounded-4 mb-3 border border-dashed d-inline-block shadow-sm">
                            <div class="position-relative">
                                <img src="{{ asset('img/qris_cipung.jpeg') }}" class="img-fluid rounded-3" style="max-width: 200px; {{ $sisaWaktu === '00:00' ? 'filter: grayscale(1); opacity: 0.3;' : '' }}">
                                @if($sisaWaktu === '00:00')
                                    <div class="position-absolute top-0 start-0 w-100 h-100 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(255,255,255,0.7);">
                                        <span class="badge bg-danger shadow-sm px-3 py-2">KADALUARSA</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($sisaWaktu !== '00:00')
                            <div class="bg-white border p-3 rounded-3 mb-4">
                                <small class="text-muted d-block mb-1">Total yang harus dibayar:</small>
                                <h4 class="fw-bold text-primary mb-0">@rupiah($Total)</h4>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>