<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\Barang;
use App\Gudang;
use App\Customer;
use DB;
use PDF;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $penjualan = Penjualan::join('barangs','barangs.id','penjualans.barang_id')
        ->join('gudangs','gudangs.id','penjualans.gudang_id')
        ->where('notapenjualan','LIKE','%'.$keyword.'%')
        ->orWhere('namabarang','LIKE','%'.$keyword.'%')
        ->orWhere('namagudang','LIKE','%'.$keyword.'%')
        ->select('penjualans.tanggal','penjualans.id','penjualans.notapenjualan','penjualans.quantity','barangs.namabarang','penjualans.hargajual', 'gudangs.namagudang')
        ->orderBy('penjualans.tanggal', 'ASC')
        ->paginate(5);

        $totalharga = Penjualan::sum(DB::raw('penjualans.hargajual * penjualans.quantity'));

        return view('penjualan.index', compact('penjualan', 'keyword', 'totalharga'));
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
        $customer = Customer::all();
        return view('penjualan.create', compact('barang', 'gudang', 'customer'));
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
            'notapenjualan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
            'hargajual' => 'required',
            'barang_id' => 'required',
            'gudang_id' => 'required',
            'customer_id' => 'required',
        ]);

        $imageName = time().'.'.$request->notapenjualan->extension();  
   
        $request->notapenjualan->move(public_path('images'), $imageName);

        $penjualan = Penjualan::create([
            'tanggal' => $request->tanggal,
            'notapenjualan' => $imageName,
            'quantity' => $request->quantity,
            'hargajual' => $request->hargajual,
            'barang_id' => $request->barang_id,
            'gudang_id' => $request->gudang_id,
            'customer_id' => $request->customer_id,
        ]);

        return redirect('/penjualan')->with('success','Item berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $barang = Barang::all();
        $gudang = Gudang::all();
        $customer = Customer::all();

        return view('penjualan.edit', compact('penjualan','barang', 'gudang', 'customer'));
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
            'hargajual' => 'required',
            'barang_id' => 'required',
            'gudang_id' => 'required',
            'customer_id' => 'required',
        ]);

        $penjualan = penjualan::findorfail($id);
        $penjualan->tanggal = $request->tanggal;
        $penjualan->quantity = $request->quantity;
        $penjualan->hargajual = $request->hargajual;
        $penjualan->barang_id = $request->barang_id;
        $penjualan->gudang_id = $request->gudang_id;
        $penjualan->customer_id = $request->customer_id;
        $penjualan -> update();
        // $penjualan -> update($validatedData); catatan: bisa langsung menggunakan syntax ini karena kebetulan nama kolom pada DB dan nama elemen pada html sama persis.
        return redirect('/penjualan')->with('success','Item berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect('/penjualan')->with('error','Item berhasil dihapus!');
    }

    public function pdf()
    {
        $penjualan = Penjualan::join('barangs','barangs.id','penjualans.barang_id')
        ->join('gudangs','gudangs.id','penjualans.gudang_id')
        ->join('customers','customers.id','penjualans.customer_id')
        ->select('penjualans.tanggal','penjualans.id','penjualans.notapenjualan','penjualans.quantity','barangs.namabarang','penjualans.hargajual', 'gudangs.namagudang', 'customers.namacustomer')
        ->orderBy('penjualans.tanggal', 'ASC')
        ->get();

        $totalharga = Penjualan::sum(DB::raw('penjualans.hargajual * penjualans.quantity'));
 
        $pdf = PDF::loadView('penjualan.pdf', ['penjualan'=>$penjualan, 'totalharga'=>$totalharga]);
        return $pdf->download('penjualan.pdf');
    }

    public function filterForm()
    {
        return view('penjualan.filter-form');
    }

    public function filterPdf(Request $request)
    {
        $daritanggal = $request->daritanggal;
        $sampaitanggal = $request->sampaitanggal;
        $penjualan = Penjualan::join('barangs','barangs.id','penjualans.barang_id')
        ->join('gudangs','gudangs.id','penjualans.gudang_id')
        ->join('customers','customers.id','penjualans.customer_id')
        ->whereBetween('tanggal', [$daritanggal, $sampaitanggal])
        ->select('penjualans.tanggal','penjualans.id','penjualans.notapenjualan','penjualans.quantity','barangs.namabarang','penjualans.hargajual', 'gudangs.namagudang', 'customers.namacustomer')
        ->orderBy('penjualans.tanggal', 'ASC')
        ->get();

        $totalharga = Penjualan::whereBetween('tanggal', [$daritanggal, $sampaitanggal])
        ->sum(DB::raw('hargajual * quantity'));

        $pdf = PDF::loadView('penjualan.filter-pdf', ['penjualan'=>$penjualan, 'totalharga'=>$totalharga]);
        return $pdf->download('laporan-penjualan.pdf');
    }
}
