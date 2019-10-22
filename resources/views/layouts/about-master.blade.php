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
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
 
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

    body.layout-3 .main-content {
    padding-left: 0;
    padding-right: 0;
    padding-top: 170px; }
  </style>
</head>

<body class="layout-3 bg-light">
    <div id="app">
      <div class="main-wrapper container">
        <div class="navbar-bg "></div>
        <nav class="navbar navbar-expand-lg main-navbar">
          <div class="container">
            @include('pages.partials.topnav')
          </div>
        </nav>
        <nav class="navbar navbar-secondary navbar-expand-lg">
            @include('pages.partials.secondnav')
        </nav>
       
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
              
                <div class="card card-primary">
                        <div class="row m-0">
                          <div class="col-12 col-md-12 col-lg-12 p-0">
                            <div class="card-header text-center"><h4>Tentang Kami</h4></div>
                            <div class="card-body">
                              <p>Pergi Wisata Tour & Travel adalah biro perjalanan wisata yang disingkat dari Pison Sinergi Wisata yang didirikan sejak Maret 2011. Berdirinya Pergi Wisata Tour & Travel di latarbelakangi oleh keinginan yang kuat untuk memberikan layanan wisata perjalanan yang berbeda dari yang selama ini banyak ditawarkan, sekaligus memperkenalkan potensi wisata yang ada di Indonesia. Betapa liburan akan lebih berkesan jika bukan hanya sekedar liburan saja tetapi wisatawan juga mendapatkan pengalaman baru dan yang tak terlupakan.</p>


                              <p>Pergi Wisata Tour & Travel lebih dari sebuah agen perjalanan. Mengantarkan klien dan menemani perjalanan hanya sebagian kecil dari tugas kami. Kami ingin menjadi mitra perjalanan bagi klien kami, memfasilitasi dan mengurus semua rincian kebutuhan perjalanan dan memberikan mereka kenyamanan serta kepuasan saat berlibur. Klien diharapkan tidak perlu repot dengan urusan perencanaan liburan, dan dapat mulai bersantai sejak sebelum berangkat. Bagi kami, pelayanan yang baik memiliki arti dan nilai lebih dari sekedar harga yang kompetitif.</p>
                                    
                                    
                                    <p>Pergi Wisata Tour & Travel tidak menjual paket wisata pada klien, namun kami ingin memahami kebutuhan klien kami. Setiap klien dapat merancang solusi perjalanan yang spesifik dan sesuai dengan keinginan dan kebutuhan klien.</p>
                                    
                                    
                                    <p>Nilai-nilai yang diusung Pergi Wisata Tour & Travel dalah komunikasi, motivasi, kepuasan dan kemitraan. Kami yakin dengan mengerti akan kebutuhan serta keinginan klien akan menciptakan perjalanan yang baik menjadi perjalanan yang luar biasa dan tak terlupakan.</p>
                            </div>  
                          </div>
                        </div>
                      </div>
            </section>
        </div>
        
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>

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
