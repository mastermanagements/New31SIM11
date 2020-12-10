<?php

namespace App\Http\Controllers\keuangan\report;

use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Transaksi;
use Session;
use App\Http\utils\data\NeracaSaldo as neraca_saldo;
use App\Http\utils\data\SettingTahunBuku;

class NeracaSaldo extends Controller
{
    use Transaksi;

    public function index(){
        $data_tahun = SettingTahunBuku::tahun_buku();
        $data_neraca = neraca_saldo::neraca($data_tahun);
    //    dd($data_neraca);
        Session::put('menu-laporan-keuangan','neraca-saldo');
        $data=[
            'judul'=> 'Neraca Saldo',
            'tahun_berjalan2'=> $this->costumDate(),
            'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'data'=>$data_neraca
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }
}
