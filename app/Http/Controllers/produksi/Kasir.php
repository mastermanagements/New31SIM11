<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
class Kasir extends Controller
{
    //

    public function index()
    {
        $data = [
            'barang'=>Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('kasir.page.kasir.page', $data);
    }
}
