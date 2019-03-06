<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use App\Model\Superadmin_ukm\U_ijin_usaha as ijin_p;
use Session;
class Ijin_usaha extends Controller
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
        $data = [
            'usaha'=> usaha::all()->where('id_user_ukm', $this->id_superadmin)
        ];
        return view('user/superadmin_ukm/master/section/isin_usaha_perusahaan/isin_create_page', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'id_perusahaan'=>'required',
            'nm_ijin' => 'required',
            'no_ijin' => 'required',
            'berlaku' => 'required',
            'kualifikasi' => 'required',
            'instansi_pemberi' => 'required',
            'klasifikasi' => 'required',
            'file_iu' => 'required|image|mimes:jpg,png,gif'
        ]);

        $id_perusahaan = $req->id_perusahaan;
        $nm_ijin= $req->nm_ijin;
        $no_ijin= $req->no_ijin;
        $berlaku= date('Y-m-d', strtotime($req->berlaku));
        $kualifikasi= $req->kualifikasi;
        $instansi_pemberi= $req->instansi_pemberi;
        $klasifikasi= $req->klasifikasi;
        $file_iu= $req->file_iu;
        $no_rak= $req->no_rak;

        $name_file =  time().'.'.$file_iu->getClientOriginalExtension();
        $model = new ijin_p;
        $model->nm_ijin = $nm_ijin;
        $model->no_ijin = $no_ijin;
        $model->berlaku = $berlaku;
        $model->kualifikasi = $kualifikasi;
        $model->instansi_pemberi = $instansi_pemberi;
        $model->klasifikasi = $klasifikasi;
        $model->file_iu = $name_file;
        $model->no_rak = $no_rak;
        $model->id_perusahaan = $id_perusahaan;
        $model->id_user_ukm = $this->id_superadmin;

        if($model->save())
        {
            if ($file_iu->move(public_path('ijinUsaha'), $name_file)) {
                return redirect('izin-usaha')->with('message_success','Berhasil menyimpan akta');
            }else{
                return redirect('unggah-ijin')->with('message_error','Gagal menyimpan akta file akta');
            }
            return redirect('izin-usaha')->with('message_success','Berhasil mengubah Data Usaha');
        }

        return redirect('unggah-ijin')->with('message_error','Terjadi kesalangan, isi dengan benar');
    }

    public function edit($id)
    {
        $data = [
            'usaha'=> usaha::all()->where('id_user_ukm', $this->id_superadmin),
            'ijin'=> ijin_p::find($id)
        ];
        return view('user/superadmin_ukm/master/section/isin_usaha_perusahaan/isin_edit_page', $data);
    }
}
