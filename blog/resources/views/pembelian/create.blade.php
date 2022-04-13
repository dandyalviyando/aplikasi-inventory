@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('pembelian.index') }}>Pembelian</a></li>&nbsp;
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('pembelian.create') }}>Catat Pembelian Baru</a></li>
@endsection
@section('page-title')
    Barang Masuk | Catat Pembelian Baru
@endsection
@section('title')
    Catat Pembelian Baru
@endsection
@section('content')
<div class="col-md-12">
  <form action={{ route('pembelian.store') }} method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="tanggal" value="{{ old('tanggal') }}">
        </div>
        @error('tanggal')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label for="notapembelian">Nota Pembelian</label>
          <input type="file" class="form-control" name="notapembelian" id="notapembelian" placeholder="Nota Pembelian" value="{{ old('notapembelian') }}">
        </div>
        @error('notapembelian')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label style="display: inline-block" for="supplier_id">Supplier</label> &nbsp;&nbsp;
          <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('supplier.create') }}> Buat Baru</a>)</p>
          <select class="form-control" id="supplier_id" name="supplier_id">
            <option value="">--- Pilih Opsi Supplier ---</option>
            @foreach ($supplier as $item)
              @if(old('supplier_id') == $item->id)
                <option value="{{ $item->id }}" selected>{{ $item->namasupplier }}</option>
              @else 
                <option value="{{ $item->id }}">{{ $item->namasupplier }}</option>
              @endif
            @endforeach
          </select>
        </div>
        @error('supplier_id')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label style="display: inline-block" for="barang_id">Nama Barang</label> &nbsp;&nbsp;
            <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('barang.create') }}> Buat Baru</a>)</p>
            <select class="form-control" id="barang_id" name="barang_id">
              <option value="">--- Pilih Opsi Barang ---</option>
              @foreach ($barang as $item)
                @if(old('barang_id') == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->namabarang }}</option>
                @else 
                  <option value="{{ $item->id }}">{{ $item->namabarang }}</option>
                @endif
              @endforeach
            </select>
        </div>
        @error('barang_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="{{ old('quantity') }}">
        </div>
        @error('quantity')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label style="display: inline-block" for="gudang_id">Tujuan</label> &nbsp;&nbsp;
            <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('gudang.create') }}> Buat Baru</a>)</p>
            <select class="form-control" id="gudang_id" name="gudang_id">
              <option value="">--- Pilih Opsi Tujuan ---</option>
              @foreach ($gudang as $item)
                @if(old('gudang_id') == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->namagudang }}</option>
                @else 
                  <option value="{{ $item->id }}">{{ $item->namagudang }}</option>
                @endif
              @endforeach
            </select>
        </div>
        @error('gudang_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('pembelian.index') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection