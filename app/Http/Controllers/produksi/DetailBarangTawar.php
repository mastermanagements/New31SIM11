<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\TawarJual;
use Session;
use App\Model\Produksi\Barang;
use App\Model\Produksi\DetailBarangTawar as detail_tj;

class DetailBarangTawar extends Controller
{
    //
    public function show($id_tawarjuan){
        $data = [
            'data_jual'=> TawarJual::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFaiL($id_tawarjuan),
            'barang'=> Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'id_tawar_jual'=> $id_tawarjuan
        ];
        return view('user.produksi.section.jualbarang.detail_penawaran_penjualan.page_create', $data);
    }

    public function store(Request $req){
         $this->validate($req,[
           'id_tawar_jual' => 'required',
           'id_barang'=> 'required',
           'jumlah_barang' => 'required',
           'hpp'=> 'required',
           'diskon' => 'required',
           'total'=> 'required'
        ]);

        $model = new detail_tj();
        $model->id_tawar_jual = $req->id_tawar_jual;
        $model->id_barang = $req->id_barang;
        $model->id_jasa = $req->id_jasa;
        $model->hpp = $req->hpp;
        $model->jumlah_barang = $req->jumlah_barang;
        $model->diskon = $req->diskon;
        $model->total_tj = $req->total;
        $model->id_perusahaan = Session::get('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if($model->save()){
            return redirect('detail-barang-Tpenjualan/'. $req->id_tawar_jual)->with('message_success', 'Data barang berhasil disimpan');
        }else{
            return redirect('detail-barang-Tpenjualan/'. $req->id_tawar_jual)->with('message_fail', 'Data barang gagal disimpan');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_barang'=> 'required',
            'n_jumlah_barang' => 'required',
            'n_hpp' => 'required',
            'n_diskon'=> 'required',
            'n_total'=> 'required'
        ]);

        $total_sebdis = 0;
        $model = detail_tj::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->id_barang = $req->id_barang;
        $model->hpp = $req->n_hpp;
        $model->jumlah_barang = $req->n_jumlah_barang;
        $model->diskon = $req->n_diskon;
        $total_sebdis = $req->n_hpp * $req->n_jumlah_barang;
        if($req->n_diskon!=0){
            $diskon = $total_sebdis*($req->n_diskon/100);
            $total_sebdis = $total_sebdis - $diskon;
        }
        $model->total_tj = $total_sebdis;
        $model->id_perusahaan = Session::get('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if($model->save()){
            return redirect('detail-barang-Tpenjualan/'. $model->id_tawar_jual)->with('message_success', 'Data barang berhasil diubah');
        }else{
            return redirect('detail-barang-Tpenjualan/'. $model->id_tawar_jual)->with('message_fail', 'Data barang gagal diubah');
        }
    }

    public function delete($id){
        $model = detail_tj::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('detail-barang-Tpenjualan/'. $model->id_tawar_jual)->with('message_success', 'Data barang berhasil dihapus');
        }else{
            return redirect('detail-barang-Tpenjualan/'. $model->id_tawar_jual)->with('message_fail', 'Data barang gagal dihapus');
        }
    }
}
