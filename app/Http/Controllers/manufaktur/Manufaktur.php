<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Manufaktur\P_SOP_Produksi;
use App\Model\Manufaktur\P_tambah_produksi;
use App\Model\Manufaktur\AkunManufaktur;

class Manufaktur extends Controller
{
    //
    private $jenis_transaksi = [
        'Pemakaian bahan baku',
        'Penambahan persediaan brg jadi',
        'Penambahan persediaan brg dlm proses'
    ];


    public function index()
    {
        $array = [
            'sop_produksi'=> P_SOP_Produksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_produksi'=>P_tambah_produksi::all()->where('status_produksi','0')->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_monitoring'=>P_tambah_produksi::all()->where('status_produksi','1')->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'selesai_produksi'=>P_tambah_produksi::all()->where('status_produksi','2')->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'akun_manufaktur'=>AkunManufaktur::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'jenis_jurnal'=> $this->jenis_transaksi
        ];
        return view('user.manufaktur.default', $array);
    }
}
