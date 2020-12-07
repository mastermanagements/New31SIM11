<?php

namespace App\Http\Controllers\keuangan\report;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\utils\data\Aruskas as DataAruskas;
use App\Traits\DateYears;

class ArusKas extends Controller
{
    //

    use DateYears;

    public function index()
    {
        $total_laba_rugi = DataAruskas::set_total_laba_rugi();
        DataAruskas::DataArusKas(null);
        $akun = DataAruskas::$akun;
        $data_arusakan = DataAruskas::compare_between_array();
        $data_arusakan['total_laba_rugi']= $total_laba_rugi;
        dd($data_arusakan);
        Session::put('menu-laporan-keuangan', 'arus-kas');
        $data = [
            'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
            'judul' => 'Arus Kas',
            'tahun_berjalan2' => $this->costumDate(),
            'data' => $data_arusakan,
            'akun'=> $akun
        ];
        return view('user.keuangan.section.laporan.page_default',$data);
    }
}
