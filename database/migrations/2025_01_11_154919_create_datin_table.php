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
        Schema::create('datin', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('acc_num');
            $table->string('cust_nm');
            $table->integer('nipnas');
            $table->string('segment_id');
            $table->string('witel');
            $table->integer('sid');
            $table->unique('sid');
            $table->string('layanan_id');
            $table->integer('bw');
            $table->string('kontrak');
            $table->date('start');
            $table->date('end');
            $table->string('am_nm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datin');
    }
};
