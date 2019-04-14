@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>تعديل مدرسة اعدادية</h1>
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
      </div>
      <div class="box-body">
        <form method="POST" action="{{ route('p-schools.update', ['id' => $school->id]) }}">
        	{{ csrf_field() }}
        	{{ method_field('PUT') }}
        	<div class="form-group col-md-12 {{ $errors->has('section') ? ' has-error':'' }}">
				<label for="section">القطاع</label>
				<select class="form-control" id="section" name="section">
					@foreach($sections as $section)
						<option value="{{ $section->id }}"
							{{ $section->id == $school->section_id ? 'selected' : '' }}>{{ $section->name }}</option>
					@endforeach
				</select>
				@if($errors->has('section'))
				<span class="help-block">
					<strong>{{ $errors->first('section') }}</strong>
				</span>
				@endif
	      	</div>
        	<div class="form-group col-md-12 {{ $errors->has('name') ? ' has-error':'' }}">
				<label for="name">الاسم</label>
				<input type="text" name="name" id="name" value="{{ $school->name }}" class="form-control" placeholder="الأسم">
				@if($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-12 {{ $errors->has('gender') ? ' has-error':'' }}">
				<label for="gender">النوع</label>
				<select class="form-control" id="gender" name="gender">
					<option value="male" {{ $school->gender == 'male' ? 'selected' : '' }}>بنين</option>
					<option value="female" {{ $school->gender == 'female' ? 'selected' : '' }}>بنات</option>
					<option value="both" {{ $school->gender == 'both' ? 'selected' : '' }}>مشتركة</option>
				</select>
				@if($errors->has('gender'))
				<span class="help-block">
					<strong>{{ $errors->first('gender') }}</strong>
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