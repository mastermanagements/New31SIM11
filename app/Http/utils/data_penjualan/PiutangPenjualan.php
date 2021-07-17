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

class PiutangPenjualan
{
    public function data($req)
    {
        $container = [];
        $no = 1;
        $model = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('metode_bayar', '1');

        if (!empty($req->tgl_awal) && !empty($req->tgl_akhir)) {
            $model->whereBetween('tgl_sales', [$req->tgl_awal, $req->tgl_akhir]);
        }

        if (!empty($req->id_klien)) {
            $model->where('id_klien', $req->id_klien);
        }

        foreach ($model->get() as $data) {
            $column = [];
            $column['no'] = $no++;
            $column['no_transaksi'] = $data->no_sales;
            $klien = '';
            if(!empty($data->linkToKlien)){
                $klien = $data->linkToKlien->nm_klien;
            }
            $column['customer'] = $klien;
            $column['tgl_transaksi'] = date('d-m-Y', strtotime($data->tgl_sales));
            $column['jumlah_piutang'] = $data->kurang_bayar;
            $column['tgl_jatuh_tempo'] = date('d-m-Y', strtotime($data->tgl_jatuh_tempo));
            $status_bayar= '';
            if($data->status_bayar=='0'){
                $status_bayar = 'Lunas';
            }else{
                $status_bayar = 'Belum Lunas';
            }
            $column['status_pembayaran'] = $status_bayar;
            $container[] = $column;
        }
        return $container;
    }
}