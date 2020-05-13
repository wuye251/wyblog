<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    
    public function index()
    {
        //
        $category = Category::all();

        $assign = compact('category');

        return view('admin.category.index', $assign);
    }

    
    public function create()
    {
        //
        return view('admin.category.create');
    }

    
    public function store(Request $request)
    {
        //
        $param = $request->all();

        $input = [
            'name'        => $param['name'],
            'description' => $param['description'],
            'sort'        => $param['sort'],
        ];

        Category::create($input);

        return redirect('admin/category/index');
    }

    
    public function show($id)
    {
        //
        $category = Category::withTrashed()->find($id);
        $assign   = compact('category');

        return view('admin.category.show', $assign);
    }

    
    public function edit($id)
    {
        //
        $category = Category::withTrashed()->find($id);
        $assign   = compact('category');

        return view('admin.category.edit', $assign);
    }

    
    public function update(Request $request, $id)
    {
        //
        Category::withTrashed()->find($id)->update([
                                                'name'        => $param['name'],
                                                'description' => $param['description'],
                                                'sort'        => $param['sort'],
                                            ]);
        return redirect()->back();
    }

    
    public function destroy($id)
    {
        //
        Category::destroy($id);

        return redirect('admin/category/index');
    }

    public function sort(Request $request, $id)
    {
        $param = $request->all();

        Category::withTrashed()->find($id)->update(['sort' => $param['sort']]);

        return redirect()->back();
    }
}
