<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Transaksi;
use Session;
use App\Http\utils\data\BukuBesar as data_buku_besar;
use App\Model\Keuangan\AkunAktifUkm;
use App\Http\utils\data\SettingTahunBuku;
class BukuBesar extends Controller
{
    //
    use Transaksi;

    public function index(){
        $data_tahun = SettingTahunBuku::tahun_buku();
        $data_buku_besar = data_buku_besar::groupAkunBaseOnDataJurnal($data_tahun);
        Session::put('menu-laporan-keuangan','buku_besar');
        $data=[
            'judul'=> 'Buku Besar',
            'tahun_berjalan2'=> $this->costumDate(),
            'data_buku_besar'=> $data_buku_besar,
            'akun'=>AkunAktifUkm::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }
}
