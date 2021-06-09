<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class Dashboard extends Controller
{
    private $id_karyawan;
    private $id_superadmin_karyawan;

    public function __construct()
    {
        $this->middleware(function($req, $next){
           if(empty(Session::get('id_karyawan')))
           {
               return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
           }
           $this->id_karyawan = Session::get('id_karyawan');
           $this->id_superadmin_karyawan = Session::get('id_superadmin_karyawan');
           return $next($req);
        });
    }

   public function index()
   {
        return view('user.karyawan.section.default.page_default');
   }


}
