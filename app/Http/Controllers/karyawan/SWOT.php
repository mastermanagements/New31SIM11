<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\SWOT as swots;
use Session;

class SWOT extends Controller
{

    private $id_karyawan;
    private $id_perusahaan;
    private $jenis_swot = ['strenght','weakness','opportunity','threats'];

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

    public function index()
    {
        $data_SWOT = [
          'data_swot' => swots::all()->where('id_perusahaan', $this->id_perusahaan)->sortBy('tahun_swot'),
            'tahun_swot'=> swots::select('tahun_swot')->where('id_perusahaan', $this->id_perusahaan)
               ->groupBy('tahun_swot')->orderBy('tahun_swot', 'DESC')->paginate(6)
        ];
        return view('user.karyawan.section.Swot.page_default', $data_SWOT);
    }

    public function create()
    {
        $data_pass=[
          'jenis_swot'=> $this->jenis_swot
        ];
        return view('user.karyawan.section.Swot.page_create', $data_pass);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'tahun_swot' => 'required|numeric',
            'kategori_swot' => 'required',
            'Isi' => 'required'
        ]);

        $tahun_anggaran = $req->tahun_swot;
        $kategori_swot = $req->kategori_swot;
        $isi = $req->Isi;

        $model = swots::updateOrCreate([
            'id_perusahaan'=>$this->id_perusahaan,
            'id_karyawan'=>$this->id_karyawan,
            'kategori_swot'=>$kategori_swot,
            'tahun_swot'=>$tahun_anggaran
        ],['Isi'=> $isi]);

        if($model->save())
        {
            return redirect('Swot')->with('message_success','Anda telah membuat '.$kategori_swot);
        }else{
            return redirect('Swot')->with('message_fail','Terjadi kesalahan, silahkan coba lagi untuk '.$kategori_swot);
        }

    }
}