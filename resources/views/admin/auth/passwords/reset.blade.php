<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Love Physics') }}</title>
    <!-- Fonts and Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}" type="text/css">
    <style>
    .be-left-sidebar .sidebar-elements>li ul {
        padding: 0;
    }

    #inputSmall {
      width: 360px;
    }
    </style>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="card card-border-color card-border-color-primary">
              <div class="card-header">
                <a href="{{ url('/') }}">
                    <img class="logo-img" src="{{ url('logo.png') }}" alt="logo">
                </a>
                <span class="splash-description">Please enter your user information.</span>
              </div>
              <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/reset') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ url('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/app.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        //-initialize the javascript
        App.init();
      });

    </script>
</body>
</html>