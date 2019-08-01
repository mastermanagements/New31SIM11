<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\PeriodeInvestasi as PI;
use App\Model\Investor\SahamPerdana as SP;
use App\Model\Investor\SahamReal as SR;

class SahamPerdana extends Controller
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

    public function index()
    {
        Session::put('menu-saham','saham-perdana');
        $data = [
            'periode_inves'=>PI::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=>SP::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.saham.page_default', $data);
    }

    public function store(Request $req){
       $this->validate($req,[
            'id_periode_invest'=> 'required',
            'lembar_saham_perdana'=> 'required',
            'nilai_saham'=> 'required',
        ]);

        $dataReq=$req->except(['id','_token']);
        $model = new SP(
            array_merge($dataReq, $this->id_con)
        );

        if($model->save()){
            $model_SR = new SR(
                ['id_periode_saham'=> $model->id_periode_invest,'jum_saham'=>$model->lembar_saham_perdana,'satuan'=>'lembar'
                    ,'id_perusahaan'=> $this->id_perusahaan, 'id_karyawan'=> $this->id_karyawan]
            );
            $model_SR->save();
            return redirect('Saham')->with('message_success','Anda telah menambahkan Saham Perdana');
        }else{
            return redirect('Saham')->with('message_fail','Maaf, Saham Perdana tidak dapat disimpan');
        }
    }

    public function edit($id)
    {
        if(empty($model = SP::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
       $this->validate($req,[
            'id_periode_invest'=> 'required',
            'lembar_saham_perdana'=> 'required',
            'nilai_saham'=> 'required',
            'id'=> 'required',
        ]);

        $dataReq=$req->except(['id','_token']);
        $model = SP::find($req->id);
        $model->id_periode_invest =$req->id_periode_invest;
        $model->lembar_saham_perdana =$req->lembar_saham_perdana;
        $model->nilai_saham =$req->nilai_saham;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save()){
            $model_SR = SR::where('id_periode_saham', $model->id_periode_invest)->first();
            $model_SR->id_periode_saham = $model->id_periode_invest;
            $model_SR->jum_saham = $model->lembar_saham_perdana;
            $model_SR->save();
            return redirect('Saham')->with('message_success','Anda telah mengubah Saham Perdana');
        }else{
            return redirect('Saham')->with('message_fail','Maaf, Saham Perdana tidak dapat diubah');
        }
    }
}
