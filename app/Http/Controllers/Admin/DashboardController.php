<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\SubCategories;
use App\Subtitle;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function subtitle()
    {
        $data = SubCategories::all();
        return view('admin.dashboard.subtitle', compact('data'));
    }

    public function subtitleStore(Request $request)
    {
        $id = $request->get('id');
        $category = Categories::findOrFail($id);

        $sub_category = new SubCategories();
        $sub_category->title = $category->name;
        $sub_category->category = $category->id;
        $sub_category->save();

        return redirect("/admin/subtitle")
            ->withSuccess("已经添加。");
    }

    public function subtitleDelete($id) {
        SubCategories::destroy($id);
        return redirect("/admin/subtitle")
            ->withSuccess("已经修改。");
    }
}
