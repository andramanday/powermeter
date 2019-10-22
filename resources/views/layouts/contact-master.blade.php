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
                          <div class="col-12 col-md-12 col-lg-5 p-0">
                            <div class="card-header text-center"><h4>Contact Us</h4></div>
                            <div class="card-body">
                              <form method="POST">
                                <div class="form-group floating-addon">
                                  <label>Name</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        <i class="far fa-user"></i>
                                      </div>
                                    </div>
                                    <input id="name" type="text" class="form-control" name="name" autofocus placeholder="Name">
                                  </div>
                                </div>
          
                                <div class="form-group floating-addon">
                                  <label>Email</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                      </div>
                                    </div>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                                  </div>
                                </div>
          
                                <div class="form-group">
                                  <label>Message</label>
                                  <textarea class="form-control" placeholder="Type your message" data-height="150"></textarea>
                                </div>
          
                                <div class="form-group text-right">
                                  <button type="submit" class="btn btn-round btn-lg btn-primary">
                                    Send Message
                                  </button>
                                </div>
                              </form>
                            </div>  
                          </div>
                          <div class="col-12 col-md-12 col-lg-7 p-2">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2770852123817!2d106.65472961464819!3d-6.227151962719269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fbdc1817d363%3A0x5badf08a5a56a5aa!2sRuko%20Prominence!5e0!3m2!1sen!2sid!4v1568626102630!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
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
