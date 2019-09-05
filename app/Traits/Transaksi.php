<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 05/09/2019
 * Time: 10:06
 */

namespace App\Traits;
use App\Model\Keuangan\Transaksi as transaksis;
use App\Model\Keuangan\AkunAktifUkm as Akun_aktif;
use App\Model\Keuangan\KetTransaksi as KetTransaksi;
use Illuminate\Http\Request;
use Session;

trait Transaksi
{

    public function getData($array)
    {
        $model =KetTransaksi::all()->where('id_perusahaan', $array['id_perusahaan']);
        $row = array();
        foreach ($model as $value){
            $colum = array();
            $colum[]= $value->nm_transaksi;
            $colum[]= $value->id;
            $row[] = $colum;
        }

        return $row;
    }

    public function get_akun_akfif($array){
        $data = Akun_aktif::all()->where('id_perusahaan', $array['id_perusahaan']);
        return $data;
    }

    public function posisi(){
        $array = array(
          '0'=>"Debit",
          '1'=>"Kredit",
        );
        return $array;
    }

    public function InsertData($req, $jenis_transaksi, $array){
        $this->validate($req,[
            'id_akun_aktif'=> 'required',
            'posisi'=> 'required',
            'nm_transaksi'=> 'required',
        ]);
        $model_ket_transaksi = new KetTransaksi();
        $model_ket_transaksi->nm_transaksi = $req->nm_transaksi;
        $model_ket_transaksi->id_perusahaan = $array['id_perusahaan'];
        $model_ket_transaksi->id_karyawan = $array['id_karyawan'];
        if($model_ket_transaksi->save())
        {
            foreach ($req->id_akun_aktif as $key=> $value){
                $model = new transaksis();
                $model->id_ket_transaksi = $model_ket_transaksi->id;
                $model->jenis_transaksi = $jenis_transaksi;
                $model->id_akun_aktif = $value;
                $model->posisi_akun = ''.$req->posisi[$key];
                $model->id_perusahaan = $array['id_perusahaan'];
                $model->id_karyawan = $array['id_karyawan'];
                $model->save();
            }
        }

        $data = [
            'message'=> 'Permintaan telah diproses',
        ];

        return $data;
    }

}