<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('title')

  <link rel="icon" href="{{ asset('gm-logo.png') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('assets/css/fontawesome/all.min.css') }}">
  @yield('css')
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @yield('navbar')
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

        <li class="nav-item">
          <form id="logout" action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" onclick="return window.confirm('Apakah anda yakin untuk keluar?')"
              class="btn nav-link">
              <i class="fas fa-sign-out-alt"></i>
            </button>
          </form>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">
          <img src="{{ asset('gm-logo.png') }}" alt="GM Logo" class="mr-2" style="width: 35px;">
          Gunawan Motor
        </span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <span class="d-block text-white">{{ auth()->user()->name }}</span>
          </div>
        </div>

        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link {{ request()->path() === '/' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('accountancies.index') }}"
                class="nav-link {{ str_contains(request()->path(), 'accountancies') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Akuntansi
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('stocks.index') }}"
                class="nav-link {{ str_contains(request()->path(), 'stocks') ? 'active' : '' }}">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Stok
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('recaps.index') }}"
                class="nav-link {{ str_contains(request()->path(), 'recaps') ? 'active' : '' }}">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                  Rekap
                </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              @yield('header')
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            @yield('content')
          </div>
        </div>
      </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>

    <footer class="main-footer">
      <strong>Copyright &copy; 2022 RPL SMK Negeri 8 Semarang</strong>
    </footer>
  </div>

  <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/adminlte/adminlte.min.js') }}"></script>
  @yield('js')
</body>

</html>
