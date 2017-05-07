@extends('layout')

@section('content')

    <div class="container">
        <div class="row">

            <section class="col-sm-12 col-md-8 content">

                <div class="row">
                    <div class="hidden-sm hidden-xs col-md-12">
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
                                            <img class="img-responsive" style="width: 100%;"
                                                 src="{{url('uploads/images/posts/title/') . '/' . $carousels[$i]->page_image}}" alt="First slide">
                                            <div class="carousel-caption">
                                                <h3 >
                                                <a style="color: #ffffff;text-shadow:5px 2px 6px #000000;"
                                                        href="{{action('BlogController@showPost', ['slug' => $carousels[$i]->slug])}}">{{$carousels[$i]->title}}</a>
                                                </h3>
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
                        @endif
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_0" data-toggle="tab">最新</a></li>

                                <?php $is_over = false;?>

                                @for($i = 0; $i < count($categories); $i++)
                                    @if ($i > 3)
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                更多 <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @for(; $i < count($categories); $i++)
                                                <li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="tab"
                                                                           href="#tab_{{$categories[$i]->id}}">{{$categories[$i]->title}}</a></li>
                                                @endfor
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="#tab_{{$categories[$i]->id}}" data-toggle="tab">{{$categories[$i]->title}}</a></li>
                                    @endif
                                @endfor
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_0">
                                    @foreach($latest as $post)
                                        @include('blog._post')
                                    @endforeach

                                        <div class="row" style="padding: 5px 0;">
                                            <div class="col-sm-12">
                                                <a href="{{action('BlogController@showMore', ['category' => 0])}}" class="btn btn-primary btn-block">查看更多...</a>
                                            </div>
                                        </div>
                                </div>
                                @for($i = 0; $i < count($categories); $i++)
                                    <div class="tab-pane " id="tab_{{$categories[$i]->id}}">

                                        @foreach($categories[$i]->posts as $post)
                                            @include('blog._post')
                                        @endforeach

                                        <div class="row" style="padding: 5px 0;">
                                            <div class="col-sm-12">
                                                <a href="{{action('BlogController@showMore', ['category' => $categories[$i]->category])}}" class="btn btn-primary btn-block">查看更多...</a>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                </div>

            </section>

            <section class="col-md-4 hidden-sm content">

                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-fire"></i> 最热</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        The body of the box
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-fire"></i> 活动</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        The body of the box
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-fire"></i> 活动</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        The body of the box
                    </div>
                    <!-- /.box-body -->
                </div>

            </section>

        </div>
    </div>

@endsection

