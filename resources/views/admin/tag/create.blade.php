@extends('admin.layout')

@section('content')
  <div class="container-fluid">

    <div class="row page-title-row">
      <div class="col-md-12">
        <h3>
          <small>Create New Tag</small>
        </h3>
      </div>
    </div>
    <!--./row-->

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

          <div class="panel-heading">
            <h3 class="panel-title">New Tag Form</h3>
          </div>

          <div class="panel-body">
            @include('admin.partials.errors')

            <form action="/admin/tag" class="form-horizontal" role="form" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <label for="tag" class="col-md-3 control-label">Tag</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="tag" name="tag" value="{{$tag}}" autofocus>
                </div>
              </div>

              @include('admin.tag._form')

              <div class="form-group">
                <div class="col-md-7 col-md-offset-3">
                  <button class="btn btn-primary btn-md">
                    <i class="fa fa-plus-circle"></i>
                    Add New Tag
                  </button>
                </div>
              </div>

            </form>
          </div>
          <!--./panel-body -->

        </div>
      </div>
    </div>
    <!--./row-->

  </div>
@endsection