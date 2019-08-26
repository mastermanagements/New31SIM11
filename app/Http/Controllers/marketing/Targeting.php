<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Marketing\ContentSegmenting as contentsg;
use App\Model\Marketing\HasilSegmenting as hasilsg; 
use App\Model\Marketing\Targeting as targetings;
use App\Model\Marketing\PolaTargeting as pola_targetings;
use App\Model\Marketing\PertanyaanTargeting as pertanyaan_targetings;
use App\Model\Marketing\JawabanTargeting as jawaban_targetings;

use Session;

class Targeting extends Controller
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
        $data = [
			
			'data_hasilsg_brg' => hasilsg::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_hasilsg_jasa' => hasilsg::whereNotNull('id_jasa')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_pola_targeting' => pola_targetings::all(),
			'pertanyaan_targeting' => pertanyaan_targetings::all(),
			'hasil_targeting' => targetings::all()->where('id_perusahaan', $this->id_perusahaan)
			
        ];
		//dd($data_segmenting['select_tahun']);
        return view('user.marketing.section.targeting.page_default', $data);
    }
	
	public function store(Request $req)
    { //validasi
		//dd($req->all());
       $this->validate($req, [
            'id_hasil_segmenting' =>'required',
            'id_pola_targeting' =>'required',
        ]);
        $id_hasil_segmenting = $req->id_hasil_segmenting;
        $id_pola_targeting = $req->id_pola_targeting;
        
        $models = new targetings();
        $models->id_hasil_segmenting = $id_hasil_segmenting;
        $models->id_pola_targeting = $id_pola_targeting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		
		 //ambil get id_targeting
		$last_targeting_id = $models->id;
		$id_pertanyaan_targeting = $req->id_pertanyaan_targeting;
		$jawaban_kriteria = $req->jawaban_kriteria;
		
		//hitung jumlah_pertanyaan
		$jum_tanya= pertanyaan_targetings::count();
		
		for($i=0; $i< $jum_tanya; $i++)
		{
		$modelss = new jawaban_targetings();
        $modelss->id_targeting = $last_targeting_id;
        $modelss->id_pertanyaan_targeting = $id_pertanyaan_targeting[$i];
        $modelss->jawaban_kriteria = $jawaban_kriteria[$i];
        $modelss->id_perusahaan = $this->id_perusahaan;
        $modelss->id_karyawan = $this->id_karyawan;
		$modelss->save(); 
		}
		
		//dd($req->all());
        if($models->save()  AND $modelss->save() )
        {
            return redirect('Targeting')->with('message_success','Anda telah menambah data Targeting');
          }else
            {
                return redirect('Targeting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data Targeting perusahaan anda');
            }
    }
}
