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
            <div class="col-md-3">

                <a href="{{url('admin/category/create')}}" class="btn btn-primary btn-block margin-bottom">创建分类</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <div style="padding: 10px 3px;"  id="categoriesList"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/category.js')}}"></script>
    <script type="text/javascript">
        var category = new Category();
        category.url = '{{url('admin/category/parent')}}';

        $(function() {
            category.currentId = 0;
            category.render('#categoriesList');
        });
    </script>
@endsection