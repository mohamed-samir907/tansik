@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>الصفحة الرئيسية</h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{-- {{ route('home') }} --}}">
					<i class="fa fa-dashboard"></i> الصفحة الرئيسية
				</a>
			</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
      
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">
              <i class="fa fa-briefcase"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">المدريات</span>
              <span class="info-box-number">{{-- {{ $modria }} --}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green">
              <i class="fa fa-folder-open"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">الإدارات</span>
              <span class="info-box-number">{{-- {{ $edara }} --}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow">
              <i class="fa fa-mortar-board"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">المدارس</span>
              <span class="info-box-number">{{-- {{ $school }} --}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red">
              <i class="fa fa-th"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">التصنيفات</span>
              <span class="info-box-number">{{-- {{ $type }} --}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      </div>
      <!-- /.row -->

	</section>
</div>
@endsection