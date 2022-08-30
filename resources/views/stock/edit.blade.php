@extends('layouts.main')

@section('title')
  <title>Edit Stok | Gunawan Motor</title>
@endsection

@section('header')
  <h1 class="m-0">Edit Stok</h1>
@endsection

@section('content')
  <div class="col-12">
    <div class="card p-3">
      <form action="{{ route('stocks.update', ['stock' => $stock->slug]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group col-12 col-md-6">
          <label>Nama Produk</label>
          <input type="text" name="name" class="form-control @error('name') {{ 'is-invalid' }} @enderror"
            value="{{ $stock->name }}">
          @error('name')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-12 col-md-6">
          <label for="image">Gambar <small>(maks. 2 MB)</small></label>
          <div class="custom-file">
            <input type="file" accept=".png,.jpg,.jpeg,.svg,.webp" name="image"
              class="custom-file-input @error('image') {{ 'is-invalid' }} @enderror" id="image">
            <label class="custom-file-label" for="image"></label>
          </div>
          @error('image')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-12 col-md-6">
          <label>Harga</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input id="price" type="text" class="form-control @error('price') {{ 'is-invalid' }} @enderror"
              name="price" value="{{ number_format(num: $stock->price, thousands_separator: '.') }}">
            <div class="input-group-append">
              <span class="input-group-text">,-</span>
            </div>
          </div>
          @error('price')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-12 col-md-6">
          <label>Jumlah</label>
          <input type="number" name="quantity" class="form-control @error('quantity') {{ 'is-invalid' }} @enderror"
            value="{{ $stock->quantity }}">
          @error('quantity')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-12 col-md-6 mt-3">
          <button type="submit" class="btn btn-success mr-3">
            <i class="fas fa-edit"></i>&nbsp; Submit
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
