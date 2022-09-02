@extends('layouts.main')

@section('title')
  <title>Rekap Stok | Gunawan Motor</title>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables/dataTables.bootstrap4.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/datatables/responsive.bootstrap4.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/datatables/buttons.bootstrap4.min.css') }}" />
@endsection

@section('header')
  <h1 class="m-0">Rekap Stok</h1>
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <table id="stocks-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Jumlah Stok</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($stocks as $stock)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $stock->name }}</td>
                <td>Rp {{ number_format(num: $stock->price, thousands_separator: '.') }},-</td>
                <td>{{ number_format(num: $stock->quantity, thousands_separator: '.') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('assets/js/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables/buttons.print.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $("#stocks-table")
        .DataTable({
          searching: false,
          responsive: true,
          autoWidth: false,
          info: false,
          paging: false,
          buttons: ["excel", "pdf", "print"],
        })
        .buttons()
        .container()
        .appendTo("#stocks-table_wrapper .col-md-6:eq(0)");
    });
  </script>
@endsection
