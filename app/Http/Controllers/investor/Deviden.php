<?php

namespace App\Http\Controllers\Investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\DevidePerbulan as DP;
use App\Model\Investor\PersenKas as PK;

class Deviden extends Controller
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
        Session::put('menu-dividen','perbulan');
        $data = [
            'data'=>DP::all()->where('id_perusahaan', $this->id_perusahaan)->sortBy('thn_dividen')
        ];
        return view('user.investor.section.dividen.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            "thn" => "required",
            "bln_dividen" => "required",
            "laba_rugi" => "required"
        ]);
        $model = new DP();
        $model->thn_dividen = $req->thn;
        $model->bln_dividen = date('Y-m-d', strtotime($req->bln_dividen));
        $model->laba_rugi = $req->laba_rugi;


        $model_pk = PK::where('thn', $req->thn)->where('id_perusahaan',$this->id_perusahaan)->first();
        $alokasi_kas =$model_pk->persen_kas*$req->laba_rugi/100;
        if($alokasi_kas < 0){
            $alokasi_kas=0;
        }
        $model->alokasi_kas =$alokasi_kas;
        $model->net_kas =$req->laba_rugi-$alokasi_kas ;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Dividen')->with('message_success','Anda telah menambahkan dividen per bulan');
        }else{
            return redirect('Dividen')->with('message_fail','Maaf, dividen perbulan tidak dapat disimpan');
        }

    }

    public function edit($id){
        if(empty($model = DP::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            "id" => "required",
            "thn" => "required",
            "bln_dividen" => "required",
            "laba_rugi" => "required"
        ]);
        $model = DP::find($req->id);
        $model->thn_dividen = $req->thn;
        $model->bln_dividen = date('Y-m-d', strtotime($req->bln_dividen));
        $model->laba_rugi = $req->laba_rugi;


        $model_pk = PK::where('thn', $req->thn)->where('id_perusahaan',$this->id_perusahaan)->first();
        $alokasi_kas =$model_pk->persen_kas*$req->laba_rugi/100;
        if($alokasi_kas < 0){
            $alokasi_kas=0;
        }
        $model->alokasi_kas =$alokasi_kas;
        $model->net_kas =$req->laba_rugi-$alokasi_kas ;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Dividen')->with('message_success','Anda telah menambahkan dividen per bulan');
        }else{
            return redirect('Dividen')->with('message_fail','Maaf, dividen perbulan tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = DP::find($id);
        if($model->delete()){
            return redirect('Dividen')->with('message_success','Anda telah menghapus dividen per bulan');
        }else{
            return redirect('Dividen')->with('message_fail','Maaf, dividen perbulan tidak dapat dihapus');
        }
    }
}
