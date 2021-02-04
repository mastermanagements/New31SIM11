<?php

namespace App\Http\Controllers\Superadmin_ukm;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_user_ukm as user_admin_ukm;
use App\Mail\superadminUkm_Mail as verification_superadmin_ukm;

class LoginAndRegisterController extends Controller
{
    //
    public function login(Request $req)
    {
        $alamat_email = $req->alamat_email;
        $password = $req->kata_kunci;
        $model = user_admin_ukm::where('email', $alamat_email)->first();
       if($model->status_verifikasi==0){
            return redirect('login-page')->with('message_fail','Maaf, Anda harus belum melakukan verifikasi ulang');
       }else{
           if(Hash::check($password, $model->password))
            {
               $req->session()->put('id_superadmin_ukm', $model->id);
               return redirect('dashboard')->with('message_success','Selamat datang '. $model->nama.' !!');
            }else{
               return redirect('/')->with('message_fail','email atau password anda salah...!');
           }
       }
    }

    public function registered(Request $req)
    {
        $this->validate($req,[
            'nama' => 'required',
            'alamat_email' => 'required',
            'kata_kunci' => 'required|min:5',
            'agree_term'=>'required'
        ]);
        //inisialisasi variable
        $nama = $req->nama;
        $alamat_email = $req->alamat_email;
        $kata_kunci = $req->kata_kunci;
        //call model
        $model = new user_admin_ukm();
        //adding value to field
        $model->nama = $nama;
        $model->email = $alamat_email;
        $model->password = bcrypt($kata_kunci);
        $model->status_verifikasi = '0';
        // if success save data then email will sending
        if($model->save())
        {
            Mail::send(new verification_superadmin_ukm($model));
            return redirect('registerApp')->with('message_success','Pesan konfirmasi anda telah dikirim, lakukan konfirmasi via email anda');
        }
        return redirect('registerApp')->with('message_fail','Anda belum berhasil mendaftar');
    }

    public function verification_($id)
    {
        $id_superadmin_ukm = $id;
        $model = user_admin_ukm::findOrFail($id_superadmin_ukm);
        $model->status_verifikasi = '1';
        if($model->save())
        {
            return redirect('login-page')->with('message_success','Anda telah berhasil melakukan verifikasi akun, login untuk masuk kedalam aplikasi');
        }
        return redirect('login-page')->with('message_fail','Maaf, telah terjadi kesalahan');
    }

    public function signOut()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }


}