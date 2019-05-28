<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\TJP as TJP;
use App\Model\Karyawan\Bagian as Bagian;
use App\Model\Karyawan\Devisi as Divisi;
use App\Model\Superadmin_ukm\U_jabatan_p as Jabatan;
use App\Model\Karyawan\TargetTahunan as TT;

use Session;

class TargetTahunan extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
	
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
        $data_pass= [
		  
          'data_tt'=> TT::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','asc')->paginate(12),
		  
		  'tjpg'=> TT::select('id_tjpg')->where('id_perusahaan', $this->id_perusahaan)
           ->groupBy('id_tjpg')->orderBy('id_tjpg', 'ASC')->paginate(12),
		   
		  'tahun_tt'=> TT::all()->where('id_perusahaan', $this->id_perusahaan)
       
        ];
		//dd($data_pass['tahun_tt']);
        return view('user.karyawan.section.TargetTahunan.page_default', $data_pass);
    }
	
	public function create()
    {
		$data_pass = [
          'target_jpg'=>TJP::all()->where('id_perusahaan', $this->id_perusahaan),
		  'bagian_p'=>Bagian::all()->where('id_perusahaan', $this->id_perusahaan),
		  'divisi_p'=>Divisi::all()->where('id_perusahaan', $this->id_perusahaan),
		  'jabatan_p'=>Jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.karyawan.section.TargetTahunan.page_create', $data_pass);
    }
	 public function store(Request $req)
    { 
        $this->validate($req,[
		   'id_tjpg'=> 'required',
           'tahun'=> 'required',
		   'id_bagian_p'=> 'required',
		   'id_divisi_p'=> 'required',
		   'id_jabatan_p'=> 'required',
           'target_tahunan'=> 'required'
        ]);
		$id_tjpg = $req->id_tjpg;
        $tahun = $req->tahun;
		//konversi tahun integer to year
		$tahun = date($tahun);
		$id_bagian_p = $req->id_bagian_p;
		$id_divisi_p = $req->id_divisi_p;	
        $id_jabatan_p = $req->id_jabatan_p;
		$target_tahunan = $req->target_tahunan;
		
		//instansiasi objek
        $model = new TT;
		$model->id_tjpg = $id_tjpg;
        $model->tahun = $tahun;
		$model->id_bagian_p = $id_bagian_p;
		$model->id_divisi_p = $id_divisi_p;
        $model->id_jabatan_p = $id_jabatan_p;
		$model->target_tahunan = $target_tahunan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Target-Tahunan')->with('message_success', 'Ada telah menambahkan Target Tahunan Perusahaan');
        }else{
            return redirect('Target-Tahunan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang target Tahunan perusahaan anda');
        }
    }
	
	public function edit($id)
    {
        if(empty($data_target_t = TT::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		  $data_pass = [
          'target_jpg'=>TJP::all()->where('id_perusahaan', $this->id_perusahaan),
		  'bagian_p'=>Bagian::all()->where('id_perusahaan', $this->id_perusahaan),
		  'divisi_p'=>Divisi::all()->where('id_perusahaan', $this->id_perusahaan),
		  'jabatan_p'=>Jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
		  'target_tahunan'=>$data_target_t
        ];
        return view('user.karyawan.section.TargetTahunan.page_edit', $data_pass);
    }
	
	public function update(Request $req, $id)
    {
		$this->validate($req,[
		   'id_tjpg'=> 'required',
           'tahun'=> 'required',
		   'id_bagian_p'=> 'required',
		   'id_divisi_p'=> 'required',
		   'id_jabatan_p'=> 'required',
           'target_tahunan'=> 'required'
        ]);

        $id_tjpg = $req->id_tjpg;
        $tahun = $req->tahun;
		//konversi tahun integer to year
		$tahun = date($tahun);
		$id_bagian_p = $req->id_bagian_p;
		$id_divisi_p = $req->id_divisi_p;	
        $id_jabatan_p = $req->id_jabatan_p;
		$target_tahunan = $req->target_tahunan;

        $model = TT::find($id);
        $model->id_tjpg = $id_tjpg;
        $model->tahun = $tahun;
		$model->id_bagian_p = $id_bagian_p;
		$model->id_divisi_p = $id_divisi_p;
        $model->id_jabatan_p = $id_jabatan_p;
		$model->target_tahunan = $target_tahunan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		
        if($model->save())
        {
            return redirect('Target-Tahunan')->with('message_success','Anda telah Berhasil Mengubah Data Target Tahunan');
        }else
        {
            return redirect('Target-Tahunan')->with('message_fail','Terjadi kesalahan silahkan mengubah kembali Data anda..!');
        }
    }
	
	 public function delete(Request $req, $id)
    {
        $model = TT::find($id);
        if($model->delete()){
            return redirect('Target-Tahunan')->with('message_success', 'Ada telah mengapus Target Tahunan Perusahaaan anda');    
        }else{
            return redirect('Target-Tahunan')->with('message_fail', 'Terjadi Kesalahan, Silahkan ubah ulang strategi anda');
        }
    }
}
