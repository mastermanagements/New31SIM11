<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 14/07/2021
 * Time: 16:45
 */

namespace App\Http\utils\data_penjualan;
use App\Model\Produksi\PSO;
use Session;

class PesananPenjualan
{
    public function data($req){
        $container = array();
        $no="";
        $model = PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));

        if(!empty($req->tgl_awal) && !empty($req->tgl_akhir) ){
            $model->whereBetween('tgl_so',[$req->tgl_awal,$req->tgl_akhir]);
        }

        if(!empty($req->id_klien)){
            $model->where('id_klien',$req->id_klien);
        }

        foreach ($model->get() as $data){
           $column =array();
           $column['no'] = $no++;
           $column['tgl_transaksi'] = date('d-m-Y', strtotime($data->tgl_so));
           $column['no_transaksi'] = $data->no_so;
           $column['customer'] = $data->linkToKlien->nm_klien;
           $column['total'] = number_format($data->total,2,',','.');
           $column['diskon'] = number_format($data->diskon_tambahan,2,',','.');
           $column['ppn'] = $data->pajak;
           $column['uang_muka'] = $data->dp_so;
           $column['kurang_bayar'] =number_format( $data->kurang_bayar,2,',','.');;
           $container[] = $column;
        }
        return $container;
    }
}