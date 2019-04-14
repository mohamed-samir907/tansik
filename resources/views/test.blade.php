@extends('layouts.app')

@section('style')
<style>
.custom-input {
    padding: 5px;
    border-radius: 5px;
    min-height: 35px;
    border: 1px solid #b8b4b4;
    display: inline-block;
}
</style>
@endsection

@section('content')
<!-- START NAV -->
@include('component.navbar')
<!-- END NAV -->

<div class="container" id="app">
    <!-- START ARTICLE FEED -->
    <section class="articles">
        <div class="column is-10 is-offset-1">
            
            {{-- The Student Basic Information --}}
            @include('pages.basic_info')
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="notification is-danger">
                        <button class="delete"></button>
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            @if(session()->has('success'))
                <div class="notification is-success">
                  <button class="delete"></button>
                  {{ session('success') }}
                </div>
            @endif
            {{-- PRint Card --}}
            @include('pages.print_card')

            <!-- START ARTICLE -->
            <div class="card article" style="margin-bottom: 10px;" v-if="highSchool.length == 0"  id="control-buttons">
                <div class="card-content">
                    <div class="content article-body">

                        <div class="has-text-centered" id="control-btns">
                            <button id="btnAddRagabas" class="button is-primary" disabled="true">تسجيل رغبات</button>
                            <button id="btnEditRagabas" class="button is-success" disabled="true">تعديل رغبات</button>
                        </div>
                        <div class="has-text-centered" id="system-btns">
                            حدد نوع التعليم: 
                            <button class="button is-primary" @click="addHigh">تعليم عام</button>
                            <button id="btnTRagabasSchools" class="button is-success">تعليم فنى</button>
                        </div>

                        @if($ragabas->count() > 0)
                            <div id="editRagabaDiv">
                                @include('pages.if_ragaba_found')
                            </div>
                        @else
                            <div id="registerRagabaDiv">
                                @include('pages.register_ragaba')
                            </div>
                            <div id="registerRagabaDiv1">
                                {{-- @include('pages.selected_ragaba') --}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END ARTICLE -->

        </div>
    </section>
</div>
@endsection

@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ url('printThis.js') }}"></script>
<script src="{{ url('js/vue.js') }}"></script>
<script src="{{ url('js/fscript.js') }}"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            schools: [],
            selectedSchools: [],
            newSchool: '',
            schoolType: '',
            highSchool: [],
        },
        methods: {
            addRagabas: function(event) {
                addRagabas('#addRagabasTable', event);
            },
            registerRagabas: function() {
                var ob = this;
                var data = $('#add_ragaba_form').serialize();

                $.ajax({
                    url: "{{ route('front.add_ragaba') }}",
                    type: 'POST',
                    data: data,
                    error: function(data) {
                        console.log(data);
                    },
                    success: function(data) {
                        $('#card-print-high').css('display', 'block');
                        swal({
                          title: "تهانينا!",
                          text: "تم اتمام عملية تسجيل الرغبات",
                          icon: "success",
                          buttons: ["الغاء","طباعة بطاقة الترشيح"],
                          dangerMode: false,
                        })
                        .then((value) => {
                            if (value) {
                                $.each(data.schools, function(key, value) {
                                    ob.highSchool.push({id: value.id, name: value.name, type: value.type});
                                })
                            } else {
                                
                            }
                        });
                    }
                });
            },
            editRagabas: function(event) {
                editRagabas('#editRagabasTable', event);
            },
            addHigh: function() {
                var ob = this;

                $.ajax({
                    url: "{{ route('front.add_high') }}",
                    type: 'POST',
                    data: {'_token': "{{ csrf_token() }}"},
                    error: function(data) {
                        console.log(data);
                    },
                    success: function(data) {
                        $('#card-print-high').css('display', 'block');
                        swal({
                          title: "تهانينا!",
                          text: "تم ترشيحكم لمدرسة " + data.schools.name,
                          icon: "success",
                          buttons: ["الغاء","طباعة بطاقة الترشيح"],
                          dangerMode: false,
                        })
                        .then((value) => {
                            if (value) {
                                ob.highSchool.push({id: data.schools.id, name: data.schools.name, type: data.schools.type});
                            } else {
                                
                            }
                        });
                    }
                });
            },
            editStudentData: function() {
                editStudentData("{{ route('front.edit_student_data') }}", "{{ auth()->user()->email }}");
            }
        }
    });
</script>
@endsection
