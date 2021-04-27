<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Hrd\H_Karyawan;
use App\Model\Manufaktur\P_tambah_produksi;

class ProsesProduksiBaru extends Controller
{
    //

    private function kode_produksi(){
        $current_date = date('Y-m-d');
        $exp_date = explode('-', $current_date);
        $kode_produksi = 'MFG'.$exp_date[2].''.$exp_date[1].''.$exp_date[1];
        return $kode_produksi;
    }

    public function create(){
        $data = [
            'barang_jadi'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang','2'),
            'barang_dalam_proses'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang','1'),
            'supervisor'=> H_Karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'current_date'=> date('Y-m-d'),
            'current_time'=> date('H:i:s'),
            'kode_produksi'=> $this->kode_produksi(),
        ];
        return view('user.manufaktur.pages.barang_produksi.page_create', $data);
    }

    public function store(Request $req){
         $this->validate($req,[
            'id_barang'=> 'required',
            'brg_dlm_proses' =>'required',
            'id_supervisor_produksi' => 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = new P_tambah_produksi($data);
        if($model->save()){
            return redirect('manufaktur')->with('message_success','Barang produksi telah disimpan');
        }else{
            return redirect('manufaktur')->with('message_fail','Barang produksi gagal disimpan');
        }
    }

    public function edit($id){
        $data = [
            'barang_jadi'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang','2'),
            'barang_dalam_proses'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang','1'),
            'supervisor'=> H_Karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'current_date'=> date('Y-m-d'),
            'current_time'=> date('H:i:s'),
            'kode_produksi'=> $this->kode_produksi(),
            'data_produksi'=>P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.manufaktur.pages.barang_produksi.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_barang'=> 'required',
            'brg_dlm_proses' =>'required',
            'id_supervisor_produksi' => 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Barang produksi telah diubah');
        }else{
            return redirect('manufaktur')->with('message_fail','Barang produksi gagal diubah');
        }
    }


    public function destroy(Request $req, $id){
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('manufaktur')->with('message_success','Barang produksi telah dihapus');
        }else{
            return redirect('manufaktur')->with('message_fail','Barang produksi gagal dihapus');
        }
    }
}
