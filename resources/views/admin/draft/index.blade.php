@extends('admin.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            草稿箱
            <small>内容管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 内容管理</a></li>
            <li class="active">草稿箱</li>
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

                <div class="box box-default">

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 80px" class="text-center">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </th>
                                <th>Title</th>
                            </tr>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{$item->id}}.</td>
                                    <td>
                                        <form action="{{action('Admin\PostController@destroy', ['post' => $item->id])}}" method="post">
                                            <a href="{{action('Admin\PostController@edit', ['post' => $item->id])}}" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                                            {{csrf_field()}}
                                            {{method_field('delete')}}
                                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td>{{$item->title}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="box-footer">
                        {!! $list->render() !!}
                    </div>

                </div>


            </div>

        </div>

    </section>
@stop