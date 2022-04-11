@extends('layouts.master')
@section('breadcrumb')
  <li><p>/</p></li>&nbsp;
  <li style="color: #777777"><a href={{route('pembelian.index') }}>Barang Masuk</a></li>
@endsection
@section('page-title')
    Barang Masuk
@endsection
@section('title')
    Barang Masuk
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div style="display:flex; justify-content:flex-start" class="col-md-6">
            <a href={{route('pembelian.create') }}><button type="button" class="btn btn-success">Catat Pembelian Baru</button></a>&nbsp;&nbsp;&nbsp;
            <a href="/pembelian/pdf"><button type="button" class="btn btn-info">Cetak File PDF</button></a>
          </div>
          <div style="display:flex; justify-content:flex-end" class="col-md-6">
            <form method="GET" action="{{route('pembelian.index') }}">
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
              <th>Tanggal</th>
              <th style="width: 15%">Supplier</th>
              <th style="width: 15%">Nama Barang</th>
              <th style="width: 15%">Harga Beli/Unit</th>
              <th style="width:3%">Qty</th>
              <th>Subtotal</th>
              <th style="width: 11%">Tujuan</th>
              <th style="width: 18%">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pembelian as $item)
              <tr>
                <td>
                  <p>{{ $item->tanggal}}</p>
                </td>
                <td>
                  <p>{{ $item->namasupplier}}</p>
                </td>
                <td>
                    <p>{{ $item->namabarang}}</p>
                </td>
                <td>
                    <p>{{ number_format($item->hargamodal)}}</p>
                </td>
                <td>
                    <p>{{ $item->quantity}}</p>
                </td>
                <td>
                  <p>{{ number_format($item->hargamodal * $item->quantity) }}</p>
                </td>
                <td>
                    <p>{{ $item->namagudang}}</p>
                </td>
              	<td>
                  <a style="display: inline-block" href="{{ route('pembelian.show', $item->id) }}"><button class="btn btn-info"><span class="fas fa-eye"></span></button></a>&nbsp;
                  <a style="display: inline-block" href="{{ route('pembelian.edit', $item->id) }}"><button class="btn btn-primary"><span class="fas fa-pencil-alt"></span></button></a>&nbsp;
                  <form style="display: inline-block" action="{{ route('pembelian.destroy', $item->id)}}" method="post">
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
      <div class="card-header">
        <div class="row">
          <div style="display:flex; justify-content:flex-start" class="col-md-12">
            <h3>Total Biaya : Rp {{ number_format($totalharga) }}</h3>
          </div>
        </div>
      </div>
      
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          {{ $pembelian->links() }}
        </ul>
      </div>
    </div>
  </div>
@endsection