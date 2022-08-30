@extends('layouts.main')

@section('title')
  <title>Rekap Akuntansi | Gunawan Motor</title>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/datatables/dataTables.bootstrap4.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/datatables/responsive.bootstrap4.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/datatables/buttons.bootstrap4.min.css') }}" />
@endsection

@section('header')
  <h1 class="m-0">Rekap Akuntansi</h1>
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-tools d-flex flex-column flex-md-row justify-content-end mt-3 mx-4">
        <form class="d-flex flex-column flex-md-row" action="{{ route('recaps.accountancy') }}" method="get">
          <div class="form-group mr-0 mr-md-3 mt-3 mt-md-0">
            <select name="date" class="form-control select2" style="width: 100%">
              @forelse ($months as $key => $month)
                <option value="{{ $key }}" {{ request()->query('date') === $key ? 'selected' : '' }}>
                  {{ $month }}</option>
              @empty
                <option>-- Belum ada Akuntansi --</option>
              @endforelse
            </select>
          </div>

          <button type="submit" class="btn btn-outline-secondary mt-3 mt-md-0" style="height: fit-content;">
            Submit
          </button>
        </form>
      </div>

      <div class="card-body">
        <table id="accountancies-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Tipe</th>
              <th>Tanggal</th>
              <th>Nilai</th>
              <th>Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($accountancies as $accountancy)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <span class="badge {{ $accountancy->type === 1 ? 'badge-success' : 'badge-danger' }}">
                    {{ $accountancy->type === 1 ? 'Pemasukan' : 'Pengeluaran' }}
                  </span>
                </td>
                <td>{{ Carbon\Carbon::parse($accountancy->created_at)->format('d F Y') }}</td>
                <td>Rp {{ number_format(num: $accountancy->value, thousands_separator: '.') }},-</td>
                <td>{{ $accountancy->description }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
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
      $(".select2").select2();

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
