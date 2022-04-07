<?php

namespace App\Http\Controllers;

use App\Mutasi;
use App\Barang;
use App\Gudang;
use DB;
use PDF;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $mutasi = Mutasi::where('quantity','LIKE','%'.$keyword.'%')
        ->orderBy('tanggal', 'ASC')
        ->paginate(5);
        return view('mutasi.index', compact('mutasi', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $gudang = Gudang::all();
        return view('mutasi.create', compact('barang', 'gudang'));
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
            'tanggal' => 'required',
            'quantity' => 'required',
            'barang_id' => 'required',
            'gudang_asal_id' => 'required',
            'gudang_tujuan_id' => 'required',
        ]);


        $mutasi = Mutasi::create([
            'tanggal' => $request->tanggal,
            'quantity' => $request->quantity,
            'barang_id' => $request->barang_id,
            'gudang_asal_id' => $request->gudang_asal_id,
            'gudang_tujuan_id' => $request->gudang_tujuan_id,
        ]);

        return redirect('/mutasi')->with('success','Item berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mutasi = Mutasi::findOrFail($id);

        $barang = Barang::all();
        $gudang = Gudang::all();

        return view('mutasi.edit', compact('mutasi','barang', 'gudang'));
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
            'tanggal' => 'required',
            'quantity' => 'required',
            'barang_id' => 'required',
            'gudang_asal_id' => 'required',
            'gudang_tujuan_id' => 'required',
        ]);

        $mutasi = Mutasi::findorfail($id);
        $mutasi->tanggal = $request->tanggal;
        $mutasi->quantity = $request->quantity;
        $mutasi->barang_id = $request->barang_id;
        $mutasi->gudang_asal_id = $request->gudang_asal_id;
        $mutasi->gudang_tujuan_id = $request->gudang_tujuan_id;
        $mutasi-> update();
        // $mutasi -> update($validatedData); catatan: bisa langsung menggunakan syntax ini karena kebetulan nama kolom pada DB dan nama elemen pada html sama persis.
        return redirect('/mutasi')->with('success','Item berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mutasi = Mutasi::findOrFail($id);
        $mutasi->delete();

        return redirect('/mutasi')->with('error','Item berhasil dihapus!');
    }

    public function pdf()
    {
        $mutasi = Mutasi::orderBy('tanggal', 'ASC')->get();
 
        $pdf = PDF::loadView('mutasi.pdf', ['mutasi'=>$mutasi]);
        return $pdf->download('mutasi.pdf');
    }
}
