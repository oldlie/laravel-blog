<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use Michelf\Markdown;

use App\Http\Requests\PostAjaxStoreRequest;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    protected $postFields = [
        "slug" => "",
        "title" => "",
        "content_raw" => "",
        "is_draft" => 1,
    ];

    protected $publishFields = [
        "author" => "",
        "publisher" => "",
        "editor" => "",
        "proof-reader" => "",
        "category" => 0,
        "is_draft" => 0,
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function ajaxStore(PostAjaxStoreRequest $request)
    {
        $post = new Post();
        foreach (array_keys($this->postFields) as $field) {
            $post->$field = $request->get($field);
        }
        $markdown = new Markdowner();
        $post->content_html = $markdown->toHTML($post->content_raw);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
