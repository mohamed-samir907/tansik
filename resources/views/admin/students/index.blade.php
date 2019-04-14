@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>الطلاب</h1>
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
           href="{{ route('students.create') }}">إضافة طالب
          </a>
          <a class="btn btn-success"
           href="{{ route('students.create') }}">تصدير الى ملف اكسل
          </a>
          <a class="btn btn-info"
           href="{{ route('students.create') }}">استيراد من ملف اكسل
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
              <th>رقم الجلوس</th>
              <th>اسم الطالب</th>
              <th>المدرسة</th>
              <th>النظام</th>
              <th>النزع</th>
              <th>لغة عربية</th>
              <th>لغة اجنبية</th>
              <th>دراسات</th>
              <th>جبر</th>
              <th>هندسة</th>
              <th>مج رياضيات</th>
              <th>علوم</th>
              <th>مجموع كلى</th>
              <th>م عمر</th>
              <th>دين</th>
              <th>فنية</th>
              <th>حاسب</th>
              <th>ادوات التحكم</th>
            </tr>
          </thead>
          <tbody class="listModria">
            @foreach($students as $student)
            <tr id="row-{{ $student->id }}">
              <td>{{ $student->name }}</td>
              <td>
                @if($student->gender == 'male')
                  {{ 'بنين' }}
                @elseif($student->gender == 'female')
                  {{ 'بنات' }}
                @elseif($student->gender == 'both')
                  {{ 'مشتركة' }}
                @endif
              </td>
              <td>{{ $student->section->name }}</td>
              <td>{{ $student->type->name }}</td>
              <td>{{ $student->degree }}</td>
              <td>
                <form class="btn-group" method="POST" action="{{ route('students.destroy', ['id' => $student->id]) }}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <a href="{{ route('students.edit', ['id' => $student->id]) }}" id="edit" data-id="{{ $student->id }}" class="btn btn-xs btn-success">تعديل</a>
                  <button id="delete" data-id="{{ $student->id }}" class="btn btn-xs btn-danger">حذف</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="2">{{ $students->links() }}</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
	</section>
</div>
@endsection