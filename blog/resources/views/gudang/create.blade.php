@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('gudang.index') }}>Gudang</a></li>&nbsp;
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('gudang.create') }}>Tambah Gudang</a></li>
@endsection
@section('page-title')
    Gudang | Tambah Gudang
@endsection
@section('title')
    Tambah Gudang
@endsection
@section('content')
<div class="col-md-12">
  <form action={{ route('gudang.store') }} method="post">
    @csrf
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="kodegudang">Kode Gudang</label>
          <input type="text" class="form-control" name="kodegudang" id="kodegudang" placeholder="Kode Gudang" value="{{ old('kodegudang') }}">
        </div>
        @error('kodegudang')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label for="namagudang">Nama Gudang</label>
          <input type="text" class="form-control" name="namagudang" id="namagudang" placeholder="Nama Gudang" value="{{ old('namagudang') }}">
        </div>
        @error('namagudang')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label for="lokasigudang">Lokasi</label>
          <input type="text" class="form-control" name="lokasigudang" id="lokasigudang" placeholder="Lokasi" value="{{ old('lokasigudang') }}">
        </div>
        @error('lokasigudang')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('gudang.index') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection