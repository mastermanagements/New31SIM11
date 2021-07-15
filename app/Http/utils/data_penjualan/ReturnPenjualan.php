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

class ReturnPenjualan
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
            $klien = 'Client Umum';
            if(!empty($data->linkToKlien)){
                $klien = $data->linkToKlien->nm_klien;
            }
            if(!empty($data->linkToMannyComplainJual)) {
                foreach ($data->linkToMannyComplainJual as $item) {
                    if (!empty($item->linkToReturnJual)) {
                        $column = array();
                        $column['no'] = $no++;
                        $column['customer'] = $klien;
                        $column['tgl_penjualan'] =date('d-m-Y', strtotime($data->tgl_sales));
                        $column['tgl_return'] =date('d-m-Y', strtotime($item->linkToReturnJual->tgl_return));
                        $jenis_return = "";
                        if($item->linkToReturnJual->jenis_return=='0'){
                            $jenis_return = 'Return barang';
                        }
                        else if($item->linkToReturnJual->jenis_return=='1'){
                            $jenis_return = 'Return uang';
                        }
                        else if($item->linkToReturnJual->jenis_return=='2'){
                            $jenis_return = 'Potong Hutang';
                        }
                        $column['jenis_return'] =$jenis_return;
                        $column['ongkir_return'] =$item->linkToReturnJual->ongkir_return;

                        $container[] = $column;
                    }
                }
            }
        }
        return $container;
    }
}