<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Post;
use App\SubCategories;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index()
    {
        /*
        $posts = Post::where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(config('blog.posts_per_page'));

        return view('blog.index', compact('posts'));
        */

        $data = array('msg'=> 'hello');

        $show_categories = SubCategories::all();

        foreach ($show_categories as $category) {
            $category->posts =
                Post::where('category', $category->category)
                    ->where('is_draft', 0)
                    ->orderBy('published_at', 'desc')
                    ->get();
        }

        $latest_posts = Post::where('is_draft', 0)
            ->orderBy('published_at', 'desc')
            ->take(config('blog.posts_per_page'))
            ->get();

        $data['latest'] = $latest_posts;
        $data['categories'] = $show_categories;

        return view('blog.index', $data);
    }

    public function showPost($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        $post->view_count++;
        $post->save();
        return view('blog.post')->withPost($post);
    }

    public function showMore($category_id)
    {
        $data = [];

        if ($category_id == 0) {
            $category = new Categories();
            $category->title = '最新';
            $data['category'] = $category;

            $posts = Post::where('is_draft', 0)
                ->orderBy('published_at', 'desc')
                ->paginate(config('blog.posts_per_page'));
            $data['posts'] = $posts;
        } else {
            $category = Categories::findOrFail($category_id);
            $data['category'] = $category;

            $posts = Post::where('category', $category_id)
                ->where('is_draft', 0)
                ->orderBy('published_at', 'desc')
                ->paginate(config('blog.posts_per_page'));
            $data['posts'] = $posts;
        }



        return view('blog.list', $data);
    }
}
