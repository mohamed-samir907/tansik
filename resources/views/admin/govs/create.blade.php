@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>اضافة مديرية</h1>
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
        <form method="POST" action="{{ route('govs.store') }}">
        	{{ csrf_field() }}
        	<div class="form-group col-md-12 {{ $errors->has('name') ? ' has-error':'' }}">
				<label for="name">الاسم</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="الأسم">
				@if($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
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