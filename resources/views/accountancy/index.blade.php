@extends('layouts.main')

@section('title')
<title>Akuntansi | Gunawan Motor</title>
@endsection

@section('header')
<h1 class="m-0">Akuntansi</h1>
@endsection

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

          <div class="input-group-append">
            <button type="submit" class="btn btn-default">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0" style="height: 300px;">
      <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Tipe</th>
            <th>Nilai</th>
            <th>Deskripsi</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if ($accountancies->isEmpty())
            <tr>
              <td colspan="5">
                <h3 class="text-center">Tidak ada data.</h1>
              </td>
            </tr>
          @else
            @foreach ($accountancies as $accountancy)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <span class="badge {{ ($accountancy->type === 1) ? 'bg-success' : 'bg-danger' }}">{{ ($accountancy->type === 1) ? 'Pemasukan' : 'Pengeluaran' }}</span>
                </td>
                <td>Rp {{ number_format(num: $accountancy->value, thousands_separator: '.') }},-</td>
                <td>{{ $accountancy->description }}</span></td>
                <td>Action</td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
    <div class="mx-3">
      {{ $accountancies->links() }}
    </div>
  </div>
</div>
@endsection