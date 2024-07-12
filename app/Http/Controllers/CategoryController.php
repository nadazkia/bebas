<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function category()
    {
        $categories = Brand::with('categories')->get();
        return view('admin.category', ['categories' => $categories]);
    }

    public function brands()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }


    public function index(Request $request)
    {
        $perPage = 5; // Set the number of items per page
        $query = Category::with('brands');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        if ($request->has('sortBy')) {
            $sortBy = $request->input('sortBy', 'id');
            $sortDirection = $request->input('sortDirection', 'desc');
            $query->orderBy($sortBy, $sortDirection);
        }

        $categories = $query->paginate($perPage);
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->only('name', 'description'));
        $category->brands()->sync($request->input('brands', []));
        return response()->json([$category, 'success' => 'Category has been successful updated']);
    }

    public function show($id)
    {
        $category = Category::with('brands')->findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required|unique|string|max:255',
        //     'description' => 'nullable|string|max:255',
        //     'categories' => 'nullable|array',
        //     'categories.*' => 'exists:categories,id',
        // ]);

        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'description'));
        $category->brands()->sync($request->input('brands', []));
        return response()->json([$category, 'success' => 'Category has been successful updated']);
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(['success' => 'Category has been successful deleted']);
    }


    public function getBrandsByCategory($id)
    {
        $category = Category::with('brands')->find($id);
        return response()->json($category);
    }

}