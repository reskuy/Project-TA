<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekrInvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekr_invs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_pekerjaan');
            $table->string('kode')->nullable();
            $table->string('perkiraan')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('rasio')->nullable();
            $table->float('harga')->nullable();
            $table->float('diskon')->nullable();
            $table->float('diskonRp')->nullable();
            $table->float('subtotal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pekr_invs');
    }
}
