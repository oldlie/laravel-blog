@extends('layout')

@section('content')

    <div class="container">
        <div class="row">

            <section class="col-sm-12 col-md-8 content">

                <div class="row">
                    <div class="hidden-sm col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item">
                                    <img src="http://localhost/uploads/13649.jpg" alt="First slide">

                                    <div class="carousel-caption">
                                        First Slide
                                    </div>
                                </div>
                                <div class="item active">
                                    <img src="http://localhost/uploads/13877.jpg" alt="Second slide">

                                    <div class="carousel-caption">
                                        Second Slide
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="http://localhost/uploads/images/category/%E9%9D%92%E5%B2%9B1.jpg" alt="Third slide">

                                    <div class="carousel-caption">
                                        Third Slide
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                            </a>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <?php $is_over = false;?>

                                @for($i = 0; $i < count($categories); $i++)
                                    @if ($i > 3)
                                        @if (!$is_over)
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                    Dropdown <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @endif
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="tab"
                                                                               href="#tab_{{$categories[$i]->id}}">{{$categories[$i]->title}}</a></li>
                                                    @if (!$is_over)
                                                </ul>
                                            </li>
                                        @endif
                                    @else
                                        <li @if($i == 0) {{'class=active'}} @endif><a href="#tab_{{$categories[$i]->id}}" data-toggle="tab">{{$categories[$i]->title}}</a></li>
                                    @endif
                                @endfor
                            </ul>
                            <div class="tab-content">
                                @for($i = 0; $i < count($categories); $i++)
                                    <div class="tab-pane @if($i == 0) {{'active'}} @endif" id="tab_{{$categories[$i]->id}}">

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

