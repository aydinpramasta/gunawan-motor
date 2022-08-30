@extends('layouts.main')

@section('title')
  <title>Rekap | Gunawan Motor</title>
@endsection

@section('header')
  <h1 class="m-0">Pilih Rekap</h1>
@endsection

@section('content')
  <div class="col-12 col-md-6">
    <a class="card" href="{{ route('recaps.accountancy') }}">
      <img src="{{ asset('assets/img/accountancy-placeholder.jpg') }}" height="300" class="card-img-top"
        alt="Ilustrasi Akuntansi">
      <div class="card-footer text-center text-bold">
        Rekap Akuntansi
      </div>
    </a>
  </div>

  <div class="col-12 col-md-6">
    <a class="card" href="{{ route('recaps.stock') }}">
      <img src="{{ asset('assets/img/stock-placeholder.jpg') }}" height="300" class="card-img-top" alt="Ilustrasi Stok">
      <div class="card-footer text-center text-bold">
        Rekap Stok
      </div>
    </a>
  </div>
@endsection
