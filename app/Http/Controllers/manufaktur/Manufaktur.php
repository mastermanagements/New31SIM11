<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Manufaktur\P_SOP_Produksi;
use App\Model\Manufaktur\P_tambah_produksi;

class Manufaktur extends Controller
{
    //
    public function index()
    {
        $array = [
            'sop_produksi'=> P_SOP_Produksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_produksi'=>P_tambah_produksi::all()->where('status_produksi','0')->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_monitoring'=>P_tambah_produksi::all()->where('status_produksi','1')->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.manufaktur.default', $array);
    }
}
