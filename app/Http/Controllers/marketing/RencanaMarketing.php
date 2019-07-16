<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\BeliBarang as belibarangs;
use App\Model\Keuangan\RencanaPendBarang as RPB;
use App\Model\Keuangan\RencanaPendJasa as RPJ;
use App\Model\marketing\RencanaMarketingBarang as RMB;
use App\Model\marketing\RencanaMarketingJasa as RMJ;

use Session;

class RencanaMarketing extends Controller
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
       $data_rm = [
            'data_rpb' => RPB::orderBy('tahun','DESC')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_rpj' => RPJ::orderBy('tahun','DESC')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_pembelian'=> beliBarangs::all()->where('id_perusahaan', $this->id_perusahaan)->sortByDesc('created_at'),
			'data_rmb' => RMB::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_rmj' => RMJ::all()->where('id_perusahaan', $this->id_perusahaan)
			
        ];
		//dd($data_rab['beli_barang']);
        return view('user.marketing.section.RencanaMarketing.page_default', $data_rm);
		
    }
	
	//Rencana Marketing Barang
	
	public function storeRMB(Request $req)
    { 
        $this->validate($req,[
           'id_rencana_pend_brg'=> 'required',
		   'jum_klien_lama'=> 'required',
		   'jum_klien_baru'=> 'required',
		   'ket'=> 'required',
        ]);

        $id_rencana_pend_brg = $req->id_rencana_pend_brg;
        $jum_klien_lama = $req->jum_klien_lama;
        $jum_klien_baru = $req->jum_klien_baru;
        $ket = $req->ket;
		
        $model = new RMB;
        $model->id_rencana_pend_brg = $id_rencana_pend_brg;
        $model->jum_klien_lama = $jum_klien_lama;
        $model->jum_klien_baru = $jum_klien_baru;
        $model->ket = $ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
		
        if($model->save()){
            return redirect('Rencana-Marketing')->with('message_success', 'Ada telah menambahkan rencana marketing barang');
        }else{
            return redirect('Rencana-Marketing')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang rencana marketing barang Perusahaan Anda');
        }
    }
	
	public function editRMB($id)
    {
        if(empty($data_rmb = RMB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_rmb'=> $data_rmb
        ];
        return response()->json($data);
    }
	
	public function updateRMB (Request $req)
    { 
        $this->validate($req,[
			'jum_klien_lama_ubah'=>'required',
            'jum_klien_baru_ubah'=> 'required',
			'id_rencana_pend_brg_ubah'=> 'required',
			'ket_ubah'=> 'required',
            'id_rmb'=> 'required'
        ]);
	
		$jum_klien_lama = $req->jum_klien_lama_ubah;
		$jum_klien_baru = $req->jum_klien_baru_ubah;
		$id_rencana_pend_brg = $req->id_rencana_pend_brg_ubah;
		$ket = $req->ket_ubah;
		
        if(empty($model = RMB::where('id', $req->id_rmb)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke @ field di tabel RMB dg asiggment value dari hasil req di atas
		
		$model->jum_klien_lama =$jum_klien_lama;
        $model->jum_klien_baru =$jum_klien_baru;
		$model->id_rencana_pend_brg =$id_rencana_pend_brg;
		$model->ket =$ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
        if($model->save())
        {
            return redirect('Rencana-Marketing')->with('message_sucess','Anda baru saja mengubah data rencana marketing barang');
        }else
        {
            return redirect('Rencana-Marketing')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }
	
	public function deleteRMB(Request $req, $id)
    {
        $model = RMB::findOrFail($id);
        if($model->delete())
        {
            return redirect('Rencana-Marketing')->with('message_success','Anda telah menghapus rencana marketing barang');
        }else
        {
            return redirect('Rencana-Marketing')->with('message_fail','Terjadi kesalahan, silahkan coba ..!!');
        }
    }
	
	//Rencana Marketing Jasa
	
	public function storeRMJ(Request $req)
    { 
        $this->validate($req,[
           'id_rencana_pend_jasa'=> 'required',
		   'jum_klien_lama'=> 'required',
		   'jum_klien_baru'=> 'required',
		   'ket'=> 'required',
        ]);

        $id_rencana_pend_jasa = $req->id_rencana_pend_jasa;
        $jum_klien_lama = $req->jum_klien_lama;
        $jum_klien_baru = $req->jum_klien_baru;
        $ket = $req->ket;
		
        $model = new RMJ;
        $model->id_rencana_pend_jasa = $id_rencana_pend_jasa;
        $model->jum_klien_lama = $jum_klien_lama;
        $model->jum_klien_baru = $jum_klien_baru;
        $model->ket = $ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
		
        if($model->save()){
            return redirect('Rencana-Marketing')->with('message_success', 'Ada telah menambahkan rencana marketing jasa');
        }else{
            return redirect('Rencana-Marketing')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang rencana marketing barang Perusahaan Anda');
        }
    }
}
