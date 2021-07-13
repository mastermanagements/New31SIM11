<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 13/07/2021
 * Time: 14:56
 */

namespace App\Http\utils\data_pembelian;
use Session;
use App\Model\Produksi\POrder;

class HutangPembelian
{
    public function data($req){
        $container = array();
        $no=1;
        $model = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('metode_bayar','1');
        if (!empty($requiest->tgl_awal) && !empty($requiest->tgl_akhir)) {
            $model->whereBetween('tgl_order',[$requiest->tgl_awal, $requiest->tgl_akhir]);
        }

        if(!empty($requiest->supplier)){
            $model->where('id_supplier',$requiest->supplier);
        }

        if(!empty($requiest->status_bayar)){
            $model->where('status_bayar',$requiest->status_bayar);
        }
        foreach ($model->get() as $data){
            $column = array();
            $column['no'] = $no++;
            $column['no_transaksi'] = $data->no_order;
            $column['supplier'] = $data->linkToSuppliers->nama_suplier;
            $column['jumlah_hutang'] = $data->kurang_bayar;
            $column['tgl_jatuh_tempo'] = $data->tgl_jatuh_tempo;
            $status_bayar = '';
            if($data->status_bayar=='0'){
                $status_bayar = 'Lunas';
            }else{
                $status_bayar = 'Lunas';
            }
            $column['status_pembayaran'] = $status_bayar;
            $container[] = $column;
        }
        return $container;
    }
}