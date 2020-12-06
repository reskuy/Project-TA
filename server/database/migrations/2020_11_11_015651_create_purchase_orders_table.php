<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('KodeNota');
            $table->string('Tanggal');
            $table->string('NamaSupplier');
            $table->string('TanggalKirim');
            $table->string('Status');
            $table->string('Total');
            $table->string('Diskon');
            $table->string('DPp');
            $table->string('PPn');
            $table->string('TotalBayar');
            $table->string('Keterangan');
            $table->string('Referensi');
            $table->string('NomorRangka');
            $table->string('NomorPolisi');
            $table->string('NomorWO');
            $table->string('BillFrom');
            $table->string('SellFrom');
            $table->string('PaymentTerm');
            $table->string('MataUang');
            $table->string('Kurs');
            $table->string('Apply');
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
        Schema::dropIfExists('purchase_orders');
    }
}
