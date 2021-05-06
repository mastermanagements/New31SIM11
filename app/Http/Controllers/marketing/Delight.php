<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Marketing\RencanaMarketing as rencana_marketings;
use App\Model\Administrasi\Klien as kliens;
use App\Model\Karyawan\Bagian as bagians;
use App\Model\Karyawan\Devisi as devisis;
use App\Model\Marketing\Delight as delights;
use App\Model\Marketing\ResponDelight as respon_delights ;

use Carbon\Carbon;
use Session;

class Delight extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
	private $tool_delight = ['Email','Telp','WA','Messengger','Telegram','Meet up'];

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
			'data_klien'=> kliens::all()->where('jenis_klien','0')->where('id_perusahaan', $this->id_perusahaan),
            'data_rm' => rencana_marketings::groupBy('bulan')->where('tahun',now()->year)->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_delight'=> delights::all()->where('id_perusahaan', $this->id_perusahaan),
			'tool_delight' =>$this->tool_delight,
			'bagian_p'=> bagians::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
		//dd($data['data_klien']);
        return view('user.marketing.section.delight.page_default', $data);

	}

	public function store(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'id_klien' =>'required',
            'tool_delight' =>'required',
            'content_delight' =>'required',
        ]);
        $id_klien = $req->id_klien;
        $tool_delight = $req->tool_delight;
        $content_delight = $req->content_delight;

		foreach($id_klien as $key =>$value)
		{
		$model = new delights();

        $model->id_klien = $value;
        $model->tool_delight = $tool_delight;
        $model->content_delight = $content_delight;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($model);
		$model->save();
		}

        if($model->save() )
        {
            return redirect('Delight')->with('message_success','Anda telah menambah data Delighting Marketing');
          }else
            {
                return redirect('Delight')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data anda');
            }
    }

	public function store_respon_delight(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'respon_klien' =>'required',
			'id_delight' =>'required',
        ]);
		$id_delight = $req->id_delight;
		$respon_klien = $req->respon_klien;
        $id_bagian = $req->id_bagian_p;
        $id_divisi = $req->id_divisi_p;

		$models = new respon_delights();
		$models->id_delight = $id_delight;
        $models->respon_klien = $respon_klien;
		$models->id_bagian = $id_bagian;
		$models->id_divisi = $id_divisi;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();

        if($models->save())
        {
            return redirect('Delight')->with('message_success','Anda telah menambah data respon delight');
          }else
            {
                return redirect('Delight')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba ulangi lagi');
            }
    }

	public function edit($id)
    {
        if(empty($respon_delight =  respon_delights::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'respon_delight'=> $respon_delight,
			'bagian_p'=> bagians::all(),
			'divisi_p'=> devisis::all(),
			'klien'=> kliens::all(),
			'tool_delight' =>$this->tool_delight,
			'delight'=> delights::where('id',$respon_delight->id_delight)->where('id_perusahaan', $this->id_perusahaan)->get()->first(),
			'bagian_p'=> bagians::all()->where('id_perusahaan', $this->id_perusahaan),
			'devisi_p'=> devisis::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
		//dd($data['response_delight']);
		return view('user.marketing.section.delight.page_edit', $data);
    }

	public function update(Request $req, $id)
    { //dd($req->all());
        $this->validate($req, [
            'id_delight' =>'required',
            'id_klien' =>'required',
            'tool_delight' =>'required',
            'content_delight' =>'required',
        ]);
		$id_klien = $req->id_klien;
		$id_delight = $req->id_delight;
        $tool_delight = $req->tool_delight;
        $content_delight = $req->content_delight;
		//
        $respon_klien = $req->respon_klien;
        $id_bagian = $req->id_bagian_p;
        $id_divisi = $req->id_divisi_p;
        //replace value ke tabel

		//$models = respon_delights::where('id_delight',$model->id)->first();

		//dd($models);
		$models = respon_delights::find($id);
		$models->id_delight = $id_delight;
		$models->respon_klien = $respon_klien;
		$models->id_bagian = $id_bagian;
		$models->id_divisi = $id_divisi;
		$models->id_perusahaan = $this->id_perusahaan;
		$models->id_karyawan = $this->id_karyawan;
		$models->save();

		$model = delights::where('id',$models->id_delight)->first();
		//dd($model);
		$model->id_klien = $id_klien;
		$model->tool_delight = $tool_delight;
		$model->content_delight = $content_delight;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;


        if($models->save() AND $model->save())

        {
            return redirect('Delight')->with('message_success','Anda baru saja mengubah data Delighting Marketing');
            }else{
                return redirect('Delight')->with('message_fail','Terjadi kesalahan, silahkan ulangi lagi');
            }
    }

	public function detail($id){

		 if(empty($delight =  delights::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'delight'=> $delight,
			'respon_delight'=> respon_delights::where('id_delight',$id)->where('id_perusahaan', $this->id_perusahaan)->get()
        ];
		//dd($data['st_closing']);
			return view('user.marketing.section.delight.detail_page', $data);
	}

	public function delete(Request $req, $id){

		$model = delights::find($id);
		if($model->delete()){
			return redirect('Delight')->with('message_success','Berhasil Menghapus data delighting');
		} else{
			return redirect('Delight')->with('message_fail','Gagal Menghapus data delighting');
		}
	}
}
