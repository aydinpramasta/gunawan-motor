@extends('layouts.main')

@section('title')
  <title>Tambah Akuntansi | Gunawan Motor</title>
@endsection

@section('header')
  <h1 class="m-0">Tambah Akuntansi</h1>
@endsection

@section('content')
  <div class="col-12">
    <div class="card p-3">
      <form action="{{ route('accountancies.store') }}" method="post">
        @csrf

        <div class="form-group col-12 col-md-6">
          <label>Tipe</label>
          <select class="form-control @error('type') {{ 'is-invalid' }} @enderror" name="type">
            <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Pemasukan</option>
            <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Pengeluaran</option>
          </select>
          @error('type')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-12 col-md-6">
          <label>Jumlah</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input id="value" type="text" class="form-control @error('value') {{ 'is-invalid' }} @enderror"
              name="value" value="{{ old('value') }}">
            <div class="input-group-append">
              <span class="input-group-text">,-</span>
            </div>
          </div>
          @error('value')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-12 col-md-6">
          <label>Deskripsi</label>
          <textarea class="form-control @error('description') {{ 'is-invalid' }} @enderror" rows="3" name="description">{{ old('description') }}</textarea>
          @error('description')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-12 col-md-6 mt-3">
          <button type="submit" class="btn btn-success mr-3">
            <i class="fas fa-plus"></i>&nbsp; Tambah
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
