<?php

namespace App\Http\Controllers;
use App\Barang;
use App\Satuan;
use DB;
use PDF;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $barang = Barang::join('satuans', 'satuans.id','barangs.satuan_id')
        ->where('namabarang','LIKE','%'.$keyword.'%')
        ->orWhere('namasatuan','LIKE','%'.$keyword.'%')
        ->select('barangs.id','namabarang','satuans.namasatuan','hargamodal')
        ->paginate(5);
        return view('barang.index', compact('barang', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuan = Satuan::all();
        return view('barang.create', compact('satuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namabarang' => 'required|unique:barangs',
            'satuan_id' => 'required',
            'hargamodal' => 'required',
        ]);


        $barang = Barang::create([
            'namabarang' => $request->namabarang,
            'satuan_id' => $request->satuan_id,
            'hargamodal' => $request->hargamodal
        ]);

        return redirect('/barang')->with('success','Item berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        $satuan = Satuan::all();

        return view('barang.edit', compact('barang','satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'satuan_id' => 'required',
            'hargamodal' => 'required',
        ]);

        $barang = Barang::findorfail($id);
        $barang->satuan_id = $request->satuan_id;
        $barang->hargamodal = $request->hargamodal;
        $barang -> update();
        // $barang -> update($validatedData); catatan: bisa langsung menggunakan syntax ini karena kebetulan nama kolom pada DB dan nama elemen pada html sama persis.
        return redirect('/barang')->with('success','Item berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect('/barang')->with('error','Item berhasil dihapus!');
    }
    public function pdf()
    {
        $barang = Barang::join('satuans', 'satuans.id','barangs.satuan_id')
        ->select('barangs.id','namabarang','satuans.namasatuan','hargamodal')
        ->get();
 
        $pdf = PDF::loadView('barang.pdf', ['barang'=>$barang]);
        return $pdf->download('barang.pdf');
    }
}
