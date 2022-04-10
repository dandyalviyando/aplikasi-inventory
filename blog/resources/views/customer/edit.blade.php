@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('customer.index') }}>Customer</a></li>&nbsp;
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{ route('customer.edit', $customer->id) }}>Edit Customer</a></li>
@endsection
@section('page-title')
    Customer | Edit Customer
@endsection
@section('title')
    Edit Customer
@endsection
@section('content')
<div class="col-md-12">
  <form action="{{ route('customer.update', $customer->id) }}" method="post">
    @csrf
    @method('put')
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="kodecustomer">Kode Customer</label>
          <input type="text" class="form-control" name="kodecustomer" id="kodecustomer" placeholder="Kode Customer" value="{{ $customer->kodecustomer }}" disabled>
        </div>
        @error('kodecustomer')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="namacustomer">Nama Customer</label>
            <input type="text" class="form-control" name="namacustomer" id="namacustomer" placeholder="Nama Customer" value="{{ $customer->namacustomer }}">
        </div>
        @error('namacustomer')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="{{ $customer->alamat }}">
        </div>
        @error('alamat')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="{{ $customer->kota }}">
        </div>
        @error('kota')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="number" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="{{ $customer->telepon }}">
        </div>
        @error('telepon')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $customer->email }}">
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('customer.index') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection