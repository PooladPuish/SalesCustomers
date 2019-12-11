<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-right image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-right info">
            <p>{{auth()->user()->name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i>آنلاین</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    @if(auth()->user()->success == "1")
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>داشبورد</span>
                    <span class="pull-left-container">
            </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-basket"></i> <span>سفارشات</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.store.user.list')}}"><i class="fa fa-circle-o"></i>ثبت سفارش</a></li>
                    <li><a href="{{route('admin.buy.user.list')}}"><i class="fa fa-circle-o"></i>پیگیری سفارشات</a>
                    </li>
                </ul>
            </li>
        </ul>
    @endif
</section>
<!-- /.sidebar -->
