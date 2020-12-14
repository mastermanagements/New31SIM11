<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;
use App\Http\utils\data\LabaRugi as laba;
use App\Http\utils\data\SettingTahunBuku;
class LabaRugi extends Controller
{
    //
    use Transaksi;

    public function index(){
        $data_tahun = SettingTahunBuku::tahun_buku();
        $data = laba::LabaRugi($data_tahun);
        $akun = laba::$akun_focus;
        Session::put('menu-laporan-keuangan','laba-rugi');
        $data_pass= [
            'judul'=> 'Laba Rugi',
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=>$data,
            'akun'=>$akun
        ];
        return view('user.keuangan.section.laporan.page_default', $data_pass);
    }

    public function print($tgl_awal, $tgl_akhir){
        $data_array= SettingTahunBuku::tahun_buku();
        $data_array['tgl_awal'] = date('Y-m-d', strtotime($tgl_awal));
        $data_array['tgl_akhir'] = date('Y-m-d', strtotime($tgl_akhir));
        $data = laba::LabaRugi($data_array);
        $akun = laba::$akun_focus;
        Session::put('menu-laporan-keuangan','laba-rugi');
        $data_pass= [
            'judul'=> 'Laba Rugi',
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=>$data,
            'akun'=>$akun
        ];
        return view('user.keuangan.section.laporan.laba_rugi.print_page', $data_pass);
    }
}
