<?php

namespace App\Http\Controllers;
use App\Gudang;
use DB;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        // $gudang = Gudang::all();
        $gudang = Gudang::where('kodegudang','LIKE','%'.$keyword.'%')
            ->orWhere('namagudang','LIKE','%'.$keyword.'%')
            ->orWhere('lokasigudang','LIKE','%'.$keyword.'%')
            ->paginate(5);
        return view('gudang.index', compact('gudang', 'keyword'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gudang.create');
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
            'kodegudang' => 'required|unique:gudangs',
            'namagudang' => 'required',
            'lokasigudang' => 'required',
        ]);

        $gudang = Gudang::create([
            'kodegudang' => $request->kodegudang,
            'namagudang' => $request->namagudang,
            'lokasigudang' => $request->lokasigudang
        ]);
        return redirect('/gudang')->with('success','Item berhasil ditambahkan!');
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
        // $gudang = Gudang::where('id', $id)->get()->first();
        $gudang = Gudang::findOrFail($id);
        // dd($gudang);
        return view('gudang.edit', compact('gudang'));
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
            'namagudang' => 'required',
            'lokasigudang' => 'required',
        ]);

        $gudang = Gudang::findorfail($id);
        $gudang->namagudang = $request->namagudang;
        $gudang->lokasigudang = $request->lokasigudang;
        $gudang -> update();
        // $gudang -> update($validatedData); catatan: bisa langsung menggunakan syntax ini karena kebetulan nama kolom pada DB dan nama elemen pada html sama persis.
        return redirect('/gudang')->with('success','Item berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gudang = Gudang::findOrFail($id);
        $gudang->delete();

        return redirect('/gudang')->with('error','Item berhasil dihapus!');
    }

    public function pdf()
    {
        $gudang = Gudang::all();
        $pdf = PDF::loadView('gudang.pdf', ['gudang'=>$gudang]);
        return $pdf->download('gudang.pdf');
    }
}
