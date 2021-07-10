<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 05/07/2021
 * Time: 09:57
 */

namespace App\Http\utils\data_pembelian;

use App\Model\Produksi\PesananPembelian as p_po;
use App\Model\Produksi\POrder;
use Session;

class PesananPembelian
{
    public function get_data($requiest)
    {
        $model = p_po::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));

        if (!empty($requiest->tgl_awal) && !empty($requiest->tgl_akhir)) {
            $model->whereBetween('tgl_po',[$requiest->tgl_awal, $requiest->tgl_akhir]);
        }

        if(!empty($requiest->supplier)){
            $model->where('id_supplier',$requiest->supplier);
        }

        $container = array();
        $no = 1;
        foreach ($model->orderBy('tgl_po', 'asc')->get() as $data_po) {
            $column = array();
            $column['no'] = $no++;
            $column['tgl_transaksi'] = $data_po->tgl_po;
            $column['no_transaksi'] = $data_po->no_po;
            $column['supplier'] = $data_po->linkToSupplier->nama_suplier;
            $column['total_belajan'] = $data_po->total;
            $column['diskon_tambahan'] = $data_po->diskon_tambahan;
            $column['ppn'] = $data_po->pajak . '%';
            $column['uang_muka'] = $data_po->dp_po;
            $column['kurang_bayar'] = $data_po->kurang_bayar;
            $container[] = $column;
        }
        return $container;
    }


    public function get_data_pembelian($requiest)
    {
        $model = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));

        if (!empty($requiest->tgl_awal) && !empty($requiest->tgl_akhir)) {
            $model->whereBetween('tgl_order',[$requiest->tgl_awal, $requiest->tgl_akhir]);
        }

        if(!empty($requiest->supplier)){
            $model->where('id_supplier',$requiest->supplier);
        }

        $container = array();
        $no = 1;
        foreach ($model->orderBy('tgl_order', 'asc')->get() as $data_po) {
            $column = array();
            $column['no'] = $no++;
            $column['transaksi'] = $data_po->tgl_order;
            $column['no_transaksi'] = $data_po->no_order;
            $column['supplier'] = $data_po->linkToSuppliers->nama_suplier;
            $column['tgl_tiba'] = $data_po->tgl_tiba;
            $no_pesanan = '';
            if(!empty($data_po->linkToPO->no_po)){
                $no_pesanan = $data_po->linkToPO->no_po;
            }
            $column['no_pesananan'] = $no_pesanan;
            $column['total_belajan'] = $data_po->total;
            $column['diskon_tambahan'] = $data_po->diskon_tambahan;
            $column['ppn'] = $data_po->pajak . '%';
            $column['ongkir'] = $data_po->dp_po;
            if($data_po->metode_bayar=='0'){
                $metode_bayar = 'Tunai';
            }else{
                $metode_bayar = 'Kredit';
            }
            $column['metode_bayar'] = $metode_bayar;
            $container[] = $column;
        }
        return $container;
    }
}