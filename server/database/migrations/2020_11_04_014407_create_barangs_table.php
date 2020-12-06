<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('Kode');
            $table->string('Nama');
            $table->string('Merk');
            $table->string('Kategori');
            $table->string('PartNumber1');
            $table->string('PartNumber2');
            $table->string('Kendaraan');
            $table->string('KdSupplier');
            $table->string('Dimensi');
            $table->string('Aktif');
            $table->string('Gudang');
            $table->string('StokMin');
            $table->string('StokMaks');
            $table->string('Memo');
            $table->string('Rasio');
            $table->string('MataUang');
            $table->string('StockOnHand');
            $table->string('TanggalHargaJual');
            $table->string('HargaJual');
            $table->string('TanggalHargaBeli');
            $table->string('HargaBeli');
            $table->string('DiskonHargaBeli');
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
        Schema::dropIfExists('barangs');
    }
}
