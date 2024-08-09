<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPesananTokoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesanan_toko', function (Blueprint $table) {
            //
            if (Schema::hasTable('tokos')){
                $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pesanan_toko', function (Blueprint $table) {
            //
            $table->dropForeign(['toko_id']);
        });
    }
};
