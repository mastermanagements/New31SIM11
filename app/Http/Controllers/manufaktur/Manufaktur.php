<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Manufaktur extends Controller
{
    //
    public function index()
    {
        return view('user.manufaktur.default');
    }
}
