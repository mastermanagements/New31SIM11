<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use App\Model\Produksi\HargaJualBaseOnJumlah as HjB;
use Session;

class HargaJualBaseOnJumlah extends Controller
{
    //
    public function index($id)
    {
        $data =[
            'data'=> Barang::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.produksi.section.barang.harga_jual_base_on_jumlah.page_conten', $data);
    }

    public function create(Request $req){
        $data = [
            'data'=>Barang::findOrFail($req->id_barang),
            'banyak_barang'=> $req->jumlah_barang
        ];
        return view('user.produksi.section.barang.harga_jual_base_on_jumlah.page_create', $data);
    }

    public function store(Request $req){
        $id_barang = $req->id_barang;
       foreach ($req->jumlah_maks_brg as $key=> $jumlah_maks_brg){
            $harga_jual = $req->harga_jual[$key];
            $model = new HjB(
                [
                    'id_barang'=>$id_barang,
                    'id_karyawan'=>Session::get('id_karyawan'),
                    'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                    'jumlah_maks_brg'=>$jumlah_maks_brg,
                    'harga_jual'=>$harga_jual
                ]
            );
           $model->save();
        }

        return redirect('Barang')->with('message_success','Data harga jual satuan telah ditambahkan')->with('tab','tab2');
    }

    public function show($id){
        $data = HjB::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $hpp = Barang::where('id',$data->id_barang)->first()->hpp;
        $untung = $data->harga_jual - $hpp;

        return view('user.produksi.section.barang.harga_jual_base_on_jumlah.page_edit',['data'=> $data], ['untung'=> $untung]);
    }

    public function update(Request $req, $id){
         $this->validate($req,[
            '_token' => 'required',
            'id_HBJ'=> 'required',
            'jumlah_maks_brg'=> 'required',
            'harga_jual'=> 'required',
        ]);
        $model = HjB::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($req->id_HBJ);
        $model->jumlah_maks_brg =$req->jumlah_maks_brg;
        $model->harga_jual =rupiahController($req->harga_jual);
        if($model->save()){
            return redirect('Barang')->with('message_success','Jumlah Barang dan Harga telah diubah')->with('tab','tab2');
        }else{
            return redirect('Barang')->with('message_error','Jumlah Barang dan Harga gagal diubah')->with('tab','tab2');
        }
    }

    public function delete($id){
        $model = HjB::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('harga-jual-baseon-jumlah/'.$model->id_barang)->with('message_success','Jumlah Barang dan Harga telah dihapus');
        }else{
            return redirect('harga-jual-baseon-jumlah/'.$model->id_barang)->with('message_error','Jumlah Barang dan Harga gagal dihapus');
        }
    }
}
