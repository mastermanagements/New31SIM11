<?php

namespace App\Http\Controllers\manufaktur;

use App\Model\Manufaktur\P_tenaga_produksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Manufaktur\P_tambah_produksi;
use Session;
use App\Model\Hrd\H_Karyawan;

class TenagaProduksi extends Controller
{
    //
    /* public function show($id_tambah_produksi){
        $model = P_tambah_produksi::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id_tambah_produksi);
        $array = [
            'data_tambah_produksi' =>$model,
            'karyawan'=> H_Karyawan::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan')),
            'tenaga_prod'=> P_tenaga_produksi::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->where('id_tambah_produksi', $model->id)
        ];
       return view('user.manufaktur.pages.barang_produksi.pekerja.page_show', $array);
    }
 */
    public function store(Request $req){
        $this->validate($req,[
            'id_tambah_produksi'=> 'required',
            'tenaga_kerja'=> 'required',
            'jumlah_upah'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan']= Session::get('id_perusahaan_karyawan');
        $data['id_karyawan']= Session::get('id_karyawan');
        $data['jumlah_upah'] = rupiahController($req->jumlah_upah);

        $model = new P_tenaga_produksi($data);
        if($model->save()){
            return redirect()->back()->with('message_success','Tenaga Produksi telah ditambahkan')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_fail','Tenaga Produksi gagal ditambahkan')->with('tab2','tab2');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_tambah_produksi'=> 'required',
            'tenaga_kerja'=> 'required',
            'jumlah_upah'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan']= Session::get('id_perusahaan_karyawan');
        $data['id_karyawan']= Session::get('id_karyawan');
        $data['jumlah_upah'] = rupiahController($req->jumlah_upah);

        $model = P_tenaga_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            return redirect()->back()->with('message_success','Tenaga Produksi telah diubah')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_fail','Tenaga Produksi gagal diubah')->with('tab2','tab2');
        }
    }

    public function destroy(Request $req, $id){
        $model = P_tenaga_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect()->back()->with('message_success','Tenaga Produksi telah dihapus')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_fail','Tenaga Produksi gagal dihapus')->with('tab2','tab2');
        }
    }
}
