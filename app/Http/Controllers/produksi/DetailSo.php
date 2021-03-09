<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PSO;
use App\Model\Administrasi\Klien;
use Session;
class DetailSo extends Controller
{
    //

    public function show($id_so){
        $data = [
            'pso'=> PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_so),
            'klien'=> Klien::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get()
        ];
        return view('user.produksi.section.jualbarang.detail_so.page_create', $data);
    }
}
