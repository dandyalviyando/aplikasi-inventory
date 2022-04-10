@extends('layouts.master')
@section('breadcrumb')
  <li><p>/</p></li>&nbsp;
  <li style="color: #777777"><a href={{route('customer.index') }}>Customer</a></li>
@endsection
@section('page-title')
    Customer
@endsection
@section('title')
    Customer
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div style="display:flex; justify-content:flex-start" class="col-md-6">
            <a href={{route('customer.create') }}><button type="button" class="btn btn-success">Tambah Customer</button></a>&nbsp;&nbsp;&nbsp;
            <a href="/customer/pdf"><button type="button" class="btn btn-info">Cetak File PDF</button></a>
          </div>
          <div style="display:flex; justify-content:flex-end" class="col-md-6">
            <form method="GET" action="{{route('customer.index') }}">
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
              <th>Kode Customer</th>
              <th style="width: 25%">Nama Customer</th>
              <th style="width: 30%">Alamat</th>
              <th style="width: 15%">Telepon</th>
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($customer as $item)
              <tr>
                <td>
                  <p>{{ $item->kodecustomer}}</p>
                </td>
                <td>
                  <p>{{ $item->namacustomer}}</p>
                </td>
                <td>
                    <p>{{ $item->alamat}}</p>
                </td>
                <td>
                    <p>{{ $item->telepon}}</p>
                </td>
              	<td>
                  <a style="display: inline-block" href="{{ route('customer.edit', $item->id) }}"><button class="btn btn-primary"><span class="fas fa-pencil-alt"></span></button></a>&nbsp;&nbsp;
                  <form style="display: inline-block" action="{{ route('customer.destroy', $item->id)}}" method="post">
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
          {{ $customer->links() }}
        </ul>
      </div>
    </div>
  </div>
@endsection