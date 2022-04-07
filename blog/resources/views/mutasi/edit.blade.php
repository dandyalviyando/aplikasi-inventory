@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('mutasi.index') }}>Mutasi</a></li>&nbsp;
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{ route('mutasi.edit', $mutasi->id) }}>Edit Catatan Mutasi</a></li>
@endsection
@section('title')
    Edit Catatan Mutasi
@endsection
@section('content')
<div class="col-md-12">
  <form action="{{ route('mutasi.update', $mutasi->id) }}" method="post">
    @csrf
    @method('put')
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="tanggal" value="{{ $mutasi->tanggal }}">
        </div>
        @error('tanggal')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label style="display: inline-block" for="barang_id">Nama Barang</label> &nbsp;&nbsp;
            <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('barang.create') }}> Buat Baru</a>)</p>
            <select class="form-control" id="barang_id" name="barang_id" value="{{ old('barang_id') }}">
                <option value="">--- Pilih Opsi Barang ---</option>
                @foreach ($barang as $item)
                <option value="{{ $item->id }}">{{ $item->namabarang }}</option>
                @endforeach
            </select>
        </div>
        @error('barang_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label style="display: inline-block" for="gudang_asal_id">Asal</label> &nbsp;&nbsp;
            <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('gudang.create') }}> Buat Baru</a>)</p>
            <select class="form-control" id="gudang_asal_id" name="gudang_asal_id" value="{{ old('gudang_asal_id') }}">
                <option value="">--- Pilih Opsi Asal ---</option>
                @foreach ($gudang as $item)
                <option value="{{ $item->id }}">{{ $item->namagudang }}</option>
                @endforeach
            </select>
        </div>
        @error('gudang_asal_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="{{ $mutasi->quantity }}">
        </div>
        @error('quantity')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label style="display: inline-block" for="gudang_tujuan_id">Tujuan</label> &nbsp;&nbsp;
            <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('gudang.create') }}> Buat Baru</a>)</p>
            <select class="form-control" id="gudang_tujuan_id" name="gudang_tujuan_id" value="{{ old('gudang_tujuan_id') }}">
                <option value="">--- Pilih Opsi Tujuan ---</option>
                @foreach ($gudang as $item)
                <option value="{{ $item->id }}">{{ $item->namagudang }}</option>
                @endforeach
            </select>
        </div>
        @error('gudang_tujuan_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('mutasi.index') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection