@extends('layouts.app')

@section('css')
<style type="text/css">
    .center-block {
        margin: 5px auto;
        text-align: center;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>الاسم : {{ $student->name }}</p>
                    <p>المدرسة: {{ $student->school->name }}</p>
                    <p>القطاع: {{ $student->school->section->name }}</p>
                    <p>الادارة: {{ $student->school->section->edara->name }}</p>
                    <p>المديرية: {{ $student->school->section->edara->gov->name }}</p>
                    <p>النوع: 
                        @if($student->gender == 'male')
                            ذكر
                        @elseif($student->gender == 'female')
                            انثى
                        @endif
                    </p>
                    <p>المجموع: {{ $student->total }}</p>
                        
                        <div class="box box-primary no-padding ">
                          <div class="box-header">
                            تسجيل الرفيات
                          </div>
                          <div class="box-body">
                            <form method="POST">
                                <div class="row justify-content-left">
                                    <div class="form-group col-md-6">
                                        <select id="school" name="school" class="form-control" size="5">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select id="type" name="type" class="form-control" size="5">
                                            <option>اختر التصنيف</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group">
                                <button id="btnAdd" class="btn btn-primary btn-lg">اضافة رغبة</button>
                            </div>
                            <form method="POST" action="{{ route('front.add_ragaba') }}">
                                <div class="row justify-content-left">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-12">
                                        {{-- <select id="ragaba" name="ragaba" class="form-control" size="3">
                                        </select> --}}
                                        <ol id="ragaba" style="1"></ol>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="submit" value="تأكيد الرغبات">
                                    </div>
                                </div>
                            </form>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$('#formNumber').on('submit', function(e) {
    e.preventDefault();

    var number = $('#s_number').val();
    // alert(number);

    $.ajax({
        url: "{{ route('get.student_data') }}",
        type: 'POST',
        data: {'_token': "{{ csrf_token() }}", 's_number': number},
        success: function(data) {
            console.log(data);
        }
    });
});
$('#type').on('change', function(){
    var val = $(this).val();

    $.ajax({
        url: "{{ route('front.get_schools') }}",
        type: 'POST',
        data: {'_token': "{{ csrf_token() }}", 'type': val},
        error: function(data) {
            console.log(error);
        },
        success: function(data) {
            $('#school').empty();
            $('#school').attr({'disabled':true});

            if (data.status == true && data.schools != '') {
                $('#school').attr({'disabled':false});
                
                $.each(data.schools, function(i, v) {
                    $('#school').append('<option value="'+v.id+'">'+v.name+'</option>')
                });
            }
        }
    });
});

$('#btnAdd').on('click', function() {
    var school = $('#school');
    // console.log(school[0].value)
    var text = school[0].innerText;
    var value = school[0].value;

    $('#ragaba').append('<li id="li-'+value+'">'+text+' <input type="hidden" name="school[]" value="'+value+'"><button type="button" id="btnDelete" data-id="'+value+'" class="btn btn-xs btn-danger">Delete</button></li>');
});

/*$(document).on('#btnDelete', 'click', function(e) {
    e.preventDefault();
    alert(1)
    var id = $(this).data('id');
    console.log(id);
});*/

</script>
@endsection