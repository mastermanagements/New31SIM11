<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as klien;
use App\Model\Produksi\TawarJual as TJ;
use App\Model\Produksi\PSO;
use Session;
class PesananPenjualan extends Controller
{
    //
    public function index(){
    }

    public function create(){
        $data = [
            'tawar_jual'=> TJ::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
//        dd("Pesanan penjualan");
        return view('user.produksi.section.jualbarang.pesanan_penjualan.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'no_so'=>'required',
           'tgl_so'=>'required',
           'id_po'=>'required',
           'id_klien'=>'required',
           'tgl_krm'=>'required',
        ]);
        $model = new PSO();
        $model->tgl_so = date('Y-m-d', strtotime($req->tgl_so));
        $model->no_so = $req->no_so;
        if($req->id_po!='null'){
            $model->id_po = $req->id_po;
        }
        $model->id_klien = $req->id_klien;
        $model->tgl_dikirim = date('Y-m-d', strtotime($req->tgl_krm));
        $model->ket = $req->ket;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Nota pesanan penjualan telah disimpan');
        }else{
            return redirect('Penjualan')->with('message_fail','Nota pesanan penjualan gagal disimpan');
        }
    }
    public function edit($id){
        $data = [
            'tawar_jual'=> TJ::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id),
        ];
//        dd("Pesanan penjualan");
        return view('user.produksi.section.jualbarang.pesanan_penjualan.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'no_so'=>'required',
            'tgl_so'=>'required',
            'id_po'=>'required',
            'id_klien'=>'required',
            'tgl_krm'=>'required',
        ]);
        $model = PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model->tgl_so = date('Y-m-d', strtotime($req->tgl_so));
        $model->no_so = $req->no_so;
        if($req->id_po!='null'){
            $model->id_po = $req->id_po;
        }
        $model->id_klien = $req->id_klien;
        $model->tgl_dikirim = date('Y-m-d', strtotime($req->tgl_krm));
        $model->ket = $req->ket;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Nota pesanan penjualan telah disimpan');
        }else{
            return redirect('Penjualan')->with('message_fail','Nota pesanan penjualan gagal disimpan');
        }
    }

    public function destroy(Request $req, $id){
        $model = PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if($model->delete()){
            return redirect('Penjualan')->with('message_success','Nota pesanan penjualan telah dihapus');
        }else{
            return redirect('Penjualan')->with('message_fail','Nota pesanan penjualan gagal dihapus');
        }
    }
}
