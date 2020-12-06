<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
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
        return Suppliers::all();
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
        $supplier = new Suppliers;
        $supplier->Kode = $request->Kode;
        $supplier->Nama = $request->Nama;
        $supplier->BillFrom = $request->BillFrom;
        $supplier->SellFrom = $request->SellFrom;
        $supplier->BadanHukum = $request->BadanHukum;
        $supplier->Alamat = $request->Alamat;
        $supplier->Kota = $request->Kota;
        $supplier->KodePos = $request->KodePos;
        $supplier->Negara = $request->Negara;
        $supplier->Telp = $request->Telp;
        $supplier->Fax = $request->Fax;
        $supplier->Email = $request->Email;
        $supplier->ContactPerson = $request->ContactPerson;
        $supplier->GrupSupplier = $request->GrupSupplier;
        $supplier->Aktif = $request->Aktif;
        $supplier->KreditLimit = $request->KreditLimit;
        $supplier->LamaKredit = $request->LamaKredit;
        $supplier->Memo = $request->Memo;
        $supplier->NPWP = $request->NPWP;
        $supplier->NPPKP = $request->NPPKP;
        $supplier->TglPengukuhan = $request->TglPengukuhan;

        if ($this->user->suppliers()->save($supplier)){
            return response()->json([
                "status" => true,
                "supplier" => $supplier
            ]);
        }

        else {
            return response()->json([
                "status" => false,
                "message" => "gagal save"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers, $id)
    {
        $supplier = Suppliers::find($id);
        return $supplier;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliers $suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $suppliers, $id)
    {
        $this->validate($request, [
            "Kode" => "required",
        ]);
        $supplier = Suppliers::find($id);
        $supplier->Kode = $request->Kode;
        $supplier->Nama = $request->Nama;
        $supplier->BadanHukum = $request->BadanHukum;
        $supplier->Alamat = $request->Alamat;
        $supplier->Kota = $request->Kota;
        $supplier->KodePos = $request->KodePos;
        $supplier->Negara = $request->Negara;
        $supplier->Telp = $request->Telp;
        $supplier->Fax = $request->Fax;
        $supplier->Email = $request->Email;
        $supplier->ContactPerson = $request->ContactPerson;
        $supplier->GrupSupplier = $request->GrupSupplier;
        $supplier->Aktif = $request->Aktif;
        $supplier->KreditLimit = $request->KreditLimit;
        $supplier->LamaKredit = $request->LamaKredit;
        $supplier->Memo = $request->Memo;
        $supplier->NPWP = $request->NPWP;
        $supplier->NPPKP = $request->NPPKP;
        $supplier->TglPengukuhan = $request->TglPengukuhan;

        if($this->user->suppliers()->save($supplier)){
            return response()->json([
                "status"=>true,
                "suppliers"=>$supplier
            ]);
        }

        else {
            return response()->json([
                "status"=>false,
                "Message"=>"gagal update"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers $suppliers, $id)
    {
        $suppliers = Suppliers::find($id);
        if ($suppliers->delete()){
            return response()->json([
                "status"=> true,
                "suppliers"=> $suppliers
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
