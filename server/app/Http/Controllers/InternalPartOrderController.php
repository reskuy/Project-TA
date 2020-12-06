<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\Models\InternalPartOrder;
use Illuminate\Http\Request;

class InternalPartOrderController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user =JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InternalPartOrder::all();
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
        $ipo = new InternalPartOrder;
        $ipo->KodeNota = $request->KodeNota;
        $ipo->NoWorkOrder = $request->NoWorkOrder;
        $ipo->Tanggal = $request->Tanggal;
        $ipo->JenisWorkOrder = $request->JenisWorkOrder;
        $ipo->NomorPolisi = $request->NomorPolisi;
        $ipo->TipeKendaraan = $request->TipeKendaraan;
        $ipo->Warna = $request->Warna;
        $ipo->Keterangan = $request->Keterangan;
        $ipo->KeteranganStatus = $request->KeteranganStatus;
        $ipo->Terpenuhi = $request->Terpenuhi;

        if ($this->user->internalpartorder()->save($ipo)) {
            return response()->json([
                "status" => true,
                "internal part order" => $ipo
            ]);
        }else {
            return response()->json([
                "status" => false,
                "message" => "gagal save"
            ], 500);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InternalPartOrder  $internalPartOrder
     * @return \Illuminate\Http\Response
     */
    public function show(InternalPartOrder $internalPartOrder, $id)
    {
        $ipo = InternalPartOrder::find($id);
        return $ipo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InternalPartOrder  $internalPartOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(InternalPartOrder $internalPartOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternalPartOrder  $internalPartOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternalPartOrder $internalPartOrder, $id)
    {
        $this->validate($request, [
            "KodeNota" => "required",
            "NoWorkOrder" => "required",
            "Tanggal" => "required",
            "JenisWorkOrder" => "required",
            "NomorPolisi" => "required",
        ]);
        $ipo = InternalPartOrder::find($id);
        $ipo->KodeNota = $request->KodeNota;
        $ipo->NoWorkOrder = $request->NoWorkOrder;
        $ipo->Tanggal = $request->Tanggal;
        $ipo->JenisWorkOrder = $request->JenisWorkOrder;
        $ipo->NomorPolisi = $request->NomorPolisi;
        $ipo->TipeKendaraan = $request->TipeKendaraan;
        $ipo->Warna = $request->Warna;
        $ipo->Keterangan = $request->Keterangan;
        $ipo->KeteranganStatus = $request->KeteranganStatus;
        $ipo->Terpenuhi = $request->Terpenuhi;
        
        if($this->user->InternalPartOrder()->save($ipo)){
            return response()->json([
                "status"=>true,
                "InternalPartOrder"=>$ipo
            ]);
        }else{
            return response()->json([
                "status"=>false,
                "Message"=>"gagal update"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternalPartOrder  $internalPartOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternalPartOrder $internalPartOrder)
    {
        $ipo = InternalPartOrder::find($id);
        if ($ipo->delete()){
            return response()->json([
                "status"=> true,
                "InternalPartOrder"=> $ipo
            ]);
        }
        
        else {
            return response()->json([
                "status"=> false,
                "Message"=> "gagal delete"
            ]);
        }
    }
}
