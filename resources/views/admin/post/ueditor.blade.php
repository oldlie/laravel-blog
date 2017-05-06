@extends('admin.layout')

@section('styles')
    <style>
        .post-title { font-weight: bold; height: 42px; }
        .post-input {
            width: 100%; padding: 2px 10px;
            border-top: none;border-right: none;border-left: none;
            border-bottom: 1px solid #d2d6de
        }

        textarea {
            width: 100%;
            height: 400px;
        }
    </style>
@stop

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

        <div class="col-sm-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border box-primary">
                    <input type="hidden" id="idTxt" value="{{$id}}"/>
                    <input id="titleTxt" value="{{$title}}" type="text"class="post-input post-title" placeholder="标题：请只输入数字，字母，汉字以及空格">
                    <input type="hidden" value="{{$slug}}" id="slugTxt" />
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <script id="container" name="content" type="text/plain">{{$content_raw}}</script>
        </div>

        <div class="col-sm-12">
            <div class="btn-group">
                <button class="btn btn-default saveDraftBtn"><i class="fa fa-save"></i> 保存草稿</button>
                <button id="publishBtn" class="btn btn-primary">发布文章</button>
            </div>
        </div>
    </section>

    <div id="callOut"></div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/ueditor/ueditor.cinfig.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/ueditor/ueditor.all.js')}}"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
@stop