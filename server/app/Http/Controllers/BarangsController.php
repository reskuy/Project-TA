<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\Models\Barangs;
use Illuminate\Http\Request;

class BarangsController extends Controller
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
        //
        return Barangs::all();
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
        //
        $this->validate($request, [
            "Kode" => "required",
            "Nama" => "required",
            "Merk" => "required",
            "Kategori" => "required",
            "PartNumber1" => "required",
            "PartNumber2" => "required",
            "Kendaraan" => "required",
            "KdSupplier" => "required",
            "Dimensi" => "required",
            "Aktif" => "required",
            "Gudang" => "required",
            "StokMin" => "required",
            "StokMaks" => "required",
        ]);
        $barang = new Barangs;
        $barang->Kode = $request->Kode;
        $barang->Nama = $request->Nama;
        $barang->Merk= $request->Merk;
        $barang->Kategori = $request->Kategori;
        $barang->PartNumber1 = $request->PartNumber1;
        $barang->PartNumber2 = $request->PartNumber2;
        $barang->Kendaraan = $request->Kendaraan;
        $barang->KdSupplier = $request->KdSupplier;
        $barang->Dimensi = $request->Dimensi;
        $barang->Aktif = $request->Aktif;
        $barang->Gudang = $request->Gudang;
        $barang->StokMin = $request->StokMin;
        $barang->StokMaks = $request->StokMaks;
        $barang->Memo = $request->Memo;
        $barang->Rasio = $request->Rasio;
        $barang->MataUang = $request->MataUang;
        $barang->StockOnHand = $request->StockOnHand;
        $barang->TanggalHargaJual = $request->TanggalHargaJual;
        $barang->TanggalHargaBeli = $request->TanggalHargaBeli;
        $barang->HargaJual = $request->HargaJual;
        $barang->HargaBeli = $request->HargaBeli;
        $barang->DiskonHargaBeli = $request->DiskonHargaBeli;
        if ($this->user->barangs()->save($barang)){
            return response()->json([
                "status" =>true, 
                "barang" => $barang
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
     * @param  \App\Models\Barangs  $barangs
     * @return \Illuminate\Http\Response
     */
    public function show(Barangs $barangs, $id)
    {
        //
        $barangs = Barangs::find($id);
        return $barangs;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barangs  $barangs
     * @return \Illuminate\Http\Response
     */
    public function edit(Barangs $barangs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barangs  $barangs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barangs $barangs, $id)
    {
        $this->validate($request, [
            "Kode" => "required",
            "Nama" => "required",
            "Merk" => "required",
            "Kategori" => "required",
            "PartNumber1" => "required",
            "PartNumber2" => "required",
            "Kendaraan" => "required",
            "KdSupplier" => "required",
            "Dimensi" => "required",
            "Aktif" => "required",
            "Gudang" => "required",
            "StokMin" => "required",
            "StokMaks" => "required",
        ]);
        $barang = Barangs::find($id);
        $barang->Kode = $request->Kode;
        $barang->Nama = $request->Nama;
        $barang->Merk= $request->Merk;
        $barang->Kategori = $request->Kategori;
        $barang->PartNumber1 = $request->PartNumber1;
        $barang->PartNumber2 = $request->PartNumber2;
        $barang->Kendaraan = $request->Kendaraan;
        $barang->KdSupplier = $request->KdSupplier;
        $barang->Dimensi = $request->Dimensi;
        $barang->Aktif = $request->Aktif;
        $barang->Gudang = $request->Gudang;
        $barang->StokMin = $request->StokMin;
        $barang->StokMaks = $request->StokMaks;
        $barang->Memo = $request->Memo;
        $barang->Rasio = $request->Rasio;
        $barang->MataUang = $request->MataUang;
        $barang->StockOnHand = $request->StockOnHand;
        $barang->TanggalHargaJual = $request->TanggalHargaJual;
        $barang->TanggalHargaBeli = $request->TanggalHargaBeli;
        $barang->HargaJual = $request->HargaJual;
        $barang->HargaBeli = $request->HargaBeli;
        $barang->DiskonHargaBeli = $request->DiskonHargaBeli;
        
        if($this->user->Barangs()->save($barang)){
            return response()->json([
                "status"=>true,
                "barangs"=> $barang
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
     * @param  \App\Models\Barangs  $barangs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barangs $barangs, $id)
    {
        $barangs = Barangs::find($id);
        if ($barangs->delete()){
            return response()->json([
                "status"=> true,
                "barangs"=> $barangs
            ]);
        } else {
            return response()->json([
                "status"=> false,
                "Message"=> "gagal delete"
            ]);
        }
    }
}
