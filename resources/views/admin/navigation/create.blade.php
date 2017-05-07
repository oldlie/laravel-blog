@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            导航条设置
            <small>内容管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 内容管理</a></li>
            <li><a href="{{action('Admin\MainNavigateController@index')}}">导航条设置</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="box box-default">

            <form action="{{action('Admin\MainNavigateController@store')}}" method="post">
                <div class="box-header with-border">
                    <h3 class="box-title">添加一个导航URL</h3>
                </div>

                <div class="box-body">

                        {{csrf_field()}}

                        <div class="from-group">
                            <label for="titleInput">名称：</label>
                            <input type="text" id="titleInput" class="form-control" name="title" value="{{$title}}">
                        </div>

                        <div class="form-group">
                            <label for="urlInput">URL：</label>
                            <input type="url" id="urlInput" class="form-control" name="url" value="{{$url}}">
                        </div>

                    <div class="from-group">
                        <label for="orderInput">顺序：</label>
                        <input type="number" class="form-control" id="orderInput" name="order" value="{{$order}}">
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 保存</button>
                </div>
            </form>
        </div>

    </section>
@endsection