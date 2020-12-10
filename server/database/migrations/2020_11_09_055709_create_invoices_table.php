<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('kd_nota')->unique();
            $table->string('jenis_wo');
            $table->string('lokasi')->nullable();
            $table->string('ket_wo')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('no_polisi')->nullable();
            $table->string('odometer')->nullable();
            $table->string('status')->nullable();
            $table->string('ket_status')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('saran')->nullable();
            $table->string('no_wo')->nullable();
            $table->string('payment_term')->nullable();
            $table->double('total')->nullable();
            $table->float('diskon')->nullable();
            $table->double('dpp')->nullable();
            $table->float('ppn')->nullable();
            $table->float('ppn_persen')->nullable();
            $table->float('ppn_persen_manual')->nullable();
            $table->float('onrisk')->nullable();
            $table->double('total_byr')->nullable();
            $table->float('nett')->nullable();
            $table->float('terbayar')->nullable();
            $table->float('kass')->nullable();
            $table->double('kttg')->nullable();
            $table->double('ddtb')->nullable();
            $table->float('kppn')->nullable();
            $table->float('kexc')->nullable();
            $table->float('kund')->nullable();
            $table->string('mata_uang')->nullable();
            $table->float('kurs')->nullable();
            $table->string('refrensi')->nullable();
            $table->string('ket_penagihan')->nullable();
            $table->string('pic')->nullable();
            $table->string('info_pemilik')->nullable();
            $table->date('tgl_kirim')->nullable();
            $table->date('tgl_konfirmTerima')->nullable();
            $table->string('no_resi')->nullable();
            $table->integer('jml_cetak')->nullable();
            $table->date('tgl_msk')->nullable();
            $table->date('tgl_klr')->nullable();
            $table->boolean('writeoff')->nullable();
            $table->string('pelanggan')->nullable();
            $table->string('sellto')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
