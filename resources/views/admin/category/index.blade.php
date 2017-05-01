@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            栏目列表
            <small>写文章</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 栏目列表</a></li>
            <li class="active">写文章</li>
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
            <div class="col-xs-12 col-sm-5 col-md-4">

                <a href="{{url('admin/category/create')}}" class="btn btn-primary btn-block margin-bottom">创建分类</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">栏目列表</h3>
                    </div>
                    <div class="box-body no-padding">
                        <div style="padding: 10px 3px;"  id="categoriesList"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-xs-12 col-sm-7 col-md-8">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title" id="postListTitle">草稿箱</h3>
                    </div>

                    <div class="box-body no-padding">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody id="postList">
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <div class="btn-group"  style="width: 80px;">
                                            <button class="btn btn-default btn-xs"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-default btn-xs"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                    <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/category.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/posts.js')}}"></script>
    <script type="text/javascript">
        var _token = '{{csrf_token()}}';

        var category = new Category();
        category.url = '{{url('admin/category/parent')}}';

        var post = new Post();
        post.url = '{{url('/')}}';

        $(function() {
            category.currentId = 0;
            category.render('#categoriesList');

            post.list('{{url("admin/ajax/post/list")}}', 0, 1, function (json) {
                console.info('render:');
                console.log(json);
                post.render('#postList', json);
            });
        });

        // region Event: 栏目选择事件
        $(function () {
            $(document).on('click', '.back-to-parent', function(){
                category.currentId = $(this).attr('data-id');
                category.render('#categoriesList');
            });
            $(document).on('click', '.select-category', function() {
                $('#postListTitle').text($(this).text());
                var category = $(this).attr('data-id');
                post.list('{{url("admin/ajax/post/list")}}', category, 1, function (json) {
                    console.info('render:');
                    console.log(json);
                    post.render('#postList', json);
                });
            });
            $(document).on('click', '.go-to-children', function() {
                category.currentId = $(this).attr('data-id');
                category.render('#categoriesList');
            });
        });
        // endregion
    </script>
@endsection