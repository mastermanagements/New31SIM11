<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 09/08/2019
 * Time: 9:47
 */

namespace App\Traits;
use App\Model\Investor\DaftarInvestasi as DI;
use App\Model\Investor\PeriodeInvestasi as PI;

trait ProsesDaftarInvestasi
{

    public function hitungInvestasi($req)
    {
        $cek_data_investor_sdh_ada = DI::where('id_investor', $req->id_investor)->orderBy('id','asc')->first();
        $model_periode =  PI::find($req->id_periode_invest)->nilai_valuasi /PI::find($req->id_periode_invest)->saham_real->jum_saham;
        if(!empty($cek_data_investor_sdh_ada)){
            $ls = PI::find($cek_data_investor_sdh_ada->id_periode_invest);
            $nilai_perlembar = $ls->nilai_valuasi/$ls->saham_real->jum_saham;
            $jumlah_investasi = $nilai_perlembar*$req->jumlah_saham;
        }else{
            $jumlah_investasi = $model_periode * $req->jumlah_saham;
        }
        $persentase = $req->jumlah_saham/PI::find($req->id_periode_invest)->saham_real->jum_saham * 100;
        $result = [
            'jumlah_investasi'=>$jumlah_investasi,
            'persentasi'=>$persentase,
        ];
        return $result;
    }


    public function  storeInvestasi($req, $id_con){
        $hitung_investasi = $this->hitungInvestasi($req);
        $model = DI::updateOrCreate(
            ['id_periode_invest'=>$req->id_periode_invest,'id_investor'=>$req->id_investor,'id_perusahaan'=>$id_con['id_perusahaan'],'id_karyawan'=>$id_con['id_karyawan']],
            [
                'tgl_invest'=>date('Y-m-d', strtotime($req->tgl_invest)),
                'id_bentuk_invest'=>$req->id_bentuk_invest,
                'jumlah_saham'=>$req->jumlah_saham,
                'jumlah_investasi'=>$hitung_investasi['jumlah_investasi'],
                'persentase'=>$hitung_investasi['persentasi'],
                'ket'=>$req->ket
            ]
        );
        return $model->save();
    }

    public function update($req,$id_con){
        $hitung_investasi=$this->hitungInvestasi($req);
        $model = DI::find($req->id);
        $model->tgl_invest = date('Y-m-d', strtotime($req->tgl_invest));
        $model->id_periode_invest = $req->id_periode_invest;
        $model->id_investor = $req->id_investor;
        $model->id_bentuk_invest = $req->id_bentuk_invest;

        $model->jumlah_saham = $req->jumlah_saham;
        $model->jumlah_investasi =$hitung_investasi['jumlah_investasi'];
        $model->persentase =$hitung_investasi['persentasi'];
        $model->ket = $req->ket;
        $model->id_perusahaan = $id_con['id_perusahaan'];
        $model->id_karyawan = $id_con['id_karyawan'];
        return $model->save();
    }

    public function delete($array){
        $model = DI::where('id_investor',$array['id_investor'])->where('id_periode_invest',$array['id_periode_invest'])->where('id_perusahaan', $array['id_perusahaan'])->first();
        return $model;
    }

    public function show_data($array){
        $model = DI::where('id_investor',$array['id_investor'])->where('id_periode_invest',$array['id_periode_invest'])->where('id_perusahaan', $array['id_perusahaan'])->first();
        return $model;
    }
}