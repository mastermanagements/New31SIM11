<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Keuangan\Jurnal;
use App\Model\Keuangan\AkunAktifUkm;
use App\Model\Keuangan\KetTransaksi;
use Session;


class TutupBuku extends Controller
{
    //
    public function store(Request $req){
        $no_transaksi=1;
        foreach ($req->id_aktif_ukm as $key=>$data){
            $id_akun_aktif = $data;
            $tgl_jurnal = $req->tgl_jurnal[$key];
            $debet_kredit= $req->debet_kredit[$key];
            $saldo_dk= $req->saldo_dk[$key];
            $explode_tgl = explode('-',$tgl_jurnal);
            $tgl_thn_depan = date('Y-m-d',  strtotime(date("Y-m-d", strtotime($explode_tgl[0].'-01-01')) . " + 1 year"));
            $model_akun_aktif = AkunAktifUkm::find($id_akun_aktif);
            $model=KetTransaksi::updateOrCreate(
                [
                    'nm_transaksi'=>'Saldo Awal Dari Periode '.$explode_tgl[0],
                    'jenis_transaksi'=> '0',
                    'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                    'id_karyawan'=> Session::get('id_karyawan'),
                ]
            );
            if($model){
                $model_jurnal = Jurnal::updateOrCreate(
                  [
                      'jenis_jurnal'=>'0',
                      'tgl_jurnal'=>$tgl_thn_depan,
                      'id_ket_transaksi'=>$model->id,
                      'id_akun_aktif'=>$id_akun_aktif,
                      'no_transaksi'=>$no_transaksi++,
                      'no_transaksi'=>'SA-RKP-'.$explode_tgl[0],
                      'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                      'id_karyawan'=> Session::get('id_karyawan'),
                      'debet_kredit'=>$debet_kredit,
                      'jumlah_transaksi'=>$saldo_dk
                  ],
                  [
                      'ket'=>'',
                  ]
                );
            }

        }
        return redirect('neraca');
    }
}
