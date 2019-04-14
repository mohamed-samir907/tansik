@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>القطاعات</h1>
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
           href="{{ route('sections.create') }}">إضافة قطاع
          </a>
          <a class="btn btn-success"
           href="{{ route('sections.create') }}">تصدير الى ملف اكسل
          </a>
          <a class="btn btn-info"
           href="{{ route('sections.create') }}">استيراد من ملف اكسل
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
              <th>الادارة</th>
              <th>ادوات التحكم</th>
            </tr>
          </thead>
          <tbody class="listModria">
            @foreach($sections as $section)
            <tr id="row-{{ $section->id }}">
              <td>{{ $section->name }}</td>
              <td>{{ $section->edara->name }}</td>
              <td>
                <form class="btn-group" method="POST" action="{{ route('sections.destroy', ['id' => $section->id]) }}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <a href="{{ route('sections.edit', ['id' => $section->id]) }}" id="edit" data-id="{{ $section->id }}" class="btn btn-xs btn-success">تعديل</a>
                  <button id="delete" data-id="{{ $section->id }}" class="btn btn-xs btn-danger">حذف</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="2">{{ $sections->links() }}</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
	</section>
</div>
@endsection