<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\PersenKas as PK;
use App\Model\Investor\Nisbah as N;
use App\Model\Investor\BulanDevidenM as BDM;

class BesarNisbah extends Controller
{
    //
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

    public function store(Request $req){
        $this->validate($req,[
            "thn" => "required",
          "bln_dividen" => "required",
          "id_periode_invest" => "required",
          "laba_rugi" => "required"
        ]);

        $thn = $req->thn;
        $bln_dividen = $req->bln_dividen;
        $laba_rugi = $req->laba_rugi;
        $id_periode_invest = $req->id_periode_invest;
        if($laba_rugi < 0){
            $alokasi = 0;
        }else{
            $persenkas = PK::where('id_perusahaan', $this->id_perusahaan)->where('thn', $thn)->first();
            if(empty($persenkas)){
                $alokasi = 0;
            }else{
                $alokasi =($laba_rugi* $persenkas->persen_kas)/100;
            }
        }
        $netkas = $laba_rugi-$alokasi;
        $nisbah = N::where('id_periode_invest',$id_periode_invest)->where('id_perusahaan', $this->id_perusahaan)->first();
        $nisbah_pelaksana = ($nisbah->pelaksana*$netkas)/100;
        $nisbah_pemodal = ($nisbah->pemodal*$netkas)/100;

        $model = BDM::updateOrCreate(
            ['id_periode_invest'=> $id_periode_invest, 'thn_dividen'=>$thn, 'bln_dividen'=>$bln_dividen,'id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan],
            ['laba_rugi'=> $laba_rugi, 'alokasi_kas'=>$alokasi,'net_kas'=>$netkas,'nisbah_pelaksana'=> $nisbah_pelaksana,'nisbah_pemodal'=> $nisbah_pemodal]
        );

        if($model->save()){
            return redirect('Nisbah')->with('message_success','Anda telah menambahkan Besar nisbah');
        }else{
            return redirect('Nisbah')->with('message_fail','Maaf, besar nisbah tidak dapat disimpan');
        }

    }
}
