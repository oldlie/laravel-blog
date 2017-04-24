@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            创建一个栏目
            <small>写文章</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-pencil"></i> 写文章</a></li>
            <li><a href="{{url('admin/category')}}"><i class="fa fa-dashboard"></i> 栏目列表</a></li>
            <li class="active">创建一个栏目</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-sm-12">

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">创建一个栏目列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{url('admin/category')}}">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    @include('admin.partials.errors')
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('admin.category._form')

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{url('admin/category')}}" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> 返回栏目列表</a>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> 保存</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>

            </div>

        </div>
    </section>

@endsection

@section('hidden')
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

    var category = new Category();
    category.url = '{{url('admin/category/parent')}}';
    var parentId = 1, currentId = 1, url = '', i = 0;

    $(document).on('change', '#fileImage', function () {
        if (window.FormData) {
            $('#fileImageProgressBar').removeClass('hide');

            var name = document.getElementById('fileImage').files[0].name;
            var pargress = $('#fileImageProgressBar').first();

            var url = "{{url('admin/upload/ajax/file')}}";
            var formData = new FormData();
            formData.append('_token', '{{csrf_token()}}')
            formData.append('file', document.getElementById('fileImage').files[0])
            formData.append('folder', 'images/category')

            core.uploadFile(url, formData, function (event) {
                if (event.lengthComputable) {
                    var percentComplete = Math.round(event.loaded * 100 / event.total);
                    $(pargress).css('width', percentComplete + "%");
                }
            }, function (event) {
                $('#fileImageProgressBar').addClass('hide');
                $('#imgCategory')
                    .css({width: "180px;", height: "120px"})
                    .attr('src', '{{url("uploads/images/category")}}/' + name);
                $('#inputImage').val(name);
            });

        } else {
            alert("浏览器不支持上传，请使用Chrome/FireFox/IE10+/360浏览器急速模式。");
        }
    });
    
    $('#selectParentIDModal').on('show.bs.modal', function (event) {
        console.log('open modal.');
        category.currentId = 0;
        category.render('#categoriesList');
    });


</script>
@endsection