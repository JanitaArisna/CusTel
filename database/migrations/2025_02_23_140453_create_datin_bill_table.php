<?php

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
        Schema::create('datin_bill', function (Blueprint $table) {
            $table->id();
            $table->integer('sid');
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
            $table->year('tahun'); // Menggunakan tipe data year untuk tahun
            $table->timestamps();

            // Menambahkan constraint unik untuk kombinasi sid + tahun
            $table->unique(['sid', 'tahun']);

            // Menambahkan foreign key
            $table->foreign('sid')->references('sid')->on('datin')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datin_bill');
    }
};

