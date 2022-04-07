@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('supplier.index') }}>Supplier</a></li>&nbsp;
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('supplier.create') }}>Tambah Supplier</a></li>
@endsection
@section('title')
    Tambah Supplier
@endsection
@section('content')
<div class="col-md-12">
  <form action={{ route('supplier.store') }} method="post">
    @csrf
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="kodesupplier">Kode Supplier</label>
          <input type="text" class="form-control" name="kodesupplier" id="kodesupplier" placeholder="Kode Supplier" value="{{ old('kodesupplier') }}">
        </div>
        @error('kodesupplier')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label for="namasupplier">Nama Supplier</label>
          <input type="text" class="form-control" name="namasupplier" id="namasupplier" placeholder="Nama Supplier" value="{{ old('namasupplier') }}">
        </div>
        @error('namasupplier')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
        </div>
        @error('alamat')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label for="kota">Kota</label>
          <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="{{ old('kota') }}">
        </div>
        @error('kota')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="number" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="{{ old('telepon') }}">
        </div>
        @error('telepon')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('supplier.index') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection