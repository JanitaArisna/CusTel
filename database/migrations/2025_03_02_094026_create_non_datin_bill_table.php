<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('non_datin_bill', function (Blueprint $table) {
            $table->id();
            $table->string('snd'); // Relasi dengan non_datin
            $table->decimal('januari', 10, 2)->nullable();
            $table->decimal('februari', 10, 2)->nullable();
            $table->decimal('maret', 10, 2)->nullable();
            $table->decimal('april', 10, 2)->nullable();
            $table->decimal('mei', 10, 2)->nullable();
            $table->decimal('juni', 10, 2)->nullable();
            $table->decimal('juli', 10, 2)->nullable();
            $table->decimal('agustus', 10, 2)->nullable();
            $table->decimal('september', 10, 2)->nullable();
            $table->decimal('oktober', 10, 2)->nullable();
            $table->decimal('november', 10, 2)->nullable();
            $table->decimal('desember', 10, 2)->nullable();
            $table->integer('tahun'); // Gunakan integer untuk tahun
            $table->timestamps();

            // Tambahkan unique constraint untuk memastikan hanya satu tagihan per snd dan tahun
            $table->unique(['snd', 'tahun']);

            // Foreign key untuk memastikan snd di non_datin_bill terhubung ke snd di non_datin
            $table->foreign('snd')->references('snd')->on('non_datin')->onDelete('cascade'); // Tambahkan foreign key untuk snd
        });
    }

    /**
     * Reverse migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_datin_bill');
    }
};
