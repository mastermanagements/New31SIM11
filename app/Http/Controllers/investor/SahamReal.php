<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Model\Investor\SahamReal as SR;
use App\Model\Investor\PeriodeInvestasi as PI;

class SahamReal extends Controller
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
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
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
        Session::put('menu-saham','saham-real');
        $data = [
            'data'=>SR::all()->where('id_perusahaan', $this->id_perusahaan),
            'periode_inves'=>PI::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.investor.section.saham.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            "id_periode_saham" => "required",
            "jum_saham" => "required"
        ]);

        $data_req = $req->except(['id','_token']);
        $data_periode_lalu = SR::all()->where('id_perusahaan', $this->id_perusahaan)->whereNotIn('id_periode_saham', $req->id_periode_saham)->last();
        $model = new SR();
        $model->id_periode_saham = $req->id_periode_saham;
        $model->jum_saham = $data_periode_lalu->jum_saham+$req->jum_saham;
        $model->satuan = "lembar";
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Saham-real')->with('message_success','Anda telah menambahkan data saham real');
        }else{
            return redirect('Saham-real')->with('message_fail','Maaf, Saham real tidak dapat disimpan');
        }

    }

    public function edit($id)
    {
        if(empty($model =  SR::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return $model;
    }

    public function update(Request $req){
        $this->validate($req,[
            "id_periode_saham" => "required",
            "jum_saham" => "required",
            "id" => "required",
        ]);

        $data_req = $req->except('_token');
        $data_periode_lalu = SR::all()->where('id_perusahaan', $this->id_perusahaan)->whereNotIn('id_periode_saham', $req->id_periode_saham)->last();
        $model = SR::find($req->id);
        $model->id_periode_saham = $req->id_periode_saham;
        $model->jum_saham = $data_periode_lalu->jum_saham+$req->jum_saham;
        $model->satuan = "lembar";
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Saham-real')->with('message_success','Anda telah mengubah data saham real');
        }else{
            return redirect('Saham-real')->with('message_fail','Maaf, Saham real tidak dapat diubah');
        }

    }

    public function updateStatus(Request $req, $id){
        $data = SR::find($id);
        $data->status = "aktif";
        if($data->save()){
            $updateYgLainJadiNonAktif = SR::where('id','!=',$data->id)->update(['status'=>'non aktif']);
            return redirect('Saham-real')->with('message_success','Status Aktif Baru Saja diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = SR::find($id);
        if($model->delete()){
            return redirect('Saham-real')->with('message_success','Anda telah menghapus data saham real');
        }else{
            return redirect('Saham-real')->with('message_fail','Maaf, Saham real tidak dapat dihapus');
        }
    }


}
