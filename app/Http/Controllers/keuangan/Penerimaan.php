<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;
use function Symfony\Component\Debug\Tests\testHeader;

class Penerimaan extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;
    use Transaksi;

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
        Session::put('menu_transaksi','penerimaan');
        $data =[
            'akun_aktif'=> $this->get_akun_akfif(array('id_perusahaan'=> $this->id_perusahaan)),
            'posisi'=> $this->posisi()
        ];
        return view('user.keuangan.section.transaksi.page_default', $data);
    }

    public function get_penerimaan()
    {
        $array =[
            'jenis_transaksi'=>'0',
            'id_perusahaan'=>$this->id_perusahaan,
        ];
        $json = $this->getData($array);
        return response()->json(array('data'=>$json));
    }

    public function store(Request $req){
        $data=[
            'id_perusahaan'=>$this->id_perusahaan,
            'id_karyawan'=>$this->id_karyawan,
        ];
        return response()->json($this->InsertData($req,'0', $data));
    }
}
