@extends('layouts.app')
@section('style')
<style>
    html,body {
      font-family: 'Open Sans', serif;
      font-size: 14px;
      font-weight: 300;
    }
    .hero.is-success {
      background: #F2F6FA;
    }
    .hero .nav, .hero.is-success .nav {
      -webkit-box-shadow: none;
      box-shadow: none;
    }
    .box {
      margin-top: 5rem;
    }
    .avatar {
      margin-top: -70px;
      padding-bottom: 20px;
    }
    .avatar img {
      padding: 5px;
      background: #fff;
      border-radius: 50%;
      -webkit-box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
      box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
    }
    input {
      font-weight: 300;
    }
    p {
      font-weight: 700;
    }
    p.subtitle {
      padding-top: 1rem;
    }
</style>
@endsection
@section('content')
<section class="hero is-success is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">التنسيق</h3>
                <p class="subtitle has-text-grey">برجاء كتابة رقم الجلوس والكود الخاص بالطالب </p>
                <div class="box">
                    <figure class="avatar">
                        <img src="{{ url('images/logo.jpg') }}" style="max-width: 128px">
                    </figure>
                    <form method="POST" action="{{ route('login') }}">
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {{ csrf_field() }}
                        <div class="field">
                            <div class="control">
                                <input class="input is-large has-text-right" name="email" type="text" placeholder="رقم الجلوس" autofocus="">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control ">
                                <input class="input is-large has-text-right" name="password" type="text" placeholder="الكود">
                            </div>
                        </div>
                        <button class="button is-block is-info is-large is-fullwidth">تسجيل الدخول</button>
                    </form>
                </div>
                <p class="has-text-grey">
                    <a href="#">حول الموقع</a> &nbsp;·&nbsp;
                    <a href="#">مساعدة؟</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection