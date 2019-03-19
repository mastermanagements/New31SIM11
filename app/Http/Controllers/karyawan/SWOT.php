<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SWOT extends Controller
{
    //
    public function index()
    {
        return view('user.karyawan.section.swot.page_default');
    }

    public function create()
    {
        return view('user.karyawan.section.swot.page_create');
    }
}
