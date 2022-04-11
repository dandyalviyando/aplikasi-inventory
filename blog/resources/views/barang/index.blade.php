@extends('layouts.master')
@section('breadcrumb')
  <li><p>/</p></li>&nbsp;
  <li style="color: #777777"><a href={{route('barang.index') }}>Barang</a></li>
@endsection
@section('page-title')
    Barang
@endsection
@section('title')
    Barang
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div style="display:flex; justify-content:flex-start" class="col-md-6">
            <a href={{route('barang.create') }}><button type="button" class="btn btn-success">Tambah Barang</button></a>&nbsp;&nbsp;&nbsp;
            <a href="/barang/pdf"><button type="button" class="btn btn-info">Cetak File PDF</button></a>
          </div>
          <div style="display:flex; justify-content:flex-end" class="col-md-6">
            <form method="GET" action="{{route('barang.index') }}">
              <div class="input-group input-group-md" style="width: 200px;">
                <input type="text" name="keyword" class="form-control float-right" placeholder="Search" value={{ $keyword }}> 
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 3%">#</th>
              <th style="width: 35%">Nama Barang</th>
              <th>Satuan</th>
              <th style="width: 25%">Harga Satuan</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($barang as $key => $item)
              <tr>
                <td>{{ $barang -> firstItem() + $key }}</td>
                <td>
                  <p>{{ $item->namabarang}}</p>
                </td>
                <td>
                  <p>{{ $item->namasatuan}}</p>
                </td>
                <td>
                  <p>{{ number_format($item->hargamodal)}}</p>
                </td>
              	<td>
                  <a style="display: inline-block" href="{{ route('barang.edit', $item->id) }}"><button class="btn btn-primary"><span class="fas fa-pencil-alt"></span></button></a>&nbsp;&nbsp;
                  <form style="display: inline-block" action="{{ route('barang.destroy', $item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="submitForm(this);"><span class="fas fa-trash-alt"></span></button>
                  </form>
              	</td>
              </tr>
              @empty
              <tr>
                <td colspan="6" style="text-align: center">
                  <p>Data tidak ditemukan.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          {{ $barang->links() }}
        </ul>
      </div>
    </div>
  </div>
@endsection