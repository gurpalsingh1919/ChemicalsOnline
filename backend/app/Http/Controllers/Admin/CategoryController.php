<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        //$categories = Category::all();
        $categories=Category::where('parent_id','0')->OrderBy('id','DESC')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories=$this->getCategories();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            //'name' => 'required|unique:categories,name',
            //'description' => 'nullable|string',
            'name' => 'required|unique:categories,name,' . ($category->id ?? 'NULL') . ',id',
            //'description' => 'nullable|string',
            //'parent_id' => 'nullable|exists:categories,id',
        ]);

        //$Category->parent_id = $request->parent_category ? $request->parent_category:0;

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
    public function getCategories()
    {
        $allcategories=Category::get();
        $rootcategories=Category::where('parent_id','0')->get();
        self::formatTree($rootcategories,$allcategories);

        return $rootcategories;
        
    }
    private static function formatTree($rootcategories,$allcategories)
    {
        foreach($rootcategories as $category)
        {
            $rootcategories->subcategories=$allcategories->where('parent_id',$category->id)->values();
            if(count($rootcategories->subcategories)>0)
            {
                self::formatTree($rootcategories->subcategories,$allcategories);
            }
        }
    }
    public function show($id)
    {
        $category = Category::with('children')->findOrFail($id);

        // Get all product ids linked with this category
        $products = $category->products()->get();

        return view('admin.categories.products', compact('category', 'products'));
    }
}
