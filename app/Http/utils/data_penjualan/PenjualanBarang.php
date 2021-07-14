<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 14/07/2021
 * Time: 16:45
 */

namespace App\Http\utils\data_penjualan;
use App\Model\Produksi\PSales;
use Session;

class PenjualanBarang
{
    public function data($req){
        $container = array();
        $no="";
        $model = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));

        if(!empty($req->tgl_awal) && !empty($req->tgl_akhir) ){
            $model->whereBetween('tgl_sales',[$req->tgl_awal,$req->tgl_akhir]);
        }

        if(!empty($req->id_klien)){
            $model->where('id_klien',$req->id_klien);
        }

        foreach ($model->get() as $data){
           $column =array();
           $column['no'] = $no++;
           $column['tgl_transaksi'] = date('d-m-Y', strtotime($data->tgl_sales));
           $column['no_transaksi'] = $data->no_sales;
           $klien = '';
           if(!empty($data->linkToKlien)){
               $klien = $data->linkToKlien->nm_klien;
           }
           $column['customer'] = $klien;
           $tgl_kirim = 'customer umum';
           if(!empty($data->linkToKlien->tgl_kirim)){
               $tgl_kirim = $data->linkToKlien->tgl_kirim;
           }
           $column['tgl_dikirim'] = $tgl_kirim;
           $no_so = '';
           if(!empty($data->linkToSo)){
               $no_so = $data->linkToSo->no_so;
           }
           $column['no_pesanan_penjualan'] = $no_so;
           $column['total_penjualan'] = $data->total;
           $column['diskon'] = $data->diskon_tambahan;
           $column['ppn'] = $data->pajak;
           $column['ongkir'] = $data->ongkir;
           $metode_penjualan = '';
           if($data->metode_bayar == '0'){
               $metode_penjualan = 'Tunai';
           }else{
               $metode_penjualan = 'Kredit';
           }
           $column['jenis_penjualan'] = $metode_penjualan;
           $container[] = $column;
        }
        return $container;
    }
}