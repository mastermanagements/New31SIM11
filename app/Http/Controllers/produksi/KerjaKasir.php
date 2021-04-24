<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\SettingKasir;
use Session;
use App\Model\Produksi\KerjaKasir as KK;

class KerjaKasir extends Controller
{
    //

    public function show_shift_kerja(Request $req){
        $tgl= date('Y-m-d');
        $current_time= date('H:i:s');
        $data = [
            'data_shift'=> SettingKasir::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($req->id_shift_karyawan),
            'current_date'=> $tgl,
            'current_time'=> $current_time,
        ];
        return view('user.produksi.section.jualbarang.kerja_kasir.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'tgl_mulai'=> 'required',
            'jam_mulai'=> 'required',
            'id_shift_kasir'=> 'required',
            'penerima'=> 'required',
        ]);

        $model = new KK();
        $model->tgl_mulai = date('Y-m-d', strtotime($req->tgl_mulai));
        $model->jam_mulai = date('H:i:s', strtotime($req->jam_mulai));
        $model->id_shift_kasir = $req->id_shift_kasir;
        $model->penerima = $req->penerima;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if ($model->save()){
            return redirect('Penjualan')->with('message_success', 'Anda telah berhasil menambah data memulai kerja kasir');
        }else{
            return redirect('Penjualan')->with('message_fail', 'Gagal menambah data kerja kasir');
        }
    }
}
