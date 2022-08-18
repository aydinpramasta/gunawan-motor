@extends('layouts.main')

@section('title')
<title>Tambah Stok | Gunawan Motor</title>
@endsection

@section('header')
<h1 class="m-0">Tambah Stok</h1>
@endsection

@section('content')
<div class="col-12">
  <div class="card p-3">
    <form action="{{ route('stocks.store') }}" method="post">
      @csrf

      <div class="form-group col-12 col-md-6 mt-3">
        <button type="submit" class="btn btn-success mr-3">
          <i class="fas fa-plus"></i>&nbsp; Tambah
        </button>

        <a href="{{ route('stocks.index') }}" class="btn btn-warning">
          <i class="fas fa-arrow-circle-left"></i>&nbsp; Kembali
        </a>
      </div>
    </form>
  </div>
</div>
@endsection

@section('js')

@endsection