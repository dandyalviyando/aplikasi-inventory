<?php

namespace App\Http\Controllers;

use App\Pembelian;
use App\Supplier;
use App\Barang;
use App\Gudang;
use DB;
use PDF;

use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $pembelian = Pembelian::join('suppliers', 'suppliers.id','pembelians.supplier_id')
        ->join('barangs', 'barangs.id','pembelians.barang_id')
        ->join('gudangs', 'gudangs.id','pembelians.gudang_id')
        ->where('notapembelian','LIKE','%'.$keyword.'%')
        ->orWhere('namasupplier','LIKE','%'.$keyword.'%')
        ->orWhere('namabarang','LIKE','%'.$keyword.'%')
        ->orWhere('namagudang','LIKE','%'.$keyword.'%')
        ->select('pembelians.tanggal','pembelians.id','pembelians.notapembelian','pembelians.quantity', 'suppliers.namasupplier', 'barangs.namabarang','barangs.hargamodal', 'gudangs.namagudang')
        ->orderBy('pembelians.tanggal', 'ASC')
        ->paginate(5);

        $totalharga = Pembelian::join('barangs', 'barangs.id', 'pembelians.barang_id')
        ->sum(DB::raw('barangs.hargamodal * pembelians.quantity'));

        // dd($totalharga);

        // dd($pembelian);
        return view('pembelian.index', compact('pembelian', 'keyword', 'totalharga'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();
        $gudang = Gudang::all();
        return view('pembelian.create', compact('supplier', 'barang', 'gudang'));
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
            'notapembelian' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'gudang_id' => 'required',
        ]);

        $imageName = time().'.'.$request->notapembelian->extension();  
   
        $request->notapembelian->move(public_path('images'), $imageName);

        $pembelian = Pembelian::create([
            'tanggal' => $request->tanggal,
            'notapembelian' => $imageName,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'barang_id' => $request->barang_id,
            'gudang_id' => $request->gudang_id,
        ]);

        return redirect('/pembelian')->with('success','Item berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembelian = Pembelian::findOrFail($id);

        return view('pembelian.show', compact('pembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id);

        $supplier = Supplier::all();
        $barang = Barang::all();
        $gudang = Gudang::all();

        return view('pembelian.edit', compact('pembelian','supplier', 'barang', 'gudang'));
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
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'gudang_id' => 'required',
        ]);

        $pembelian = Pembelian::findorfail($id);
        $pembelian->tanggal = $request->tanggal;
        $pembelian->quantity = $request->quantity;
        $pembelian->supplier_id = $request->supplier_id;
        $pembelian->barang_id = $request->barang_id;
        $pembelian->gudang_id = $request->gudang_id;
        $pembelian -> update();
        // $pembelian -> update($validatedData); catatan: bisa langsung menggunakan syntax ini karena kebetulan nama kolom pada DB dan nama elemen pada html sama persis.
        return redirect('/pembelian')->with('success','Item berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->delete();

        return redirect('/pembelian')->with('error','Item berhasil dihapus!');
    }

    public function pdf()
    {
        $pembelian = Pembelian::join('suppliers', 'suppliers.id','pembelians.supplier_id')
        ->join('barangs', 'barangs.id','pembelians.barang_id')
        ->join('gudangs', 'gudangs.id','pembelians.gudang_id')
        ->select('pembelians.tanggal','pembelians.id','pembelians.notapembelian','pembelians.quantity', 'suppliers.namasupplier', 'barangs.namabarang','barangs.hargamodal', 'gudangs.namagudang')
        ->orderBy('pembelians.tanggal', 'ASC')
        ->get();

        $totalharga = Pembelian::join('barangs', 'barangs.id', 'pembelians.barang_id')
        ->sum(DB::raw('barangs.hargamodal * pembelians.quantity'));
 
        $pdf = PDF::loadView('pembelian.pdf', ['pembelian'=>$pembelian, 'totalharga'=>$totalharga]);
        return $pdf->download('pembelian.pdf');
    }

    public function filterForm()
    {
        return view('pembelian.filter-form');
    }

    public function filterPdf(Request $request)
    {
        $daritanggal = $request->daritanggal;
        $sampaitanggal = $request->sampaitanggal;
        $pembelian = Pembelian::join('suppliers', 'suppliers.id','pembelians.supplier_id')
        ->join('barangs', 'barangs.id','pembelians.barang_id')
        ->join('gudangs', 'gudangs.id','pembelians.gudang_id')
        ->whereBetween('tanggal', [$daritanggal, $sampaitanggal])
        ->select('pembelians.tanggal','pembelians.id','pembelians.notapembelian','pembelians.quantity','barangs.namabarang','barangs.hargamodal', 'gudangs.namagudang','suppliers.namasupplier')
        ->orderBy('pembelians.tanggal', 'ASC')
        ->get();

        $totalharga = Pembelian::join('barangs', 'barangs.id','pembelians.barang_id')
        ->whereBetween('tanggal', [$daritanggal, $sampaitanggal])
        ->sum(DB::raw('barangs.hargamodal * pembelians.quantity'));

        $pdf = PDF::loadView('pembelian.filter-pdf', ['pembelian'=>$pembelian, 'totalharga'=>$totalharga]);
        return $pdf->download('laporan-pembelian.pdf');
    }
}
