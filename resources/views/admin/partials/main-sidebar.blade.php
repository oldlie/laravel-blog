<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="{{action('Admin\DashboardController@index')}}"><i class="fa fa-dashboard"></i></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>内容管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/category')}}"><i class="fa fa-circle-o"></i> 栏目列表</a></li>
                    <li><a href="{{url('admin/post')}}"><i class="fa fa-circle-o"></i> 写文章</a></li>
                    <li><a href="{{action('Admin\DashboardController@subtitle')}}"><i class="fa fa-circle-o"></i> 设置展示的栏目</a></li>
                </ul>
            </li>

        </ul>

    </section>

</aside>