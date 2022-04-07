<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Customer</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{asset("/adminlte/plugins/fontawesome-free/css/all.min.css")}}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{asset("/adminlte/dist/css/adminlte.min.css") }}>
    <!-- Additional style -->
    <link rel="stylesheet" href={{asset("/additional/additional-style.css") }}>
</head>
<body>
    <style>
        body {
            text-align:center;
        }
        table.center {
            margin-left:auto; 
            margin-right:auto;
        }
        table {
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em solid #ccc;
            border-bottom: 0;
            border-collapse: collapse;
        }
        table td, table th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
        }
        tr, td, th {
            padding-left: 15px;
            padding-right: 15px;
        }
        .card-header {
            margin-bottom: 15px;
        }
    </style>

    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div style="display:flex; justify-content:flex-start" class="col-md-6">
                <h2 style="font-weight: bold">DAFTAR Customer</h2>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered center">
              <thead>
                <tr>
                  <th style="width: 3%">#</th>
                  <th>Kode Customer</th>
                  <th style="width: 30%">Nama Customer</th>
                  <th style="width: 35%">Alamat</th>
                  <th>Telepon</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $i=1;
                @endphp
                @foreach ($customer as $key => $item)
                  <tr>
                    <td>{{ $i }}</td>
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
                  </tr>
                  @php
                      $i++;
                  @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</body>
</html>