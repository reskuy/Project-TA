<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('Kode');
            $table->string('Nama');
            $table->string('BillFrom');
            $table->string('SellFrom');
            $table->string('BadanHukum');
            $table->string('Alamat');
            $table->string('Kota');
            $table->string('KodePos');
            $table->string('Negara');
            $table->string('Telp');
            $table->string('Fax');
            $table->string('Email');
            $table->string('ContactPerson');
            $table->string('GrupSupplier');
            $table->string('Aktif');
            $table->string('KreditLimit');
            $table->string('LamaKredit');
            $table->string('Memo');
            $table->string('NPWP');
            $table->string('NPPKP');
            $table->string('TglPengukuhan');
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
        Schema::dropIfExists('suppliers');
    }
}
