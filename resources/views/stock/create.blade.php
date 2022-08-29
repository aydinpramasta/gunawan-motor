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
      <form action="{{ route('stocks.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group col-12 col-md-6">
          <label>Nama Produk</label>
          <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group col-12 col-md-6">
          <label for="image">Gambar <small>(maks. 2 MB)</small></label>
          <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="image">
            <label class="custom-file-label" for="image"></label>
          </div>
        </div>

        <div class="form-group col-12 col-md-6">
          <label>Harga</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input id="price" type="text" class="form-control" name="price">
            <div class="input-group-append">
              <span class="input-group-text">,-</span>
            </div>
          </div>
        </div>

        <div class="form-group col-12 col-md-6">
          <label>Jumlah</label>
          <input type="number" name="quantity" class="form-control">
        </div>

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
  <script src="{{ asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();
    });

    $(document).ready(function() {
      $('#price').keyup(function() {
        $('#price').val(formatRupiah(this.value, 'Rp. '));
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
