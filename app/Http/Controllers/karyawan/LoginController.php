<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;

class LoginController extends Controller
{
    //
//    private $id_karyawan;
//
//    public function __construct()
//    {
//        $this->middleware(function($req, $next){
//           if(empty(Session::get('id_karyawan')))
//           {
//               return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
//           }
//           $this->id_karyawan = Session::get('id_karyawan');
//           return $next($req);
//        });
//    }
//
    public function Login()
    {
        return view('user.karyawan.login');
    }

    public function cek_login(Request $req)
    {
        $this->validate($req, [
           'user_nm' => 'required',
           'pass' => 'required'
        ]);
        $user_nm = $req->user_nm;
        $password = $req->pass;

        $model_ky = karyawan::where('username', $user_nm)->first();
          //dd($model_ky);
        if(Hash::check($password, $model_ky->password)){
            $req->session()->put('id_karyawan', $model_ky->id);
            $req->session()->put('user_nm', $model_ky->username);
            $req->session()->put('id_perusahaan_karyawan', $model_ky->id_perusahaan);
            $req->session()->put('id_superadmin_karyawan', $model_ky->id_user_ukm);
            return redirect('welcome-page')->with('success_login','Selamat Datang '.$model_ky->nama_ky);
        }else{
            return redirect('login-karyawan')->with('fail_login','Nama karyawan atau password anda salah...!');
        }
        return redirect('login-karyawan')->with('fail_login','Anda Belum Terdaftar diperusahaan manapun...!');
    }

    public function logOut()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
