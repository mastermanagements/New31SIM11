<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\marketing\RencanaMarketing as rencana_marketings;
use App\Model\marketing\EvaluasiMarketing as evaluasi_marketings;
use App\Model\marketing\KriteriaEvaluasi as kriteria_evaluasis;
use App\Model\marketing\IndikatorEvaluasi as indikator_evaluasis;
use App\Model\marketing\SolusiEvaluasi as solusi_evaluasis;
use Carbon\Carbon;
use Session;

class Evaluasi extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
	private $dimensi = ['Realtime','Audience','Acquisition','Behavior','Conversions'];
	
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
        $data = [
            'data_rm' => rencana_marketings::groupBy('bulan')->where('tahun',now()->year)->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_evaluasi' => evaluasi_marketings::all()->where('id_perusahaan', $this->id_perusahaan),
			'dimensi' =>$this-> dimensi,
			'kriteria_evaluasi' => kriteria_evaluasis::all(),
			'indikator_evaluasi' => indikator_evaluasis::all(),
			'solusi_evaluasi' => solusi_evaluasis::all()
			
			
        ];
		//dd($data['solusi_evaluasi']);
        return view('user.marketing.section.evaluasi.page_default', $data);
		
	}
	public function store_KE(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'kriteria_evaluasi' =>'required',
        ]);
        $kriteria_evaluasi = $req->kriteria_evaluasi;
		//
        $model = new kriteria_evaluasis();	
		$model->kriteria_evaluasi = $kriteria_evaluasi;
		$model->save();
		
        if($model->save())
        {
            return redirect('Evaluasi')->with('message_success','Anda telah menambah data kriteria evaluasi marketing');
          }else
            {
                return redirect('Evaluasi')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data kriteria evaluasi marketing');
            }
    }
	public function store_IE(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'indikator_evaluasi' =>'required',
        ]);
        $indikator_evaluasi = $req->indikator_evaluasi;
		//
        $model = new indikator_evaluasis();	
		$model->indikator_evaluasi = $indikator_evaluasi;
		$model->save();
		
        if($model->save())
        {
            return redirect('Evaluasi')->with('message_success','Anda telah menambah data indikator evaluasi marketing');
          }else
            {
                return redirect('Evaluasi')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data indikator evaluasi marketing');
            }
    }
	public function store_SE(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'solusi_evaluasi' =>'required',
        ]);
        $solusi_evaluasi = $req->solusi_evaluasi;
		//
        $model = new solusi_evaluasis();	
		$model->solusi = $solusi_evaluasi;
		$model->save();
		
        if($model->save())
        {
            return redirect('Evaluasi')->with('message_success','Anda telah menambah data solusi evaluasi evaluasi marketing');
          }else
            {
                return redirect('Evaluasi')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data solusi evaluasi marketing');
            }
    }
	
	public function store(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'id_kriteria_evaluasi' =>'required',
            'dimensi' =>'required',
            'id_indikator_evaluasi' =>'required',
            'jenis_content' =>'required',
            'id_solusi_evaluasi' =>'required',
        ]);
        $id_kriteria_evaluasi = $req->id_kriteria_evaluasi;
        $dimensi = $req->dimensi;
        $id_indikator_evaluasi = $req->id_kriteria_evaluasi;
        $jenis_content = $req->jenis_content;
        $link_url = $req->link_url;
        $id_solusi_evaluasi = $req->id_solusi_evaluasi;
        $ket = $req->ket;
		//
        $model = new evaluasi_marketings();	
		$model->id_kriteria_evaluasi = $id_kriteria_evaluasi;
		$model->dimensi = $dimensi;
		$model->id_indikator_evaluasi = $id_indikator_evaluasi;
		$model->jenis_content = $jenis_content;
		$model->link_url = $link_url;
		$model->ket = $ket;
		$model->id_solusi_evaluasi = $id_solusi_evaluasi;
		$model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		$model->save();
		
        if($model->save())
        {
            return redirect('Evaluasi')->with('message_success','Anda telah menambah data solusi evaluasi evaluasi marketing');
          }else
            {
                return redirect('Evaluasi')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data solusi evaluasi marketing');
            }
    }
	public function edit($id)
    {
        if(empty($evaluasi =  evaluasi_marketings::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'data_evaluasi'=> $evaluasi,
			'dimensi' =>$this-> dimensi,
			'kriteria_evaluasi' => kriteria_evaluasis::all(),
			'indikator_evaluasi' => indikator_evaluasis::all(),
			'solusi_evaluasi' => solusi_evaluasis::all()
        ];
		//dd($data['data_closing_e']);
		return view('user.marketing.section.evaluasi.page_edit', $data); 
    }
	
	public function update(Request $req, $id)
    { //dd($req->all());
        $this->validate($req, [
            'id_kriteria_evaluasi' =>'required',
            'dimensi' =>'required',
            'id_indikator_evaluasi' =>'required',
            'jenis_content' =>'required',
            'id_solusi_evaluasi' =>'required',
        ]);
		$id_kriteria_evaluasi = $req->id_kriteria_evaluasi;
        $dimensi = $req->dimensi;
        $id_indikator_evaluasi = $req->id_kriteria_evaluasi;
        $jenis_content = $req->jenis_content;
        $link_url = $req->link_url;
        $id_solusi_evaluasi = $req->id_solusi_evaluasi;
        $ket = $req->ket;
		
		$model = evaluasi_marketings::find($id);	
		//dd($models);
		$model->id_kriteria_evaluasi = $id_kriteria_evaluasi;
		$model->dimensi = $dimensi;
		$model->id_indikator_evaluasi = $id_indikator_evaluasi;
		$model->jenis_content = $jenis_content;
		$model->link_url = $link_url;
		$model->ket = $ket;
		$model->id_solusi_evaluasi = $id_solusi_evaluasi;
		$model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		
        if($model->save())
		
        {
            return redirect('Evaluasi')->with('message_success','Anda baru saja mengubah data Evaluasi Marketing');
            }else{
                return redirect('Evaluasi')->with('message_fail','Terjadi kesalahan, silahkan ulangi lagi');
            }
    }
	
	public function delete(Request $req, $id){
		
		$model = evaluasi_marketings::find($id);
		if($model->delete()){
			return redirect('Evaluasi')->with('message_success','Berhasil Menghapus data Evaluasi Marketing');
		} else{
			return redirect('Evaluasi')->with('message_fail','Gagal Menghapus data Evaluasi Marketing');
		}	
	}
}
