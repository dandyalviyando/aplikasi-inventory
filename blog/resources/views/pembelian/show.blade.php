@extends('layouts.master')
@section('breadcrumb')
<li><p style="color: #777777">/</p></li>&nbsp;
<li style="color: #777777"><a href={{route('pembelian.index') }}>Pembelian</a></li>&nbsp;
<li><p style="color: #777777">/</p></li>&nbsp;
<li style="color: #777777"><a href={{route('pembelian.show', $pembelian->id) }}>Nota Pembelian</a></li>
@endsection
@section('content')
<div class="col-md-12" style="padding-bottom: 8%">
        <div class="text-center m-auto" style="width: 500px;">
            <img src="{{ asset('images/'. $pembelian->notapembelian)}}" alt="{{$pembelian->notapembelian}}" class="img-fluid"> 
        </div>
</div>
@endsection