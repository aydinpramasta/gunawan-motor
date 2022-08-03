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
      <h3><sup style="font-size: 20px">Rp </sup>{{ number_format(num: $income->sum('value'), thousands_separator: '.') }},-</h3>

      <p>Pemasukan</p>
    </div>
    <div class="icon">
      <i class="ion ion-stats-bars"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-md-6 col-12">
  <div class="small-box bg-danger">
    <div class="inner">
      <h3><sup style="font-size: 20px">Rp </sup>{{ number_format(num: $expense->sum('value'), thousands_separator: '.') }},-</h3>

      <p>Pengeluaran</p>
    </div>
    <div class="icon">
      <i class="ion ion-card"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-12">
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Pendapatan</h3>
      </div>
    </div>
    <div class="card-body">
      <div class="d-flex">
        <p class="d-flex flex-column">
          <span>Pendapatan Minggu Ini</span>
          <span class="text-bold text-lg">Rp {{ number_format(num: $income->sum('value') - $expense->sum('value'), thousands_separator: '.') }},-</span>
        </p>
      </div>
      <!-- /.d-flex -->

      <div class="position-relative mb-4">
        <canvas id="visitors-chart" height="200"></canvas>
      </div>

      <div class="d-flex flex-row justify-content-end">
        <span class="mr-2">
          <i class="fas fa-square text-primary"></i> Minggu Ini
        </span>

        <span>
          <i class="fas fa-square text-gray"></i> Minggu Kemarin
        </span>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/js/chartjs/Chart.min.js') }}"></script>
<script>
  const ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  const mode = 'index'
  const intersect = true

  const $visitorsChart = document.getElementById('visitors-chart')
  const visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type: 'line',
        data: [100, 120, 170, 167, 180, 177, 160],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
      },
      {
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
</script>
@endsection