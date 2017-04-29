@extends('admin.layout')

@section('styles')
    <style>
        .post-title { font-weight: bold; height: 42px; }
        .post-input {
            width: 100%; padding: 2px 10px;
            border-top: none;border-right: none;border-left: none;
            border-bottom: 1px solid #d2d6de
        }
        .post-row { margin: 5px 0;}

        .out-put {
            border: 1px solid #666;
            width: 100%;
            height: 400px;
            padding: 10px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        textarea {
            width: 100%;
            height: 400px;
        }
    </style>
@endsection

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

      <div class="col-xs-12 col-sm-12 col-md-6" id="inputSection">
          <div class="box box-solid">

              <div class="box-body no-padding">
                  <div class="btn-group">
                      <button id="appendImageBtn" class="btn btn-sm btn-default" type="button"
                              data-toggle="modal" data-target="#appendImageModal" >
                          <i class="fa fa-image"></i>
                      </button>
                      <button id="clearContentBtn" class="btn btn-sm btn-warning"><i class="fa fa-eraser"></i></button>
                      <button id="columnChangeBtn" class="btn btn-sm btn-default"><i class="fa fa-columns"></i></button>
                      <button class="btn btn-sm btn-primary saveDraftBtn"><i class="fa fa-save"></i></button>
                  </div>
<textarea id="input">@if ($id == 0)
# 一级标题
## 二级标题
### 三级标题
#### 四级标题
##### 五级标题
###### 六级标题

***

1. 列表
2. 列表
3. 列表

***

链接：
[简书](http://jianshu.io)

![图片](http://ww4.sinaimg.cn/bmiddle/aa397b7fjw1dzplsgpdw5j.jpg)

***

> 我是被引用的内容 =w=

**两个连续星号包围一段文本，就把这段加粗啦**
*两个单独星号包围一段文本，就让文本倾斜咯*
_或者用下划线来倾斜_
~~删除线~~

***

#### 表格

dog | bird | cat
----|:----:|----:
foo | foo | foo
bar | bar | bar
baz | baz | baz

分页线和换行：
---

行内代码用 `int sum = b + c`

```
行内代码用 ` int sum = b + c `
```
 @else{{$content_raw}}@endif</textarea>

              </div>
              <!-- /.box-body -->
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6" id="outputSection">
          <div class="box box-solid">
              <div class="box-body no-padding">
                  <div class="btn-group">
                      <button id="refreshBtn" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></button>
                      <button id="previewBtn" class="btn btn-sm btn-default"><i class="fa fa-eye"></i></button>
                  </div>
                  <div class="out-put"></div>
              </div>
              <!-- /.box-body -->
          </div>
      </div>

      <div class="col-sm-12">
          <div class="btn-group">
              <button class="btn btn-default saveDraftBtn"><i class="fa fa-save"></i> 保存草稿</button>
              <button id="publishBtn" class="btn btn-primary">发布文章</button>
          </div>
      </div>
  </section>

    <div id="call-out"></div>
@endsection

@section('hidden')
    <div class="modal" id="appendImageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">上传图片</h4>
                </div>
                <div class="modal-body" >
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="fileImage">
                        <div id="fileImageProgressBar" class="progress hide">
                            <div class="progress-bar progress-bar-primary progress-bar-striped active"
                                 role="progressbar"
                                 aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">0% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/markdown.js')}}"></script>
    <!-- Page Events -->
    <script type="text/javascript">
        var core = new Core();
        var date = new Date();
        var yearMonth = date.getFullYear().toString() + "-" + date.getMonth().toString();
        var column = 2;
        var preview = 2;
        var callOut = new CallOut("#call-out");

        $(document).on('keyup', '#titleTxt', function() {
            $('#slugTxt').val($(this).val().replace(/\s/g, "-"));
        });

        $(document).on('keyup', '#input', function (event) {
            var text = $(this).val();
            $('.out-put').html(markdown.toHTML(text))
                    .scrollTop($(this).scrollTop());
        });

        $(document).on('change', '#fileImage', function(){
            var name = document.getElementById('fileImage').files[0].name;
            var progress = $('#fileImageProgressBar').first();
            var url = "{{url('admin/upload/ajax/file')}}";
            var formData = new FormData();
            formData.append('_token', '{{csrf_token()}}')
            formData.append('file', document.getElementById('fileImage').files[0])
            formData.append('folder', 'images/posts/' + yearMonth);

            core.uploadFile(url, formData, function (event) {
                if (event.lengthComputable) {
                    var percentComplete = Math.round(event.loaded * 100 / event.total);
                    $(progress).css('width', percentComplete + "%");
                }
            }, function (event) {
                $('#fileImageProgressBar').addClass('hide');
                var image = "{{url('uploads/images/posts')}}" + "/" + yearMonth + "/" + name;
                var content = $("#input").val() + "\n![" + name + "](" + image + ")\n";
                $("#input").val(content);
                $('#appendImageModal').modal('hide');
                $('.out-put').html(markdown.toHTML(content))
                        .scrollTop($(this).scrollTop());
            });
        });

        $(document).on('click', '#clearContentBtn', function() {
            $("#input").val('');
            $('.out-put').html('');
        });

        $(document).on('click', '#columnChangeBtn', function() {
            console.log("hello");
            if (column == 2) {
                $('#inputSection').removeClass('col-md-6').addClass('col-md-12');
                $('#outputSection').addClass('hide');
                column = 1;
            } else {
                $('#inputSection').removeClass('col-md-12').addClass('col-md-6');
                $('#outputSection').removeClass('hide');
                column = 2;
            }
        });

        $(document).on('click', '#refreshBtn', function() {
            $('.out-put').html(markdown.toHTML($("#input").val()));
        });

        $(document).on('click', '#previewBtn', function() {
            if (preview == 2) {
                $('#outputSection').removeClass('col-md-6').addClass('col-md-12');
                $('#inputSection').addClass('hide');
                preview = 1;
            } else {
                $('#outputSection').removeClass('col-md-12').addClass('col-md-6');
                $('#inputSection').removeClass('hide');
                preview = 2;
            }
        });

        $(document).on('click', '.saveDraftBtn', function() {
            var title = $('#titleTxt').val();
            if (title == "") {
                callOut.warning("保存文字内容之前请输入文章标题。");
                return void(0);
            }
            var id = $('#idTxt').val();
            var data = {
                _token: '{{csrf_token()}}',
                title: $('#titleTxt').val(),
                slug: $('#slugTxt').val(),
                content_raw: $('#input').val(),
                is_draft: 1
            };

            $.post('{{url('admin/ajax/post/store/')}}' + "/" + id, data, function(json) {
                console.log(json);
                if (json.post_id > 0) {
                    $('#idTxt').val(json.post_id);
                    callOut.success("草稿已经保存");
                }
            }, 'json')
        });

        $(document).on('click', '#publishBtn', function () {
            var id = Number($('#idTxt').val());
            if (id <= 0) {
                callOut.warning("请先保存文章到草稿。")
                return;
            }

            window.location.href = "{{url('admin/post/publish')}}" + "/" + id.toString();
        });
    </script>
    <script type="text/javascript">
        $(function(){
            $('.out-put').html(markdown.toHTML($('textarea').val()));
        });
    </script>
@endsection