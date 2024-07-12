<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{

    public function brand()
    {
        $brands = Brand::with('categories')->get();
        return view('admin.dashboard', ['brands' => $brands]);
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function index(Request $request)
    {
        $perPage = 5; // Set the number of items per page
        $query = Brand::with('categories');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        if ($request->has('sortBy')) {
            $sortBy = $request->input('sortBy', 'id');
            $sortDirection = $request->input('sortDirection', 'asc');
            $query->orderBy($sortBy, $sortDirection);
        }

        $brands = $query->paginate($perPage);
        return response()->json($brands);
    }

    public function store(Request $request)
    {
        $brand = Brand::create($request->only('name', 'description'));
        $brand->categories()->sync($request->input('categories', []));
        return response()->json([$brand, 'success' => 'Brand has been successful added']);
    }

    public function show($id)
    {
        $brand = Brand::with('categories')->findOrFail($id);
        return response()->json($brand);
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string|max:255',
        //     'categories' => 'nullable|array',
        //     'categories.*' => 'exists:categories,id',
        // ]);

        $brand = Brand::findOrFail($id);
        $brand->update($request->only('name', 'description'));
        $brand->categories()->sync($request->input('categories', []));
        return response()->json([$brand, 'success' => 'Brand has been successful updated']);
    }

    public function destroy($id)
    {
        Brand::destroy($id);
        return response()->json(['success' => 'Brand has been successful deleted']);
    }

    public function getCategoriesByBrand($id)
    {
        $brand = Brand::with('categories')->find($id);
        return response()->json($brand);
    }
}