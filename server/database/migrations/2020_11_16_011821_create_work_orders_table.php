<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('KodeNota');
            $table->string('Tanggal');
            $table->string('JenisWorkOrder');
            $table->string('Lokasi');
            $table->string('Pelanggan');
            $table->string('NamaPelanggan');
            $table->string('NamaPemilik');
            $table->string('NamaKendaraan');
            $table->string('Lessor');
            $table->string('NomorPolisi');
            $table->string('NomorRangka');
            $table->string('NomorMesin');
            $table->string('Odometer');
            $table->string('Status');
            $table->string('KeteranganStatus');
            $table->string('Keterangan');
            $table->string('Saran');
            $table->string('PaymentTerm');
            $table->string('Total');
            $table->string('Diskon');
            $table->string('DPP');
            $table->string('PPn');
            $table->string('PPnPersen');
            $table->string('PPnPersenManual');
            $table->string('TotalBayar');
            $table->string('Terbayar');
            $table->string('SisaBayar');
            $table->string('MataUang');
            $table->string('Kurs');
            $table->string('Referensi');
            $table->string('IsClose');
            $table->string('JumlahCetak');
            $table->string('SudahInvoice');
            $table->string('SudahDeductible');
            $table->string('Penawaran');
            $table->string('Persetujuan');
            $table->string('TglSPK');
            $table->string('TglTerimaSPK');
            $table->string('KeteranganWIP');
            $table->string('Coding');
            $table->string('JenisKerusakan');
            $table->string('ProgressPengerjaan');
            $table->string('DetailProgress');
            $table->string('PICSite');
            $table->string('Surveyor');
            $table->string('TglDOL');
            $table->string('NoPolisAsuransi');
            $table->string('NoRegistrasi');
            $table->string('Remarks');
            $table->string('RemarksSCM');
            $table->string('PICSCM1');
            $table->string('PICSCM2');
            $table->string('ReserveOutcome');
            $table->string('AvailableBudget');
            $table->string('RFU');
            $table->string('CekList');
            $table->string('Adjuster');
            $table->string('PICAdj');
            $table->string('Broker');
            $table->string('PICBroker');
            $table->string('KeteranganProgressClaim');
            $table->string('PIC');
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
        Schema::dropIfExists('work_orders');
    }
}
