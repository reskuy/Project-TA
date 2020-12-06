<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\Models\JenisPekerjaan;
use Illuminate\Http\Request;

class JenisPekerjaanController extends Controller
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
        return JenisPekerjaan::all();
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
        $jp = new JenisPekerjaan;
        $jp->Kode = $request->Kode;
        $jp->Nama = $request->Nama;
        $jp->GrupPekerjaan = $request->GrupPekerjaan;
        $jp->GrupKendaraan = $request->GrupKendaraan;
        $jp->HargaJualDefault = $request->HargaJualDefault;
        $jp->HargaBeliDefault = $request->HargaBeliDefault;

        if ($this->user->jenis_pekerjaan()->save($jp)){
            return response()->json([
                "status" => true,
                "jenis perkerjaan" => $jp
            ]);
        }

        else {
            return response()->json([
                "status" => false,
                "message" => "gagal save"
            ], 500);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisPekerjaan  $jenisPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(JenisPekerjaan $jenisPekerjaan, $id)
    {
        $jp = JenisPekerjaan::find($id);
        return $jp;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisPekerjaan  $jenisPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisPekerjaan $jenisPekerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisPekerjaan  $jenisPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisPekerjaan $jenisPekerjaan,$id)
    {
        $this->validate($request, [
            "Kode" => "required",
            "Nama" => "required",
            "GrupPekerjaan" => "required",
            "GrupKendaraan" => "required",
            "HargaBeliDefault" => "required",
        ]);
        $jp = JenisPekerjaan::find($id);
        $jp->Kode = $request->Kode;
        $jp->Nama = $request->Nama;
        $jp->GrupPekerjaan = $request->GrupPekerjaan;
        $jp->GrupKendaraan = $request->GrupKendaraan;
        $jp->HargaJualDefault = $request->HargaJualDefault;
        $jp->HargaBeliDefault = $request->HargaBeliDefault;

        if($this->user->jenis_pekerjaan()->save($jp)){
            return response()->json([
                "status"=>true,
                "jenis pekerjaan"=>$jp
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
     * @param  \App\Models\JenisPekerjaan  $jenisPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisPekerjaan $jenisPekerjaan,$id)
    {
        $jp = JenisPekerjaan::find($id);
        if ($jp->delete()){
            return response()->json([
                "status"=> true,
                "jenis pekerjaan"=> $jp
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
