<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 15/07/2021
 * Time: 09:04
 */

namespace App\Http\utils\data_penjualan;
use App\Model\Produksi\PSales;
use Session;

class ComplainPenjualan
{
    public function data($req)
    {
        $container = [];
        $no=1;
        $model= PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));

        if(!empty($req->tgl_awal) && !empty($req->tgl_akhir) ){
            $model->whereBetween('tgl_sales',[$req->tgl_awal,$req->tgl_akhir]);
        }

        if(!empty($req->id_klien)){
            $model->where('id_klien',$req->id_klien);
        }


        foreach ($model->get() as $data){
            if(!empty($data->linkToMannyComplainJual)){
                foreach ($data->linkToMannyComplainJual as $item){
                    $column = array();
                    $column['no'] =  $no++;
                    $column['no_transaksi'] = $data->no_sales;
                    $column['tgl_penjualan'] = date('d-m-Y', strtotime($data->tgl_sales));
                    $klien = 'Client Umum';
                    if(!empty($data->linkToKlien)){
                        $klien = $data->linkToKlien->nm_klien;
                    }
                    $column['klien'] =$klien;
                    $column['bbk'] =  $item->complain_jumlah;
                    $column['bbr'] =   $item->complain_kualitas;
                    $column['nilai_uang'] =  $item->total_return;
                    $column['tgl_complain'] =  date('d-m-Y', strtotime($item->created_at));
                    $status_complain = '';
                    if($item->status_complain=='0'){
                        $status_complain = 'Diterima';
                    }else{
                        $status_complain = 'Ditolak';
                    }
                    $column['status_complain'] = $status_complain;
                    $column['asalan_status'] = $item->alasan_ditolak;
                    $column['keterangan'] =   $item->ket;
                    $container[] =  $column;
                }
            }

        }
        return $container;
    }
}