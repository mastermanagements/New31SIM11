<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 14/07/2021
 * Time: 14:36
 */

namespace App\Http\utils\data_pembelian;

use Session;
use App\Model\Produksi\POrder;

class Pembayaran_pembelian
{
    public function data($req)
    {
        $container = array();
        $no = 1;
        $model = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if (!empty($req->tgl_awal) && !empty($req->tgl_akhir)) {
            $model->whereBetween('tgl_order',[$req->tgl_awal, $req->tgl_akhir]);
        }

        if(!empty($req->supplier)){
            $model->where('id_supplier',$req->supplier);
        }
        foreach ($model->get() as $data) {
            if (!empty($data->linkToMannyPembayaran)) {
                foreach ($data->linkToMannyPembayaran as $item_data) {
                    $column = array();
                    $column['no'] = $no++;
                    $column['no_transaksi'] = $data->no_order;
                    $column['suppliers'] = $data->linkToSuppliers->nama_suplier;
                    $column['tgl_bayar'] = $item_data->tgl_bayar;
                    $column['jumlah_bayar'] = $item_data->jumlah_bayar;
                    $column['bank_asal'] = $item_data->linkToBankAsal->nama_bank;
                    $column['bank_tujuan'] = $item_data->linkToBankTujuan->nama_bank;
                    $metode_bayar = '';

                    if ($item_data->metode_bayar == '0') {
                        $metode_bayar = 'Transfer Bank';
                    } else if ($item_data->metode_bayar == '1') {
                        $metode_bayar = 'Cek';
                    } else if ($item_data->metode_bayar == '2') {
                        $metode_bayar = 'Langsung';
                    } else if ($item_data->metode_bayar == '3') {
                        $metode_bayar = 'Return Barang';
                    }

                    $column['metode_bayar'] =$metode_bayar;
                    $container[] = $column;
                }
            }
        }
        return $container;
    }
}