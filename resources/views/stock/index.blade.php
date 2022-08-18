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

      <form class="d-flex flex-column flex-md-row" action="{{ route('stocks.index') }}" method="get">
      </form>
    </div>

    <div class="card-body">

      <div class="mt-5 mx-3">
        
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')

@endsection