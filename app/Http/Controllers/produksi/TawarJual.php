<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as klien;
use Session;
use App\Model\Marketing\Promo;
use App\Model\Produksi\TawarJual as TJ;
class TawarJual extends Controller
{
    //
    public function index(){
        $data = [
            'promo'=> Promo::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
        return view('user.produksi.section.jualbarang.penawaran_penjualan.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'no_penawaran'=> 'required',
            'tgl_penawaran'=> 'required',
            'tgl_sd'=> 'required',
            'id_klien' => 'required',
        ]);

        $model = new TJ();
        $model->id_promo = $req->id_promo;
        $model->no_tawar = $req->no_penawaran;
        $model->tgl_tawar = date('Y-m-d', strtotime($req->tgl_penawaran));
        $model->tgl_berlaku = date('Y-m-d', strtotime($req->tgl_sd));
        $model->tgl_krm = date('Y-m-d', strtotime($req->tgl_krm));
        $model->ket = $req->ket;
        $model->id_klien = $req->id_klien;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Penawaran penjualan telah disimpan');
        }else{
            return redirect('Penjualan')->with('message_fail','Penawaran penjualan gagal disimpan');
        }
    }

    public function edit($id_tawar_jual){
        $data = [
            'data'=> TJ::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id_tawar_jual),
            'promo'=> Promo::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
        return view('user.produksi.section.jualbarang.penawaran_penjualan.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'no_penawaran'=> 'required',
            'tgl_penawaran'=> 'required',
            'tgl_sd'=> 'required',
            'id_klien' => 'required',
        ]);

        $model = TJ::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->id_promo = $req->id_promo;
        $model->no_tawar = $req->no_penawaran;
        $model->tgl_tawar = date('Y-m-d', strtotime($req->tgl_penawaran));
        $model->tgl_berlaku = date('Y-m-d', strtotime($req->tgl_sd));
        $model->tgl_krm = date('Y-m-d', strtotime($req->tgl_krm));
        $model->ket = $req->ket;
        $model->id_klien = $req->id_klien;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Penawaran penjualan telah diubah');
        }else{
            return redirect('Penjualan')->with('message_fail','Penawaran penjualan gagal diubah');
        }
    }

    public function destroy(Request $req, $id){
        $model = TJ::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Penawaran penjualan telah dihapus');
        }else{
            return redirect('Penjualan')->with('message_fail','Penawaran penjualan gagal dihapus');
        }
    }

}
