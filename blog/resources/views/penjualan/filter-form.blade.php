@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href="/penjualan/filter-form">Laporan Penjualan</a></li>
@endsection
@section('page-title')
    Cetak Laporan Penjualan
@endsection
@section('title')
    Cetak Laporan Penjualan
@endsection
@section('content')
<div class="col-md-12">
  <form action="/penjualan/filter-pdf" method="GET">
    @csrf
    <div class="card">
      <div class="card-body">
        <div class="form-group">
            <label for="daritanggal">Dari Tanggal</label>
            <input type="date" class="form-control" name="daritanggal" id="daritanggal" placeholder="Dari Tanggal">
        </div>
        @error('daritanggal')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="sampaitanggal">Sampai Tanggal</label>
            <input type="date" class="form-control" name="sampaitanggal" id="sampaitanggal" placeholder="Sampai Tanggal">
        </div>
        @error('sampaitanggal')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cetak</button>
      </div>
    </div>
  </form>

  </div>
@endsection