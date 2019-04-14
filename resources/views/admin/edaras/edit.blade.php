@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>تعديل دارة</h1>
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
        <form method="POST" action="{{ route('edaras.update', ['id' => $edara->id]) }}">
        	{{ csrf_field() }}
        	{{ method_field('PUT') }}
        	<div class="form-group col-md-12 {{ $errors->has('modria') ? ' has-error':'' }}">
				<label for="modria">المديرية</label>
				<select class="form-control" id="modria" name="modria">
					@foreach($govs as $gov)
						<option value="{{ $gov->id }}"
							{{ $gov->id == $edara->gov_id ? 'selected' : '' }}>{{ $gov->name }}</option>
					@endforeach
				</select>
				@if($errors->has('modria'))
				<span class="help-block">
					<strong>{{ $errors->first('modria') }}</strong>
				</span>
				@endif
	      	</div>
        	<div class="form-group col-md-12 {{ $errors->has('name') ? ' has-error':'' }}">
				<label for="name">الاسم</label>
				<input type="text" name="name" id="name" value="{{ $edara->name }}" class="form-control" placeholder="الأسم">
				@if($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
	      	</div>
	      	<div class="form-group col-md-12">
	      		<input type="submit" value="تعديل" class="btn btn-primary">
	      	</div>
        </form>
      </div>
	</section>
</div>
@endsection