<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Marketing\RencanaMarketing as rencana_marketings;
use App\Model\Marketing\MediaMarketing as media_marketings;
use App\Model\Marketing\SubMediaMarketing as submedia_marketings;
use App\Model\Marketing\RmFase as rm_fase;
use App\Model\Marketing\RmSTP as rm_stp;
use App\Model\Marketing\RmSasaran as rm_sasaran;
use App\Model\Marketing\ContentMarketing as content_marketings;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\Jasa as jasas;
use App\Model\Marketing\Targeting as targetings;
use App\Model\Marketing\HasilSegmenting as hasilsg;
use App\Model\Marketing\PelMarketing as pel_marketings;
use App\Model\Marketing\KegMarketingHarian as km_harian;

use Carbon\Carbon;
use Session;

class RencanaMarketing extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
	private $fase_m = ['Attract (Pengenalan)','Convert (Branding)','Close (Penjualan)','Delighting (Pemeliharaan)'];
	private $fase_rm = ['Attract (Pengenalan)','Convert (Branding)','Delighting (Pemeliharaan)','Evaluating (Evaluasi)'];
	private $sasaran_m = ['Umum','Leads','Customer'];


	public function __construct()
    {
        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
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

			'fase_m'=> $this->fase_m,
			'fase_rm'=> $this->fase_rm,
			'sasaran_m'=> $this->sasaran_m,

			'data_rm_fase_b' => rm_fase::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->groupBy('tgl_rencana_terbit','id_barang')->get(),
			'data_rm_fase_j' => rm_fase::whereNotNull('id_jasa')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_rm_stp' => rm_stp::groupBy('id_rm')->where('id_perusahaan', $this->id_perusahaan)->get(),

			'data_mm_off'=> media_marketings::all()->where('jenis_media','0'),
			'data_mm_on'=> media_marketings::all()->where('jenis_media','1'),
			'data_submm'=> submedia_marketings::all(),

			'hasil_targeting' => targetings::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_hasilsg_brg' => hasilsg::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->get(),

			'tahun_rm_off'=> rencana_marketings::where('off_on','0')->groupBy('tahun')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'tahun_rm_on'=> rencana_marketings::where('off_on','1')->groupBy('tahun')->where('id_perusahaan', $this->id_perusahaan)->get(),

			'waktu_now'=> Carbon::now(),
			'data_sasaran' => rm_sasaran::all()->where('id_perusahaan', $this->id_perusahaan),

			'pel_marketing'=> pel_marketings::all()->where('id_perusahaan', $this->id_perusahaan),
			'keg_market_harian'=> km_harian::all()->where('id_perusahaan', $this->id_perusahaan),

        ];
		//dd($data_pass['data_sasaran']);
        return view('user.marketing.section.rencana_marketing.page_default', $data_pass);
    }

	public function search_rmbj(Request $req){
        $data = [
            'data_rm_off' => rencana_marketings::all()->where('off_on','0')->where('tahun',$req->tahun_cari)->where('id_perusahaan', $this->id_perusahaan),

			'data_rm_on' => rencana_marketings::all()->where('off_on','1')->where('tahun',$req->tahun_cari)->where('id_perusahaan', $this->id_perusahaan),

			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan),

			'fase_m'=> $this->fase_m,
			'sasaran_m'=> $this->sasaran_m,
			'data_rm_fase' => rm_fase::all()->sortBy('tgl_rencana_terbit')->where('id_perusahaan', $this->id_perusahaan),
            'data_rm_produk_b' => rm_produk::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_rm_produk_j' => rm_produk::whereNotNull('id_jasa')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_rm_sasaran' => rm_sasaran::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_rm_stp' => rm_stp::groupBy('id_rm')->where('id_perusahaan', $this->id_perusahaan)->get(),

			'data_mm_off'=> media_marketings::all()->where('jenis_media','0'),
			'data_mm_on'=> media_marketings::all()->where('jenis_media','1'),
			'data_submm'=> submedia_marketings::all(),

			'hasil_targeting' => targetings::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_hasilsg_brg' => hasilsg::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->get(),

			'tahun_rm_off'=> rencana_marketings::where('off_on','0')->groupBy('tahun')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'tahun_rm_on'=> rencana_marketings::where('off_on','1')->groupBy('tahun')->where('id_perusahaan', $this->id_perusahaan)->get()

        ];

        return view('user.marketing.section.rencana_marketing.page_default', $data);
    }

	public function create(Request $req){
		//dd($req->all());
		$data = [
			'off_on'=> $req->off_on
		];
        return view('user.marketing.section.rencana_marketing.page_create', $data);
    }

	public function store_rmb_onOff(Request $req)
    {
       $this->validate($req, [
            'tahun' =>'required',
            'off_on' =>'required',
        ]);
        $tahun = $req->tahun;
        $bulan = $req->bulan;


		$off_on = $req->off_on;


		foreach($bulan as $key =>$value){

        $models = new rencana_marketings();
		$models->tahun = $tahun;
        $models->bulan = $value;
		$models->off_on = $off_on;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		}


        if($models->save())
        {
            return redirect('Rencana-Marketing')->with('message_success','Anda telah menambah data Rencana Marketing');
          }else
            {
                return redirect('Rencana-Marketing')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data Rencana Marketing perusahaan anda');
            }
    }

	public function store_rmb(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'id_barang' =>'required',
            'fase_marketing' =>'required',
			'id_media_marketing' =>'required',
			'tgl_rencana_terbit' =>'required',
			'id_content_marketing' =>'required',
			'sasaran_klien' =>'required',
        ]);
		$id_rm = $req->id_rm;
		$tgl_rencana_terbit = date('Y-m-d', strtotime($req->tgl_rencana_terbit));
		$fase_marketing = $req->fase_marketing;
		$id_media_marketing = $req->id_media_marketing;
		$id_submedia_marketing = $req->id_submedia_marketing;
		$id_content_marketing = $req->id_content_marketing;
		$id_barang = $req->id_barang;


		$model = new rm_fase();
        $model->id_rm = $id_rm;
		$model->tgl_rencana_terbit = $tgl_rencana_terbit;
        $model->fase_marketing = $fase_marketing;
		$model->id_media_marketing = $id_media_marketing;
		$model->id_submedia_marketing = $id_submedia_marketing;
		$model->id_content_marketing = $id_content_marketing;
		$model->id_barang = $id_barang;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		$model->save();

		$last_id_rm_fase = $model->id;
		$sasaran_klien = $req->sasaran_klien;

		foreach($sasaran_klien as $key =>$value)
		{
		$models = new rm_sasaran();
		$models->id_rm_fase = $last_id_rm_fase;
		$models->sasaran_klien = $value;
		$models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		}
        if($model->save() AND $models->save())
        {
            return redirect('Rencana-Marketing')->with('message_success','Anda telah menambah data Rencana Marketing Barang');
          }else
            {
                return redirect('Rencana-Marketing')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data Rencana Marketing Barang anda');
            }
    }

	public function store_rmj(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'id_jasa' =>'required',
            'fase_marketing' =>'required',
			'id_media_marketing' =>'required',
			'tgl_rencana_terbit' =>'required',
			'id_content_marketing' =>'required',
			'sasaran_klien' =>'required',
        ]);
		$model = new rm_fase();
        $model->id_rm = $id_rm;
		$model->tgl_rencana_terbit = $tgl_rencana_terbit;
        $model->fase_marketing = $fase_marketing;
		$model->id_media_marketing = $id_media_marketing;
		$model->id_submedia_marketing = $id_submedia_marketing;
		$model->id_content_marketing = $id_content_marketing;
		$model->id_jasa = $id_jasa;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		$model->save();

		$last_id_rm_fase = $model->id;
		$sasaran_klien = $req->sasaran_klien;

		foreach($sasaran_klien as $key =>$value)
		{
		$models = new rm_sasaran();
		$models->id_rm_fase = $last_id_rm_fase;
		$models->sasaran_klien = $value;
		$models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		}
        if($model->save() AND $models->save())
        {
            return redirect('Rencana-Marketing')->with('message_success','Anda telah menambah data Rencana Marketing Jasa');
          }else
            {
                return redirect('Rencana-Marketing')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data Rencana Marketing Jasa anda');
            }
    }

	public function store_target_audience(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'id_targeting' =>'required',

        ]);

		$id_rm = $req->id_rm;
		$id_targeting = $req->id_targeting;

		foreach($id_targeting as $key =>$value){

        $model = new rm_stp();
		$model->id_rm = $id_rm;
        $model->id_targeting = $value;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		$model->save();
		}

        if($model->save())
        {
            return redirect('Rencana-Marketing')->with('message_success','Anda telah menambah Target Auudience pada Rencana Marketing Barang');
          }else
            {
                return redirect('Rencana-Marketing')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi Target Auudience pada Rencana Marketing Barang');
            }
    }

	public function delete(Request $req, $id)
    {
        if(empty($data = rm_fase::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        if($data->delete())
        {
            return redirect('Rencana-Marketing')->with('message_success','Anda telah menghapus rencana marketing');
        }
        else
        {
            return redirect('Rencana-Marketing')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba menghapus rencana marketing anda');
        }
    }

	public function getMedia()
    {
        $model = media_marketings::all();
        return $model;
    }

    public function getSubMedia($id=1)
    {
        $model = submedia_marketings::all()->where('id_media_marketing', $id);
        return $model;
    }

    public function ResponseSubMedia($id_submedia_marketing){
        return response()->json($this->getSubMedia($id_submedia_marketing));
    }

	//======

	public function getSubMarketing()
    {
        $model = submedia_marketings::all();
        return $model;
    }

    public function getContentMarketing($id=1)
    {
        $model = content_marketings::all()->where('id_submedia_marketing', $id);
        return $model;
    }

    public function ResponseContentMarketing($id_content_marketing){
        return response()->json($this->getContentMarketing($id_content_marketing));
    }

	public function store_keg_marketing(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'tema_content' =>'required',
            'id_keg_marketing' =>'required',

        ]);
		$id_rm_fase = $req->id_rm_fase;
        $tema_content = $req->tema_content;


        $model = new pel_marketings();
		$model->id_rm_fase = $id_rm_fase;
		$model->tema_content = $tema_content;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		$model->save();

		$last_id_pel_m = $model->id;
		$id_keg_marketing = $req->id_keg_marketing;
		$count_keg_m = count($id_keg_marketing);

		for($i=0; $i< $count_keg_m; $i++)
		{
		$models = new km_harian();
		$models->id_pel_m = $last_id_pel_m;
		$models->id_keg_marketing = $id_keg_marketing[$i];
		$models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		}

        if ($model->save() AND $models->save())
        {
            return redirect('Rencana-Marketing')->with('message_success','Anda telah menambah Kegiatan Marketing Barang Off Line');
          }else
            {
                return redirect('Rencana-Marketing')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi Kegiatan Marketing Barang Off Line');
            }
    }

	public function get_data_RM($id)
    {
        if(empty($data_rm = rencana_marketings::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data_pass = [
            'data'=> $data_rm
        ];
        return response()->json($data_pass);
    }

	public function get_data_KM($id)
    {
        if(empty($data_km = rm_fase::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data_pass = [
            'data'=> $data_km->getContentMarketing->kegiatan_marketing
			//'data'=> $data_rm->getRmProduct->getBarang
        ];
        return response()->json($data_pass);
    }


}
