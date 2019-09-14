<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;
use App\Traits\DateYears;
class DaftarJurnal extends Controller
{

    private $id_karyawan;
    private $id_perusahaan;
    use Transaksi;
    use DateYears;

    public function __construct()
    {
        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index(){
        Session::put('menu_transaksi','daftar_jurnal');
        $pass = array(
            'tanggal_awal'=>'',
            'tanggal_akhir'=>'',
            'id_perusahaan'=>$this->id_perusahaan,
            'tahun_berjalan'=>$this->costumDate()->year,

        );
        $data = $this->daftar_jurnal($pass);
        $data_pass = [
            'data' => $data,
            'jenis_jurnal'=>$this->jenis_jurnal
        ];
        return view('user.keuangan.section.transaksi.page_default', $data_pass);
    }

    public function edit($id){
        $data = $this->getDataByNoTransaksiWithTahunBerjalan($id, $this->id_perusahaan);
        return response()->json(array('data'=>$data));
    }

    public function update(Request $req){
        $this->validate($req,[
            "tgl_jurnal" => "required",
            "no_transaksi" => "required",
            "jenis_jurnal" => "required",
            "example_rincians_length" => "required",
            "id_jurnal" => 'required',
            "debet_kredit" => 'required',
            "jumlah_transaksi" => 'required']);

        foreach ($req->id_jurnal as $key => $value){
            $this->update_keterangan($req, $req->jumlah_transaksi[$key], $value);
        }

        return redirect('Daftar-jurnal')->with('message_success', 'Ubah jurnal telah selesai');
    }

}
