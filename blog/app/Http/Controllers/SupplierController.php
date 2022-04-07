<?php

namespace App\Http\Controllers;
use App\Supplier;
use DB;
use PDF;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $supplier = Supplier::where('kodesupplier','LIKE','%'.$keyword.'%')
            ->orWhere('namasupplier','LIKE','%'.$keyword.'%')
            ->orWhere('alamat','LIKE','%'.$keyword.'%')
            ->paginate(5);
        return view('supplier.index', compact('supplier', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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
            'kodesupplier' => 'required|unique:suppliers',
            'namasupplier' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        $supplier = Supplier::create([
            'kodesupplier' => $request->kodesupplier,
            'namasupplier' => $request->namasupplier,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'telepon' => $request->telepon,
            'email' => $request->email
        ]);
        return redirect('/supplier')->with('success','Item berhasil ditambahkan!');
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
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
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
            'namasupplier' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        $supplier = Supplier::findorfail($id);
        $supplier->namasupplier = $request->namasupplier;
        $supplier->alamat = $request->alamat;
        $supplier->kota = $request->kota;
        $supplier->telepon = $request->telepon;
        $supplier->email = $request->email;
        $supplier -> update();
        // $supplier -> update($validatedData); catatan: bisa langsung menggunakan syntax ini karena kebetulan nama kolom pada DB dan nama elemen pada html sama persis.
        return redirect('/supplier')->with('success','Item berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect('/supplier')->with('error','Item berhasil dihapus!');
    }

    public function pdf()
    {
        $supplier = Supplier::all();
        $pdf = PDF::loadView('supplier.pdf', ['supplier'=>$supplier]);
        return $pdf->download('supplier.pdf');
    }
}
