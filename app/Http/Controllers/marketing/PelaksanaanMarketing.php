<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\marketing\RencanaMarketing as rencana_marketings;
use App\Model\marketing\MediaMarketing as media_marketings;
use App\Model\marketing\SubMediaMarketing as submedia_marketings;
use App\Model\marketing\RmFase as rm_fase;
use App\Model\marketing\RmSTP as rm_stp;
use App\Model\marketing\RmSasaran as rm_sasaran;
use App\Model\marketing\ContentMarketing as content_marketings;
use App\Model\produksi\Barang as barangs;
use App\Model\produksi\Jasa as jasas;
use App\Model\marketing\PelMarketing as pel_marketings;
use App\Model\marketing\ResponLeads as respon_leads;
use App\Model\marketing\KegMarketingHarian as km_harian;

use Session;
use Carbon\Carbon;
class PelaksanaanMarketing extends Controller
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
        $data_pass = [
           
			'data_rm_off' => rencana_marketings::all()->where('off_on','0')->where('tahun',now()->year)->where('id_perusahaan', $this->id_perusahaan),
            
			'data_rm_on' => rencana_marketings::all()->where('off_on','1')->where('tahun',now()->year)->where('id_perusahaan', $this->id_perusahaan),
			
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan),
			
			'data_rm_fase_b' => rm_fase::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_rm_fase_j' => rm_fase::whereNotNull('id_jasa')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_rm_stp' => rm_stp::groupBy('id_rm')->where('id_perusahaan', $this->id_perusahaan)->get(),
			
			'data_mm_off'=> media_marketings::all()->where('jenis_media','0'),
			'data_mm_on'=> media_marketings::all()->where('jenis_media','1'),
			'data_submm'=> submedia_marketings::all(),
			'waktu_now'=> Carbon::now(),
			
			'pel_marketing'=> pel_marketings::all()->where('id_perusahaan', $this->id_perusahaan),
			'keg_market_harian'=> km_harian::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_sasaran' => rm_sasaran::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_respon_leads'=> respon_leads::groupBy('id_pel_m')->where('id_perusahaan', $this->id_perusahaan)->get()
        ];
		//dd($data_pass['data_respon_attract']);
        return view('user.marketing.section.pelaksanaan_marketing.attract.page_default', $data_pass);
	}
	
	public function index_convert()
    {
        $data_pass = [
           
			'data_rm_off' => rencana_marketings::all()->where('off_on','0')->where('tahun',now()->year)->where('id_perusahaan', $this->id_perusahaan),
            
			'data_rm_on' => rencana_marketings::all()->where('off_on','1')->where('tahun',now()->year)->where('id_perusahaan', $this->id_perusahaan),
			
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan),
			
			'data_rm_fase_b' => rm_fase::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_rm_fase_j' => rm_fase::whereNotNull('id_jasa')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_rm_stp' => rm_stp::groupBy('id_rm')->where('id_perusahaan', $this->id_perusahaan)->get(),
			
			'data_mm_off'=> media_marketings::all()->where('jenis_media','0'),
			'data_mm_on'=> media_marketings::all()->where('jenis_media','1'),
			'data_submm'=> submedia_marketings::all(),
			'waktu_now'=> Carbon::now(),
			
			'pel_marketing'=> pel_marketings::all()->where('id_perusahaan', $this->id_perusahaan),
			'keg_market_harian'=> km_harian::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_sasaran' => rm_sasaran::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_respon_leads'=> respon_leads::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
		//dd($data_pass['pel_marketing']);
        return view('user.marketing.section.pelaksanaan_marketing.convert.page_default', $data_pass);
	}
	
	public function store_respon_attract(Request $req)
    { 
       $this->validate($req, [
            'id_pel_m' =>'required'
        ]);
        $id_pel_m = $req->id_pel_m;
        $jum_like = $req->jum_like;
        $jum_comment = $req->jum_comment;
        $jum_share = $req->jum_share;
        $jum_follower = $req->jum_follower;
        $ket = $req->ket;
		
        $models = new respon_leads();	
		$models->id_pel_m = $id_pel_m;
        $models->jum_like = $jum_like;
		$models->jum_comment = $jum_comment;
		$models->jum_share = $jum_share;
		$models->jum_follower = $jum_follower;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();	
		
        if($models->save())
        {
            return redirect('Attract')->with('message_success','Anda telah menambahkan data respon leads');
          }else
            {
                return redirect('Attract')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data respon leads perusahaan anda');
            }
    }
	
	public function store_respon_convert(Request $req)
    { 
       $this->validate($req, [
            'id_pel_m' =>'required'
        ]);
        $id_pel_m = $req->id_pel_m;
        $jum_like = $req->jum_like;
        $jum_comment = $req->jum_comment;
        $jum_share = $req->jum_share;
        $jum_follower = $req->jum_follower;
        $ket = $req->ket;
		
        $models = new respon_leads();	
		$models->id_pel_m = $id_pel_m;
        $models->jum_like = $jum_like;
		$models->jum_comment = $jum_comment;
		$models->jum_share = $jum_share;
		$models->jum_follower = $jum_follower;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();	
		
		
        if($models->save())
        {
            return redirect('Convert')->with('message_success','Anda telah menambahkan data respon leads');
          }else
            {
                return redirect('Convert')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data respon leads perusahaan anda');
            }
    }
}	
