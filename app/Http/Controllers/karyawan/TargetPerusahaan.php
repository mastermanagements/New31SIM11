<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\TJP as TJP;
use App\Model\Karyawan\TargetTahunan as TT;
use App\Model\Karyawan\TargetBulanan as TB;
use App\Model\Karyawan\Bagian as Bagian;
use App\Model\Karyawan\Devisi as Divisi;
use App\Model\Superadmin_ukm\U_jabatan_p as Jabatan;

use Session;

class TargetPerusahaan extends Controller
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
	/* -- menampilkan target jangka panjang, target tahunan & target bulanan--*/
	public function index()
    {
        $data_pass= [
		'data_tjp'=> TJP::all()->where('id_perusahaan',$this->id_perusahaan),
		'data_tt'=> TT::all()->where('id_perusahaan', $this->id_perusahaan),
		'data_tb'=> TB::all()->where('id_perusahaan', $this->id_perusahaan),
		'bagian_p'=>Bagian::all()->where('id_perusahaan', $this->id_perusahaan),
		'divisi_p'=>Divisi::all()->where('id_perusahaan', $this->id_perusahaan),
		'jabatan_p'=>Jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
		//dd($data_pass['data_tjp']);
        return view('user.karyawan.section.TargetPerusahaan.page_default', $data_pass);
		
    }
	
	/* -- target jangka panjang --*/
	public function create()
    {
        return view('user.karyawan.section.TargetPerusahaan.page_create');
    }
	public function store(Request $req)
    { //dd($req->all());
        $this->validate($req,[
		   'nm_tjp'=> 'required',
           'periode'=> 'required',
		   'thn_mulai'=> 'required',
		   'thn_selesai'=> 'required',
		   'isi_tjp'=> 'required'
        ]);
		$nm_tjp = $req->nm_tjp;
		$periode = $req->periode;
        $thn_mulai = $req->thn_mulai;
		//konversi tahun mulai integer to year
		$thn_mulai = date($thn_mulai);
		
		$thn_selesai = $req->thn_selesai;
		//konversi tahun selesai integer to year
		$thn_selesai = date($thn_selesai);
		$isi_tjp = $req->isi_tjp;
		
		//instansiasi objek
        $model = new TJP;
		$model->nm_tjp = $nm_tjp;
        $model->periode = $periode;
		$model->thn_mulai = $thn_mulai;
		$model->thn_selesai = $thn_selesai;
		$model->isi_tjp= $isi_tjp;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		
        if($model->save()){
            return redirect('Target-Perusahaan')->with('message_success', 'Ada telah menambahkan Target Jangka Panjang Perusahaan');
        }else{
            return redirect('Target-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang Target Jangka Panjang perusahaan anda');
        }
    }
	
	public function edit($id)
    {
        if(empty($data_tjp = TJP::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_tjp'=> $data_tjp
        ];
        return response()->json($data);
    }
	
	public function update(Request $req)
    { 
        $this->validate($req,[
            'nm_tjp_ubah' => 'required',
			'periode_ubah'=>'required',
            'thn_mulai_ubah'=> 'required',
			'thn_selesai_ubah'=> 'required',
			'isi_tjp_ubah'=> 'required',
            'id_mtjp'=> 'required'
        ]);
		
		$nm_tjp = $req->nm_tjp_ubah;
		$periode = $req->periode_ubah;
		$thn_mulai = $req->thn_mulai_ubah;
		$thn_selesai = $req->thn_selesai_ubah;
		$isi_tjp = $req->isi_tjp_ubah;
		
        if(empty($model = TJP::where('id', $req->id_mtjp)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		
		$model->nm_tjp = $nm_tjp;
		$model->periode =$periode;
        $model->thn_mulai =$thn_mulai;
		$model->thn_selesai =$thn_selesai;
		$model->isi_tjp =$isi_tjp;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
        if($model->save())
        {
            return redirect('Target-Perusahaan')->with('message_sucess','Anda baru saja mengubah data Target Jangka Panjang perusahaan');
        }else
        {
            return redirect('Target-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }
	
	public function delete(Request $req, $id)
    {
        if(empty($model = TJP::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
           $res = [
               'message'=> 'Anda baru saja menghapus data target jangka panjang perusahaan',
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

    public function getTJP($id=1)
    {
        $model = TJP::all()->where('id_tjps', $id);
        return $model;
    }

    public function ResponseTJP($id_tjps){
        return response()->json($this->getTJP($id_tjps));
    }
	
	
	/* -- target tahunan--*/
	public function storeTtahunan(Request $req)
    { //dd($req->all());
        $this->validate($req,[
           'id_tjp'=> 'required',
		   'tahun'=> 'required',
		   'id_bagian_p' => 'required',
		   'id_divisi_p' => 'required',
		   'id_jabatan_p' => 'required',
           'target_tahunan'=> 'required'
        ]);

        $id_tjp = $req->id_tjp;
		$tahun = $req->tahun;
		$id_bagian_p = $req->id_bagian_p;
		$id_divisi_p = $req->id_divisi_p;
		$id_jabatan_p = $req->id_jabatan_p;
        $target_tahunan = $req->target_tahunan;

        $model = new TT;
        $model->id_tjp = $id_tjp;
		$model->tahun = $tahun;
		$model->id_bagian_p = $id_bagian_p;
        $model->id_divisi_p = $id_divisi_p;
		$model->id_jabatan_p = $id_jabatan_p;
		$model->target_tahunan = $target_tahunan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Target-Perusahaan')->with('message_success', 'Ada telah menambahkan Target Tahunan baru');
        }else{
            return redirect('Target-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang Target Tahunan Anda');
        }
    }
	
	public function editTtahunan($id)
    {
        if(empty($data_tt = TT::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_tt'=> $data_tt
        ];
        return response()->json($data);
		
    }
	
	public function updateTtahunan(Request $req)
    { 
        $this->validate($req,[
            'id_tjp_ubah' => 'required',
			'tahun_ubah'=>'required',
            'id_bagian_p_ubah'=> 'required',
			'id_divisi_p_ubah'=> 'required',
			'id_jabatan_p_ubah'=> 'required',
			'target_tahunan_ubah'=> 'required',
            'id_Ttahunan'=> 'required'
        ]);
		
		$id_tjp = $req->id_tjp_ubah;
		$tahun = $req->tahun_ubah;
		$id_bagian_p = $req->id_bagian_p_ubah;
		$id_divisi_p = $req->id_divisi_p_ubah;
		$id_jabatan_p = $req->id_jabatan_p_ubah;
		$target_tahunan = $req->target_tahunan_ubah;
		
        if(empty($model = TT::where('id', $req->id_Ttahunan)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke @ field di tabel TT dg asiggment value dari hasil req di atas
		$model->id_tjp = $id_tjp;
		$model->tahun =$tahun;
        $model->id_bagian_p =$id_bagian_p;
		$model->id_divisi_p =$id_divisi_p;
		$model->id_jabatan_p =$id_jabatan_p;
		$model->target_tahunan =$target_tahunan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
        if($model->save())
        {
            return redirect('Target-Perusahaan')->with('message_sucess','Anda baru saja mengubah data Target Tahunan perusahaan');
        }else
        {
            return redirect('Target-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }
	
	public function deleteTtahunan(Request $req, $id)
    {
        if(empty($model = TT::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
           $res = [
               'message'=> 'Anda baru saja menghapus data target tahunan perusahaan',
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
	
	
	public function getTtahunan($id=1)
    {
        $model = TT::all()->where('id_tt', $id);
        return $model;
    }

    public function ResponseTtahunan($id_tt){
        return response()->json($this->getTtahunan($id_tt));
    }

	/* -- target bulanan --*/
	public function storeTbulanan(Request $req)
    { //dd($req->all());
        $this->validate($req,[
           'id_target_tahunan'=> 'required',
		   'bulan'=> 'required',
		   'target_bulanan' => 'required'
        ]);

        $id_target_tahunan = $req->id_target_tahunan;
		$bulan = $req->bulan;
		$target_bulanan = $req->target_bulanan;

        $model = new TB;
        $model->id_target_tahunan = $id_target_tahunan;
		$model->bulan = $bulan;
		$model->target_bulanan = $target_bulanan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Target-Perusahaan')->with('message_success', 'Ada telah menambahkan Target Bulanan baru');
        }else{
            return redirect('Target-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang Target Bulanan Anda');
        }
    }
	
	public function editTbulanan($id)
    {
        if(empty($data_tb = TB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_tb'=> $data_tb
        ];
        return response()->json($data);
    }
	
	public function updateTbulanan(Request $req)
    { 
        $this->validate($req,[
            'id_tt_ubah' => 'required',
			'bulan_ubah'=>'required',
			'target_bulanan_ubah'=> 'required',
            'id_Tbulanan'=> 'required'
        ]);
		
		$id_target_tahunan = $req->id_tt_ubah;
		$bulan = $req->bulan_ubah;
		$target_bulanan = $req->target_bulanan_ubah;
		
        if(empty($model = TB::where('id', $req->id_Tbulanan)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke @ field di tabel TB dg asiggment value dari hasil req di atas
		$model->id_target_tahunan = $id_target_tahunan;
		$model->bulan =$bulan;
		$model->target_bulanan =$target_bulanan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
		
        if($model->save())
        {
            return redirect('Target-Perusahaan')->with('message_sucess','Anda baru saja mengubah data Target Bulanan perusahaan');
        }else
        {
            return redirect('Target-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }
	
	public function deleteTbulanan(Request $req, $id)
    {
        if(empty($model = TB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
           $res = [
               'message'=> 'Anda baru saja menghapus data target Bulanan perusahaan',
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
	
	public function getTbulanan($id=1)
    {
        $model = TB::all()->where('id_tb', $id);
        return $model;
    }

    public function ResponseTbulanan($id_tb){
        return response()->json($this->getTbulanan($id_tb));
    }
}
