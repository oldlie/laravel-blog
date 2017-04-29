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

                <div class="box-body">

                    <form>

                        <div class="form-group">
                            <label for="titleTxt">标题:</label>
                            <input title type="text" class="form-control" id="titleTxt" value="{{$title}}">
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
                            <input type="text" class="form-control" readonly value="顶级栏目">
                            <input type="hidden" value="0" name="category">
                            <input type="hidden" name="is_draft" value="1">
                            <input type="hidden" name="id" value="{{$id}}">
                        </div>

                        <div class="form-group">
                            <label for="fileImage">选择题图</label>
                            <input type="file" class="form-control" id="fileImage">
                            <img class="img-thumbnail">
                        </div>
                    </form>
                </div>

                <div class="box-footer">
                    <button class="btn btn-primary">发布文章</button>
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

        $(function () {
            category.currentId = 1;
            category.render('#categoriesList');
        });
    </script>
@endsection