<?php

namespace App\Http\Controllers\Superadmin_ukm;

use Session;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_user_ukm as user_admin_ukm;
use App\Mail\superadminUkm_Mail as verification_superadmin_ukm;

class LoginAndRegisterController extends Controller
{
    //

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
        $kata_kunci = bcrypt($req->alamat_email);
        //call model
        $model = new user_admin_ukm();
        //adding value to field
        $model->nama = $nama;
        $model->email = $alamat_email;
        $model->password = bcrypt($kata_kunci);
        // if success save data then email will sending
        if($model->save())
        {
            Mail::send(new verification_superadmin_ukm($model));
            return redirect('registerApp')->with('message_success','Pesan konfirmasi anda telah dikirim, lakukan konfirmasi via email anda');
        }
        return redirect('registerApp')->with('message_fail','Anda belum berhasil mendaftar');
    }
}
