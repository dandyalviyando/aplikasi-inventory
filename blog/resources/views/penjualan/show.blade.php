@extends('layouts.master')
@section('breadcrumb')
<li><p style="color: #777777">/</p></li>&nbsp;
<li style="color: #777777"><a href={{route('penjualan.index') }}>Penjualan</a></li>&nbsp;
<li><p style="color: #777777">/</p></li>&nbsp;
<li style="color: #777777"><a href={{route('penjualan.show', $penjualan->id) }}>Nota Penjualan</a></li>
@endsection
@section('page-title')
    Barang Keluar | Nota Penjualan
@endsection
@section('content')
<div class="col-md-12" style="padding-bottom: 8%">
        <div class="text-center m-auto" style="width: 500px;">
            <img src="{{ asset('images/'. $penjualan->notapenjualan)}}" alt="{{$penjualan->notapenjualan}}" class="img-fluid"> 
        </div>
</div>
@endsection