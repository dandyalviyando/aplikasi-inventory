<?php

namespace App\Http\Controllers;
use App\Customer;
use DB;
use PDF;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $customer = Customer::where('kodecustomer','LIKE','%'.$keyword.'%')
            ->orWhere('namacustomer','LIKE','%'.$keyword.'%')
            ->orWhere('alamat','LIKE','%'.$keyword.'%')
            ->paginate(5);
        return view('customer.index', compact('customer', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'kodecustomer' => 'required|unique:customers',
            'namacustomer' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        $customer = Customer::create([
            'kodecustomer' => $request->kodecustomer,
            'namacustomer' => $request->namacustomer,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'telepon' => $request->telepon,
            'email' => $request->email
        ]);
        return redirect('/customer')->with('success','Item berhasil ditambahkan!');
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
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
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
            'namacustomer' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        $customer = Customer::findorfail($id);
        $customer->namacustomer = $request->namacustomer;
        $customer->alamat = $request->alamat;
        $customer->kota = $request->kota;
        $customer->telepon = $request->telepon;
        $customer->email = $request->email;
        $customer -> update();
        // $customer -> update($validatedData); catatan: bisa langsung menggunakan syntax ini karena kebetulan nama kolom pada DB dan nama elemen pada html sama persis.
        return redirect('/customer')->with('success','Item berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('/customer')->with('error','Item berhasil dihapus!');
    }

    public function pdf()
    {
        $customer = Customer::all();
        $pdf = PDF::loadView('customer.pdf', ['customer'=>$customer]);
        return $pdf->download('customer.pdf');
    }
}
