@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('satuan.index') }}>Satuan</a></li>&nbsp;
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{ route('satuan.edit', $satuan->id) }}>Edit Satuan</a></li>
@endsection
@section('title')
    Edit Satuan
@endsection
@section('content')
<div class="col-md-12">
  <form action="{{ route('satuan.update', $satuan->id) }}" method="post">
    @csrf
    @method('put')
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="namasatuan">Nama Satuan</label>
          <input type="text" class="form-control" name="namasatuan" id="namasatuan" placeholder="Nama Satuan" value="{{ $satuan->namasatuan }}">
        </div>
        @error('namasatuan')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('satuan.index') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection