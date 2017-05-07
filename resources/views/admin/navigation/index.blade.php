@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            导航条设置
            <small>内容管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-list"></i> 内容管理</a></li>
            <li class="active">导航条设置</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-sm-12">
                @include('admin.partials.success')
                @include('admin.partials.errors')
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <a href="{{action('Admin\MainNavigateController@create')}}" class="btn btn-default">
                    <i class="fa fa-plus"></i> 添加一个导航栏目</a>
            </div>
        </div>

        <br>

        <header class="main-header">
            <nav class="navbar navbar-static-top" style="margin-left: 0;">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{action('BlogController@index')}}" class="navbar-brand"><b>Admin</b>LTE</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active dropdown" >
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">资讯 <span class="fa fa-bars"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{action('BlogController@showMore', ['category' => 0])}}">
                                            最新</a>
                                    </li>
                                    @foreach($links as $link)
                                        <li>
                                            <a href="{{action('BlogController@showMore', ['category' => $link->id])}}">
                                                {{$link->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @foreach($urls as $url)
                                <li>
                                    <a href="#" target="_blank">{{$url->title}}</a>
                                </li>
                                <li>
                                    <form action="{{action('Admin\MainNavigateController@destroy', ['id' => $url->id])}}"
                                    method="post">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <button type="submit" class="btn btn-danger btm-xs"><i class="fa fa-trash"></i></button>
                                    </form>

                                </li>
                            @endforeach

                        </ul>

                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">

                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>


    </section>
@endsection
