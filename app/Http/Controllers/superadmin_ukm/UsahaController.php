<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use App\Model\Superadmin_ukm\U_usaha as perusahaan;

class UsahaController extends Controller
{
    //

    private $id_superadmin;

    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            return $next($req);
        });
    }

    public function create()
    {
        $data_pass = [
            'provinsi'=>provinsi::all(),
        ];
        return view('user.superadmin_ukm.master.section.profil_perusahaan.create_page',$data_pass);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'nm_usaha'=>'required',
            'alamat'=>'required',
            'id_provinsi'=>'required',
            'id_kabupaten' => 'required',
            'kd_pos'=> 'required',
            'jenis_usaha'=>'required',
            'logo'=>'required|image|mimes:jpeg,png,gif,jpg|max:2048',
        ]);

        $nama_usaha = $req->nm_usaha;
        $alamat = $req->alamat;
        $id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $kd_pos = $req->kd_pos;
        $telp= $req->telp;
        $hp= $req->hp;
        $wa= $req->wa;
        $teleg= $req->teleg;
        $jenis_usaha= $req->jenis_usaha;
        $email= $req->email;
        $web= $req->web;
        $logo= $req->logo;

        $image_name = time().'.'.$logo->getClientOriginalExtension();

        $model = new perusahaan;
        $model->nm_usaha =  $nama_usaha;
        $model->alamat =  $alamat;
        $model->id_prov =  $id_provinsi;
        $model->id_prov =  $id_provinsi;
        $model->id_kab =  $id_kabupaten;
        $model->kode_pos =  $kd_pos;
        $model->telp =  $telp;
        $model->hp =  $hp;
        $model->wa =  $wa;
        $model->teleg =  $teleg;
        $model->jenis_usaha =  $jenis_usaha;
        $model->email =  $email;
        $model->web =  $web;
        $model->id_user_ukm =  $this->id_superadmin;

        if($model->save())
        {
            if ($logo->move(public_path('logoUsaha'), $image_name)) {
                return redirect('profil-perusahaan')->with('message_success','Berhasil menambahkan Data Usaha');
            }else{
                return redirect('profil-perusahaan')->with('message_error','Gagal menambahkan Data Usaha');
            }
        }
        return redirect('tambah-usaha')->with('message_error','Terjadi kesalahan, isi dengan benar');
    }

    public function edit($id)
    {
       if(empty($data_usaha = perusahaan::where('id', $id)->where('id_user_ukm', $this->id_superadmin)->first() ))
       {
            return abort(404);
       }
        $data_pass = [
            'provinsi'=>provinsi::all(),
            'usaha'=>$data_usaha
        ];
        return view('user.superadmin_ukm.master.section.profil_perusahaan.edit_page',$data_pass);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'nm_usaha'=>'required',
            'alamat'=>'required',
            'id_provinsi'=>'required',
            'id_kabupaten' => 'required',
            'kd_pos'=> 'required',
            'jenis_usaha'=>'required',
            'logo'=>'required|image|mimes:jpeg,png,gif,jpg|max:2048',
        ]);

        $nama_usaha = $req->nm_usaha;
        $alamat = $req->alamat;
        $id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $kd_pos = $req->kd_pos;
        $telp= $req->telp;
        $hp= $req->hp;
        $wa= $req->wa;
        $teleg= $req->teleg;
        $jenis_usaha= $req->jenis_usaha;
        $email= $req->email;
        $web= $req->web;
        $logo= $req->logo;

        if(!empty($logo)){
            $image_name = time().'.'.$logo->getClientOriginalExtension();
        }else{
            $image_name = $req->logo_lama;
        }

        $model = perusahaan::find($id);
        $model->nm_usaha =  $nama_usaha;
        $model->alamat =  $alamat;
        $model->id_prov =  $id_provinsi;
        $model->id_prov =  $id_provinsi;
        $model->id_kab =  $id_kabupaten;
        $model->kode_pos =  $kd_pos;
        $model->telp =  $telp;
        $model->hp =  $hp;
        $model->wa =  $wa;
        $model->teleg =  $teleg;
        $model->jenis_usaha =  $jenis_usaha;
        $model->email =  $email;
        $model->web =  $web;
        $model->logo = $image_name;
        $model->id_user_ukm =  $this->id_superadmin;

        if($model->save())
        {
            if ($logo->move(public_path('logoUsaha'), $image_name)) {
                return redirect('profil-perusahaan')->with('message_success','Berhasil mengubah Data Usaha');
            }else{
                return redirect('profil-perusahaan')->with('message_error','Gagal mengubah Data Usaha');
            }
            return redirect('profil-perusahaan')->with('message_success','Berhasil mengubah Data Usaha');
        }
        return redirect('ubah-usaha/'.$id)->with('message_error','Terjadi kesalahan, isi dengan benar');
    }

    public function delete(Request $req, $id)
    {
        $model = perusahaan::find($id);
        $file_path =public_path('logoUsaha').'/' . $model->logo;
        if (file_exists($file_path)) {
            @unlink($file_path);
        }

        if($model->delete())
        {
            return redirect('profil-perusahaan')->with('message_success','Berhasil menghapus Data Usaha');
        }
        return redirect('profil-perusahaan')->with('message_error','Terjadi kesalahan');
    }
}
