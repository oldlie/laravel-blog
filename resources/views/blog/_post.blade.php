
    <div class="row" style="padding: 0px 0 15px 0;">
        <div class="col-xs-12 col-sm-5  col-md-4">
            @if ($post->page_image != '')
                <img class="img-responsive" style="margin: 0 0 3px 0"
                     src="{{url('uploads/images/posts/title') . '/' . $post->page_image}}"
                     alt="{{$post->title}}">
            @else
                <img class="img-responsive" style="margin: 0 0 3px 0"
                     src="{{url('uploads/images/posts/title') . '/' . $post->page_image}}"
                     alt="{{$post->title}}">
            @endif

        </div>
        <div class="col-xs-12 col-sm-7 col-md-8">
            <h3 style="margin: 0; padding: 2px 0; font-size: 1.2em;"><a href="{{action('BlogController@showPost', ['slug' => $post->slug])}}">{{$post->title}}</a></h3>
            <div style="padding: 5px; font-size: 0.75em;">{{$post->meta_description}}</div>
            <div style="padding: 5px;font-size: 0.75em;">
                <i class="fa fa-user-o"></i>:{{$post->author}} &nbsp;&nbsp;
                <i class="fa fa-calendar-plus-o"></i>:{{$post->published_at}} &nbsp;&nbsp;
                <i class="fa fa-eye"></i>:{{$post->view_count}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12" style="border-bottom: 1px solid #f4f4f4;margin: 15px 0;"></div>

    </div>
