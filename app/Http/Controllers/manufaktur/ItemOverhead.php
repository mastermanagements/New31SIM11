<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Manufaktur\P_item_overhead;
use Session;
class ItemOverhead extends Controller
{
    //
    public function create(){
        $array = [
            'item_overhead'=> P_item_overhead::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.manufaktur.pages.barang_produksi.overhead.page_show', $array);
    }

    public function store(Request $req){
        $this->validate($req,[
           'item_overhead' => 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = new P_item_overhead($data);
        if($model->save()){
            return redirect()->back()->with('message_success','Item biaya overhead telah disimpan');
        }else{
            return redirect()->back()->with('message_fail','Item biaya overhead gagal disimpan');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'item_overhead' => 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_item_overhead::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if($model->update($data)){
            return redirect()->back()->with('message_success','Item biaya overhead telah diubah');
        }else{
            return redirect()->back()->with('message_fail','Item biaya overhead gagal diubah');
        }
    }

    public function destroy(Request $req, $id){
        $model = P_item_overhead::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if($model->delete()){
            return redirect()->back()->with('message_success','Item biaya overhead telah dihapus');
        }else{
            return redirect()->back()->with('message_fail','Item biaya overhead gagal dihapus');
        }
    }
}
