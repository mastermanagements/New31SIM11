<?php

namespace App\Http\Controllers\keuangan\report;

use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Transaksi;
use Session;
use App\Http\utils\data\NeracaSaldo as neraca_saldo;
use App\Http\utils\data\SettingTahunBuku;
use App\Http\utils\HeaderReport;
class NeracaSaldo extends Controller
{
    use Transaksi;
    private $tgl_awal;
    private $tgl_akhir;

    public function __construct()
    {
        $this->tgl_awal = date('Y-m-01');
        $this->tgl_akhir = date('Y-m-t');
    }

    public function index()
    {
        $data_tahun = SettingTahunBuku::tahun_buku();
        $data_tahun['tgl_awal'] = $this->tgl_awal;
        $data_tahun['tgl_akhir'] = $this->tgl_akhir;
        $data_neraca = neraca_saldo::neraca($data_tahun);
        Session::put('menu-laporan-keuangan', 'neraca-saldo');
        $data = [
            'judul' => 'Neraca Saldo',
            'tahun_berjalan2' => $this->costumDate(),
            'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
            'tahun_berjalan' => $this->costumDate()->year,
            'jenis_jurnal' => ['0', '1'],
            'data' => $data_neraca
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function print($tgl_awal, $tgl_akhir)
    {
        $data_array = SettingTahunBuku::tahun_buku();
        $data_array['tgl_awal'] = date('Y-m-d', strtotime($tgl_awal));
        $data_array['tgl_akhir'] = date('Y-m-d', strtotime($tgl_akhir));
        $data_neraca = neraca_saldo::neraca($data_array);
        $data = [
            'judul' => 'Neraca Saldo',
            'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
            'jenis_jurnal' => ['0', '1'],
            'data' => $data_neraca
        ];
        $data['header'] = HeaderReport::header('layouts.header_print.header',$tgl_awal,$tgl_akhir,'Neraca Saldo');

        return view('user.keuangan.section.laporan.neraca_saldo.print_page', $data);
    }
}
