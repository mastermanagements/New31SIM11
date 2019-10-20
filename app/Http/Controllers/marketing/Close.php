<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\marketing\RencanaMarketing as rencana_marketings;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\Jasa as jasas;
use App\Model\Karyawan\Bagian as bagians;
use App\Model\Karyawan\Devisi as devisis;
use App\Model\Marketing\Closing as closings;
use App\Model\Marketing\StatusClosing as status_closings ;
use App\Model\Administrasi\Klien as kliens;
use Carbon\Carbon;
use Session;

class Close extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
	private $tool_closing = ['Email','Telp','WA','Messengger','Telegram','Meet up'];
	private $hasil_akhir = ['Deal','No Deal','Waiting Respond','No Respond','Follow Up'];
	private $status_closing = ['Open','Close'];
	
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
			'data_klien'=> kliens::orderBy('jenis_klien','1')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan),
			'tool_closing' =>$this->tool_closing,
			'status_closing_f' =>$this->status_closing,
			'hasil_akhir' =>$this->hasil_akhir,
			'bagian_p'=> bagians::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_closing'=> closings::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_closing_brg'=> closings::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_closing_jasa'=> closings::whereNotNull('id_jasa')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'status_closing'=> status_closings::groupBy('id_closing')->where('id_perusahaan', $this->id_perusahaan)->get()
			
        ];
		//dd($data['status_closing']);
        return view('user.marketing.section.close.page_default', $data);
		
	}
	
	public function store(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'id_klien' =>'required',
            'tool_closing' =>'required',
            'content_closing' =>'required',
            'hasil_akhir' =>'required',
            'status_closing' =>'required'
 
        ]);
        $id_klien = $req->id_klien;
		$id_barang = $req->id_barang;
        $id_jasa = $req->id_jasa;
		//
        $model = new closings();	
		$model->id_klien = $id_klien;
		$model->id_barang = $id_barang;
		$model->id_jasa = $id_jasa;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		$model->save();
		
		$id_closing = $model->id;
		$tool_closing = $req->tool_closing;
        $content_closing = $req->content_closing;
		$respon_klien = $req->respon_klien;
		$hasil_akhir = $req->hasil_akhir;
		$status_closing = $req->status_closing;
        $id_bagian = $req->id_bagian_p;
        $id_divisi = $req->id_divisi_p;
        $ket = $req->ket;
		
		//
		$models = new status_closings();
		
		$models->id_closing = $id_closing;
		$models->tool_closing = $tool_closing;
		$models->content_closing = $content_closing;
		$models->respon_klien = $respon_klien;
        $models->hasil_akhir = $hasil_akhir;
		$models->id_bagian = $id_bagian;
		$models->id_divisi = $id_divisi;
		$models->status_closing = $status_closing;
		$models->ket = $ket;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
			
        if($model->save() AND $models->save())
        {
            return redirect('Closing')->with('message_success','Anda telah menambah data Closing Marketing');
          }else
            {
                return redirect('Closing')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data Closing marketing');
            }
    }
	
	public function store_sclosing(Request $req)
    { //dd($req->all());
       $this->validate($req, [
            'tool_closing' =>'required',
            'content_closing' =>'required',
            'hasil_akhir' =>'required',
			'status_closing' =>'required',
        ]);
      
		$id_closing = $req->id_closing;
		$tool_closing = $req->tool_closing;
        $content_closing = $req->content_closing;
		$respon_klien = $req->respon_klien;
		$hasil_akhir = $req->hasil_akhir;
		$status_closing = $req->status_closing;
        $id_bagian = $req->id_bagian_p;
        $id_divisi = $req->id_divisi_p;
        $ket = $req->ket;
				
		$models = new status_closings();	
		$models->id_closing = $id_closing;
		$models->tool_closing = $tool_closing;
		$models->content_closing = $content_closing;
        $models->respon_klien = $respon_klien;
		$models->hasil_akhir = $hasil_akhir;
		$models->id_bagian = $id_bagian;
		$models->id_divisi = $id_divisi;
		$models->status_closing = $status_closing;
		$models->ket = $ket;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
			
        if($models->save())
        {
            return redirect('Closing')->with('message_success','Anda telah menambah data follow up closing');
          }else
            {
                return redirect('Closing')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba ulangi lagi');
            }
    }
	
	public function edit($id)
    {
        if(empty($status_closing =  status_closings::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'status_closing'=> $status_closing,
			'bagian_p'=> bagians::all(),
			'divisi_p'=> devisis::all(),
			'klien'=> kliens::all(),
			'barang'=> barangs::all(),
			'jasa'=> jasas::all(),
			'tool_closing' =>$this->tool_closing,
			'status_closing_f' =>$this->status_closing,
			'data_closing_e'=> closings::where('id',$status_closing->id_closing)->where('id_perusahaan', $this->id_perusahaan)->get()->first(),
			'hasil_akhir' =>$this->hasil_akhir,
			'bagian_p'=> bagians::all()->where('id_perusahaan', $this->id_perusahaan),
			'devisi_p'=> devisis::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
		//dd($data['data_closing_e']);
		return view('user.marketing.section.close.page_edit', $data); 
    }
	
	public function update(Request $req, $id)
    { //dd($req->all());
        $this->validate($req, [
            'id_closing' =>'required',
            'id_klien' =>'required',
            'tool_closing' =>'required',
            'content_closing' =>'required',
            'hasil_akhir' =>'required',
        ]);
		$id_klien = $req->id_klien;
		$id_barang = $req->id_barang;
        $id_jasa = $req->id_jasa;
		
		$id_closing = $req->id_closing;
		$tool_closing = $req->tool_closing;
        $content_closing = $req->content_closing;
        $respon_klien = $req->respon_klien;
		$status_closing = $req->status_closing;
		$hasil_akhir = $req->hasil_akhir;
        $id_bagian = $req->id_bagian_p;
        $id_divisi = $req->id_divisi_p;
        $ket = $req->ket;
        //insert value ke tabel
        
		$models = status_closings::find($id);	
		//$models = status_closings::where('id_closing',$model->id)->first();
		//dd($models);
		$models->id_closing = $id_closing;
		$models->tool_closing = $tool_closing;
		$models->content_closing = $content_closing;
		$models->respon_klien = $respon_klien;
		$models->hasil_akhir = $hasil_akhir;
		$models->status_closing = $status_closing;
		$models->id_bagian = $id_bagian;
		$models->id_divisi = $id_divisi;
		$models->ket = $ket;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		
		$model = closings::where('id',$models->id_closing)->first();	
		//dd($model);
		$model->id_klien = $id_klien;
		$model->id_barang = $id_barang;
		$model->id_jasa = $id_jasa;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		
        if($models->save() AND $model->save())
		
        {
            return redirect('Closing')->with('message_success','Anda baru saja mengubah data Closing Marketing');
            }else{
                return redirect('Closing')->with('message_fail','Terjadi kesalahan, silahkan ulangi lagi');
            }
    }
	
	public function detail($id){
		
		 if(empty($closing =  closings::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'closing'=> $closing,
			'status_closing'=> status_closings::where('id_closing',$id)->where('id_perusahaan', $this->id_perusahaan)->get()
        ];
		//dd($data['st_closing']);
			return view('user.marketing.section.close.detail_page', $data); 
	}
	public function delete(Request $req, $id){
		
		$model = closings::find($id);
		if($model->delete()){
			return redirect('Closing')->with('message_success','Berhasil Menghapus data closing');
		} else{
			return redirect('Closing')->with('message_fail','Gagal Menghapus data closing');
		}	
	}

}
