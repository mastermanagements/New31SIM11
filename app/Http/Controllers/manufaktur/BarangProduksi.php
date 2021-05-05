<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Hrd\H_Karyawan;
use App\Model\Manufaktur\P_tambah_produksi;


class BarangProduksi extends Controller
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

    public function qualityControll(Request $req, $id)
    {
        $data = $req->except(['_token']);
        $data['tgl_mulai_qc'] = date('Y-m-d');
        $data['jam_mulai_qc'] = date('H:i:s');
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Quality control telah disimpan');
        }else{
            return redirect('manufaktur')->with('message_fail','Quality control gagal disimpan');
        }
    }

    public function UpdateQualityControll(Request $req, $id)
    {

        $data = $req->except(['_token']);
        $data['tgl_mulai_qc'] = date('Y-m-d');
        $data['jumlah_bdp_bagus'] = $req->jumlah_bdp_bagus;
        $data['jumlah_bdp_rusak'] = $req->jumlah_bdp_rusak;
        $data['status_bdp'] = $req->status_bdp;
        $data['jumlah_brg_jadi_bagus'] = $req->jumlah_brg_jadi_bagus;
        $data['jumlah_brg_jadi_rusan'] = $req->jumlah_brg_jadi_rusan;
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            $this->setStok($model);
            return redirect('manufaktur')->with('message_success','Quality control telah disimpan');
        }else{
            return redirect('manufaktur')->with('message_fail','Quality control gagal disimpan');
        }
    }

    public function EndqualityControll(Request $req)
    {
        $data = $req->except(['_token']);
        $data['tgl_selesai'] = date('Y-m-d');
        $data['jam_selesai'] = date('H:i:s');
        $data['status_produksi'] = '2';
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($req->id_quality_control);
        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Quality control telah disimpan');
        }else{
            return redirect('manufaktur')->with('message_fail','Quality control gagal disimpan');
        }
    }

    public function cek_stok( $id){
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $array = [
            'data'=> $model
        ];

        return response()->json($array);
    }

    private function setStok($model){

        $model_barang = Barang::findOrFail($model->id);
        if($model->status_bdp=='0'){
            $model_barang->stok_akhir = $model->jumlah_bdp_bagus;
            $model_barang->stok_akhir = $model->jumlah_brg_jadi_bagus;
            $model_barang->save();
        }else{
            $model_barang->stok_akhir = $model->jumlah_brg_jadi_bagus;
            $model_barang->save();
        }
    }

}
