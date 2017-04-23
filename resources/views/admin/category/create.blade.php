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
                    <form class="form-horizontal">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">栏目名称：</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="栏目名称">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputParentID" class="col-sm-2 control-label">上级栏目：</label>

                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button class="btn btn-default" type="button"
                                                    data-toggle="modal" data-target="#selectParentIDModal"
                                                    style="width: 100%;"> 选择上一级栏目</button>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="inputParentCategory">
                                        </div>
                                    </div>
                                    <input type="hidden" id="inputParentID">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputImage" class="col-sm-2 control-label">栏目题图：</label>

                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="fileImage">
                                    <div id="fileImageProgressBar" class="progress hide">
                                        <div class="progress-bar progress-bar-primary progress-bar-striped active"
                                             role="progressbar"
                                             aria-valuenow="0" aria-valuemin="0"
                                             aria-valuemax="100" style="width: 100%">
                                            <span class="sr-only">0% Complete (success)</span>
                                        </div>
                                    </div>
                                    <img id="imgCategory" class="img img-thumbnail">
                                    <input type="hidden" class="form-control" id="inputImage" placeholder="栏目题图">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{url('admin/category')}}" class="btn btn-default"><i class="fa fa-arrow-circle-o-left"></i> 返回栏目列表</a>
                            <button type="button" class="btn btn-primary pull-right"><i class="fa fa-save"></i> 保存</button>
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
                    <div class="btn-group" style="width: 100%;">
                        <button type="button" class="btn btn-ms btn-default"><i class="fa fa-angle-double-left"></i> </button>
                        <button style="width: 90%;" type="button" class="btn btn-default" disabled>根目录</button>
                    </div>
                    <div class="btn-group" style="width: 100%;">
                        <button style="width: 90%;" type="button" class="btn btn-ms btn-default text-left"></i> 日记</button>
                        <button type="button" class="btn btn-ms btn-default"><i class="fa fa-angle-double-right"></i> </button>
                    </div>
                    <div class="btn-group" style="width: 100%;">
                        <button style="width: 90%;" type="button" class="btn btn-ms btn-default text-left"><i class="fa fa-check"></i> 文摘</button>
                        <button type="button" class="btn btn-ms btn-default"><i class="fa fa-angle-double-right"></i> </button>
                    </div>
                    <div class="btn-group" style="width: 100%;">
                        <button style="width: 90%;" type="button" class="btn btn-ms btn-default text-left"><i class="fa fa-check"></i> 照片</button>
                        <button type="button" class="btn btn-ms btn-default"><i class="fa fa-angle-double-right"></i> </button>
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
<script type="text/javascript">

    var Category = (function () {

        function Category() {

            this.parentId = 1;
            this.currentId = 1;
        }

        var core = new Core();
        var tempHtml = [];
        var template = {
            back : ['<div class="btn-group" style="width: 100%;">',
                '<button type="button" class="btn btn-ms btn-default" ${disabled} data-id=${id}><i class="fa fa-angle-double-left"></i> </button>',
                '<button style="width: 90%;" type="button" class="btn btn-default" disabled>上层栏目</button>',
                '</div>'
            ].join(''),
            next : ['<div class="btn-group" style="width: 100%;">',
                '<button style="width: 90%;" type="button" class="btn btn-ms btn-default text-left" data-id="${id}" onclick="category.select()">${text}</button>',
                '<button type="button" class="btn btn-ms btn-default"  ${disabled}><i class="fa fa-angle-double-right"></i> </button>',
                '</div>'
            ].join('')
        };

        Category.prototype.draw = function (list) {
            tempHtml = [];

            if (this.currentId > 1) {
                tempHtml.push(core.html(template.back, {id: this.parentId}));
            }

            for (var i = 0; i < list.length; i++) {
                var item = list[i];
                var disabled = '';
                if (item.children <= 0) {
                    disabled = 'disabled';
                }
                tempHtml.push(core.html(template.next, {id: item.id, text: item.name, disabled: disabled}));
            }
            return tempHtml.join('');
        };

        Category.prototype.select = function () {
            $('#inputParentID').val($(event.target).attr('data-id'));
            $('#inputParentCategory').val($(event.target).text());
            $('#selectParentIDModal').modal('hide');
        };
        return Category;
    })();

    var core = new Core();
    var parentId = 1, currentId = 1, url = '', i = 0;
    var category = new Category();


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
        url = "{{url('admin/category/parent')}}" + "/" + parentId.toString();
        $.get(url, function (list) {
            if (list.length > 0) {
                $('#categoriesList').html(category.draw(list));
            }
        }, "json");
    });


</script>
@endsection