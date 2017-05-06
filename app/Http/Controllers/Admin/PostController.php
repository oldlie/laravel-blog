<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Markdowner;

use App\Http\Requests\PostAjaxStoreRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Controllers\Controller;
use Mockery\Exception;


class PostController extends Controller
{
    protected $postFields = [
        "id" => 0,
        "title" => "",
        "slug" => "",
        "content_raw" => "",
        "is_draft" => 1,
    ];

    protected $postUpdateFields = [
        "title" => "",
        "content_raw" => "",
    ];

    protected $publishFields = [
        "id" => 0,
        "title" => "",
        "subtitle" => "",
        "author" => "",
        "publisher" => "",
        "editor" => "",
        "category" => 0,
        "page_image" => "",
        "meta_description" => "",
        "is_draft" => 0,
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        foreach($this->postFields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        return view('admin.post.ueditor', $data);
    }

    public function create()
    {

    }


    public function store(PostStoreRequest $request)
    {
        $id = $request->get('id');
        $post = Post::findOrFail($id);
        foreach (array_keys($this->publishFields) as $filed) {
            $post->$filed = $request->get($filed);
        }
        $post->published_at = Carbon::now();
        $post->save();
        return redirect('admin/post/publish/' . $id)->withSuccess('文章已经发布了。');
    }

    public function ajaxStore(PostAjaxStoreRequest $request, $id)
    {
        try {
            $_exist = true; // 判断文章是不是
            if ($id != 0) {
                $post = Post::where('id', $id)->first();
                if ($post == null) {
                    $_exist = false;
                }
            } else {
                $_exist = false;
            }

            if (!$_exist) {
                $post = new Post();
                foreach (array_keys($this->postFields) as $field) {
                    $post->$field = $request->get($field);
                }
                $post->slug = $this->setUniqueSlug($post->slug, 0);
            } else {
                foreach (array_keys($this->postUpdateFields) as $field) {
                    $post->$field = $request->get($field);
                }
            }

            $post->save();

            return response()->json(['post_id' => $post->id]);
        } catch (Exception $e) {
            return response()->json(['post_id' => 0, 'msg' => $e->getMessage()]);
        }
    }

    private function setUniqueSlug($slug, $extra)
    {
        $result = $slug . '-'. $extra;
        if (Post::whereSlug($result)->exists()) {
            $extra = $extra + 1;
            return $this->setUniqueSlug($slug, $extra);
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Post::findOrFail($id);
        return view('admin.post.ueditor', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('admin/category')
            ->withSuccess('文章已经删除了。');
    }


    public function publish($id)
    {
        $post = Post::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->publishFields) as $field) {
            $data[$field] = old($field, $post->$field);
        }
        return view('admin.post.publish', $data);
    }

    public function postAjaxList($category) {
        $posts = Post::where('category', $category)
            ->orderBy('published_at', 'desc')
            ->paginate(config('blog.posts_per_page'));

        return response()->json($posts);
    }
}
