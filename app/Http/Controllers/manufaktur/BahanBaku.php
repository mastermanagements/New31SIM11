<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Manufaktur\P_tambah_produksi;
use Session;
use App\Model\Produksi\Barang as barang;
use App\Model\Manufaktur\P_Bahan_produksi;
use App\Http\utils\Stok;
class BahanBaku extends Controller
{
    //
   /*  public function show($id_tambah_produksi){
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrfail($id_tambah_produksi);
        $array = [
            'data'=> $model,
            'id_tambah_produksi'=>$id_tambah_produksi,
            'bahan_baku'=> P_Bahan_produksi::all()->where('id_tambah_produksi', $model->id)->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'barang' => barang::all()->where('jenis_barang','1')->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.manufaktur.pages.barang_produksi.bahan_baku.page_show', $array);
    } */

    public function store(Request $req){
        $this->validate($req,[
            'id_tambah_produksi'=> 'required',
            'id_barang_mentah'=> 'required',
            'jumlah_bahan'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $data['jumlah_bahan'] = $req->jumlah_bahan;

        $model = new P_Bahan_produksi($data);
        if($model->save()){

//            Stok::updateStokAkhirManufaktur($model);
            return redirect()->back()->with('message_success', 'Berhasil tambah bahan baku')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_fail', 'Bahan baku gagal disimpan')->with('tab2','tab2');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_tambah_produksi'=> 'required',
            'id_barang_mentah'=> 'required',
            'jumlah_bahan'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $data['jumlah_bahan'] = $req->jumlah_bahan;
        
        $model = P_Bahan_produksi::find($id);
        if($model->update($data)){
            return redirect()->back()->with('message_success', 'Bahan baku telah diubah')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_fail', 'Bahan baku gagal diubah')->with('tab2','tab2');
        }
    }

    public function delete(Request $req, $id){
        $model = P_Bahan_produksi::find($id);
        if($model->delete()){			
//            Stok::DeleteStokAkhirManufaktur($model);
            return redirect()->back()->with('message_success', 'Bahan baku telah hapus')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_fail', 'Bahan baku gagal hapus')->with('tab2','tab2');
        }
    }
}
