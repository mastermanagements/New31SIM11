<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Manufaktur\P_tambah_produksi;
use Session;
use App\Model\Manufaktur\P_proses_produksi;

class ProsesProduksi extends Controller
{
    //

    private $current_date;
    private $current_time;
    public function __construct()
    {
        $this->current_date = date('Y-m-d');
        $this->current_time = date('H:i:s');
    }

    private function query_tahap_produksi($id_barang){
        $query_tahap_produksi = DB::select('select p_proses_bisnis.* from p_proses_bisnis,p_tambah_produksi,
              p_barang_sop where p_proses_bisnis.id_sop_pro=p_barang_sop.id_sop_pro 
              and p_tambah_produksi.id_barang in (select id_barang from p_barang_sop) 
              and p_tambah_produksi.id_barang = '.$id_barang.' and p_proses_bisnis.id_perusahaan='.Session::get('id_perusahaan_karyawan'));

        return $query_tahap_produksi;
    }

    public function show($id_tambah_produksi)
    {
//       dd(asd);
        $model_tambah_produksi = P_tambah_produksi::findOrFail($id_tambah_produksi);
        $array = [
            'tahap_produksi'=>$this->query_tahap_produksi($model_tambah_produksi->id_barang),
            'id_tambah_produksi'=> $id_tambah_produksi,
            'model_tambah_produksi'=> $model_tambah_produksi
        ];
        return view('user.manufaktur.pages.monitoring.proses_pengerjaan.page_create', $array);
    }

    public function store(Request $req){

        $this->validate($req,[
            'id_tambah_produksi'=> 'required',
            'id_proses_bisnis'=> 'required',
            'ket'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['tgl_mulai']=$this->current_date;
        $data['jam_mulai']=$this->current_time;
        $data['id_perusahaan']=Session::get('id_perusahaan_karyawan');
        $data['id_karyawan']=Session::get('id_karyawan');
        $model =new P_proses_produksi($data);
        if($model->save()){
            return redirect('manufaktur')->with('message_success','Proses produksi telah disimpan');
        }else{
            return redirect('manufaktur')->with('message_fial','Proses produksi gagal disimpan');
        }
    }

    public function edit($id_proses_produksi)
    {
        $model_proses_produksi = P_proses_produksi::findOrFail($id_proses_produksi);
        $array = [
            'data_proses_produksi'=> $model_proses_produksi,
            'current_time'=> $this->current_time,
            'current_date'=> $this->current_date,
        ];
        return view('user.manufaktur.pages.monitoring.proses_pengerjaan.page_edit', $array);
    }

    public function update(Request $req, $id){

        $this->validate($req,[
             'ket'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $model =P_proses_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $data['tgl_mulai']=$this->current_date;
        $data['jam_mulai']=$this->current_time;
        $data['id_perusahaan']=Session::get('id_perusahaan_karyawan');
        $data['id_karyawan']=Session::get('id_karyawan');
        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Proses produksi telah diubah');
        }else{
            return redirect('manufaktur')->with('message_fial','Proses produksi gagal diubah');
        }
    }
}
