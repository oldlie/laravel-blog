<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;

class CarouselController extends Controller
{

    public function index()
    {
        $data = [];

        $data['carousels'] = Post::where('is_carousel', 1)->get();
        $data['posts'] = Post::where('is_draft', 0)
            ->orderBy('published_at', 'desc')
            ->paginate(config('blog.posts_per_page'));

        return view('admin.carousel.index', $data);
    }

    public function store(Request $request)
    {
        $id = $request->get('post_id');
        $post = Post::findOrFail($id);
        $post->is_carousel = 1;
        $post->save();
        return redirect('admin/carousel')
            ->withSuccess('添加《' . $post->title . '》到轮播。');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->is_carousel = 0;
        $post->save();
        return redirect('admin/carousel')
            ->withSuccess('把《' . $post->title . '》从轮播中移除。');
    }
}
