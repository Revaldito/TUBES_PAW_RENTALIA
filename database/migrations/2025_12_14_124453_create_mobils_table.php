<?php

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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('Plat_nomor')->nullable();
            $table->string('Merk')->nullable();
            $table->enum('Jenis', ['Sedan', 'SUV', 'LCGC', 'MPV'])->nullable();
            $table->string('Kapasitas')->nullable();
            $table->string('Harga')->nullable();
            $table->text('Foto')->nullable();
            $table->timestamps();
            $table->softDeletes('Deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
