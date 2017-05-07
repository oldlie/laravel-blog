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
            <script id="container" name="content" type="text/html"></script>
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
    <script type="text/javascript" src="{{url('ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" src="{{url('ueditor/ueditor.all.js')}}"></script>
    <script type="text/javascript">
        var callOut = new CallOut('#callOut');
        var ue = UE.getEditor('container', {
            autoHeight: false
        });
        ue.ready(function() {
            //设置编辑器的内容
            ue.setContent('{!! $content_raw !!}');
        });

        /**
         * set slug title
         */
        $(document).on('change', '#titleTxt', function () {
            $('#slugTxt').val($(this).val());
        });

        /**
         * save draft
         */
        $(document).on('click', '.saveDraftBtn', function () {
            saveDraft(function (json) {
                console.log(json);
                if (json.post_id > 0) {
                    $('#idTxt').val(json.post_id);
                    callOut.success("草稿已经保存");
                }
            });
        });
        
        function saveDraft(callBack) {
            console.log('save draft.');
            var title = $('#titleTxt').val();
            if (title === "") {
                callOut.warning("保存文字内容之前请输入文章标题。");
                return void(0);
            }

            var id = $('#idTxt').val();
            var data = {
                _token: '{{csrf_token()}}',
                title: $('#titleTxt').val(),
                slug: $('#slugTxt').val(),
                content_raw: ue.getContent(),
                is_draft: 1
            };

            $.post('{{url('admin/ajax/post/store/')}}' + "/" + id, data, function(json) {
                if (callBack != null) {
                    callBack(json);
                }
            }, 'json')
        }

        /**
         * publish article
         */
        $(document).on('click', '#publishBtn', function () {
            var id = Number($('#idTxt').val());
            if (id <= 0) {
                callOut.warning("请先保存文章到草稿。")
                return;
            }
            saveDraft(function (json) {
                console.log(json);
                if (json.post_id > 0) {
                    window.location.href = "{{url('admin/post/publish')}}" + "/" + json.post_id.toString();
                }
            });
        });
    </script>
@stop