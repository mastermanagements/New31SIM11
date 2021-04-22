<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Manufaktur\P_SOP_Produksi;

class Manufaktur extends Controller
{
    //
    public function index()
    {
        $array = [
            'sop_produksi'=> P_SOP_Produksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.manufaktur.default', $array);
    }
}
