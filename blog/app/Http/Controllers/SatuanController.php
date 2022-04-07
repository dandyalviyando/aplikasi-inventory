<?php

namespace App\Http\Controllers;
use App\Satuan;
use DB;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $satuan = Satuan::where('namasatuan','LIKE','%'.$keyword.'%')->paginate(5);
        return view('satuan.index', compact('satuan', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('satuan.create');
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
            'namasatuan' => 'required|unique:satuans',
        ]);

        $satuan = Satuan::create([
            'namasatuan' => $request->namasatuan
        ]);
        return redirect('/satuan')->with('success','Item berhasil ditambahkan!');
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
        $satuan = Satuan::findOrFail($id);

        return view('satuan.edit', compact('satuan'));
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
            'namasatuan' => 'required',
        ]);

        $satuan = Satuan::findorfail($id);
        $satuan->namasatuan = $request->namasatuan;
        $satuan -> update();
        // $satuan -> update($validatedData); catatan: bisa langsung menggunakan syntax ini karena kebetulan nama kolom pada DB dan nama elemen pada html sama persis.
        return redirect('/satuan')->with('success','Item berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->delete();

        return redirect('/satuan')->with('error','Item berhasil dihapus!');
    }
}
