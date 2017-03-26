<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{$post->title}}</title>
  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div>
  <h1>{{ $post->title }}</h1>
  <h5>{{ $post->published_at }}</h5>
  <hr>
    {!! nl2br(e($post->content)) !!}
  <hr>
  <button class="btn btn-primary" onclick="history.go(-1)"><< Back</button>
</div>
</body>
</html>