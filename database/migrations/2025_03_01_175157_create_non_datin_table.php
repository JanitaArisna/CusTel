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
        Schema::create('non_datin', function (Blueprint $table) {
            $table->id();
            $table->string('cca');
            $table->string('snd');
            $table->unique('snd');
            $table->string('snd_g');
            $table->string('ncli');
            $table->string('nama');
            $table->text('alamat');
            $table->string('sto');
            $table->string('segment_non');
            $table->string('produk');
            $table->string('desc_newbill');
            $table->string('bundling');
            $table->date('start');
            $table->date('end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_datin');
    }
};
