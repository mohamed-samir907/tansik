@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>المدارس الثانوية</h1>
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
           href="{{ route('s-schools.create') }}">إضافة مدرسة
          </a>
          <a class="btn btn-success"
           href="{{ route('s-schools.create') }}">تصدير الى ملف اكسل
          </a>
          <a class="btn btn-info"
           href="{{ route('s-schools.create') }}">استيراد من ملف اكسل
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
              <th>النوع</th>
              <th>القطاع</th>
              <th>التصنيف</th>
              <th>الدرجة</th>
              <th>ادوات التحكم</th>
            </tr>
          </thead>
          <tbody class="listModria">
            @foreach($schools as $school)
            <tr id="row-{{ $school->id }}">
              <td>{{ $school->name }}</td>
              <td>
                @if($school->gender == 'male')
                  {{ 'بنين' }}
                @elseif($school->gender == 'female')
                  {{ 'بنات' }}
                @elseif($school->gender == 'both')
                  {{ 'مشتركة' }}
                @endif
              </td>
              <td>{{ $school->section->name }}</td>
              <td>{{ $school->type }}</td>
              <td>{{ $school->degree }}</td>
              <td>
                <form class="btn-group" method="POST" action="{{ route('s-schools.destroy', ['id' => $school->id]) }}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <a href="{{ route('s-schools.edit', ['id' => $school->id]) }}" id="edit" data-id="{{ $school->id }}" class="btn btn-xs btn-success">تعديل</a>
                  <button id="delete" data-id="{{ $school->id }}" class="btn btn-xs btn-danger">حذف</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="2">{{ $schools->links() }}</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
	</section>
</div>
@endsection