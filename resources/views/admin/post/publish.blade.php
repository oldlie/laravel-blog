@extends('admin.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            发布文章
            <small>写文章</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 写文章</a></li>
            <li class="active">发布文章</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-sm-12 col-md-8">

            <div class="box box-primary">
                <div class="box-header with-border box-primary">
                    <h3>发布文章</h3>
                </div>

                <form action="{{url('admin/post')}}" method="post">
                    {{csrf_field()}}
                <div class="box-body">

                    <div class="col-sm-12">
                        @include('admin.partials.success')
                        @include('admin.partials.errors')
                    </div>

                        <div class="form-group">
                            <label for="titleTxt">标题:</label>
                            <input name="title" type="text" class="form-control" id="titleTxt" value="{{$title}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="subtitleTxt">副标题:</label>
                            <input name="subtitle" id="subtitleTxt" type="text" class="form-control" value="{{$subtitle}}">
                        </div>

                        <div class="form-group">
                            <label for="authorTxt">作者:</label>
                            <input name="author" type="text" class="form-control" id="authorTxt" value="{{$author}}">
                        </div>

                        <div class="form-group">
                            <label for="publisherTxt">发布者:</label>
                            <input name="publisher" type="text" class="form-control" id="publisherTxt" value="{{$publisher}}">
                        </div>


                        <div class="form-group">
                            <label for="editorTxt">编辑:</label>
                            <input name="editor" type="text" class="form-control" id="editorTxt" value="{{$editor}}">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-default" type="button"
                                    data-toggle="modal" data-target="#selectParentIDModal">选择类型</button>
                            <input type="text" class="form-control" readonly value="顶级栏目" id="categoryNameTxt">
                            <input type="hidden" value="{{$category}}" name="category" id="categoryIdTxt">
                            <input type="hidden" name="is_draft" value="1">
                            <input type="hidden" name="id" value="{{$id}}">

                        </div>

                        <div class="form-group">
                            <label for="fileImage">选择题图</label>
                            <input type="file" class="form-control" id="fileImage">
                            <div id="fileImageProgressBar" class="progress hide">
                                <div class="progress-bar progress-bar-primary progress-bar-striped active"
                                     role="progressbar"
                                     aria-valuenow="0" aria-valuemin="0"
                                     aria-valuemax="100" style="width: 100%">
                                    <span class="sr-only">0% Complete (success)</span>
                                </div>
                            </div>
                            @if ($page_image)
                                <img id="imageImg" class="img-thumbnail" src="{{url('uploads/images/posts/title')}}/{{$page_image}}" >
                            @else
                                <img id="imageImg" class="img-thumbnail">
                            @endif

                            <input type="hidden" id="imageTxt" name="page_image" value="{{$page_image}}">
                        </div>
                        
                        <div class="form-group">
                            <label for="description">简要描述</label>
                            <textarea name="meta_description" id="description" cols="30" rows="10" class="form-control">{{$meta_description}}</textarea>
                        </div>

                </div>

                <div class="box-footer">
                    <button class="btn btn-primary">发布文章</button>
                </div>

                </form>
            </div>

        </div>
    </section>
@stop

@section('hidden')
    <div id="callOut"></div>
    <!-- Modal -->
    <div class="modal" id="selectParentIDModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">选择上一级栏目</h4>
                </div>
                <div class="modal-body" id="categoriesList">
                    <div class="overlay">
                        <i class="fa fa-spinner fa-spin"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--./ Modal-->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/category.js')}}"></script>
    <script type="text/javascript">
        var core = new Core();
        var date = new Date();
        var yearMonth = date.getFullYear().toString() + "-" + date.getMonth().toString();
        var callOut = new CallOut('#callOut');
        var category = new Category();
        category.url = '{{url('admin/category/parent')}}';

        $(document).on('click', '.back-to-parent', function(){
            category.currentId = $(this).attr('data-id');
            category.render('#categoriesList');
        });

        $(document).on('click', '.select-category', function() {
            $('#categoryIdTxt').val($(this).attr('data-id'));
            $('#categoryNameTxt').val($(this).text());
            $('#selectParentIDModal').modal('hide');
        });

        $(document).on('click', '.go-to-children', function() {
            category.currentId = $(this).attr('data-id');
            category.render('#categoriesList');
        });

        $(document).on('change', '#fileImage', function () {
            if (window.FormData) {
                $('#fileImageProgressBar').removeClass('hide');

                var name = document.getElementById('fileImage').files[0].name;
                var progress = $('#fileImageProgressBar').first();

                var url = "{{url('admin/upload/ajax/file')}}";
                var formData = new FormData();
                formData.append('_token', '{{csrf_token()}}')
                formData.append('file', document.getElementById('fileImage').files[0])
                formData.append('folder', 'images/posts/title/' + yearMonth);
                var name = yearMonth + "/" + name;

                core.uploadFile(url, formData, function (event) {
                    if (event.lengthComputable) {
                        var percentComplete = Math.round(event.loaded * 100 / event.total);
                        $(progress).css('width', percentComplete + "%");
                    }
                }, function (event) {
                    $('#fileImageProgressBar').addClass('hide');
                    $('#imageImg')
                            .css({width: "180px;", height: "120px"})
                            .attr('src', '{{url("uploads/images/posts/title")}}/' + name);
                    $('#imageTxt').val(name);
                });

            } else {
                callOut.warning("浏览器不支持上传，请使用Chrome/FireFox/IE10+/360浏览器急速模式。");
            }
        });

        $(function () {
            category.currentId = 0;
            category.render('#categoriesList');
        });
    </script>
@endsection