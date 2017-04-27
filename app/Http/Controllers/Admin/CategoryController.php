<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $fields = [
        'name' => '',
        'parent_id' => 1,
        'parent_name' => '顶级栏目',
        'image' => '',
        'order' => 0,
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }

        return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoryCreateRequest $request
     */
    public function store(CategoryCreateRequest $request)
    {
        $cate = new Categories();
        foreach (array_keys($this->fields) as $field) {
            $cate->$field = $request->get($field);
        }
        $cate->save();

        $parent_cate = Categories::findOrFail($cate->parent_id);
        if ($parent_cate) {
            $parent_cate->child_count++;
            $parent_cate->save();
        }

        return redirect('/admin/category')->withSuccess("分类 '$cate->name' 已经保存.");
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

    public function listCategory($id)
    {
        try {
            $category = Categories::where('id', $id)->first();
        } catch(NotFoundHttpException $e) {
            $category = "";
        }
        $children = Categories::where('parent_id', (int)$id)->get();
        return \response()->json(["self" => $category, "list" => $children]);
    }
}
