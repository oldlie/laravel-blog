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
                  <input type="text" class="post-input post-title" placeholder="标题：">

                  <div class="box-tools">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                  </div>
              </div>

              <div class="box-body no-padding container-fluid">
                  <div class="col-sm-12 post-row">
                      <input type="text" class="post-input" placeholder="副标题">
                  </div>
                  <div class="col-sm-12 post-row">
                      <input type="text" class="post-input" placeholder="作者">
                  </div>
                  <div class="col-sm-12 post-row">
                      <input type="text" class="post-input" placeholder="发布/审核员">
                  </div>
                  <div class="col-sm-12 post-row">
                      <button class="btn btn-default"><i class="fa fa-list"></i> 选择栏目</button>
                  </div>
                  <div class="col-sm-12 post-row">
                      <input class="form-control" type="file" placeholder="题图"/>
                      <img class="img-thumbnail">
                  </div>

              </div>
          </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6">
          <div class="box box-solid">

              <div class="box-body no-padding">
                  <div class="btn-group">
                      <button class="btn btn-sm btn-default"><i class="fa fa-image"></i></button>
                      <button class="btn btn-sm btn-warning"><i class="fa fa-eraser"></i></button>
                      <button class="btn btn-sm btn-default"><i class="fa fa-columns"></i></button>
                      <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i></button>
                  </div>
<textarea id="input">
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

</textarea>
              </div>
              <!-- /.box-body -->
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6">
          <div class="box box-solid">
              <div class="box-body no-padding">
                  <div class="btn-group">
                      <button class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></button>
                      <button class="btn btn-sm btn-default"><i class="fa fa-eye"></i></button>
                  </div>
                  <div class="out-put"></div>
              </div>
              <!-- /.box-body -->
          </div>
      </div>

      <div class="col-sm-12">
          <button class="btn btn-primary">发布文章</button>
      </div>
  </section>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/markdown.js')}}"></script>
    <script type="text/javascript">
        $(document).on('keyup', '#input', function (event) {
            var text = $(this).val();
            console.log($(this).height());
            console.log($(this).scrollTop());
            $('.out-put').html(markdown.toHTML(text))
                    .scrollTop($(this).scrollTop());
        });
        $(function(){
            $('.out-put').html(markdown.toHTML($('textarea').val()));
        });
    </script>
@endsection