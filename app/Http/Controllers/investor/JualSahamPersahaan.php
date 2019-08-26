<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\PeriodeInvestasi as PI;
use App\Model\Investor\JualSahamPerusahaan as JSM;
use App\Model\Investor\SahamReal as SR;

class JualSahamPersahaan extends Controller
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
        Session::put('menu-jual-saham','saham-perusahaan');
        $data = [
            'periode_inves'=> PI::all()->where('id_perusahaan'),
            'data'=> JSM::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.JualSaham.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            "id_periode_invest" => "required",
            "jumlah_persen_saham" => "required"
        ]);
        $data_periode_lalu = SR::all()->where('id_perusahaan', $this->id_perusahaan)->whereNotIn('id_periode_saham', $req->id_periode_invest)->last();

        if(empty($data_periode_lalu)){
            $jumlah_persanSaham = 0;
        }else{
            $jumlah_persanSaham = $data_periode_lalu->jum_saham/100*$req->jumlah_persen_saham;
        }

        $data_req = $req->except(['id', '_token']);
        $model = JSM::updateOrCreate(
            ['id_periode_invest'=>$data_req['id_periode_invest'], 'id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan],
            ['jumlah_persen_saham'=>$data_req['jumlah_persen_saham'],'jumlah_saham_terbit'=>$jumlah_persanSaham]
        );
        if($model->save()){
           $modelSr = SR::updateOrCreate(
                ['id_periode_saham'=>$req->id_periode_invest, 'id_perusahaan'=>$this->id_perusahaan, 'id_karyawan'=>$this->id_karyawan],
                ['jum_saham'=>$data_periode_lalu->jum_saham+$jumlah_persanSaham, 'satuan'=>'lembar']
            );
            $modelSr->save();
            return redirect('Jual-Saham')->with('message_success','Anda telah menambahkan daftar persentasi saham yang akan dijual');
        }else{
            return redirect('Jual-Saham')->with('message_fail','Maaf, persentase saham yang akan dijual tidak dapat disimpan');
        }
    }

    public function edit($id){
        if(empty($model = JSM::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return $model;
    }

    public function update(Request $req){
        $this->validate($req,[
            "id_periode_invest" => "required",
            "id" => "required",
            "jumlah_persen_saham" => "required"
        ]);

        $data_req = $req->except(['id', '_token']);
        $model = JSM::find($req->id);
        $model->id_periode_invest =  $req->id_periode_invest;
        $model->jumlah_persen_saham =  $req->jumlah_persen_saham;

        $data_periode_lalu = SR::all()->where('id_perusahaan', $this->id_perusahaan)->whereNotIn('id_periode_saham', $req->id_periode_invest)->last();

        if(empty($data_periode_lalu)){
            $jumlah_persanSaham = 0;
        }else{
            $jumlah_persanSaham = $data_periode_lalu->jum_saham/100*$req->jumlah_persen_saham;
        }


        if($model->save()){
            $modelSr = SR::updateOrCreate(
                ['id_periode_saham'=>$req->id_periode_invest, 'id_perusahaan'=>$this->id_perusahaan, 'id_karyawan'=>$this->id_karyawan],
                ['jum_saham'=>$data_periode_lalu->jum_saham+$jumlah_persanSaham, 'satuan'=>'lembar']
            );
            $modelSr->save();
            return redirect('Jual-Saham')->with('message_success','Anda telah mengubah daftar persentasi saham yang akan dijual');
        }else{
            return redirect('Jual-Saham')->with('message_fail','Maaf, persentase saham yang akan dijual tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = JSM::find($id);
        if($model->delete()){
            return redirect('Jual-Saham')->with('message_success','Anda telah menghapus daftar persentasi saham yang akan dijual');
        }else{
            return redirect('Jual-Saham')->with('message_fail','Maaf, persentase saham yang akan dijual tidak dapat dihapus');
        }
    }
}
