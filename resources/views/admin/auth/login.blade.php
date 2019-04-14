
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Love Physics') }}</title>
        
        <link rel="stylesheet" href="{{ url('css/uikit.min.css') }}" />
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ url('css/style.css') }}" />
        <link rel="stylesheet" href="{{ url('css/notyf.min.css') }}" />
        <script src="{{ url('js/uikit.min.js') }}" ></script>
        <script src="{{ url('js/uikit-icons.min.js') }}" ></script>
        <style>
            * {
                direction: rtl;
            }
        </style>
    </head>
    <body>
        <div uk-sticky="media: 960" class="uk-navbar-container tm-navbar-container uk-sticky uk-active" style="position: fixed; top: 0px; width: 1903px;">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar>
                    <div class="uk-navbar-left">
                        <a href="#" class="uk-navbar-item uk-logo">
                            التنسيق
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="content-background">
            <div class="uk-section-small">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-2-3@l">
                        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
                        <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    تسجيل الدخول للادمن
                                </div>
                                <div class="uk-card-body">
                                    <center>
                                        <h2>تسجيل الدخول</h2><br />
                                    </center>
                                    <form method="POST" action="/admin/login">
                                        {{ csrf_field() }}
                                        <fieldset class="uk-fieldset">

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-android-person"></span>
                                                    <input name="email" class="uk-input" type="email" placeholder="البريد الالكترونى">
                                                </div>
                                            </div>

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-locked"></span>
                                                    <input name="password" class="uk-input" type="password" placeholder="كلمة السر">
                                                </div>
                                            </div>

                                            <div class="uk-margin">
                                                <a href="#">هل نسيت كلمة السر؟</a>
                                            </div>

                                            <div class="uk-margin">
                                                <button type="submit" class="uk-button uk-button-primary">
                                                    <span class="ion-forward"></span>&nbsp; تسجيل الدخول
                                                </button>
                                            </div>

                                            <hr />
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ url('js/script.js') }}"></script>
    </body>
</html>
