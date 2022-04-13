@extends('layouts.master')
@section('breadcrumb')
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{route('barang.index') }}>Barang</a></li>&nbsp;
    <li><p style="color: #777777">/</p></li>&nbsp;
    <li style="color: #777777"><a href={{ route('barang.edit', $barang->id) }}>Edit Barang</a></li>
@endsection
@section('page-title')
    Barang | Edit Barang
@endsection
@section('title')
    Edit Barang
@endsection
@section('content')
<div class="col-md-12">
  <form action="{{ route('barang.update', $barang->id) }}" method="post">
    @csrf
    @method('put')
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="namabarang">Nama Barang</label>
          <input type="text" class="form-control" name="namabarang" id="namabarang" placeholder="Nama Barang" value="{{ $barang->namabarang }}" disabled>
        </div>
        @error('namabarang')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label style="display: inline-block" for="satuan_id">Satuan Barang</label> &nbsp;&nbsp;
          <p style="display: inline-block; font-size: 15px">(Tidak tersedia ?<a href={{route('satuan.create') }}> Buat Baru</a>)</p>
          <select class="form-control" id="satuan_id" name="satuan_id">
            <option value="">--- Pilih Opsi Satuan ---</option>
            @foreach ($satuan as $item)
              @if(old('satuan_id') == $item->id)
                <option value="{{ $item->id }}" selected>{{ $item->namasatuan }}</option>
              @else 
                @if ($barang->satuan_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->namasatuan }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->namasatuan }}</option>
                @endif
              @endif
            @endforeach
          </select>
        </div>
        @error('satuan_id')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
          <label for="hargamodal">Harga Satuan</label>
          <input type="number" class="form-control" name="hargamodal" id="hargamodal" placeholder="Harga Satuan" value="{{ $barang->hargamodal }}">
        </div>
        @error('hargamodal')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Simpan</button>&nbsp;&nbsp;
        <a href={{route('barang.index') }}><button type="button" class="btn btn-secondary">Batal</button></a>
      </div>
    </div>
  </form>

  </div>
@endsection