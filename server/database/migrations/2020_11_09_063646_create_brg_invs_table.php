<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrgInvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brg_invs', function (Blueprint $table) {
            $table->id();
            $table->boolean('brg_bks');
            $table->string('kode')->nullable();
            $table->string('barang')->nullable();
            $table->string('nama')->nullable();
            $table->string('part_number1')->nullable();
            $table->string('merk')->nullable();
            $table->string('kendaraan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan')->nullable();
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
        Schema::dropIfExists('brg_invs');
    }
}
