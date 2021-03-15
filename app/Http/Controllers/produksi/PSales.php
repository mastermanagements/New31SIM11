<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as klien;
use App\Model\Produksi\KomisiSales as komisi_sales;
use App\Model\Produksi\PSO;
use App\Model\Produksi\PSales as PS;
use App\Model\Produksi\Barang;
use Session;

class PSales extends Controller
{
    //
    public function create(){
        $pass = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_create', $pass);
    }

    public function show($id_p_sales){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $pass = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> $model,
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_show', $pass);
    }

    public function store(Request $req){
        $this->validate($req,[
            'no_sales'=> 'required',
            'tgl_sales'=> 'required',
            'id_klien' => 'required',
            'tgl_kirim' => 'required',
            'id_komisi_sales'=> 'required'
        ]);

        $model = new PS();
        $model->tgl_sales = date('Y/m/d', strtotime($req->tgl_sales));
        $model->no_sales = $req->no_sales;
        $model->id_klien = $req->id_klien;
        $model->tgl_kirim = date('Y/m/d', strtotime($req->tgl_kirim));
        $model->id_komisi_sales = $req->id_komisi_sales;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if($model->save()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah disimpan');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal disimpan');
        }
    }

    public function edit($id_p_sales){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $pass = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> $model,
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_edit', $pass);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'no_sales'=> 'required',
            'tgl_sales'=> 'required',
            'id_klien' => 'required',
            'tgl_kirim' => 'required',
            'id_komisi_sales'=> 'required'
        ]);

        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->tgl_sales = date('Y/m/d', strtotime($req->tgl_sales));
        $model->no_sales = $req->no_sales;
        $model->id_klien = $req->id_klien;
        $model->tgl_kirim = date('Y/m/d', strtotime($req->tgl_kirim));
        $model->id_komisi_sales = $req->id_komisi_sales;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if($model->save()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah diubah');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal diubah');
        }
    }

    public function destroy(Request $req, $id){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah dihapus');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal dihapus');
        }
    }
}
