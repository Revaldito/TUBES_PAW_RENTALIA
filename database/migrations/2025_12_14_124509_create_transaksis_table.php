<?php

use App\Models\Mobil;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Mobil::class);
            $table->string('Nama')->nullable();
            $table->string('No_telp')->nullable();
            $table->string('Alamat')->nullable();
            $table->integer('Lama_sewa')->nullable(); // Ubah ke integer agar mudah dihitung
            $table->date('Tanggal_pesan')->nullable(); // Gunakan Tanggal_pesan secara konsisten
            $table->bigInteger('Total')->nullable();
            // Samakan dengan status yang ada di gambar Kelola Transaksi
            $table->enum('Status', ['Menunggu Pembayaran', 'Sedang Disewa', 'Selesai', 'Dibatalkan'])->default('Menunggu Pembayaran');
            $table->timestamp('expired_at')->nullable();
            $table->string('qris_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
