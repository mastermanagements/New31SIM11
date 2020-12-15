<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Keuangan\TahunBuku as thn_buku;
use Session;

class TahunBuku extends Controller
{
    public function index(){
        $data = [
            'data'=> thn_buku::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.keuangan.section.tahun_buku.content', $data);
    }

    public function create(){
        return view('user.keuangan.section.tahun_buku.new');
    }

    public function store(Request $req){
        $this->validate($req,[
            'thn_buku'=> 'required'
        ]);

        $month_years = $req->thn_buku;
        $explode = explode('-', $month_years);
        $model = new thn_buku();
        $model->bln_buku = $explode[1];
        $model->thn_buku = $explode[0];
        $model->id_perusahaan =Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('tahun-buku')->with('message_success','Tahun Buku telah dibuat');
        }else{
            return redirect('tahun-buku')->with('message_fail','Tahun Buku gagal dibuat');
        }
    }

    public function edit($id){
        $model = thn_buku::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $data = [
            'data'=> $model
        ];
        return view('user.keuangan.section.tahun_buku.edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'thn_buku'=> 'required'
        ]);

        $month_years = $req->thn_buku;
        $explode = explode('-', $month_years);
        $model = thn_buku::findOrFail($id);
        $model->bln_buku = $explode[1];
        $model->thn_buku = $explode[0];
        $model->id_perusahaan =Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('tahun-buku')->with('message_success','Tahun Buku telah diubah');
        }else{
            return redirect('tahun-buku')->with('message_fail','Tahun Buku gagal diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = thn_buku::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('tahun-buku')->with('message_success',' Status Tahun Buku telah dihapus');
        }else{
            return redirect('tahun-buku')->with('message_fail','Status Tahun Buku gagal dihapus');
        }
    }

    public function ubah_status(Request $req, $id){
        $model = thn_buku::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $status='0';
        if($model->status == 0){
            $status = '1';
        }else{
            $status='0';
        }
        $model->status  = $status;
        if($model->save()){
            return redirect('tahun-buku')->with('message_success',' Status Tahun Buku telah dibuat');
        }else{
            return redirect('tahun-buku')->with('message_fail','Status Tahun Buku gagal dibuat');
        }
    }
}
