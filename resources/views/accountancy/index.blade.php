@extends('layouts.main')

@section('title')
<title>Akuntansi | Gunawan Motor</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/datatables/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/datatables/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/datatables/buttons.bootstrap4.min.css') }}" />
@endsection

@section('header')
<h1 class="m-0">Akuntansi</h1>
@endsection

@section('content')
<div class="col-12">
  <div class="card">
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible m-3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        {{ session()->get('success') }}
      </div>
    @endif
    <div class="card-tools d-flex flex-column flex-md-row justify-content-between mt-3 mx-4">
      <a href="{{ route('accountancies.create') }}" class="btn btn-success" style="height: fit-content;">
        <i class="fas fa-plus"></i>&nbsp; Tambah
      </a>

      <form class="d-flex flex-column flex-md-row" action="{{ route('accountancies.index') }}" method="get">
        <div class="form-group mr-3 mt-3 mt-md-0">
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="type-income" name="type" value="income" {{ (request()->input('type') === 'income') ? 'checked' : '' }}>
            <label for="type-income" class="custom-control-label">Pemasukan</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="type-expense" name="type" value="expense" {{ (request()->input('type') === 'expense') ? 'checked' : '' }}>
            <label for="type-expense" class="custom-control-label">Pengeluaran</label>
          </div>
        </div>

        <div class="form-group mr-3">
          <div class="custom-control custom-radio">
            <input class="custom-control-input custom-control-input-danger" type="radio" id="date-weekly" name="date" value="weekly" {{ (request()->input('date') === 'weekly') ? 'checked' : '' }}>
            <label for="date-weekly" class="custom-control-label">Mingguan</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input custom-control-input-danger" type="radio" id="date-monthly" name="date" value="monthly" {{ (request()->input('date') === 'monthly') ? 'checked' : '' }}>
            <label for="date-monthly" class="custom-control-label">Bulanan</label>
          </div>
        </div>

        <a href="{{ route('accountancies.index') }}" class="btn btn-outline-warning mr-0 mr-md-2" style="height: fit-content;">
          Reset
        </a>

        <button type="submit" class="btn btn-outline-secondary mt-3 mt-md-0" style="height: fit-content;">
          Filter
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
            <th>Tanggal</th>
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
              <td>{{ Carbon\Carbon::parse($accountancy->created_at)->format('d F Y') }}</td>
              <td>Rp {{ number_format(num: $accountancy->value, thousands_separator: '.') }},-</td>
              <td>{{ $accountancy->description }}</td>
              <td>
                <a href="{{ route('accountancies.edit', ['accountancy' => $accountancy->id]) }}" class="m-1 btn btn-sm btn-warning">
                  <i class="fas fa-edit"></i>
                </a>
                
                <form action="{{ route('accountancies.destroy', ['accountancy' => $accountancy->id]) }}" method="post">
                  @csrf
                  @method('delete')

                  <button id="delete-button" type="button" class="m-1 btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
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

<script>
  $(document).ready(function () {
    $("#delete-button").click(function () {
      const confirm = window.confirm('Yakin ingin menghapus data ini?');

      if (confirm) {
        $(this).parent().submit();
      }
    });

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