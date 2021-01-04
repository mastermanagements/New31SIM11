<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Produksi\HargaJualSatuan as harga_jual;

class HargaJualSatuan extends Controller
{
    //

    public function index(){
        return "return";
    }

    public function show($id){
        $data = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan') )->findOrfail($id);
        return view('user.produksi.section.barang.harga_jual_satuan.page_conten',['data'=> $data]);
    }

    public function create($id){
        $data = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan') )->findOrfail($id);
        return view('user.produksi.section.barang.harga_jual_satuan.page_create',['data'=> $data]);
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_barang'=> 'required',
            'harga_jual'=> 'required',
        ]);

        $model = harga_jual::updateOrCreate(
            [
                'id_barang'=>$req->id_barang,
                'id_karyawan'=> Session::get('id_karyawan'),
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
            ],
            [
                'harga_jual'=>$req->harga_jual
            ]
        );

        if($model->save()){
            return redirect('Barang')->with('message_success','Harga Jual telah disimpan')->with('tab','tab2');
        }else{
            return redirect('Barang')->with('message_fail','Harga Jual gagal untuk disimpan')->with('tab','tab2');
        }

    }

    public function edit($id){
        $data = harga_jual::where('id_perusahaan', Session('id_perusahaan_karyawan'))->findOrFail($id);
        return view('user.produksi.section.barang.harga_jual_satuan.page_edit',['data'=> $data]);
    }

    public function destroy($id){
        $data = harga_jual::where('id_perusahaan', Session('id_perusahaan_karyawan'))->findOrFail($id);
        if($data->delete()){
            return redirect('harga-jual-satuan/'.$data->id_barang)->with('message_success','Harga Jual telah dihapus');
        }else{
            return redirect('harga-jual-satuan/'.$data->id_barang)->with('message_fail','Harga Jual gagal untuk dihapus');
        }
    }
}
