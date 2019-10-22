<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'Stisla Laravel') &mdash; {{ env('APP_NAME') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">

  @yield('style')
  <style>
.col-md-3{
  display: inline-block;
  margin-left:-4px;
}
.col-md-3 img{
  width:100%;
  height:auto;
}
body .carousel-indicators li{
  background-color:red;
}
body .carousel-indicators{
  bottom: 0;
}
body .carousel-control-prev-icon,
body .carousel-control-next-icon{
  background-color:red;
}
body .no-padding{
  padding-left: 0;
  padding-right: 0;
   }
  </style>
</head>

<body class="layout-3 bg-light">
    <div id="app">
      <div class="main-wrapper container">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
          <div class="container">
            @include('pages.partials.topnav')
          </div>
        </nav>
        <nav class="navbar navbar-secondary navbar-expand-lg">
            @include('pages.partials.secondnav')
        </nav>
      </div>
       
        <!-- Main Content -->
        <div class="main-content">
            @yield('banner')
              
          <section class="section container">       
              {{-- <div class="section-header">
                  <h1>Top Navigation</h1>
                  <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Layout</a></div>
                    <div class="breadcrumb-item">Top Navigation</div>
                  </div>
                </div> --}}
  
            <div class="section-body">
              <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><i class="fa fa-coin" aria-hidden="true"></i> Harga Terbaik</h5>
                      <hr>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      <p class="card-text">Lorem ipsum dolor sit amet elit, adipiscing, sed do eiusmod tempor incididunt ut labore dolore magna..</p>
                    </div>
                  </div>  
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><i class="fa fa-coin" aria-hidden="true"></i> Harga Terbaik</h5>
                      <hr>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      <p class="card-text">Lorem ipsum dolor sit amet elit, adipiscing, sed do eiusmod tempor incididunt ut labore dolore magna..</p>
                    </div>
                  </div>  
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><i class="fa fa-coin" aria-hidden="true"></i> Harga Terbaik</h5>
                      <hr>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      <p class="card-text">Lorem ipsum dolor sit amet elit, adipiscing, sed do eiusmod tempor incididunt ut labore dolore magna..</p>
                    </div>
                  </div>  
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><i class="fa fa-coin" aria-hidden="true"></i> Harga Terbaik</h5>
                      <hr>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      <p class="card-text">Lorem ipsum dolor sit amet elit, adipiscing, sed do eiusmod tempor incididunt ut labore dolore magna..</p>
                    </div>
                  </div>  
                </div>
              </div>

              <hr class="">

              <h2 class="text-center"> Promo </h2>
              <p class="text-center mt-3">Nikmati Berbagai Penawaran Eksklusif di Pergiwisata.com</p>
              <div class="row">
                  @include('pages.partials.popular-place')
              </div>
            </div>
          </section>
        </div>
        
        @include('pages.partials.footer')
        <footer class="main-footer bg-dark">
            <div class="container">
              <div class="footer-left">
                  Copyright &copy; 2019 <div class="bullet"></div> <a href="https://Pergiwisata.com/">Pergiwisata.com</a>
                </div>
                <div class="footer-right">
                  
                </div>
          </div>
        </footer>
      </div>
    </div>

  <script src="{{ route('js.dynamic') }}"></script>
  <script src="{{ asset('js/app.js') }}?{{ uniqid() }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>

  <!-- JS Libraies -->
  <script src="assets/modules/sticky-kit.js"></script>

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  @yield('scripts')
  <script>
    $('#toggle-modal').fireModal({
      title: 'My Modal',
      content: 'Hello!'
    });
  </script>

</body>

</html>
