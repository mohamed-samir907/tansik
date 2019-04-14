@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>اضافة طالب</h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.home') }}">
					<i class="fa fa-dashboard"></i> الصفحة الرئيسية
				</a>
			</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
      <div class="box box-primary no-padding">
      <div class="box-header">
      	@if(session()->has('success'))
        <div class="alert alert-success" style="margin-top: 10px;">
        	{{ session('success') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger" style="margin-top: 10px;">
        	{{ session('error') }}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger" style="margin-top: 10px;">
        	@foreach($errors->all() as $error)
        		{{ $error }}
        	@endforeach
        </div>
        @endif
      </div>
      <div class="box-body">
        <form method="POST" action="{{ route('students.store') }}">
        	{{ csrf_field() }}
        	<div class="form-group col-md-3 {{ $errors->has('modria') ? ' has-error':'' }}">
				<label for="modria">المديرية</label>
				<select class="form-control" id="modria" name="modria">
					<option>قم باختيار المديرية</option>
					@foreach($modrias as $modria)
						<option value="{{ $modria->id }}">{{ $modria->name }}</option>
					@endforeach
				</select>
				@if($errors->has('modria'))
				<span class="help-block">
					<strong>{{ $errors->first('modria') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('edara') ? ' has-error':'' }}">
				<label for="edara">الادارة</label>
				<select class="form-control" id="edara" name="edara">
				</select>
				@if($errors->has('edara'))
				<span class="help-block">
					<strong>{{ $errors->first('edara') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('section') ? ' has-error':'' }}">
				<label for="section">القطاع</label>
				<select class="form-control" id="section" name="section">
				</select>
				@if($errors->has('section'))
				<span class="help-block">
					<strong>{{ $errors->first('section') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('school') ? ' has-error':'' }}">
				<label for="school">المدرسة</label>
				<select class="form-control" id="school" name="school">
				</select>
				@if($errors->has('school'))
				<span class="help-block">
					<strong>{{ $errors->first('school') }}</strong>
				</span>
				@endif
	      	</div>
	      	<!-- ---------- -->
        	<div class="form-group col-md-4 {{ $errors->has('name') ? ' has-error':'' }}">
				<label for="name">الاسم</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="الأسم">
				@if($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-4 {{ $errors->has('phone') ? ' has-error':'' }}">
				<label for="phone">رقم التليفون</label>
				<input type="text" name="phone" id="phone" class="form-control" placeholder="رقم التليفون">
				@if($errors->has('phone'))
				<span class="help-block">
					<strong>{{ $errors->first('phone') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-4 {{ $errors->has('gender') ? ' has-error':'' }}">
				<label for="gender">النوع</label>
				<select class="form-control" id="gender" name="gender">
					<option value="male">ذكر</option>
					<option value="female">انثى</option>
				</select>
				@if($errors->has('gender'))
				<span class="help-block">
					<strong>{{ $errors->first('gender') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('s_number') ? ' has-error':'' }}">
				<label for="s_number">رقم الجلوس</label>
				<input type="number" name="s_number" id="s_number" class="form-control" placeholder="رقم الجلوس" step="0.5" value="{{ old('s_number') }}">
				@if($errors->has('s_number'))
				<span class="help-block">
					<strong>{{ $errors->first('s_number') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('s_code') ? ' has-error':'' }}">
				<label for="s_code">الكود</label>
				<input type="number" name="s_code" id="s_code" class="form-control" placeholder="الكود" step="0.5" value="{{ old('s_code') }}">
				@if($errors->has('s_code'))
				<span class="help-block">
					<strong>{{ $errors->first('s_code') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('national_id') ? ' has-error':'' }}">
				<label for="national_id">الرقم القومى</label>
				<input type="number" name="national_id" id="national_id" class="form-control" placeholder="الرقم القومى" step="0.5" value="{{ old('national_id') }}">
				@if($errors->has('national_id'))
				<span class="help-block">
					<strong>{{ $errors->first('national_id') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('system') ? ' has-error':'' }}">
				<label for="system">النظام</label>
				<select class="form-control" id="system" name="system">
					<option value="school">انتظام</option>
					<option value="home">منازل</option>
				</select>
				@if($errors->has('system'))
				<span class="help-block">
					<strong>{{ $errors->first('system') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-12 {{ $errors->has('address') ? ' has-error':'' }}">
				<label for="address">العنوان</label>
				<input type="text" name="address" id="address" class="form-control" placeholder="العنوان" value="{{ old('address') }}">
				@if($errors->has('address'))
				<span class="help-block">
					<strong>{{ $errors->first('address') }}</strong>
				</span>
				@endif
	      	</div>
	      	<!-- ------------------- -->
	      	<div class="form-group col-md-3 {{ $errors->has('arabic') ? ' has-error':'' }}">
				<label for="arabic">لغة عربية</label>
				<input type="number" name="arabic" id="arabic" class="form-control" placeholder="الدرجة" step="0.5" value="{{ old('arabic') }}">
				@if($errors->has('arabic'))
				<span class="help-block">
					<strong>{{ $errors->first('arabic') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('english') ? ' has-error':'' }}">
				<label for="english">لغة اجنبية</label>
				<input type="number" name="english" id="english" class="form-control" placeholder="الدرجة" step="0.5" value="{{ old('english') }}">
				@if($errors->has('english'))
				<span class="help-block">
					<strong>{{ $errors->first('english') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('dersat') ? ' has-error':'' }}">
				<label for="dersat">دراسات</label>
				<input type="number" name="dersat" id="dersat" class="form-control" placeholder="الدرجة" step="0.5" value="{{ old('dersat') }}">
				@if($errors->has('dersat'))
				<span class="help-block">
					<strong>{{ $errors->first('dersat') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('al_gebra') ? ' has-error':'' }}">
				<label for="al_gebra">جبر</label>
				<input type="number" name="al_gebra" id="al_gebra" class="form-control" placeholder="الدرجة" step="0.5" value="{{ old('al_gebra') }}">
				@if($errors->has('al_gebra'))
				<span class="help-block">
					<strong>{{ $errors->first('al_gebra') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('handsa') ? ' has-error':'' }}">
				<label for="handsa">هندسة</label>
				<input type="number" name="handsa" id="handsa" class="form-control" placeholder="الدرجة" step="0.5" value="{{ old('handsa') }}">
				@if($errors->has('handsa'))
				<span class="help-block">
					<strong>{{ $errors->first('handsa') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('total_math') ? ' has-error':'' }}">
				<label for="total_math">مج رياضيات</label>
				<input type="number" name="total_math" id="total_math" class="form-control" placeholder="الدرجة" step="0.5" value="{{ old('total_math') }}">
				@if($errors->has('total_math'))
				<span class="help-block">
					<strong>{{ $errors->first('total_math') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('science') ? ' has-error':'' }}">
				<label for="science">علوم</label>
				<input type="number" name="science" id="science" class="form-control" placeholder="الدرجة" step="0.5" value="{{ old('science') }}">
				@if($errors->has('science'))
				<span class="help-block">
					<strong>{{ $errors->first('science') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-3 {{ $errors->has('total') ? ' has-error':'' }}">
				<label for="total">المجموع الكلى</label>
				<input type="number" name="total" id="total" class="form-control" placeholder="الدرجة" step="0.5" value="{{ old('total') }}">
				@if($errors->has('total'))
				<span class="help-block">
					<strong>{{ $errors->first('total') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-4 {{ $errors->has('deen') ? ' has-error':'' }}">
				<label for="deen">دين</label>
				<input type="number" name="deen" id="deen" class="form-control" placeholder="دين" step="0.5" value="{{ old('deen') }}">
				@if($errors->has('deen'))
				<span class="help-block">
					<strong>{{ $errors->first('deen') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-4 {{ $errors->has('art') ? ' has-error':'' }}">
				<label for="art">فنى</label>
				<input type="number" name="art" id="art" class="form-control" placeholder="فنى" step="0.5" value="{{ old('art') }}">
				@if($errors->has('art'))
				<span class="help-block">
					<strong>{{ $errors->first('art') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-4 {{ $errors->has('computer') ? ' has-error':'' }}">
				<label for="computer">حاسب الى</label>
				<input type="number" name="computer" id="computer" class="form-control" placeholder="حاسب الى" step="0.5" value="{{ old('computer') }}">
				@if($errors->has('computer'))
				<span class="help-block">
					<strong>{{ $errors->first('computer') }}</strong>
				</span>
				@endif
	      	</div>
	      	<hr style="border: .5px solid #ccc">
	      	<div class="form-group col-md-12 {{ $errors->has('notes') ? ' has-error':'' }}">
				<label for="notes">ملاحظات عمر</label>
				<textarea name="notes" class="form-control"></textarea>
				@if($errors->has('notes'))
				<span class="help-block">
					<strong>{{ $errors->first('notes') }}</strong>
				</span>
				@endif
	      	</div>

	      	<div class="form-group col-md-12">
	      		<input type="submit" value="اضافة" class="btn btn-primary">
	      	</div>
        </form>
      </div>
	</section>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
	$('#edara').attr({'disabled':true});
	$('#section').attr({'disabled':true});
	$('#school').attr({'disabled':true});
});
$('#modria').on('change', function(){
    var val = $(this).val();

    $.ajax({
		url: "{{ route('students.get_edaras') }}",
		type: 'POST',
		data: {'_token': "{{ csrf_token() }}", 'modria': val},
		error: function(data) {
	      	$('#edara').empty();
	        $('#section').empty();
	        $('#school').empty();
	        $('#edara').attr({'disabled':true});
	        $('#section').attr({'disabled':true});
	        $('#school').attr({'disabled':true});
	        console.clear();
      	},
      	success: function(data) {
	        $('#edara').empty();
	        $('#section').empty();
	        $('#school').empty();

	        $('#edara').attr({'disabled':true});
	        $('#section').attr({'disabled':true});
	        $('#school').attr({'disabled':true});

        	if (data.status == true && data.edaras != '') {
				$('#edara').attr({'disabled':false});

				$('#edara').append('<option>قم باختيار الادارة</option>');
				$.each(data.edaras, function(i, v) {
					$('#edara').append('<option value="'+v.id+'">'+v.name+'</option>')
				});
        	}
      	}
    });
});

$('#edara').on('change', function(){
    var val = $(this).val();

    $.ajax({
		url: "{{ route('students.get_sections') }}",
		type: 'POST',
		data: {'_token': "{{ csrf_token() }}", 'edara': val},
		error: function(data) {
	        $('#section').empty();
	        $('#school').empty();
	        $('#section').attr({'disabled':true});
	        $('#school').attr({'disabled':true});
	        console.clear();
      	},
      	success: function(data) {
	        $('#section').empty();
	        $('#school').empty();

	        $('#section').attr({'disabled':true});
	        $('#school').attr({'disabled':true});

        	if (data.status == true && data.edaras != '') {
				$('#section').attr({'disabled':false});

				$('#section').append('<option>قم باختيار القطاع</option>');
				$.each(data.edaras, function(i, v) {
					$('#section').append('<option value="'+v.id+'">'+v.name+'</option>')
				});
        	}
      	}
    });
});

$('#section').on('change', function(){
    var val = $(this).val();

    $.ajax({
		url: "{{ route('students.get_schools') }}",
		type: 'POST',
		data: {'_token': "{{ csrf_token() }}", 'section': val},
		error: function(data) {
	        $('#school').empty();
	        $('#school').attr({'disabled':true});
	        console.clear();
      	},
      	success: function(data) {
	        $('#school').empty();
	        $('#school').attr({'disabled':true});

        	if (data.status == true && data.edaras != '') {
				$('#school').attr({'disabled':false});

				$('#school').append('<option>قم باختيار المدرسة</option>');
				$.each(data.edaras, function(i, v) {
					$('#school').append('<option value="'+v.id+'">'+v.name+'</option>')
				});
        	}
      	}
    });
});

$('input').on('keyup', function() {

	$('#total_math').val(parseFloat($('#al_gebra').val()) + parseFloat($('#handsa').val()) );

	$('#total').val(parseFloat($('#arabic').val()) + 
		parseFloat($('#english').val()) + 
		parseFloat($('#dersat').val()) + 
		parseFloat($('#al_gebra').val()) + 
		parseFloat($('#handsa').val()) + 
		parseFloat($('#science').val())
	);

});
</script>
@endsection