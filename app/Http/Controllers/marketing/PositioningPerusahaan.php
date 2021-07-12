<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_Kompetitor as kompetitors;
use App\Model\Marketing\PositioningPerusahaan as posisi_usaha;
use App\Model\Marketing\PositioningMarketing as posisi_marketing;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\Jasa as jasas;
use Session;

class PositioningPerusahaan extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;

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
	
	public function index(){
        $data=[
            'data_posisi_p'=> posisi_usaha::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_kompetitor'=> kompetitors::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_posisi_m'=> posisi_marketing::all(),
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.marketing.section.positioning_perusahaan.page_default', $data);
    }
	
	public function create(){
		$data=[
			'data_kompetitor'=> kompetitors::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_posisi_m'=> posisi_marketing::all(),
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
		//dd($data['data_posisi_m']);
        return view('user.marketing.section.positioning_perusahaan.page_create',$data);
    }
	
	public function store(Request $req)
    {
        $this->validate($req,[
            'id_kompetitor' => 'required',
            'posisi_k' => 'required',
            'posisi_p' =>'required',
        ]);

        $id_kompetitor = $req->id_kompetitor;
		$id_barang = $req->id_barang;
        $plus_produk_k = $req->plus_produk_k;
        $minus_produk_k = $req->minus_produk_k;
        $value_produk_k = $req->value_produk_k;
        $posisi_k = $req->posisi_k;
		$plus_produk_p = $req->plus_produk_p;
        $minus_produk_p = $req->minus_produk_p;
        $value_produk_p = $req->value_produk_p;
        $posisi_p = $req->posisi_p;

        $model = new posisi_usaha;
        $model->id_kompetitor = $id_kompetitor;
        $model->id_barang = $id_barang;
        $model->plus_produk_k = $plus_produk_k;
        $model->minus_produk_k = $minus_produk_k;
        $model->value_produk_k = $value_produk_k;
        $model->posisi_k = $posisi_k;
		$model->plus_produk_p = $plus_produk_p;
        $model->minus_produk_p = $minus_produk_p;
        $model->value_produk_p = $value_produk_p;
        $model->posisi_p = $posisi_p;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Positioning')->with('message_success', 'Anda telah menambah data positining perusahaan');
        }else{
            return redirect('Positioning')->with('message_fail', 'Maaf terjadi kesalahan, silahkan coba lagi untuk menambah data positining perusahaan anda');
        }
    }
	
	public function edit($id)
    {
        if(empty($data_posisi_p = posisi_usaha::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data_pass = [
            'data_posisi_p' => $data_posisi_p,
			'data_kompetitor' => kompetitors::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_barang' => barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_posisi_m'=> posisi_marketing::all()
        ];
		//dd($data_pass['data_kompetitor']);
        return view('user.marketing.section.positioning_perusahaan.page_edit',$data_pass);
    }
	
	public function update(Request $req,$id)
    { 
        $this->validate($req,[
            'id_kompetitor' => 'required',
            'posisi_k' => 'required',
            'posisi_p' =>'required',
        ]);

        $id_kompetitor = $req->id_kompetitor;
		$id_barang = $req->id_barang;
        $plus_produk_k = $req->plus_produk_k;
        $minus_produk_k = $req->minus_produk_k;
        $value_produk_k = $req->value_produk_k;
        $posisi_k = $req->posisi_k;
		$plus_produk_p = $req->plus_produk_p;
        $minus_produk_p = $req->minus_produk_p;
        $value_produk_p = $req->value_produk_p;
        $posisi_p = $req->posisi_p;

        $model=posisi_usaha::find($id);
        $model->id_kompetitor = $id_kompetitor;
        $model->id_barang = $id_barang;
        $model->plus_produk_k = $plus_produk_k;
        $model->minus_produk_k = $minus_produk_k;
        $model->value_produk_k = $value_produk_k;
        $model->posisi_k = $posisi_k;
		$model->plus_produk_p = $plus_produk_p;
        $model->minus_produk_p = $minus_produk_p;
        $model->value_produk_p = $value_produk_p;
        $model->posisi_p = $posisi_p;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Positioning')->with('message_success', 'Anda telah mengubah data Positioning Perusahaan');
        }else{
            return redirect('Positioning')->with('message_fail', 'Maaf terjadi kesalahan, silahkan coba lagi untuk mengubah data Positioning Perusahaan');
        }
    }
	
	public function delete(Request $req,$id)
  {
        $model = posisi_usaha::find($id);

        if($model->delete())
        {
            return redirect('Positioning')->with('message_success','Berhasil menghapus data Positioning Perusahaan');
        }
        else {
            return redirect('Positioning')->with('message_error','Terjadi Kesahalan, Coba Lagi');
        }
  }
  
  public function detail($id)
    {
        if(empty($data_posisi_p = posisi_usaha::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'data_posisi_p' => $data_posisi_p,
			'data_kompetitor' => kompetitors::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_barang' => barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_posisi_m'=> posisi_marketing::all()
        ];
        return view('user.marketing.section.positioning_perusahaan.detail_page',$data_pass);
    }
	
}
