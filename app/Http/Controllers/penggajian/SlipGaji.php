<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as ky;
use App\Model\Penggajian\G_slip_gaji as gsg;

class SlipGaji extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;

    public function __construct()
    {
        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index($id)
    {
        $year =date('Y');
        $data =[
            'id_ky'=> $id,
           // 'date'=> ,
            'slip_gaji'=> gsg::all()->where('id_ky', $id)->where('id_perusahaan', $this->id_perusahaan)
                ->where('id_karyawan', $this->id_karyawan)
        ];
        return view('user.penggajian.section.daftar_gaji.slipGaji.list_check', $data);
    }

    public function create($id)
    {

        if(empty($model = gsg::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data =[
            'data_slip'=>$model
        ];
        return view('user.penggajian.section.daftar_gaji.slipGaji.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'periode'=> 'required',
            'id_ky'=> 'required',
        ]);
        $data_req=$req->except(['id','_token']);
        $data_req['periode'] = date('Y-m-d', strtotime($req->periode));
        $model = new gsg(array_merge($data_req, ['id_perusahaan'=> $this->id_perusahaan,'id_karyawan'=>$this->id_karyawan]));
        if($model->save()){
            return redirect('daftar-slip-gaji/'. $req->id_ky)->with('message_success','Anda telah membuat slip');
        }else{
            return redirect('daftar-slip-gaji/'. $req->id_ky)->with('message_fail','Maaf, slip tidak dapat dibuat');
        }
    }
}
