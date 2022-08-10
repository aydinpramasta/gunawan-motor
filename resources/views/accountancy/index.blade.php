@extends('layouts.main')

@section('title')
<title>Akuntansi | Gunawan Motor</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/datatables/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/datatables/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/datatables/buttons.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}" />
@endsection

@section('header')
<h1 class="m-0">Akuntansi</h1>
@endsection

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-tools d-flex justify-content-between mt-3 mx-4">
      <a href="{{ route('accountancies.create') }}" class="btn btn-success" style="height: fit-content">
        <i class="fas fa-plus"></i>&nbsp; Tambah
      </a>

      <form class="d-flex ml-auto" action="{{ route('accountancies.index') }}" method="get">
        <select id="filter" name="filter[]" multiple="multiple" data-placeholder="Filter" style="width: 300px;">
          <option value="p-off">Pagination Off</option>
          <option value="just-income">Hanya Pendapatan</option>
          <option value="just-expense">Hanya Pengeluaran</option>
          <option value="this-week">Minggu ini</option>
          <option value="this-month">Bulan ini</option>
        </select>

        <input type="text" name="search" class="form-control mx-3" placeholder="Search" style="width: 150px;">
        
        <button type="submit" class="btn btn-primary" style="height: fit-content;">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>

    <div class="card-body">
      <table
        id="accountancies-table"
        class="table table-bordered table-striped"
      >
        <thead>
          <tr>
            <th>#</th>
            <th>Tipe</th>
            <th>Nilai</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($accountancies as $accountancy)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <span class="badge {{ ($accountancy->type === 1) ? 'badge-success' : 'badge-danger' }}">
                  {{ ($accountancy->type === 1) ? 'Pemasukan' : 'Pengeluaran' }}
                </span>
              </td>
              <td>Rp {{ number_format(num: $accountancy->value, thousands_separator: '.') }},-</td>
              <td>{{ $accountancy->description }}</td>
              <td>Action</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-5 mx-3">
        {{ $accountancies->links() }}
      </div>
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
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>

<script>
  $(function () {
    $("#filter").select2();

    $("#accountancies-table")
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
      .appendTo("#accountancies-table_wrapper .col-md-6:eq(0)");
  });
</script>
@endsection