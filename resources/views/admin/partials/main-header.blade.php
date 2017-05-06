<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            @if (Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
                <li><a href="{{url('/auth/logout')}}"><i class="fa fa-sign-out"></i></a></li>
            </ul>
            @endif
        </div>

    </nav>
</header>