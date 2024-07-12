<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('categories')->get();
        return view('welcome', ['brands' => $brands]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $brands = Brand::where('name', 'LIKE', '%' . $request->keyword . '%')
                ->orderBy('name')
                ->with('categories')
                ->get();

            $output = "";
            if (count($brands) != null) {
                foreach ($brands as $brand) {
                    $output .=
                        '<a class="px-3 py-1 md:px-5 md:py-4 border-b m-0 text-sm md:text-lg lg:text-2xl w-full flex flex-col bg-white hover:bg-slate-200 duration-300 transition cursor-pointer"  data-id="' . route('show', $brand->id) . '" data-name="'
                        . $brand->name . '">'
                        . $brand->name .
                        '</a>';
                }
            } else {
                $output .=
                    '<p class="px-2 py-1 border-b border-b-black text-sm md:text-lg lg:text-xl bg-white"> No Result <p>';
            }
            return $output;
        }
    }

    public function searchByScan(Request $request)
    {
        $barcode = $request->input('barcode');
        $brand = Brand::where('barcode', $barcode)->with('categories')->get();
        return response()->json($brand);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand);
    }

    public function edit(Brand $brand)
    {
        //
    }

    public function update(Request $request, Brand $brand)
    {
        //
    }

    public function destroy(Brand $brand)
    {
        //
    }
}
