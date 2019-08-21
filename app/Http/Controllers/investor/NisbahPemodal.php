<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DateYears;
use Session;
use App\Model\Investor\BulanDevidenM as BDM;
use App\Model\Investor\Pemodal as p;
use App\Model\Investor\DividenPemodal as DP;

class NisbahPemodal extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    private  $id_con;
    use DateYears;


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

    public function index()
    {
        Session::put('menu-nisbah','nisbah_pemodal');
        $data = [
            'ymd'=>$this->costumDate(),
            'BDM'=> BDM::all()->where('id_perusahaan', $this->id_perusahaan)->groupBy('thn_dividen'),
            'pemodal' =>p::all()->where('id_perusahaan', $this->id_perusahaan),
            'data' => DP::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
         return view('user.investor.section.nisbah.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            "id_pemodal" => "required",
            "id_bulan_dividen" => "required"
        ]);

        $model = new DP();
        $model->id_pemodal = $req->id_pemodal;
        $model->id_bulan_dividen = $req->id_bulan_dividen;

        $model_pemodal = p::find($req->id_pemodal);
        $models_bulan_dividen_m = BDM::find($req->id_bulan_dividen);
        $model->besar_dividen = $model_pemodal->persen_saham*$models_bulan_dividen_m->net_kas;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Nisbah-pemodal')->with('message_success','Anda telah menambahkan Nisbah Pemodal');
        }else{
            return redirect('Nisbah-pemodal')->with('message_fail','Maaf,gagal menambahkan Nisbah Pemodal');
        }
    }

    public function edit($id){
        if(empty($model = DP::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            "id_pemodal" => "required",
            "id_bulan_dividen" => "required",
            "id" => "required"
        ]);

        $model = DP::find($req->id);
        $model->id_pemodal = $req->id_pemodal;
        $model->id_bulan_dividen = $req->id_bulan_dividen;

        $model_pemodal = p::find($req->id_pemodal);
        $models_bulan_dividen_m = BDM::find($req->id_bulan_dividen);
        $model->besar_dividen = $model_pemodal->persen_saham*$models_bulan_dividen_m->net_kas;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Nisbah-pemodal')->with('message_success','Anda telah mengubah Nisbah Pemodal');
        }else{
            return redirect('Nisbah-pemodal')->with('message_fail','Maaf,gagal mengubah Nisbah Pemodal');
        }
    }

    public function delete(Request $req, $id){
        $model = DP::find($id);
        if($model->delete()){
            return redirect('Nisbah-pemodal')->with('message_success','Anda telah menghapus Nisbah Pemodal');
        }else{
            return redirect('Nisbah-pemodal')->with('message_fail','Maaf,gagal menghapus Nisbah Pemodal');
        }
    }

}
