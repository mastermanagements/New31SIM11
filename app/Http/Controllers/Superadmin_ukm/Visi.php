<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use App\Model\Superadmin_ukm\A_visi_p as visi_p;
use Session;
class Visi extends Controller
{
    //
    private $id_superadmin;

    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('/')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
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
          return view('user/superadmin_ukm/master/section/visi_perusahaan/visi_create_page', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'id_perusahaan'=>'required',
            'visi'=>'required'
        ]);

        $id_perusahaan= $req->id_perusahaan;
        $visi = $req->visi;
        $id_user_ukm = $this->id_superadmin;

        $model =visi_p::updateOrCreate(['id_perusahaan'=>$id_perusahaan,'id_user_ukm'=>$id_user_ukm],['visi'=>$visi]);
        if($model->save())
        {
            return redirect('visi')->with('message_sucess', 'Visi berhasil dibuat');
        }
    }
}
