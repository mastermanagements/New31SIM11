<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as klien;
use Session;
class TawarJual extends Controller
{
    //
    public function index(){
        $data = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
        return view('user.produksi.section.jualbarang.penawaran_penjualan.page_create', $data);
    }
}
