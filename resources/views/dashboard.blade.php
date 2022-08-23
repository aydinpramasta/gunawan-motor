@extends('layouts.main')

@section('title')
  <title>Dashboard | Gunawan Motor</title>
@endsection

@section('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('header')
  <h1 class="m-0">Dashboard</h1>
@endsection

@section('content')
  <div class="col-md-6 col-12">
    <div class="small-box bg-success">
      <div class="inner">
        <h3><sup style="font-size: 20px">Rp </sup>{{ number_format(num: $income, thousands_separator: '.') }},-</h3>

        <p>Pemasukan</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="{{ route('accountancies.index', ['type' => 'income', 'date' => 'weekly']) }}" class="small-box-footer">More
        info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-md-6 col-12">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><sup style="font-size: 20px">Rp </sup>{{ number_format(num: $expense, thousands_separator: '.') }},-</h3>

        <p>Pengeluaran</p>
      </div>
      <div class="icon">
        <i class="ion ion-card"></i>
      </div>
      <a href="{{ route('accountancies.index', ['type' => 'expense', 'date' => 'weekly']) }}"
        class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
@endsection
