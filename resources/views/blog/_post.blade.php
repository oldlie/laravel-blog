
    <div class="row" style="padding: 5px 0;">
        <div class="col-xs-12 col-sm-4  col-md-3">
            <img class="img-responsive" style="margin: 0 0 3px 0"
                 src="{{url('uploads/images/posts/title') . '/' . $post->page_image}}"
                 alt="{{$post->title}}">
        </div>
        <div class="col-xs-12 col-sm-8 col-md-9">
            <h3 style="margin: 0; padding: 2px 0;"><a href="{{action('BlogController@showPost', ['slug' => $post->slug])}}">{{$post->title}}</a></h3>
            <div style="padding: 5px;">{{$post->meta_description}}</div>
            <div style="padding: 5px;font-size: 0.75em">
                <i class="fa fa-user-o"></i>:{{$post->author}} &nbsp;&nbsp;
                <i class="fa fa-calendar-plus-o"></i>:{{$post->published_at}} &nbsp;&nbsp;
                <i class="fa fa-eye"></i>:{{$post->view_count}}
            </div>
        </div>
    </div>
