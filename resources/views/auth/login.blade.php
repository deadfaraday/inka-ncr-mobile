<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="../assets/img/log.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Online NCR</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/paper-kit.css?v=2.0.1') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet">

    <!--     Fonts and icons     -->
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-toggleable-md fixed-top navbar-transparent">
        <div class="container">
      <div class="navbar-translate">
              <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar"></span>
          <span class="navbar-toggler-bar"></span>
          <span class="navbar-toggler-bar"></span>
              </button>
              <a class="navbar-brand" href="http://inka.co.id" target="_blank">
                    <img border="0" alt="" src="../assets/img/cropped-logo3.png" width="50%" height="50%">
                </a>
      </div>
      <div class="collapse navbar-collapse" id="navbarToggler">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      {{-- <a href="{{ url('/') }}" class="nav-link"><i class="nc-icon nc-bank"></i> Home</a> --}}
                      <a href="{{ url('/') }}" class="btn btn-danger btn-round">Home</a>
                  </li>
              </ul>
          </div>
    </div>
    </nav>
    <div class="wrapper">
        <div class="page-header" style="background-image: url('../assets/img/IMG_5807.jpg');">
            <div class="filter"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 offset-lg-4 col-sm-6 offset-sm-3">
                            <div class="card card-register">
                                <h3 class="title">Online NCR</h3>
                            <form action="{{ route('login') }}" method="POST" class="register-form">
                                {{ csrf_field() }}
                                <div class="form-group has-feedback{{ $errors->has('nip') ? ' has-error' : '' }}" style="border-color: #FF8F5E; border-style: solid; border-width: 2px; border-radius: 8px;">
                                    <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-badge"></i>
                                        </span>
                                        <input id="nip" type="text" class="form-control" name="nip" value="{{ old('nip') }}" placeholder="NIP" required autofocus>
                                    </div>
                                </div>
                                  <span class="glyphicon glyphicon-exclamation-sign form-control-feedback"></span>
                                  @if ($errors->has('nip'))
                                      <span class="help-block" style="color: #f5593d;">{{ $errors->first('nip') }}</span>
                                  @endif
                                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}" style="border-color: #FF8F5E; border-style: solid; border-width: 2px; border-radius: 8px;">
                                    <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                        
                                    </div>
                                </div>
                                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                  @if ($errors->has('password'))
                                    <span class="help-block" style="color: #f5593d;">{{ $errors->first('password') }}</span>
                                  @endif
                                    <button type="submit" class="btn btn-danger btn-block btn-round">Sign In</button>    
                            </form>
                            </div>
                        </div>
                    </div>
          <div class="footer register-footer text-center">
            <h6>&copy; <script>document.write(new Date().getFullYear())</script>, made by IT Development</h6>
          </div>
                </div>
        </div>
    </div>
</body>

<!-- Core JS Files -->
<script src="{{ asset('assets/js/jquery-3.2.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/tether.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="{{ asset('assets/js/paper-kit.js?v=2.0.1') }}"></script>

</html>

