<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;

class JurnalUmum extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    use Transaksi;

    public function __construct()
    {

        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index(){
        Session::put('menu_transaksi','menu_transaksi');
        $data =[
            'akun_aktif'=> $this->get_akun_akfif(array('id_perusahaan'=> $this->id_perusahaan)),
            'posisi'=> $this->posisi(),
            'keterangan'=>$this->getKeterangan(array('id_perusahaan'=> $this->id_perusahaan)),
            'jenis_jurnal'=> $this->jenis_jurnal
        ];
        return view('user.keuangan.section.transaksi.jurnal_umum.page_default', $data);
    }

    public function store_jurnal_awal(Request $req){
        $data = $this->store_jurnal($req, $this->id_perusahaan, $this->id_karyawan);
        return redirect('Jurnal-Umum')->with('message_success',$data['message']);
    }

}
