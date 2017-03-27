<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('blog.title')}}</title>
  <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>

{{-- Navigation Bar --}}
<nav class="navar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-targe="#navgar-menu">
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-menu">
        @include('admin.partials.navbar')
    </div>
  </div>
</nav>

@yield('content')

<script type="text/javascript" src="/assets/js/admin.js"></script>
@yield('scripts')

</body>
</html>