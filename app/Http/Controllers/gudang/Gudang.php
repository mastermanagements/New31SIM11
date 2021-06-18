<?php

namespace App\Http\Controllers\gudang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Gudang as model_gudang;
use Session;
class Gudang extends Controller
{
    //
    public function index(){
        $data = [
            'gudang'=> model_gudang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.gudang.page_default', $data);
    }


}
