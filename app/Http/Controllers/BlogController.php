<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Post;
use App\SubCategories;
use App\MainNavigation;

class BlogController extends Controller
{
    public function index()
    {
        $data = [];
        $data['links'] = $this->buildCategories(0);
        $data['urls'] = MainNavigation::orderBy('order', 'asc')->get();

        $data['carousels'] = Post::where('is_carousel', 1)->get();

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

    private function buildCategories($id)
    {
        $result = Categories::where('parent_id', $id)->get();
        /*
        foreach ($result as $item) {
            if ($item->child_count>0) {
                $this->buildCategory($item);
            }
        }*/
        return $result;
    }

    private function buildCategory($data)
    {
        $data->children = Categories::where('parent_id', $data->id)->get();
        foreach ($data->children as $item) {
            if ($item->child_count>0) {
                $this->buildCategory($item->id, $item);
            }
        }
    }

    public function showPost($slug)
    {
        $data = [];
        $data['links'] = $this->buildCategories(0);
        $data['urls'] = MainNavigation::orderBy('order', 'asc')->get();

        $post = Post::whereSlug($slug)->firstOrFail();
        $post->view_count++;
        $post->save();
        $data['post'] = $post;
        return view('blog.post', $data);
    }

    public function showMore($category_id)
    {
        $data = [];
        $data['links'] = $this->buildCategories(0);
        $data['urls'] = MainNavigation::orderBy('order', 'asc')->get();

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
