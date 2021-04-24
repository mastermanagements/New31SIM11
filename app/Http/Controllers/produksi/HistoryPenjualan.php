<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PSales;
use App\Model\Produksi\DetailSales;
use Session;
class HistoryPenjualan extends Controller
{
    //
    public function store(Request $req){
        $model = DetailSales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if(!empty($req->id_klien))
        {
            $model->where('id_klien', $req->id_klien);
        }

        if(!empty($req->barang_id))
        {
            $model->where('id_barang', $req->barang_id);
        }

//        $model->groupBy('hpp');

        $array = array();
        $no=1;
        foreach ($model as $data_model){
//            foreach ($data as $data_model){
//
//            }
            $column = array();
            if(!empty($req->tgl_awal) && !empty($req->tgl_akhir))
                if((strtotime($req->tgl_awal)<=strtotime($data_model->_linkToSales->tgl_sales)) && (strtotime($req->tgl_akhir) >=strtotime($data_model->_linkToSales->tgl_sales))){
                    $column[] = $no++;
                    $column[] = date('d-m-Y', strtotime($data_model->_linkToSales->tgl_sales));
                    $column[] = $data_model->_linkToSales->no_sales;
                    $column[] = $data_model->linkToBarang->nm_barang;
                    $column[] = $data_model->linkToBarang->spec_barang;
                    $column[] = $data_model->_linkToSales->linkToKlien->nm_klien;
                    $column[] = $data_model->jumlah_jual;
                    $column[] = $data_model->linkToBarang->linkToSatuan->satuan_brg;
                    $column[] = $data_model->jumlah_harga;
                    $array[] = $column;
                }
        }
        return response()->json($array);
    }

}
