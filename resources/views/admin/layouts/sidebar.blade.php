<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-right image">
        <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>محمد سمير</p>
        <a href="#"><i class="fa fa-circle text-success"></i> نشط</a>
      </div>
    </div>
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">القائمة</li>
      
      <li>
        <a href="{{ route('admin.home') }}">
          <i class="fa fa-dashboard"></i> <span>الصفحة الرئيسية</span> 
        </a>
      </li>
      
      <li>
        <a href="{{ route('admin.home') }}">
          <i class="fa fa-users"></i> <span> المسئولين</span>
        </a>
      </li>

      <li>
        <a href="{{ route('govs.index') }}">
          <i class="fa fa-briefcase"></i> <span> المدريات</span>
        </a>
      </li>

      <li>
        <a href="{{ route('edaras.index') }}">
          <i class="fa fa-folder-open"></i> <span> الإدارات</span>
        </a>
      </li>

      <li>
        <a href="{{ route('sections.index') }}">
          <i class="fa fa-mortar-board"></i> <span>القطاعات</span>
        </a>
      </li>

      <li>
        <a href="{{ route('types.index') }}">
          <i class="fa fa-th"></i> <span> التصنيفات</span>
        </a>
      </li>

      <li>
        <a href="{{ route('p-schools.index') }}">
          <i class="fa fa-mortar-board"></i> <span>المدارس الاعدادية</span>
        </a>
      </li>

      <li>
        <a href="{{ route('s-schools.index') }}">
          <i class="fa fa-mortar-board"></i> <span>المدارس الثانوية</span>
        </a>
      </li>

      <li>
        <a href="{{ route('students.index') }}">
          <i class="fa fa-users"></i> <span> الطلاب</span>
        </a>
      </li>

      <li>
        <a href="{{ route('ragabas.index') }}">
          <i class="fa fa-th"></i> <span> الرغبات</span>
        </a>
      </li>
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>