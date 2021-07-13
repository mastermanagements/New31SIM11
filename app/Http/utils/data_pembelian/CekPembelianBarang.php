<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 12/07/2021
 * Time: 17:06
 */

namespace App\Http\utils\data_pembelian;
use Session;
use App\Model\Produksi\Cek_Barang;

class CekPembelianBarang
{
    public function Data_pengecekanBarang($req){
        $model = Cek_Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if(!empty($req->tgl_awal) && !empty($req->tgl_akhir)){
            $model->whereBetween('tgl_tiba',[$req->tgl_awal, $req->tgl_akhir]);
        }
        $container = [];
        $no = 1;
        foreach ($model->get() as $data_cek_pembelian){
            $column = array();
            $column['no'] = $no++;
            $column['tgl_terima'] = $data_cek_pembelian->linkToOrder->tgl_order;
            $column['tgl_pengecekkan'] = $data_cek_pembelian->created_at;
            $column['no_order'] = $data_cek_pembelian->linkToOrder->no_order;
            $column['jum_brg_terima'] =$data_cek_pembelian->linkToCekDetailBarang->sum('jum_sesuai');
            $column['jum_brg_kurang'] = $data_cek_pembelian->linkToCekDetailBarang->sum('jum_no_sesuai');
            $column['kon_brg_bagus'] = $data_cek_pembelian->linkToCekDetailBarang->sum('jum_kualitas_sesuai');
            $column['kon_brg_kurang'] = $data_cek_pembelian->linkToCekDetailBarang->sum('jum_kualitas_no_sesuai');
            $column['petugas'] = $data_cek_pembelian->linkToKaryawan->nama_ky;
            $column['tgl_complain'] = $data_cek_pembelian->tgl_konfirm_cek;
            $column['suplier_tgl_respon'] = $data_cek_pembelian->tgl_respon_supplier;
            $column['suplier_diterima'] = $data_cek_pembelian->linkToCekDetailBarang->where('status_return','0')->sum('jum_sesuai')+$data_cek_pembelian->linkToCekDetailBarang->where('status_return','0')->sum('jum_kualitas_sesuai');
            $column['suplier_di_tolak'] = $data_cek_pembelian->linkToCekDetailBarang->where('status_return','1')->sum('jum_no_sesuai')+$data_cek_pembelian->linkToCekDetailBarang->where('status_return','1')->sum('jum_kualitas_no_sesuai');
            $container[] = $column;
        }
        return $container;
    }
}