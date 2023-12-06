<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // list categories
    public function list()
    {
        $categories = Category::latest()->get();

        return view('category-list', compact('categories'));
    }

    // category form
    public function form($id = false)
    {
        $category = new Category();
        if($id)
        {
            $category = Category::findOrFail($id);
        }

        return view('category', compact('category'));
    }

    // category create and update
    public function save(Request $request)
    {
        $id = $request['category_id'];
        if(filled($id))
        {
            $category = Category::findOrFail($id);
        }
        else
        {
            $category = new Category();
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|string'
        ]);

        if($validator->fails())
        {
            return redirect('/category/new')->withErrors($validator)->withInput();
        }

        $category->category = $request['category'];
        $category->save();

        return redirect()->route('category.list');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.list');
    }
}
