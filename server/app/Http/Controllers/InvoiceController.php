<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\Models\Invoice;
use App\Models\BrgInv;
use App\Models\PekrInv;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $user;
    protected $primaryKey = 'invoice_id';
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
        // $p=  Invoice::all();
        // dd($p);
        return Invoice::all();
        // return BrgInv::all();
        // $data = Invoice::get();
        // return InvoiceResource::collection($data);
        // dd(Invoice::all());
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
        $invoice = new Invoice;
        $invoice->kd_nota = $request->kd_nota;
        $invoice->jenis_wo = $request->kd_nota;
        $invoice->lokasi = $request->lokasi;
        $invoice->ket_wo = $request->kd_nota;
        $invoice->nama_pelanggan = $request->pelanggan;
        $invoice->nama_pemilik = $request->pelanggan;
        $invoice->mata_uang = $request->mata_uang;
        // $request->tanggal
        $invoice->kurs = $request->kurs;
        $invoice->pelanggan = $request->pelanggan;
        $invoice->refrensi = $request->refrensi;
        $invoice->no_wo = $request->no_wo;
        $invoice->kass = $request->kass;
        $invoice->no_rangka = $request->no_rangka;
        $invoice->no_mesin = $request->no_mesin;
        $invoice->no_polisi = $request->no_polisi;
        $invoice->odometer = $request->odometer;
        $invoice->payment_term = $request->payment_term;
        $invoice->kttg = $request->kttg;
        $invoice->ddtb = $request->ddtb;
        $invoice->kppn = $request->kppn;
        $invoice->kexc = $request->kexc;
        $invoice->kund = $request->kund;
        $invoice->dpp = $request->dpp;
        $invoice->ppn = $request->ppn;
        $invoice->ppn_persen = $request->ppn_persen;
        $invoice->ppn_persen_manual = $request->ppn_persen;
        $invoice->total_byr = $request->total_byr;

        // $brginv = new brginv;
        //     $brginv->invoice_id = $invoice->id;
        //     $brginv->brg_bks = 1;
        //     $brginv->brg = $request->brg;
        //     $brginv->nama = $request->nama;
            // brginv()->save($brginv);
        
        if ($this->user->invoice()->save($invoice)){
            // foreach ($brg as $key => $value) {
            //     # code...
            // }
            
            // for ($i=0; $i < count($brg); $i++) { 
            //     # code...
            // }
            // $countbrg = array();
            // $countbrg = Input::get('brg');
            for ($i=0; $i < count($request->brg); $i++) {
                $brginv = new brginv;
                // dd($request->all());
                $brginv->invoice_id = $invoice->id;
                $brginv->brg_bks = 1;
                $brginv->kode = $request->brg[$i]['kode'];
                $brginv->barang = $request->brg[$i]['barang'];
                $brginv->nama = $request->brg[$i]['nama'];
                $brginv->merk = $request->brg[$i]['merk'];
                $brginv->part_number1 = $request->brg[$i]['part_number1'];
                $brginv->nama = $request->brg[$i]['nama'];
                $brginv->kendaraan = $request->brg[$i]['kendaraan'];
                $brginv->jumlah = $request->brg[$i]['jumlah'];
                $brginv->satuan = $request->brg[$i]['satuan'];
                $brginv->harga = $request->brg[$i]['harga'];
                $brginv->diskon = $request->brg[$i]['diskon'];
                $brginv->diskonRp = $request->brg[$i]['diskonRp'];
                $brginv->subtotal = $request->brg[$i]['subtotal'];
                $brginv->save();
                // dd($brginv);
                // $this->invoice->brginv()->save($brginv);
            }
            for ($k=0; $k < count($request->pekerjaan); $k++) { 
                # code...
                $pkrinv= new PekrInv;
                $pkrinv->invoice_id = $invoice->id;
                $pkrinv->kode = $request->pekerjaan[$k]['kode'];
                $pkrinv->jenis_pekerjaan = $request->pekerjaan[$k]['jenis_pekerjaan'];
                $pkrinv->perkiraan = $request->pekerjaan[$k]['perkiraan'];
                $pkrinv->keterangan = $request->pekerjaan[$k]['keterangan'];
                $pkrinv->jumlah = $request->pekerjaan[$k]['jumlah'];
                $pkrinv->rasio = $request->pekerjaan[$k]['rasio'];
                $pkrinv->harga = $request->pekerjaan[$k]['harga'];
                $pkrinv->diskon = $request->pekerjaan[$k]['diskon'];
                $pkrinv->diskonRp = $request->pekerjaan[$k]['diskonRp'];
                $pkrinv->subtotal = $request->pekerjaan[$k]['subtotal'];
                $pkrinv->save();
            }
            return response()->json([
                "status" => true,
                "invoice" => $invoice,
                "brg"=>$brginv
                // "brg"=> $brginv
            ]);
        }
        else {
            return response()->json([
                "status" => false,
                "message" => "gagal save"
            ], 500);
        };
        brginv()->save($brginv);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $invoice = Invoice::find($id);
        $brginv['BARANG'] = BrgInv::where('invoice_id',$id)->get();
        $pkrinv['PEKERJAAN'] = PekrInv::where('invoice_id',$id)->get();
        $a = array();
        // array_push($invoice,$brginv);
        array_push($a, $invoice, $brginv, $pkrinv);
        // array_push($a, $brginv);
        // $a = array_merge($invoice,$brginv);
        // array_push($invoice, 'barang' ,'mau');
        // return $a;
        // $a = $invoice + $brginv;
        // dd($a);
        return $a;
        // return $invoice;
        // return Invoice::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $invoice = Invoice::find($id);
        // $invoice->kd_nota = $request->kd_nota;
        $invoice->jenis_wo = $request->kd_nota;
        $invoice->lokasi = $request->lokasi;
        $invoice->ket_wo = $request->kd_nota;
        $invoice->nama_pelanggan = $request->pelanggan;
        $invoice->nama_pemilik = $request->pelanggan;
        $invoice->mata_uang = $request->mata_uang;
        // $request->tanggal
        $invoice->kurs = $request->kurs;
        $invoice->pelanggan = $request->pelanggan;
        $invoice->refrensi = $request->refrensi;
        $invoice->no_wo = $request->no_wo;
        $invoice->kass = $request->kass;
        $invoice->no_rangka = $request->no_rangka;
        $invoice->no_mesin = $request->no_mesin;
        $invoice->no_polisi = $request->no_polisi;
        $invoice->odometer = $request->odometer;
        $invoice->payment_term = $request->payment_term;
        $invoice->kttg = $request->kttg;
        $invoice->ddtb = $request->ddtb;
        $invoice->kppn = $request->kppn;
        $invoice->kexc = $request->kexc;
        $invoice->kund = $request->kund;
        $invoice->dpp = $request->dpp;
        $invoice->ppn = $request->ppn;
        $invoice->ppn_persen = $request->ppn_persen;
        $invoice->ppn_persen_manual = $request->ppn_persen;
        $invoice->total_byr = $request->total_byr;

        // // $invoice->kd_nota = $request->kd_nota;
        // $invoice->jenis_wo = $request->kd_nota;
        // $invoice->lokasi = $request->lokasi;
        // $invoice->ket_wo = $request->ket_wo;
        // $invoice->nama_pelanggan = $request->nama_pelanggan;
        // $invoice->nama_pemilik = $request->nama_pemilik;

        if ($this->user->invoice()->save($invoice)){
            // dd(isset($request->brg[0]['id']));
            for ($i=0; $i < count($request->brg); $i++) { 
                # code...
                // $a = [];
                // array_push($a,isset($request->brg[$i]['id']));
                // echo(isset($request->brg[1]['id']));
                // dd(count($request->brg));
                if (isset($request->brg[$i]['id']) == false) {
                    # code...
                    $brginv = new BrgInv;
                    $brginv->invoice_id = $id;
                    $brginv->brg_bks = 1;
                    $brginv->kode = $request->brg[$i]['kode'];
                    $brginv->barang = $request->brg[$i]['barang'];
                    $brginv->nama = $request->brg[$i]['nama'];
                    $brginv->merk = $request->brg[$i]['merk'];
                    $brginv->part_number1 = $request->brg[$i]['part_number1'];
                    $brginv->nama = $request->brg[$i]['nama'];
                    $brginv->kendaraan = $request->brg[$i]['kendaraan'];
                    $brginv->jumlah = $request->brg[$i]['jumlah'];
                    $brginv->satuan = $request->brg[$i]['satuan'];
                    $brginv->harga = $request->brg[$i]['harga'];
                    $brginv->diskon = $request->brg[$i]['diskon'];
                    $brginv->diskonRp = $request->brg[$i]['diskonRp'];
                    $brginv->subtotal = $request->brg[$i]['subtotal'];
                    $brginv->save();
                    
                } else {
                    # code...
                    $brginv = BrgInv::find($request->brg[$i]['id']);
                    $brginv->barang = $request->brg[$i]['barang'];
                    $brginv->merk = $request->brg[$i]['merk'];
                    $brginv->part_number1 = $request->brg[$i]['part_number1'];
                    $brginv->nama = $request->brg[$i]['nama'];
                    $brginv->kendaraan = $request->brg[$i]['kendaraan'];
                    $brginv->jumlah = $request->brg[$i]['jumlah'];
                    $brginv->satuan = $request->brg[$i]['satuan'];
                    $brginv->harga = $request->brg[$i]['harga'];
                    $brginv->diskon = $request->brg[$i]['diskon'];
                    $brginv->diskonRp = $request->brg[$i]['diskonRp'];
                    $brginv->subtotal = $request->brg[$i]['subtotal'];
                    $brginv->save();
                }
                
            }
            // $`brgsinv = BrgInv::where('invoice_id',$id)->get();
            // // dd($brginv);
            // for ($i=0; $i < count($brgsinv); $i++) {
            //     // dd($request->all());
            //     $brginv = BrgInv::find($brgsinv[$i]['id']);
            //     // dd($brginv);
            //     // $brginv->brg_bks = 1;
            //     $brginv->barang = $request->brg[$i]['barang'];
            //     // $brginv->nama = $request->nama[$i]->;
            //     $brginv->merk = $request->brg[$i]['merk'];
            //     $brginv->part_number1 = $request->brg[$i]['part_number1'];
            //     $brginv->nama = $request->brg[$i]['nama'];
            //     $brginv->kendaraan = $request->brg[$i]['kendaraan'];
            //     $brginv->jumlah = $request->brg[$i]['jumlah'];
            //     $brginv->satuan = $request->brg[$i]['satuan'];
            //     $brginv->harga = $request->brg[$i]['harga'];
            //     $brginv->diskon = $request->brg[$i]['diskon'];
            //     $brginv->diskonRp = $request->brg[$i]['diskonRp'];
            //     $brginv->subtotal = $request->brg[$i]['subtotal'];
            //     $brginv->save();
            //     // dd($brginv);
            //     // $this->invoice->brginv()->save($brginv);
            // }`
            // $pkrsinv= PekrInv::where('invoice_id',$id)->get();
            // for ($k=0; $k < count($pkrsinv); $k++) { 
            //     # code...
            //     $pkrinv = PekrInv::find($pkrsinv[$k]['id']);
            //     $pkrinv->jenis_pekerjaan = $request->pekerjaan[$k]['jenis_pekerjaan'];
            //     $pkrinv->perkiraan = $request->pekerjaan[$k]['perkiraan'];
            //     $pkrinv->keterangan = $request->pekerjaan[$k]['keterangan'];
            //     $pkrinv->jumlah = $request->pekerjaan[$k]['jumlah'];
            //     $pkrinv->rasio = $request->pekerjaan[$k]['rasio'];
            //     $pkrinv->harga = $request->pekerjaan[$k]['harga'];
            //     $pkrinv->diskon = $request->pekerjaan[$k]['diskon'];
            //     $pkrinv->diskonRp = $request->pekerjaan[$k]['diskonRp'];
            //     $pkrinv->subtotal = $request->pekerjaan[$k]['subtotal'];
            //     $pkrinv->save();
            // }
            for ($a=0; $a < count($request->pekerjaan); $a++) { 
                if (isset($request->pekerjaan[$a]['id']) == false) {
                    $pkrinv= new PekrInv;
                    $pkrinv->invoice_id = $id;
                    $pkrinv->kode = $request->pekerjaan[$a]['kode'];
                    $pkrinv->jenis_pekerjaan = $request->pekerjaan[$a]['jenis_pekerjaan'];
                    $pkrinv->perkiraan = $request->pekerjaan[$a]['perkiraan'];
                    $pkrinv->keterangan = $request->pekerjaan[$a]['keterangan'];
                    $pkrinv->jumlah = $request->pekerjaan[$a]['jumlah'];
                    $pkrinv->rasio = $request->pekerjaan[$a]['rasio'];
                    $pkrinv->harga = $request->pekerjaan[$a]['harga'];
                    $pkrinv->diskon = $request->pekerjaan[$a]['diskon'];
                    $pkrinv->diskonRp = $request->pekerjaan[$a]['diskonRp'];
                    $pkrinv->subtotal = $request->pekerjaan[$a]['subtotal'];
                    $pkrinv->save();
                } else {
                    $pkrinv = PekrInv::find($request->pekerjaan[$a]['id']);
                    $pkrinv->jenis_pekerjaan = $request->pekerjaan[$a]['jenis_pekerjaan'];
                    $pkrinv->perkiraan = $request->pekerjaan[$a]['perkiraan'];
                    $pkrinv->keterangan = $request->pekerjaan[$a]['keterangan'];
                    $pkrinv->jumlah = $request->pekerjaan[$a]['jumlah'];
                    $pkrinv->rasio = $request->pekerjaan[$a]['rasio'];
                    $pkrinv->harga = $request->pekerjaan[$a]['harga'];
                    $pkrinv->diskon = $request->pekerjaan[$a]['diskon'];
                    $pkrinv->diskonRp = $request->pekerjaan[$a]['diskonRp'];
                    $pkrinv->subtotal = $request->pekerjaan[$a]['subtotal'];
                    $pkrinv->save();
                }
            }
            return response()->json([
                "status" => true,
                "invoice" => $invoice,
                "brg"=>$brginv
                // "brg"=> $brginv
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $invoice = Invoice::find($id);
        // $brginv = BrgInv::find($id);
        if ($invoice->delete()){
            // $brginv->delete();
            return response()->json([
                "status"=> true,
                "invoice"=> $invoice,
                // "barangInvoice"=> $brginv
            ]);
        } else {
            return response()->json([
                "status"=> false,
                "Message"=> "gagal delete"
            ]);
        }
    }
}
