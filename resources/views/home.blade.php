@extends('layouts.app')

@section('css')
<style>

</style>
@endsection

@section('content')
<!-- START NAV -->
<nav class="navbar">
    <div class="container">
        <div class="navbar-brand large">
            <a class="navbar-item" href="{{ route('home') }}">
                <img src="{{ url('images/logo.jpg') }}" alt="Logo"> &nbsp;&nbsp;
                <h1 class="title">التنسيق</h1>
            </a>
            <span class="navbar-burger burger" data-target="navbarMenu">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </div>
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            تسجيل الخروج
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- END NAV -->
<div class="container">
    <!-- START ARTICLE FEED -->
    <section class="articles">
        <div class="column is-10 is-offset-1">
            <!-- START ARTICLE -->
            <div class="card article" style="margin-bottom: 10px;">
                <div class="card-content">
                    <div class="content article-body">
                        <h5 class="has-text-centered">
                            مديرية التربية والتعليم بمحافظة 
                            {{ $student->school->section->edara->gov->name }}
                        </h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>الادارة:</b> {{ $student->school->section->edara->name }}</td>
                                    <td><b>اسم الطالب:</b> {{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>القطاع:</b> {{ $student->school->section->name }}</td>
                                    <td>
                                        <b>النوع: </b>
                                        @if($student->gender == 'male')
                                            ذكر
                                        @elseif($student->gender == 'female')
                                            انثى
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>المدرسة:</b> {{ $student->school->name . ' ('  }}
                                        @if($student->school->gender == 'male')
                                            بنين
                                        @elseif($student->school->gender == 'female')
                                            بنات
                                        @elseif($student->school->gender == 'both')
                                            مشتركة
                                        @endif
                                        {{ ')' }}
                                    </td>
                                    <td><b>المجموع:</b> {{ $student->total }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- END ARTICLE -->

            <!-- START ARTICLE -->
            <div class="card article" style="margin-bottom: 10px;" id="app">
                <div class="card-content">
                    <div class="content article-body">
                        <h5 class="has-text-centered">
                            تسجيل الرغبات
                        </h5>
                        
                        @if(session()->has('success'))
                            <div class="notification is-success">
                              <button class="delete"></button>
                              {{ session('success') }}
                            </div>
                        @endif

                        <table>
                            <tbody>
                                <tr>
                                    <td class="col s12">
                                        <label for="type" style="font-weight: bold">اختر التصنيف</label>
                                        <select id="type" name="type" size="5" 
                                            style="width: 100%; border-radius: 5px;border-color: #3273dc;box-shadow: 0 0 0 0.125em rgba(50,115,220,.25);">
                                            <option style="padding: 8px 5px">اختر التصنيف</option>
                                            
                                            <option 
                                                style="padding: 8px 5px" 
                                                v-for="type in schoolTypes" 
                                                @click="getSchools(type.id)"
                                                value="@{{ type.id }}">
                                                @{{ type.name }}
                                            </option>
                                        </select>
                                    </td>
                                    <td class="col s12">
                                        <label for="school" style="font-weight: bold">اختر  المدرسة</label>
                                        <select id="school" name="school" size="5" 
                                            style="width: 100%; border-radius: 5px;border-color: #3273dc;box-shadow: 0 0 0 0.125em rgba(50,115,220,.25);">
                                            <option style="padding: 8px 5px">اختر المدرسة</option>
                                            <option 
                                                style="padding: 8px 5px" 
                                                v-for="school in schools" 
                                                @click="addSchool(school.id, school.name)"
                                                value="@{{ school.id }}">
                                                @{{ school.name }}
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="has-background-light" style="margin-top: 15px; margin-bottom: 10px; padding: 10px">
                            <form method="POST" action="{{ route('front.add_ragaba') }}">
                                <div class="row justify-content-left">
                                    {{ csrf_field() }}
                                    <table>
                                        <tbody>
                                            <tr v-for="school in selectedSchools">
                                                <td :data-id="school.id">
                                                    <input type="hidden" name="school[]" :value="school.id">
                                                    @{{ school.name }}
                                                </td>
                                                <td>
                                                    <button class="button is-danger is-outlined is-small" @click="deleteSelectedSchool(school)">×</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                            
                                    </table>
                                    <input class="button is-success" type="submit" value="تأكيد الرغبات">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END ARTICLE -->
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ url('js/vue.js') }}"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            name: 'mohamed',
            schoolTypes: [
                @foreach($types as $type)
                    { id: {{ $type->id }}, name: "{{ $type->name }}" },
                @endforeach
            ],
            schools: [],
            selectedSchools: [],
            newSchool: '',
        },
        methods: {
            getSchools: function(type_id) {
                event.preventDefault();
                var schools = this.schools;

                $.ajax({
                    url: "{{ route('front.get_schools') }}",
                    type: 'POST',
                    data: {'_token': "{{ csrf_token() }}", 'type': type_id},
                    error: function(data) {
                        console.log(error);
                    },
                    success: function(data) {
                        $('#school').empty();
                        $('#school').append('<option style="padding: 8px 5px">اختر المدرسة</option>')

                        if (data.status == true && data.schools != '') {
                            $.each(data.schools, function(i, v) {
                                schools.push({id: v.id, name: v.name });
                            });
                        }
                    }
                });
            },
            addSchool: function(id, name) {
                var schools = this.selectedSchools;
                var func = this;
                
                if (schools.length < 3) {

                    if (schools.length > 0) {
                        
                        $.each(schools, function(i, v) {
                        
                            if (v.id == id) {
                                alert('لا يمكن اضاافة هذه المدرسة اكثر من مرة')
                            } else {
                                schools.push({id: id, name: name});
                            }

                            return false;
                        });

                    } else {
                        schools.push({id: id, name: name});
                        return false;
                    }

                }
                
            },
            deleteSelectedSchool: function(school) {
                event.preventDefault();
                var index = this.selectedSchools.indexOf(school);
                this.selectedSchools.splice(index, 1);
            }
        }
    });
document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    $notification = $delete.parentNode;
    $delete.addEventListener('click', () => {
      $notification.parentNode.removeChild($notification);
    });
  });
});
</script>
@endsection