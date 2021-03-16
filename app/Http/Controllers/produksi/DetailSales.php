<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\DetailSales as DS;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Administrasi\GroupKlien;
use App\Model\Administrasi\Klien;

class DetailSales extends Controller
{
    //

    private function check_metode_jual($req){
        $hpp=0;
        $model = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($req->id_barang);
        if(!empty($model)){
            if($model->metode_jual == '0'){
                $hpp = $model->linkToHargaJual->harga_jual;
            }elseif($model->metode_jual=='1'){
                if($req->jumlah_jual <= $model->linkToHargaBaseOneJumlah->jumlah_maks_brg){
                    $hpp = $model->linkToHargaBaseOneJumlah->harga_jual;
                }
            }
        }
        return $hpp;
    }

    private function penentuan_diskon($model_PSO){
        $model = Klien::findOrFail($model_PSO->id_klien);
        foreach ($model->linkToMannyGroupKlien as $data){
            dd($data);
        }
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_sales'=> 'required',
            'id_barang'=> 'required',
            'hpp'=> 'required',
            'jumlah_jual'=> 'required',
            'diskon'=> 'required',
            'jumlah_harga'=> 'required',
        ]);

        $model = new DS();
        $model->id_sales = $req->id_sales;
        $model->id_barang = $req->id_barang;
        $model->hpp = $this->check_metode_jual($req);

        $model->jumlah_jual = $req->jumlah_jual;
        $model->diskon = $req->diskon;
        $model->jumlah_harga = $req->jumlah_harga;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect()->back()->with('message_success','Data Barang telah ditambahkan');
        }else{
            return redirect()->back()->with('message_fail','Data Barang gagal ditambahkan');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_barang'=> 'required',
            'hpp'=> 'required',
            'jumlah_jual'=> 'required',
            'diskon'=> 'required',
            'jumlah_harga'=> 'required',
        ]);

        $model = DS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrfail($id);

        $total = 0;
        $total =  $this->check_metode_jual($req)*$req->jumlah_jual;
        if($req->diskon !=0){
            $diskon = $total*($req->diskon/100);
            $total = $total-$diskon;
        }

        $model->id_barang = $req->id_barang;
        $model->hpp =  $this->check_metode_jual($req);
        $model->jumlah_jual = $req->jumlah_jual;
        $model->diskon = $req->diskon;
        $model->jumlah_harga = $total;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect()->back()->with('message_success','Data Barang telah diubah');
        }else{
            return redirect()->back()->with('message_fail','Data Barang gagal diubah');
        }
    }

    public function destroy($id){
        $model = DS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrfail($id);
        if($model->delete()){
            return redirect()->back()->with('message_success','Data Barang telah dihapus');
        }else{
            return redirect()->back()->with('message_fail','Data Barang gagal dihapus');
        }
    }
}
