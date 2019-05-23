<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\TargetTahunan as TT;
use App\Model\Karyawan\TargetBulanan as TB;
use App\Model\Karyawan\TJP as TJP;
//use App\Helpers\Bulan as Bulan;
use Session;

class TargetBulanan extends Controller
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
          'target_bl'=> TB::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','asc')->paginate(12),
		  'per_thn'=> TB::select('id_th')->where('id_perusahaan', $this->id_perusahaan)
           ->groupBy('id_th')->orderBy('id_th', 'ASC')->paginate(12),
		   'per_bl'=> TB::select('bulan')->where('id_perusahaan', $this->id_perusahaan)
           ->groupBy('bulan')->orderBy('bulan', 'ASC')->paginate(12),
        ];
        return view('user.karyawan.section.TargetBulanan.page_default', $data_pass);
    }
	public function create()
    {
		$data_pass = [
          'target_th'=>TT::all()->where('id_perusahaan', $this->id_perusahaan), 
        ];
        return view('user.karyawan.section.TargetBulanan.page_create', $data_pass);
    }
	public function store(Request $req)
    { 
        $this->validate($req,[
		   'id_th'=> 'required',
           'bulan'=> 'required',
           'target_bulanan'=> 'required'
        ]);
		$id_th = $req->id_th;
        $bulan = $req->bulan;
		$target_bulanan = $req->target_bulanan;
		
		//instansiasi objek
        $model = new TB;
		$model->id_th = $id_th;
        $model->bulan = $bulan;
		$model->target_bulanan = $target_bulanan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Target-Bulanan')->with('message_success', 'Ada telah menambahkan Target Bulanan Perusahaan');
        }else{
            return redirect('Target-Bulanan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang target Bulanan perusahaan anda');
        }
    }
	public function edit($id)
    {
        if(empty($data_target_b = TB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		  $data_pass = [
          'target_th'=>TT::all()->where('id_perusahaan', $this->id_perusahaan),
		  'target_bulanan'=>$data_target_b
        ];
        return view('user.karyawan.section.TargetBulanan.page_edit', $data_pass);
    }
	public function update(Request $req, $id)
    {
		$this->validate($req,[
		   'id_th'=> 'required',
           'bulan'=> 'required',
           'target_bulanan'=> 'required'
        ]);

        $id_th = $req->id_th;
        $bulan = $req->bulan;
		$target_bulanan = $req->target_bulanan;

        $model = TB::find($id);
        $model->id_th = $id_th;
        $model->bulan = $bulan;
		$model->target_bulanan = $target_bulanan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		
        if($model->save())
        {
            return redirect('Target-Bulanan')->with('message_success','Anda telah Berhasil Mengubah Data Target Bulanan');
        }else
        {
            return redirect('Target-Bulanan')->with('message_fail','Terjadi kesalahan silahkan mengubah kembali Data anda..!');
        }
    }
	public function delete(Request $req, $id)
    {
        $model = TB::find($id);
        if($model->delete()){
            return redirect('Target-Bulanan')->with('message_success', 'Ada telah mengapus Target Bulanan Perusahaaan anda');    
        }else{
            return redirect('Target-Bulanan')->with('message_fail', 'Terjadi Kesalahan, Silahkan ubah data anda');
        }
    }
	
}
