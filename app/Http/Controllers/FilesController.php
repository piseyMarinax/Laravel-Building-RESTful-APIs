<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{
    public function Show()
    {
        return response()->download(storage_path('app/GraceHopper.pdf'),'Amazing Grace'); 
    }

    public function create(Request $request)
    {
        $path = $request->file('photo')->store('testing');
        return response()->json(['path' => $path],200);
    }
}
