<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\TJP as TJP;
use App\Model\Karyawan\TargetTahunan as TT;
use App\Model\Karyawan\TargetBulanan as TB;
use App\Model\Karyawan\SJP as SJP;
use App\Model\Karyawan\StrategiTahunan as ST;
use App\Model\Karyawan\StrategiBulanan as SB;
use Session;

class StrategiPerusahaan extends Controller
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
	
	/*--- halaman SJP + STahunan + Sbulanan ----*/
	public function index()
    {
        $data_pass= [
		  'data_tjp'=> TJP::all()->where('id_perusahaan', $this->id_perusahaan),
          'data_tt'=> TT::all()->where('id_perusahaan', $this->id_perusahaan),
		  'tahun_tt'=> TT::select('tahun')->where('id_perusahaan', $this->id_perusahaan)
           ->groupBy('tahun'),
		  'strategi_jp'=> SJP::all()->where('id_perusahaan', $this->id_perusahaan),
		  'strategi_tahunan'=> ST::all()->where('id_perusahaan', $this->id_perusahaan),
		  'data_tbulanan'=> TB::all()->where('id_perusahaan', $this->id_perusahaan)
		 
        ];
		//dd($data_pass['data_bulanan']);
        return view('user.karyawan.section.StrategiPerusahaan.page_default', $data_pass);
    }
	
	/*--- Strategi Jangka Panjang ----*/
	
	public function storeSJP(Request $req)
    { 
        $this->validate($req,[
           'id_tjp'=> 'required',
		   'isi_sjp'=> 'required'
        ]);

        $id_tjp = $req->id_tjp;
        $isi_sjp = $req->isi_sjp;

        $model = new SJP;
        $model->id_tjp = $id_tjp;
        $model->isi_sjp = $isi_sjp;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
		
        if($model->save()){
            return redirect('Strategi-Perusahaan')->with('message_success', 'Ada telah menambahkan strategi Jangka Panjang Perusahaan');
        }else{
            return redirect('Strategi-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang strategi Jangka Panjang Perusahaan Anda');
        }
    }
	
	public function editSJP($id)
    {
        if(empty($data_sjp_u = SJP::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_sjp'=> $data_sjp_u
        ];
        return response()->json($data);
    }
	
	public function updateSJP(Request $req)
    { //dd($req->all());
		//validasi harus di isi
        $this->validate($req,[
            'id_sjp'=> 'required',
			'isi_sjp_ubah'=> 'required'
        ]);
		//tampung di variabel
        $isi_sjp = $req->isi_sjp_ubah;
        
        if(empty($model = SJP::where('id', $req->id_sjp)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke field nilai dari variabel yg berisi data request
        $model->isi_sjp =$isi_sjp;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Strategi-Perusahaan')->with('message_sucess','Anda baru saja mengubah data strategi Jangka Panjang perusahaan');
        }else
        {
            return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }
	
	public function deleteSJP(Request $req, $id)
    {
        if(empty($model = SJP::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
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
	
	public function getSJP($id=1)
    {
        $model = SJP::all()->where('id_sjp', $id);
        return $model;
    }

    public function ResponseSJP($id_sjp){
        return response()->json($this->getSJP($id_sjp));
    }
	
	/*--- Strategi Tahunan ----*/
	
	public function storeStahunan(Request $req)
    { 
		//validasi input
        $this->validate($req,[
           'id_sjp'=> 'required',
		   'id_target_tahunan'=> 'required',
		   'isi_stahunan'=> 'required'
        ]);
		//tampung nilai req ke variabel
        $id_sjp = $req->id_sjp;
        $id_target_tahunan = $req->id_target_tahunan;
        $isi_stahunan = $req->isi_stahunan;
		
		//instansiasi 
        $model = new ST;
		
		//insert variabel yg berisi nilai req ke field tabel ST
        $model->id_sjp = $id_sjp;
        $model->id_target_tahunan = $id_target_tahunan;
        $model->isi_stahunan = $isi_stahunan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
		
        if($model->save()){
            return redirect('Strategi-Perusahaan')->with('message_success', 'Ada telah menambahkan strategi Jangka Tahunan Perusahaan');
        }else{
            return redirect('Strategi-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang strategi Tahuan Perusahaan Anda');
        }
    }
	
	public function editStahunan($id)
    {
        if(empty($data_stahunan_u = ST::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_stahunan'=> $data_stahunan_u
        ];
        return response()->json($data);
    }
	
	public function updateStahunan(Request $req)
    { //dd($req->all());
		//validasi harus di isi
        $this->validate($req,[
            'id_stahunan'=> 'required',
			'isi_stahunan_ubah'=> 'required'
        ]);
		//tampung di variabel
        $isi_stahunan = $req->isi_stahunan_ubah;
        
        if(empty($model = ST::where('id', $req->id_stahunan)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke field nilai dari variabel yg berisi data request
        $model->isi_stahunan =$isi_stahunan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Strategi-Perusahaan')->with('message_sucess','Anda baru saja mengubah data strategi Tahunan perusahaan');
        }else
        {
            return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }
	
	public function deleteStahunan(Request $req, $id)
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
	
	
	public function getStahunan($id=1)
    {
        $model = ST::all()->where('id_st', $id);
        return $model;
    }

    public function ResponseStahunan($id_st){
        return response()->json($this->getStahunan($id_st));
    }
	
	/*--- Strategi Bulanan ----*/
	
	public function storeSbulanan(Request $req)
    { 
		//validasi input
        $this->validate($req,[
			'id_stahunan'=> 'required',
            'id_target_bulanan'=> 'required',
		    'isi_sbulanan'=> 'required'
        ]);
		//tampung nilai req ke variabel
        $id_stahunan = $req->id_stahunan;
        $id_target_bulanan = $req->id_target_bulanan;
        $isi_sbulanan = $req->isi_sbulanan;
		
		//instansiasi 
        $model = new SB;
		
		//insert variabel yg berisi nilai req ke field tabel ST
        $model->id_stahunan = $id_stahunan;
        $model->id_target_bulanan = $id_target_bulanan;
        $model->isi_sbulanan = $isi_sbulanan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
		
        if($model->save()){
            return redirect('Strategi-Perusahaan')->with('message_success', 'Ada telah menambahkan strategi Bulanan Perusahaan');
        }else{
            return redirect('Strategi-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang strategi Tahuan Perusahaan Anda');
        }
    }
	
	public function editSbulanan($id)
    {
        if(empty($data_sbulanan_u = SB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_sbulanan'=> $data_sbulanan_u
        ];
        return response()->json($data);
    }
	
	public function updateSbulanan(Request $req)
    { //
		//validasi harus di isi
        $this->validate($req,[
            'id_sbulanan'=> 'required',
			'isi_sbulanan_ubah'=> 'required'
        ]);
		//tampung di variabel
        $isi_sbulanan = $req->isi_sbulanan_ubah;
        
        if(empty($model = SB::where('id', $req->id_sbulanan)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke field nilai dari variabel yg berisi data request
        $model->isi_sbulanan =$isi_sbulanan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
        if($model->save())
        {
            return redirect('Strategi-Perusahaan')->with('message_sucess','Anda baru saja mengubah data strategi Bulanan perusahaan');
        }else
        {
            return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }
	
	public function deleteSbulanan(Request $req, $id)
    {
        if(empty($model = SB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
           $res = [
               'message'=> 'Anda baru saja menghapus data strategi bulanan perusahaan',
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
	
	
	public function getSbulanan($id=1)
    {
        $model = ST::all()->where('id_sb', $id);
        return $model;
    }

    public function ResponseSbulanan($id_sb){
        return response()->json($this->getStahunan($id_sb));
    }
}
