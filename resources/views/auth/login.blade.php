@extends('admin.layout')

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

          <div class="panel-heading">Login</div>
          <!--./heading-->

          <div class="panel-body">
            @include('admin.partials.errors')

            <form action="{{ url('/auth/login') }}" class="form-horizontal" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="emailTxt" class="col-md-4 control-label">Email Address:</label>
                <div class="col-md-6">
                  <input id="emailTxt" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                </div>
              </div>

              <div class="form-group">
                <label for="passwordTxt" class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                  <input id="passwordTxt" type="password" class="form-control" name="password" autofocus>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <div class="checkbox">
                    <label for="">
                      <input type="checkbox" name="remember"> Remember Me
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button class="btn btn-primary">Login</button>
                </div>
              </div>
            </form>
          </div>
          <!--./panel body-->

        </div>
      </div>
    </div>
  </div>

@stop