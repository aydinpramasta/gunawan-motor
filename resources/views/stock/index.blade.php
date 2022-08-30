@extends('layouts.main')

@section('title')
  <title>Stok | Gunawan Motor</title>
@endsection

@section('css')
@endsection

@section('header')
  <h1 class="m-0">Stok</h1>
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
        <a href="{{ route('stocks.create') }}" class="btn btn-success" style="height: fit-content;">
          <i class="fas fa-plus"></i>&nbsp; Tambah
        </a>

        <form class="d-flex flex-column flex-md-row mt-3 mt-md-0" action="{{ route('stocks.index') }}" method="get">
          <div class="input-group">
            <input type="text" name="search" class="form-control float-right" placeholder="Search"
              value="{{ request()->query('search') }}">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="card-body row">
        @forelse ($stocks as $stock)
          <div class="mt-3 col-12 col-md-4">
            <div class="card">
              <div class="card-header d-flex justify-content-end">
                <a href="{{ route('stocks.edit', ['stock' => $stock->slug]) }}" class="btn btn-sm btn-warning mr-2">
                  <i class="fas fa-edit"></i>
                </a>

                <form action="{{ route('stocks.destroy', ['stock' => $stock->slug]) }}" method="post">
                  @csrf
                  @method('delete')

                  <button onclick="return window.confirm('Yakin ingin menghapus data ini?')" type="submit"
                    class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
              <img
                src="{{ $stock->image !== null ? asset('storage/' . $stock->image) : asset('storage/stock-null.png') }}"
                class="card-img-top" height="300" style="object-fit: cover;" alt="{{ $stock->name }}">
              <div class="card-body">
                <h5 class="card-title"><strong>{{ $stock->name }}</strong></h5>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                  <strong>Harga:</strong>
                  <span>Rp {{ number_format(num: $stock->price, thousands_separator: '.') }},-</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                  <strong>Jumlah:</strong>
                  <span>{{ number_format(num: $stock->quantity, thousands_separator: '.') }}</span>
                </li>
              </ul>
            </div>
          </div>
        @empty
          <h3 class="mx-auto">Tidak ada data.</h3>
        @endforelse
        <div class="mt-5 mx-3">
          {{ $stocks->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
@endsection
