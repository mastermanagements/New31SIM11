<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fronendController extends Controller
{
    //

    public function index(){
        return view('page/index');
    }

    public function pelatihan(){
        return view('page/pelatihan');
    }

    public function event(){
        return view('page/event');
    }
}
