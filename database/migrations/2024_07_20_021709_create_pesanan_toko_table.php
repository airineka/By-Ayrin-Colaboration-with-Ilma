<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTokoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan_toko', function (Blueprint $table) {
            $table->id();
            $table->foreignId('toko_id')->constrained()->onDelete('cascade');
            $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->foreign('toko_id')->references('id')->on('toko')->onDelete('cascade');
            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_toko');
    }
};
