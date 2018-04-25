<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function Show()
    {
        return response()->download(storage_path('app/GraceHopper.pdf'),'Amazing Grace'); 
    }
}
