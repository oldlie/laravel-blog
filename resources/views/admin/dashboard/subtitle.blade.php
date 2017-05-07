@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('admin.partials.errors')
        @include('admin.partials.success')

        <button data-toggle="modal" data-target="#selectParentIDModal"
                type="button" class="btn btn-default" id="selectCategoryBtn"> 选择一个栏目</button>

        @if (count($data) > 0)
            <div class="box box-default">
                <div class="box-body">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @for($i = 0; $i < count($data); $i++)
                                @if ($i > 3)
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                更多 <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @for(; $i < count($data); $i++)
                                                <li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="tab"
                                                                           href="#tab_{{$data[$i]->id}}">{{$data[$i]->title}}</a></li>
                                                @endfor
                                            </ul>
                                        </li>
                                @else
                                    <li @if($i == 0) {{'class=active'}} @endif><a href="#tab_{{$data[$i]->id}}" data-toggle="tab">{{$data[$i]->title}}</a></li>
                                @endif
                            @endfor
                        </ul>
                        <div class="tab-content">
                            @for($i = 0; $i < count($data); $i++)
                                <div class="tab-pane @if($i == 0) {{'active'}} @endif" id="tab_{{$data[$i]->id}}">
                                    <p>首页将会加载 <b>{{$data[$i]->title}}</b> 栏目下的文章</p>
                                    <form action="{{url('admin/subtitle/') . '/'. $data[$i]->id}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field("delete")}}
                                        <p><button type="submit" class="btn btn-danger">删除</button></p>
                                    </form>
                                </div>
                            @endfor

                        </div>
                        <!-- /.tab-content -->
                    </div>

                </div>
            </div>
        @else
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> 您好!</h4>
                还没有设置需要展示的栏目。
            </div>
        @endif

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

    <div class="hidden">
        <form id="addForm" action="{{url('admin/subtitle')}}" method="post">
            {{csrf_field()}}
            <input id="inputCategoryId" type="hidden" name="id">
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/category.js')}}"></script>
    <script type="text/javascript">
        var core = new Core();
        var category = new Category();
        category.url = '{{url('admin/category/parent')}}';

        // region Events: 选择父一级的栏目
        /**
         * 返回上一级目录
         */
        $(document).on('click', '.back-to-parent', function(){
            category.currentId = $(this).attr('data-id');
            category.render('#categoriesList');
        });

        /**
         * 选择这个目录作为上级目录
         */
        $(document).on('click', '.select-category', function() {
            var id = $(this).attr('data-id');
            console.log(id);
            $('#inputCategoryId').val(id);
            $('#addForm').submit();
        });

        /**
         * 去到它的子栏目
         */
        $(document).on('click', '.go-to-children', function() {
            category.currentId = $(this).attr('data-id');
            category.render('#categoriesList');
        });
        // endregion

        $('#selectParentIDModal').on('show.bs.modal', function (event) {
            console.log('open modal.');
            category.currentId = 0;
            category.render('#categoriesList');
        });

    </script>
@endsection