<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('backend.admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191|unique:categories',
            'img' => 'mimes:jpg,jpeg,bmp,png|max:200'
        ]);

        if ($request->hasFile('img')) {

            $image = $request->file('img');

            $image_name = strtolower(rand(10000, 999999).'_'.$image->getClientOriginalName());

            Image::make($image)->save(public_path('images/category/'.$image_name));

            $request['image'] = $image_name;
        }

        $request['slug'] = Str::slug($request->name);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('successMsg', 'Category created successfully');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('backend.admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:191|unique:categories,name,'.$category->id,
            'img' => 'mimes:jpg,jpeg,bmp,png|max:200'
        ]);

        if ($request->hasFile('img')) {

            $image = $request->file('img');

            $image_name = strtolower(rand(10000, 999999).'_'.$image->getClientOriginalName());

            Image::make($image)->save(public_path('images/category/'.$image_name));

            $request['image'] = $image_name;

            //delete image
            if ($category->image){
                $image_path = public_path('images/category/'.$category->image);

                if (file_exists($image_path)){
                    unlink($image_path);
                }
            }
        }

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('successMsg', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('successMsg', 'Category delete successfully');
    }

    public function changeStatus(Category $category){

        $status = $category->status ? 0 : 1;

        $update = $category->update(['status' => $status]);

        if ($update) {
            return back()->with('successMsg', 'Category publication status changed successfully');
        }
    }
}
