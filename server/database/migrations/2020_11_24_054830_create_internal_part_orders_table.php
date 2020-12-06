<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalPartOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_part_orders', function (Blueprint $table) {
            $table->id();
            $table->string('KodeNota');
            $table->string('NoWorkOrder');
            $table->string('Tanggal');
            $table->string('JenisWorkOrder');
            $table->string('NomorPolisi');
            $table->string('TipeKendaraan');
            $table->string('Warna');
            $table->string('Keterangan');
            $table->string('KeteranganStatus');
            $table->string('Terpenuhi');
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
        Schema::dropIfExists('internal_part_orders');
    }
}
