@extends('layout')

@section('content')
    <div class="container">

        <div class="row">
            <section class="col-sm-12 col-md-8 content">

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3>{{$category->name}}</h3>
                    </div>

                    <div class="box-body">
                        @foreach($posts as $post)
                            @include('blog._post')
                        @endforeach
                    </div>

                    <div class="box-footer">
                        {!! $posts->render() !!}
                    </div>
                </div>


            </section>

            <section class="col-sm-12 col-md-4 content"></section>
        </div>

    </div>
@endsection

