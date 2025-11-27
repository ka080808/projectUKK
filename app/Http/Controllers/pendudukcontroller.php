<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pendudukcontroller extends Controller
{
    //
    public function index()
    {
        return view('lihat data.penduduk');
    }
}
