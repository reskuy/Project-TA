<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\Models\WorkOrders;
use Illuminate\Http\Request;

class WorkOrdersController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WorkOrders::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wo = new WorkOrders;
        $wo->KodeNota = $request->KodeNota;
        $wo->Tanggal = $request->Tanggal;
        $wo->JenisWorkOrder = $request->JenisWorkOrder;
        $wo->Lokasi = $request->Lokasi;
        $wo->Pelanggan = $request->Pelanggan;
        $wo->NamaPelanggan = $request->NamaPelanggan;
        $wo->NamaPemilik = $request->NamaPemilik;
        $wo->NamaKendaraan = $request->NamaKendaraan;
        $wo->Lessor = $request->Lessor;
        $wo->NomorPolisi = $request->NomorPolisi;
        $wo->NomorRangka = $request->NomorRangka;
        $wo->NomorMesin = $request->NomorMesin;
        $wo->Odometer = $request->Odometer;
        $wo->Status = $request->Status;
        $wo->KeteranganStatus = $request->KeteranganStatus;
        $wo->Keterangan = $request->Keterangan;
        $wo->Saran = $request->Saran;
        $wo->PaymentTerm = $request->PaymentTerm;
        $wo->Total = $request->Total;
        $wo->Diskon = $request->Diskon;
        $wo->DPP = $request->DPP;
        $wo->PPn = $request->PPn;
        $wo->PPnPersen = $request->PPnPersen;
        $wo->PPnPersenManual = $request->PPnPersenManual;
        $wo->TotalBayar = $request->TotalBayar;
        $wo->Terbayar = $request->Terbayar;
        $wo->SisaBayar = $request->SisaBayar;
        $wo->MataUang = $request->MataUang;
        $wo->Kurs = $request->Kurs;
        $wo->Referensi = $request->Referensi;
        $wo->IsClose = $request->IsClose;
        $wo->JumlahCetak = $request->JumlahCetak;
        $wo->SudahInvoice = $request->SudahInvoice;
        $wo->SudahDeductible = $request->SudahDeductible;
        $wo->Penawaran = $request->Penawaran;
        $wo->Persetujuan = $request->Persetujuan;
        $wo->TglSPK = $request->TglSPK;
        $wo->TglTerimaSPK = $request->TglTerimaSPK;
        $wo->KeteranganWIP = $request->KeteranganWIP;
        $wo->Coding = $request->Coding;
        $wo->JenisKerusakan = $request->JenisKerusakan;
        $wo->ProgressPengerjaan = $request->ProgressPengerjaan;
        $wo->DetailProgress = $request->DetailProgress;
        $wo->PICSite = $request->PICSite;
        $wo->Surveyor = $request->Surveyor;
        $wo->TglDOL = $request->TglDOL;
        $wo->NoPolisAsuransi = $request->NoPolisAsuransi;
        $wo->NoRegistrasi = $request->NoRegistrasi;
        $wo->Remarks = $request->Remarks;
        $wo->RemarksSCM = $request->RemarksSCM;
        $wo->PICSCM1 = $request->PICSCM1;
        $wo->PICSCM2 = $request->PICSCM2;
        $wo->ReserveOutcome = $request->ReserveOutcome;
        $wo->AvailableBudget = $request->AvailableBudget;
        $wo->RFU = $request->RFU;
        $wo->CekList = $request->CekList;
        $wo->Adjuster = $request->Adjuster;
        $wo->PICAdj = $request->PICAdj;
        $wo->Broker = $request->Broker;
        $wo->PICBroker = $request->PICBroker;
        $wo->KeteranganProgressClaim = $request->KeteranganProgressClaim;
        $wo->PIC = $request->PIC;

        if ($this->user->work_orders()->save($wo)) {
            return response()->json([
                "status"=>  true,
                "Work Orders" => $wo
            ]);
        }else{
            return response()->json([
                "status" => false,
                "message" => "gagal save"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOrders  $workOrders
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrders $workOrders)
    {
        $workOrders = WorkOrders::find($id);
        return $workOrders;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrders  $workOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrders $workOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkOrders  $workOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOrders $workOrders,$id)
    {
        $this->validate($request, [
            "KodeNota" => "required",
            "Tanggal" => "required",
        ]);
        $wo = WorkOrders::find($id);
        $wo->KodeNota = $request->KodeNota;
        $wo->Tanggal = $request->Tanggal;
        $wo->JenisWorkOrder = $request->JenisWorkOrder;
        $wo->Lokasi = $request->Lokasi;
        $wo->Pelanggan = $request->Pelanggan;
        $wo->NamaPelanggan = $request->NamaPelanggan;
        $wo->NamaPemilik = $request->NamaPemilik;
        $wo->NamaKendaraan = $request->NamaKendaraan;
        $wo->Lessor = $request->Lessor;
        $wo->NomorPolisi = $request->NomorPolisi;
        $wo->NomorRangka = $request->NomorRangka;
        $wo->NomorMesin = $request->NomorMesin;
        $wo->Odometer = $request->Odometer;
        $wo->Status = $request->Status;
        $wo->KeteranganStatus = $request->KeteranganStatus;
        $wo->Keterangan = $request->Keterangan;
        $wo->Saran = $request->Saran;
        $wo->PaymentTerm = $request->PaymentTerm;
        $wo->Total = $request->Total;
        $wo->Diskon = $request->Diskon;
        $wo->DPP = $request->DPP;
        $wo->PPn = $request->PPn;
        $wo->PPnPersen = $request->PPnPersen;
        $wo->PPnPersenManual = $request->PPnPersenManual;
        $wo->TotalBayar = $request->TotalBayar;
        $wo->Terbayar = $request->Terbayar;
        $wo->SisaBayar = $request->SisaBayar;
        $wo->MataUang = $request->MataUang;
        $wo->Kurs = $request->Kurs;
        $wo->Referensi = $request->Referensi;
        $wo->IsClose = $request->IsClose;
        $wo->JumlahCetak = $request->JumlahCetak;
        $wo->SudahInvoice = $request->SudahInvoice;
        $wo->SudahDeductible = $request->SudahDeductible;
        $wo->Penawaran = $request->Penawaran;
        $wo->Persetujuan = $request->Persetujuan;
        $wo->TglSPK = $request->TglSPK;
        $wo->TglTerimaSPK = $request->TglTerimaSPK;
        $wo->KeteranganWIP = $request->KeteranganWIP;
        $wo->Coding = $request->Coding;
        $wo->JenisKerusakan = $request->JenisKerusakan;
        $wo->ProgressPengerjaan = $request->ProgressPengerjaan;
        $wo->DetailProgress = $request->DetailProgress;
        $wo->PICSite = $request->PICSite;
        $wo->Surveyor = $request->Surveyor;
        $wo->TglDOL = $request->TglDOL;
        $wo->NoPolisAsuransi = $request->NoPolisAsuransi;
        $wo->NoRegistrasi = $request->NoRegistrasi;
        $wo->Remarks = $request->Remarks;
        $wo->RemarksSCM = $request->RemarksSCM;
        $wo->PICSCM1 = $request->PICSCM1;
        $wo->PICSCM2 = $request->PICSCM2;
        $wo->ReserveOutcome = $request->ReserveOutcome;
        $wo->AvailableBudget = $request->AvailableBudget;
        $wo->RFU = $request->RFU;
        $wo->CekList = $request->CekList;
        $wo->Adjuster = $request->Adjuster;
        $wo->PICAdj = $request->PICAdj;
        $wo->Broker = $request->Broker;
        $wo->PICBroker = $request->PICBroker;
        $wo->KeteranganProgressClaim = $request->KeteranganProgressClaim;
        $wo->PIC = $request->PIC;

        if ($this->user->work_orders()->save($wo)) {
            return response()->json([
                "status"=>true,
                "work order"=>$wo
            ]);
        }else{
            return response()->json([
                "status"=>false,
                "message"=> "gagal update"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOrders  $workOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrders $workOrders,$id)
    {
        $workOrders = WorkOrders::find($id);
        if ($workOrders->delete()){
            return response()->json([
                "status"=> true,
                "Work Orders"=> $workOrders
            ]);
        }else {
            return response()->json([
                "status"=> false,
                "Message"=> "gagal delete"
            ]);
        }
    }
}
