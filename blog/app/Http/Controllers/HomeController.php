<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Penjualan;
use App\Mutasi;
use App\Agenda;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pembelian = Pembelian::count();
        $penjualan = Penjualan::count();
        $mutasi = Mutasi::count();
        $agenda = Agenda::paginate(5);

        return view('home', compact('pembelian','penjualan','mutasi','agenda'));


    }
}
