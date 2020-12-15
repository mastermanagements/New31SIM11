<?php

namespace App\Http\Controllers\keuangan\report;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\utils\data\Aruskas as DataAruskas;
use App\Traits\DateYears;
use App\Model\Keuangan\TahunBuku;

class ArusKas extends Controller
{
    //

    use DateYears;

    public function index()
    {
        $total_laba_rugi = DataAruskas::set_total_laba_rugi();

        $thn_buku = TahunBuku::where('status','1')->first();
        if(!empty($thn_buku)){
            $tahun_berjalan = $thn_buku->thn_buku;
            $tahun_lalu = $tahun_berjalan-1;
        }else{
            $tahun_berjalan = date('Y');
            $tahun_lalu = $tahun_berjalan-1;
        }

        DataAruskas::$tahun_setting=[$tahun_lalu,$tahun_berjalan];
        DataAruskas::DataArusKas(null);
        $akun = DataAruskas::$akun;
        $data_arusakan = DataAruskas::compare_between_array();
        $data_arusakan['total_laba_rugi']= $total_laba_rugi;
        Session::put('menu-laporan-keuangan', 'arus-kas');

        // dd($data_arusakan);
        $data = [
            'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
            'judul' => 'Arus Kas',
            'tahun_berjalan2' => $this->costumDate(),
            'data' => $data_arusakan,
            'akun'=> $akun
        ];
        return view('user.keuangan.section.laporan.page_default',$data);
    }

    public function print()
    {
        $total_laba_rugi = DataAruskas::set_total_laba_rugi();

        $thn_buku = TahunBuku::where('status','1')->first();
        if(!empty($thn_buku)){
            $tahun_berjalan = $thn_buku->thn_buku;
            $tahun_lalu = $tahun_berjalan-1;
        }else{
            $tahun_berjalan = date('Y');
            $tahun_lalu = $tahun_berjalan-1;
        }

        DataAruskas::$tahun_setting=[$tahun_lalu,$tahun_berjalan];

        DataAruskas::DataArusKas(null);
        $akun = DataAruskas::$akun;
        $data_arusakan = DataAruskas::compare_between_array();
        $data_arusakan['total_laba_rugi']= $total_laba_rugi;

        // dd($data_arusakan);
        $data = [
            'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
            'judul' => 'Arus Kas',
            'tahun_berjalan2' => $this->costumDate(),
            'data' => $data_arusakan,
            'akun'=> $akun
        ];
        return view('user.keuangan.section.laporan.arus_kas.print_page',$data);
    }
}
