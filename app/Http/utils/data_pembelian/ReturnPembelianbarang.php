<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 13/07/2021
 * Time: 13:22
 */

namespace App\Http\utils\data_pembelian;

use Session;
use App\Model\Produksi\POrder;

class ReturnPembelianbarang
{
    public function data_return_pembelian($req)
    {

        $container = array();
        $no = 1;
        $model = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));

        if(!empty($req->tgl_awal) && !empty($req->tgl_akhir)){
            $model->whereBetween('tgl_order',[$req->tgl_awal, $req->tgl_akhir]);
        }

        if(!empty($req->supplier)){
            $model->where('id_supplier',$req->supplier);
        }

        foreach ($model->get() as $data_order) {
            if (!empty($data_order->linkToMannyReturnBeli)) {
                foreach ($data_order->linkToMannyReturnBeli as $data_return) {
                    $column = array();
                    $column['no'] = $no++;
                    $column['supplier'] = $data_order->linkToSuppliers->nama_suplier;
                    $column['tgl_terima'] = $data_order->tgl_tiba;
                    $column['tgl_return'] = $data_return->tgl_return;
                    $jenis_return = '';
                    if($data_return->jenis_return == '0'){
                        $jenis_return = "Return Barang";
                    }else if($data_return->jenis_return == '1'){
                        $jenis_return = "Return Uang";
                    }else if($data_return->jenis_return == '2'){
                        $jenis_return = "Potong Hutang";
                    }
                    $column['jenis_return'] = $jenis_return;
                    $column['ongkir_return'] = $data_return->ongkir_return;
                    $container[] = $column;
                }
            }
        }
        return $container;
    }
}