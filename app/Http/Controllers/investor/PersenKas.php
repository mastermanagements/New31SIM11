<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\PersenKas as PK;

class PersenKas extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    private  $id_con;

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
            $this->id_con=[
                'id_perusahaan'=> $this->id_perusahaan,
                'id_karyawan' => $this->id_karyawan
            ];
            return $next($req);
        });
    }


    public function index(){
        $data =[
            'data'=>PK::all()->where('id_perusahaan', $this->id_perusahaan)->sortBy('thn')
        ];
        return view('user.investor.section.persenkas.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            "thn" => "required",
            "persen_kas" => "required"
        ]);
        $dataReq= $req->except(['id','_token']);
        $model = new PK(
            array_merge($dataReq, $this->id_con)
        );
        if($model->save()){
            return redirect('Persen-kas')->with('message_success','Anda telah menambahkan Persen Kas Baru');
        }else{
            return redirect('Persen-kas')->with('message_fail','Maaf, Persen Kas tidak dapat disimpan');
        }

    }

    public function edit($id){
        if(empty($model = PK::where('id', $id)->where('id_perusahaan',$this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            "thn" => "required",
            "persen_kas" => "required",
            "id" => "required"
        ]);
        $dataReq= $req->except('_token');
        $model = PK::find($req->id)->update(
            array_merge($dataReq, $this->id_con)
        );
        if($model){
            return redirect('Persen-kas')->with('message_success','Anda telah mengubah Persen Kas ');
        }else{
            return redirect('Persen-kas')->with('message_fail','Maaf, Persen Kas tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = PK::find($id);
        if($model->delete()){
            return redirect('Persen-kas')->with('message_success','Anda telah menghapus Persen Kas');
        }else{
            return redirect('Persen-kas')->with('message_fail','Maaf, Persen Kas tidak dapat dihapus');
        }
    }
}
