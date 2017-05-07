@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            设置轮播文章
            <small>内容管理</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 内容管理</a></li>
            <li class="active">设置轮播文章</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-sm-12">
                @include('admin.partials.errors')
                @include('admin.partials.success')
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                @if (count($carousels) > 0)
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @for ($i = 0; $i < count($carousels); $i++)
                                <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"
                                    class="@if ($i == 0)
                                            active
                                            @endif "></li>
                            @endfor
                        </ol>
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($carousels); $i++)
                                <div class="item @if($i == 0)
                                        active
                                        @endif">
                                    <img src="{{url('uploads/images/posts/title/') . '/' . $carousels[$i]->page_image}}" alt="First slide">
                                    <div class="carousel-caption">
                                        {{$carousels[$i]->title}}
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="fa fa-angle-right"></span>
                        </a>
                    </div>
                @else
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Alert!</h4>
                        还没有设置轮播文章。
                    </div>
                @endif

            </div>
            <div class="col-sm-6">
                <div class="box box-default">
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            @foreach($carousels as $carousel)
                                <tr>
                                    <td style="width: 40px">{{$carousel->id}}</td>
                                    <td>{{$carousel->title}}</td>
                                    <td>
                                        <form action="{{action('Admin\CarouselController@destroy', ['id' => $carousel->id])}}"
                                              method="post">
                                            {{csrf_field()}}
                                            {{method_field('delete')}}
                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12">

                <div class="box box-default">

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td style="width: 40px;">{{$post->id}}</td>
                                    <td>
                                        <form action="{{action('Admin\CarouselController@store')}}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="post_id" value="{{$post->id}}">
                                            <button class="btn btn-default"> 设置</button>
                                        </form>
                                    </td>
                                    <td>
                                        {{$post->title}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="box-footer">
                        {!! $posts->render() !!}
                    </div>

                </div>


            </div>
        </div>

    </section>
@endsection