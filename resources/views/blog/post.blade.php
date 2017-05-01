@extends('layout')

@section('content')
  <div class="container">

    <div class="row">
      <section class="col-sm-12 col-md-8 content">

        <div class="box box-info">
          <div class="box-header with-border">
            <h3>{{$post->title}}</h3>
            <small>{{$post->subtitle}}</small>
          </div>

          <div class="box-body">

            <div class="row">
              <div class="col-sm-12">
                <div style="padding: 5px;">
                  <i class="fa fa-user-o"></i>:{{$post->author}} &nbsp;&nbsp;
                  <i class="fa fa-calendar-plus-o"></i>:{{$post->published_at}} &nbsp;&nbsp;
                  <i class="fa fa-eye"></i>:{{$post->view_count}}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <blockquote style="font-size: 0.75em">
                  {{$post->meta_description}}
                </blockquote>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                {!! $post->content_html !!}
              </div>
            </div>

          </div>

        </div>


      </section>

      <section class="col-sm-12 col-md-4 content"></section>
    </div>

  </div>
@endsection