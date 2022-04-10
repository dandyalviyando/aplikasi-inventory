@extends('layouts.master')
@section('breadcrumb')
  <li><p>/</p></li>&nbsp;
  <li style="color: #777777"><a href={{route('mutasi.index') }}>Mutasi Barang</a></li>
@endsection
@section('page-title')
    Mutasi Barang
@endsection
@section('title')
    Mutasi Barang
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div style="display:flex; justify-content:flex-start" class="col-md-6">
            <a href={{route('mutasi.create') }}><button type="button" class="btn btn-success">Catat Mutasi Baru</button></a>&nbsp;&nbsp;&nbsp;
            <a href="/mutasi/pdf"><button type="button" class="btn btn-info">Cetak File PDF</button></a>
          </div>
          <div style="display:flex; justify-content:flex-end" class="col-md-6">
            <form method="GET" action="{{route('mutasi.index') }}">
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
              <th style="width: 11%">Tanggal</th>
              <th>Nama Barang</th>
              <th style="width: 18%">Asal</th>
              <th style="width:3%">Qty</th>
              <th style="width: 18%">Tujuan</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mutasi as $item)
              <tr>
                <td>
                  <p>{{ $item->tanggal}}</p>
                </td>
                <td>
                    <p>{{ $item->barang->namabarang}}</p>
                </td>
                <td>
                    <p>{{ $item->gudangAsal->namagudang}}</p>
                </td>
                <td>
                    <p>{{ $item->quantity}}</p>
                </td>
                <td>
                    <p>{{ $item->gudangTujuan->namagudang}}</p>
                </td>
              	<td>
                  <a style="display: inline-block" href="{{ route('mutasi.edit', $item->id) }}"><button class="btn btn-primary"><span class="fas fa-pencil-alt"></span></button></a>&nbsp;&nbsp;
                  <form style="display: inline-block" action="{{ route('mutasi.destroy', $item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="submitForm(this);"><span class="fas fa-trash-alt"></span></button>
                  </form>
              	</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          {{ $mutasi->links() }}
        </ul>
      </div>
    </div>
  </div>
@endsection