<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\Models\PurchaseOrders;
use Illuminate\Http\Request;

class PurchaseOrdersController extends Controller
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
        return PurchaseOrders::all();
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
        $po = new PurchaseOrders;
        $po->KodeNota = $request->KodeNota;
        $po->Tanggal = $request->Tanggal;
        $po->NamaSupplier = $request->NamaSupplier;
        $po->TanggalKirim = $request->TanggalKirim;
        $po->Status = $request->Status;
        $po->Total = $request->Total;
        $po->Diskon = $request->Diskon;
        $po->DPP = $request->DPP;
        $po->PPn = $request->PPn;
        $po->TotalBayar = $request->TotalBayar;
        $po->Keterangan = $request->Keterangan;
        $po->Referensi = $request->Referensi;
        $po->NomorRangka = $request->NomorRangka;
        $po->NomorPolisi = $request->NomorPolisi;
        $po->NomorWO = $request->NomorWO;
        $po->BillFrom = $request->BillFrom;
        $po->SellFrom = $request->SellFrom;
        $po->PaymentTerm = $request->PaymentTerm;
        $po->MataUang = $request->MataUang;
        $po->Kurs = $request->Kurs;
        $po->Apply = $request->Apply;

        if ($this->user->purchase_orders()->save($po)) {
            return response()->json([
                "status"=>  true,
                "purchase orders" => $po
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
     * @param  \App\Models\PurchaseOrders  $purchaseOrders
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrders $purchaseOrders, $id)
    {
        $purchaseOrders = PurchaseOrders::find($id);
        return $purchaseOrders;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrders  $purchaseOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrders $purchaseOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrders  $purchaseOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrders $purchaseOrders, $id)
    {
        $this->validate($request, [
            "KodeNota" => "required",
            "Tanggal" => "required",
            "NamaSupplier" => "required",
            "TanggalKirim" => "required",
            "Status" => "required",
            "Total" => "required",
            "Diskon" => "required",
            "DPP" => "required",
            "PPn" => "required",
            "TotalBayar" => "required",
            "Keterangan" => "required",
            "Referensi" => "required",
            "NomorRangka" => "required",
            "NomorPolisi" => "required",
            "NomorWO" => "required",
            "BillFrom" => "required",
            "SellFrom" => "required",
            "PaymentTerm" => "required",
            "MataUang" => "required",
            "Kurs" => "required",
            "Apply" => "required",
        ]);
        $po = PurchaseOrders::find($id);
        $po->KodeNota = $request->KodeNota;
        $po->Tanggal = $request->Tanggal;
        $po->NamaSupplier = $request->NamaSupplier;
        $po->TanggalKirim = $request->TanggalKirim;
        $po->Status = $request->Status;
        $po->Total = $request->Total;
        $po->Diskon = $request->Diskon;
        $po->DPP = $request->DPP;
        $po->PPn = $request->PPn;
        $po->TotalBayar = $request->TotalBayar;
        $po->Keterangan = $request->Keterangan;
        $po->Referensi = $request->Referensi;
        $po->NomorRangka = $request->NomorRangka;
        $po->NomorPolisi = $request->NomorPolisi;
        $po->NomorWO = $request->NomorWO;
        $po->BillFrom = $request->BillFrom;
        $po->SellFrom = $request->SellFrom;
        $po->PaymentTerm = $request->PaymentTerm;
        $po->MataUang = $request->MataUang;
        $po->Kurs = $request->Kurs;
        $po->Apply = $request->Apply;

        if ($this->user->purchase_orders()->save($po)) {
            return response()->json([
                "status"=>true,
                "purchase order"=>$po
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
     * @param  \App\Models\PurchaseOrders  $purchaseOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrders $purchaseOrders,$id)
    {
        $purchaseOrders = PurchaseOrders::find($id);
        if ($purchaseOrders->delete()){
            return response()->json([
                "status"=> true,
                "Purchase Orders"=> $purchaseOrders
            ]);
        }else {
            return response()->json([
                "status"=> false,
                "Message"=> "gagal delete"
            ]);
        }
    }
}
