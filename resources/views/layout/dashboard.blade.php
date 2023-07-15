<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="/img/logopnj.png" type="image/x-icon">
  <title>
    SIMBKM Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="/css/nucleo-icons.css" rel="stylesheet" />
  {{-- <link href="{{ asset('/css/nucleo-icons.css') }}" rel="stylesheet" /> --}}
  <link href="/css/nucleo-svg.css" rel="stylesheet" />
  {{-- <link href="{{ asset('../public/css/nucleo-svg.css') }}" rel="stylesheet" /> --}}
  
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="/css/nucleo-svg.css" rel="stylesheet" />
  {{-- <link href="{{ URL::asset('../public/css/nucleo-svg.css') }}" rel="stylesheet" /> --}}

  <!-- CSS Files -->
  <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  {{-- <link id="pagestyle" href="{{ URL::asset('/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" /> --}}
  {{-- <link id="pagestyle" href="{{ URL::asset('css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" /> --}}
  {{-- Trix-dependency --}}
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
  
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}

  <style>
    trix-toolbar [data-trix-button-group="file-tools"]{
      display: none;
    }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300  position-absolute w-100" style="background-color:#5ca8b1;"></div>
  {{-- sidebar --}}
  @include('partials.sidebar')
  {{-- endsidebar --}}
  
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('partials.navbar-dashboard')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @yield('container')
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="/js/core/popper.min.js"></script>
  <script src="/js/core/bootstrap.min.js"></script>
  <script src="/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="/js/plugins/chartjs.min.js"></script>
  
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
</body>
</html>