@extends('layouts.main')

@section('title')
  <title>Edit Akuntansi | Gunawan Motor</title>
@endsection

@section('header')
  <h1 class="m-0">Edit Akuntansi</h1>
@endsection

@section('content')
  <div class="col-12">
    <div class="card p-3">
      <form action="{{ route('accountancies.update', ['accountancy' => $accountancy->id]) }}" method="post">
        @csrf
        @method('put')

        <div class="form-group col-12 col-md-6">
          <label>Tipe</label>
          <select class="form-control" name="type">
            <option value="1" {{ $accountancy->type === 1 ? 'selected' : '' }}>Pemasukan</option>
            <option value="2" {{ $accountancy->type === 2 ? 'selected' : '' }}>Pengeluaran</option>
          </select>
        </div>

        <div class="form-group col-12 col-md-6">
          <label>Jumlah</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input id="value" type="text" class="form-control" name="value"
              value="{{ number_format(num: $accountancy->value, thousands_separator: '.') }}">
            <div class="input-group-append">
              <span class="input-group-text">,-</span>
            </div>
          </div>
        </div>

        <div class="form-group col-12 col-md-6">
          <label>Deskripsi</label>
          <textarea class="form-control" rows="3" name="description"> {{ $accountancy->description }}</textarea>
        </div>

        <div class="form-group col-12 col-md-6 mt-3">
          <button type="submit" class="btn btn-success mr-3">
            <i class="fas fa-edit"></i>&nbsp; Submit
          </button>

          <a href="{{ route('accountancies.index') }}" class="btn btn-warning">
            <i class="fas fa-arrow-circle-left"></i>&nbsp; Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(document).ready(function() {
      $('#value').keyup(function() {
        $('#value').val(formatRupiah(this.value, 'Rp. '));
      });
    });

    function formatRupiah(angka) {
      let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

      return rupiah;
    }
  </script>
@endsection
