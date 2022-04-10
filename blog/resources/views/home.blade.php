@extends('layouts.master')
@section('page-title')
    Home
@endsection
@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-8">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $penjualan }}</h3>
  
                  <p>Penjualan</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('penjualan.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-8">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $pembelian }}</h3>
  
                  <p>Pembelian</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('pembelian.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-8">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $mutasi }}</h3>
  
                  <p>Mutasi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('mutasi.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                To Do List
              </h3>

              <div class="card-tools">
                <ul class="pagination pagination-sm">
                  {{ $agenda->links() }}
                </ul>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul class="todo-list" data-widget="todo-list">
                @foreach ($agenda as $item)
                <li>
                  <div  class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                    <label for="todoCheck1"></label>
                  </div>
                  <span class="text">{{ $item->catatan }}</span>
                  <div class="tools">
                    <form action="{{ route('agenda.destroy', $item->id) }}" method="post" id="hapuscatatan">
                      @csrf
                      @method('DELETE')
                      <a style="color: red" href="#" onclick="document.getElementById('hapuscatatan').submit();">
                        <i onclick="submitForm(this);" class="fas fa-trash-alt"></i>
                      </a>
                    </form>
                  </div>
                </li>
                @endforeach
              </ul>

            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <form action={{ route('agenda.store') }} method="post">
                @csrf
                <div class="input-group">
                  <input onkeyup="activeButton()" id="catatan" type="text" name="catatan" class="form-control input-md" placeholder="Tambahkan Catatan">
                  <span class="input-group-btn">
                    <button id="tambahcatatan" disabled="true" onclick="submitForm(this);" type="submit" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Tambah</button>
                  </span>   
                </div>
              </form>    
            </div>
          </div>
    </section>
@endsection
