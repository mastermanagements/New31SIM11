<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\StrategiTahunan as ST;
use App\Model\Karyawan\StrategiBulanan as SB;
use App\Model\Karyawan\TargetTahunan as TT;
use App\Model\Karyawan\TargetBulanan as TB;

use Session;

class StrategiBulanan extends Controller
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
	
	
	public function store(Request $req)
    { //dd($req->all());
        $this->validate($req,[
           'id_stahunan'=> 'required',
		   'id_target_bulanan' => 'required',
           'isi_sbulanan'=> 'required'
        ]);

        $id_stahunan = $req->id_stahunan;
		$id_target_bulanan = $req->id_target_bulanan;
        $isi_sbulanan = $req->isi_sbulanan;

        $model = new SB;
        $model->id_stahunan = $id_stahunan;
		$model->id_target_bulanan = $id_target_bulanan;
        $model->isi_sbulanan = $isi_sbulanan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Strategi-Tahunan')->with('message_success', 'Ada telah menambahkan strategi Tahunan baru');
        }else{
            return redirect('Strategi-Tahunan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang strategi Tahunan Anda');
        }
    }
	public function edit($id)
    {
        if(empty($data_stahunan = ST::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_stahunan'=> $data_stahunan
        ];
        return response()->json($data);
    }
	public function update(Request $req)
    { //dd($req->all());

        $this->validate($req,[
            'id_sjpg_ubah' => 'required',
			'nm_stahunan_ubah'=>'required',
            'isi_stahunan_ubah'=> 'required',
            'id_stahunan'=> 'required'
        ]);
		
		$id_sjpg = $req->id_sjpg_ubah;
		$nm_stahunan = $req->nm_stahunan_ubah;
        $isi_stahunan = $req->isi_stahunan_ubah;
        
		
        if(empty($model = ST::where('id', $req->id_stahunan)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		
        $model->id_sjpg = $id_sjpg;
		$model->nm_stahunan =$nm_stahunan;
        $model->isi_stahunan =$isi_stahunan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Strategi-Tahunan')->with('message_sucess','Anda baru saja mengubah data strategi Tahunan perusahaan');
        }else
        {
            return redirect('Strategi-Tahunan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }
	
	public function delete(Request $req, $id)
    {
        if(empty($model = ST::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
           $res = [
               'message'=> 'Anda baru saja menghapus data strategi tahunan perusahaan',
               'status'=> true
           ];
           return response()->json($res);
        }else
        {
            $res = [
                'message'=> 'Terjadi Kesalahan, Silahkan hapus ulang data  anda',
                'status'=> true
            ];
            return response()->json($res);
        }
    }
	
	public function getTT()
    {
        $model = TT::all();
        return $model;
    }

    public function getStahunan($id=1)
    {
        $model = ST::all()->where('id_target_tahunan', $id);
        return $model;
    }

    public function ResponseStahunan($id_target_tahunan){
        return response()->json($this->getStahunan($id_target_tahunan));
    }
}
