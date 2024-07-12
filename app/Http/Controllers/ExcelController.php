<?php

namespace App\Http\Controllers;

use App\Imports\BrandsImport;
use App\Imports\UsersImport;
use App\Models\Brand;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        // $this->validate($request, [
        //     'file' => 'required|mimes:csv,xls,xlsx'
        // ]);

        $file = $request->file;

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();
        // $nama_file = $file->hashName();

        $file->move('excel', $nama_file);

        //temporary file
        // $path = $file->path('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new BrandsImport, public_path('/excel/' . $nama_file));

        //remove from server
        // Storage::delete($path);

        if ($import) {
            return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('dashboard')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

}