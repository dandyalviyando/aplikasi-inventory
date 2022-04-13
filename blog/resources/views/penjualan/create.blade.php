@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('penjualan.index') }}>Penjualan</a></li>&nbsp;
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('penjualan.create') }}>Catat Penjualan Baru</a></li>
@endsection
@section('page-title')
    Barang Keluar | Catat Penjualan Baru
@endsection
@section('title')
    Catat Penjualan Baru
@endsection
@section('content')
<div class="col-md-12">
  <form action={{ route('penjualan.store') }} method="post" enctype="multipart/form-data">
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
          <label for="notapenjualan">Nota Penjualan</label>
          <input type="file" class="form-control" name="notapenjualan" id="notapenjualan" placeholder="Nota Penjualan" value="{{ old('notapenjualan') }}">
        </div>
        @error('notapenjualan')
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
            <label style="display: inline-block" for="gudang_id">Dari Gudang</label> &nbsp;&nbsp;
            <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('gudang.create') }}> Buat Baru</a>)</p>
            <select class="form-control" id="gudang_id" name="gudang_id">
              <option value="">--- Pilih Opsi Gudang ---</option>
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
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="{{ old('quantity') }}">
        </div>
        @error('quantity')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="hargajual">Harga Jual</label>
            <input type="number" class="form-control" name="hargajual" id="hargajual" placeholder="Harga Jual" value="{{ old('hargajual') }}">
        </div>
        @error('hargajual')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label style="display: inline-block" for="customer_id">Customer</label> &nbsp;&nbsp;
          <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('customer.create') }}> Buat Baru</a>)</p>
          <select class="form-control" id="customer_id" name="customer_id">
            <option value="">--- Pilih Opsi Customer ---</option>
            @foreach ($customer as $item)
              @if(old('customer_id') == $item->id)
                <option value="{{ $item->id }}" selected>{{ $item->namacustomer }}</option>
              @else 
                <option value="{{ $item->id }}">{{ $item->namacustomer }}</option>
              @endif
            @endforeach
          </select>
        </div>
        @error('customer_id')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('penjualan.index') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection