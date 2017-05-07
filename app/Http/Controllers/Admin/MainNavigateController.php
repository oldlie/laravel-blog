<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\MainNavigationCreateRequest;
use App\Http\Controllers\Controller;
use App\MainNavigation;
use App\Categories;

class MainNavigateController extends Controller
{

    protected $fields = [
        "id" => 0,
        "title" => "",
        "url" => "",
        "order" => 1
    ];

    public function index()
    {
        $data = [];
        $data['links'] = Categories::where('parent_id', 0)->get();
        $data['urls'] = MainNavigation::orderBy('order', 'asc')->get();
        return view('admin.navigation.index', $data);
    }


    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        return view('admin.navigation.create', $data);
    }


    public function store(MainNavigationCreateRequest $request)
    {
        $navigate = new MainNavigation();
        foreach (array_keys($this->fields) as $field){
            $navigate->$field = $request->get($field);
        }
        $navigate->save();
        return redirect('/admin/navigation')->withSuccess("创建了一个新的栏目链接:" . $navigate->title);
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

    public function destroy($id)
    {
        $navigation = MainNavigation::findOrFail($id);
        $navigation->delete();
        return redirect('/admin/navigation')->withSuccess("删除了一个新的栏目链接:" . $navigation->title);
    }
}
