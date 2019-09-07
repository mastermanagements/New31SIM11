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
            'id_ket_transaksi'=> $req->id_ket_transaksi
        ];
        return response()->json($this->InsertData($req,'0', $data));
    }

    public function detail_keterangan(Request $req)
    {
        $data_pass = [
            'id'=> $req->id,
            'jenis_transaksi'=>'0',
            'id_perusahaan'=> $this->id_perusahaan,
        ];
        $data= $this->getDetailKeterangan($data_pass);
        return response()->json($data);
    }

    public function update_keterangan(Request $req, $id){
        $this->validate($req,[
            'nm_transaksi'=>'required',
            'id_akun_aktif'=> 'required',
            'posisi'=> 'required',
        ]);
        $array = [
            'nm_transaksi' => $req->nm_transaksi,
            'id_akun_aktif' => $req->id_akun_aktif,
            'posisi' => $req->posisi,
        ];

        $data = $this->update_keterangans($array, $id, $this->id_perusahaan);
        return response()->json($data);
    }

    public function delete_keterangans(Request $req, $id){
        if(empty($model = $this->delete_keterangan($id, $this->id_perusahaan))){
            return abort(404);
        }
        if($model->delete()){
            $data = [
                'message'=>'Anda telah menghapus akun',
                'id'=> $model->id_ket_transaksi
            ];
            return $data;
        }
    }
}
