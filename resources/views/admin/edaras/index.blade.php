@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>الادارات</h1>
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
        @if(Session::has('success'))
        <div class="alert alert-success">
          {{ Session::get('success') }}
        </div>
        @endif
        <div class="btn-group">
          <a class="btn btn-primary"
           href="{{ route('edaras.create') }}">إضافة ادارة
          </a>
          <a class="btn btn-success"
           href="{{ route('edaras.create') }}">تصدير الى ملف اكسل
          </a>
          <a class="btn btn-info"
           href="{{ route('edaras.create') }}">استيراد من ملف اكسل
          </a>
        </div>
        
        @if(session()->has('error'))
        <div class="alert alert-danger" style="margin-top: 10px;">
          {{ session('error') }}
        </div>
        @endif
      </div>
      <div class="box-body table-responsive">
        <table id="modriaTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>الأسم</th>
              <th>المديرية</th>
              <th>ادوات التحكم</th>
            </tr>
          </thead>
          <tbody class="listModria">
            @foreach($edaras as $edara)
            <tr id="row-{{ $edara->id }}">
              <td>{{ $edara->name }}</td>
              <td>{{ $edara->gov->name }}</td>
              <td>
                <form class="btn-group" method="POST" action="{{ route('edaras.destroy', ['id' => $edara->id]) }}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <a href="{{ route('edaras.edit', ['id' => $edara->id]) }}" id="edit" data-id="{{ $edara->id }}" class="btn btn-xs btn-success">تعديل</a>
                  <button id="delete" data-id="{{ $edara->id }}" class="btn btn-xs btn-danger">حذف</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="2">{{ $edaras->links() }}</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
	</section>
</div>
@endsection