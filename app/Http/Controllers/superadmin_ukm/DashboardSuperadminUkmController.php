<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class DashboardSuperadminUkmController extends Controller
{
    //
    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            return $next($req);
        });
    }

    public function index()
    {
        return "Halaman pengaturan awal";
    }
}
