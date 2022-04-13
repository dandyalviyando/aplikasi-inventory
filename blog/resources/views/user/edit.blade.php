@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{ route('user.edit', $user->id) }}>Edit Profil</a></li>
@endsection
@section('page-title')
    Edit Profil
@endsection
@section('title')
    Edit Profil
@endsection
@section('content')
<div class="col-md-12">
  <form action="/user/{{ $user->id }}" method="post">
    @csrf
    @method('put')
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="nama">Nama Pengguna</label>
          <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pengguna" value="{{ $user->name }}">
        </div>
        @error('nama')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('home') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection