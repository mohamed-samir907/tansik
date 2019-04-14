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

<section class="hero is-success is-fullheight" id="app">
    <div class="hero-body">
        <div class="container has-text-centered">
          
          <h3 class="title has-text-grey">النتيجة </h3>
          <span>@{{ errorMessage }}</span>
          <p v-if="result.length == 0" class="subtitle has-text-grey">برجاء كتابة رقم الجلوس لمعرفة النتيجة</p>
          <p v-else class="subtitle has-text-grey">
            <a href="#" class="button" @click="returnBack">اضغط للرجوع لمعرفة نتيجة اخرى</a>
          </p>
          <!-- Result Div -->
          <div v-if="result.length == 1">
            <!-- START ARTICLE -->
            <div class="card article" style="margin-bottom: 10px;">
                <div class="card-content">
                    <div class="content article-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>المدرسة:</b> @{{ result[0].school.name }}</td>
                                    <td><b>اسم الطالب:</b> @{{ result[0].name }}</td>
                                    <td><b>رقم الجلوس: </b> @{{ result[0].s_number }}</td>
                                    <td><b>الحالة</b> 
                                      <span class="has-background-success has-text-white" style="padding: 10px;">ناجح</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- END ARTICLE -->
            <!-- START ARTICLE -->
            <div class="card article" style="margin-bottom: 10px;">
              <div class="card-content">
                <div class="content article-body">
                  @{{ errorMessage }}
                  <table class="table">
                    <tbody>
                      <tr>
                        <th class="col is-6">عربى</th>
                        <td class="col is-6">@{{ result[0].arabic }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">انجليزى</th>
                        <td class="col is-6">@{{ result[0].english }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">درسات</th>
                        <td class="col is-6">@{{ result[0].dersat }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">جبر</th>
                        <td class="col is-6">@{{ result[0].al_gebra }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">هندسة</th>
                        <td class="col is-6">@{{ result[0].handsa }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">مج. رياضيات</th>
                        <td class="col is-6">@{{ result[0].total_math }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">علوم</th>
                        <td class="col is-6">@{{ result[0].science }}</td>
                      </tr>
                      <tr class="has-background-grey-lighter ">
                        <th class="col is-6 ">المجموع الكلى</th>
                        <td class="col is-6">@{{ result[0].total }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">دين</th>
                        <td class="col is-6">@{{ result[0].deen }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">رسم</th>
                        <td class="col is-6">@{{ result[0].art }}</td>
                      </tr>
                      <tr>
                        <th class="col is-6">حاسب الى</th>
                        <td class="col is-6">@{{ result[0].computer }}</td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
            <!-- END ARTICLE -->
          </div>
          <!-- End Result Div -->
          
          <!-- Start Result Box -->
          <div class="column is-4 is-offset-4" v-if="result.length == 0">
              <div class="box">
                  <div v-if="!result"></div>
                  <div v-else>
                    <figure class="avatar">
                        <img src="{{ url('images/logo.jpg') }}" style="max-width: 128px">
                    </figure>
                    <form method="POST" action="{{ route('result') }}" @submit="getResult">
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {{ csrf_field() }}

                        <div class="notification is-danger" v-if="errorMessage != ''" v-model="getErrorMessage">
                          @{{ getErrorMessage() }}
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input is-large has-text-right" name="s_number" type="text" placeholder="رقم الجلوس" autofocus="">
                            </div>
                        </div>

                        <button @click="getResult" class="button is-block is-info is-large is-fullwidth">عرض النتيجة</button>
                    </form>
                  </div>
              </div>
              <p class="has-text-grey">
                  <a href="#">حول الموقع</a> &nbsp;·&nbsp;
                  <a href="#">مساعدة؟</a>
              </p>
          </div>
          <!-- End Result Box -->

        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ url('js/vue.js') }}"></script>
<script>
new Vue({
  el: '#app',
  data: {
    result: [],
    errorMessage: "",
  },
  methods: {
    getResult: function (e) {
      e.preventDefault();
      var data = $('form').serialize();
      var result = this.result;
      ob = this;

      $.ajax({
        url: "{{ route('result') }}",
        type: "POST",
        data: data,
        beforeSend: function() {
          result.splice(0, result.length);
          ob.errorMessage = '';
        },
        error: function(data) {
          console.log(data.responseJSON)
        },
        success: function(data) {
          if (data != ''){
            result.push(data);
            console.log(data)
          } else {
            ob.errorMessage = 'لم يتم العثور على نتيجة لرقم الجلوس هذا';
          }
        }
      });
    },
    returnBack: function() {
      this.result.splice(0, this.result.length);
    },
    getErrorMessage: function() {
      return this.errorMessage;
    }
  }
});
</script>
@endsection