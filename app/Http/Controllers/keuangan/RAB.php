<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\TargetEksekutif as TEks;
use App\Model\Karyawan\TargetStaf as TStaf;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\Jasa as jasas;
use App\Model\Keuangan\RencanaPendBarang as RPB;
use App\Model\Keuangan\RencanaPendJasa as RPJ;
use App\Model\Keuangan\RencanaPengeluaran as ROUT;
use App\Model\Keuangan\SubSubAkun as SSA;

use  Session;

class RAB extends Controller
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

	public function index()
    {
      $data_rab = [
      'data_rpb' => RPB::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_rpj' => RPJ::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_rout'=> ROUT::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_teks'=> TEks::orderBy('tahun', 'DESC')->groupBy('tahun')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_tstaf'=> TStaf::orderBy('bulan','J','F','M','A','M','Ju','Jul','Ag','S','O','N','D')->groupBy('bulan')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_subsub_akun'=> SSA::all()->where('id_perusahaan', $this->id_perusahaan)

        ];
  		//dd($data_rab['data_jasa']);
      if(empty(Session::get('tab2')) && empty(Session::get('tab3'))){
          Session::flash('tab1','tab1');
      }

      if(!empty(Session::get('tab2'))){
          Session::flash('tab2',Session::get('tab2'));
      }

      if(!empty(Session::get('tab3'))){
          Session::flash('tab3',Session::get('tab3'));
      }
        return view('user.keuangan.section.rab.page_default', $data_rab);
    }

	//-----Rencana Pendapatan Barang---

	public function storeRPB(Request $req)
    {
        $this->validate($req,[
       'tahun'=> 'required',
		   'bulan'=> 'required',
		   'id_barang'=> 'required',
		   'target_brg_terjual'=> 'required',
		   'target_klien_beli'=> 'required'
        ]);

        $tahun = $req->tahun;
        $bulan = $req->bulan;
        $id_barang = $req->id_barang;
        $target_brg_terjual = $req->target_brg_terjual;
        $target_klien_beli = $req->target_klien_beli;

        $model = new RPB;
        $model->tahun = $tahun;
        $model->bulan = $bulan;
        $model->id_barang = $id_barang;
        $model->target_brg_terjual = $target_brg_terjual;
        $model->target_klien_beli = $target_klien_beli;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());

        if($model->save()){
            return redirect('RAB')->with('message_success', 'Ada telah menambahkan rencana penjualan barang');
        }else{
            return redirect('RAB')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang rencana penjualan barang Perusahaan Anda');
        }
    }

	public function editRPB($id)
    {
        if(empty($data_rpb = RPB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_rpb'=> $data_rpb
        ];
        return response()->json($data);

    }

	public function updateRPB (Request $req)
    {
        $this->validate($req,[
			'tahun_ubah'=>'required',
      'bulan_ubah'=> 'required',
			'id_barang_ubah'=> 'required',
			'target_brg_terjual_ubah'=> 'required',
			'target_klien_beli_ubah'=> 'required',
      'id_rpb'=> 'required'
        ]);

		$tahun = $req->tahun_ubah;
		$bulan = $req->bulan_ubah;
		$id_barang = $req->id_barang_ubah;
		$target_brg_terjual = $req->target_brg_terjual_ubah;
		$target_klien_beli = $req->target_klien_beli_ubah;

        if(empty($model = RPB::where('id', $req->id_rpb)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke @ field di tabel RPB dg asiggment value dari hasil req di atas

		$model->tahun =$tahun;
        $model->bulan =$bulan;
		$model->id_barang =$id_barang;
		$model->target_brg_terjual =$target_brg_terjual;
		$model->target_klien_beli =$target_klien_beli;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
        if($model->save())
        {
            return redirect('RAB')->with('message_sucess','Anda baru saja mengubah data rencana penjualan barang');
        }else
        {
            return redirect('RAB')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

	public function deleteRPB(Request $req, $id)
    {
        $model = RPB::findOrFail($id);
        if($model->delete())
        {
            return redirect('RAB')->with('message_success','Anda telah menghapus rencana penjualan barang');
        }else
        {
            return redirect('RAB')->with('message_fail','Terjadi kesalahan, silahkan coba ..!!');
        }
    }

	//-----Rencana Pendapatan jasa-----

	public function storeRPJ(Request $req)
    {
        $this->validate($req,[
       'tahun'=> 'required',
		   'bulan'=> 'required',
		   'id_jasa'=> 'required',
		   'target_jasa_terjual'=> 'required',
		   'target_klien_beli'=> 'required'
        ]);

        $tahun = $req->tahun;
        $bulan = $req->bulan;
        $id_jasa = $req->id_jasa;
        $target_jasa_terjual = $req->target_jasa_terjual;
        $target_klien_beli = $req->target_klien_beli;

        $model = new RPJ;
        $model->tahun = $tahun;
        $model->bulan = $bulan;
        $model->id_jasa = $id_jasa;
        $model->target_jasa_terjual = $target_jasa_terjual;
        $model->target_klien_beli = $target_klien_beli;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());

        if($model->save()){
            return redirect('RAB')->with('message_success', 'Ada telah menambahkan rencana penjualan jasa')->with('tab3','tab3');
        }else{
            return redirect('RAB')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang rencana penjualan barang Perusahaan Anda')->with('tab3','tab3');
        }
    }

	public function editRPJ($id)
    {
        if(empty($data_rpj = RPJ::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_rpj'=> $data_rpj
        ];
        return response()->json($data);

    }

	public function updateRPJ (Request $req)
    {
        $this->validate($req,[
			'tahun_ubah'=>'required',
      'bulan_ubah'=> 'required',
			'id_jasa_ubah'=> 'required',
			'target_jasa_terjual_ubah'=> 'required',
			'target_klien_beli_ubah'=> 'required',
            'id_rpj'=> 'required'
        ]);

		$tahun = $req->tahun_ubah;
		$bulan = $req->bulan_ubah;
		$id_jasa = $req->id_jasa_ubah;
		$target_jasa_terjual = $req->target_jasa_terjual_ubah;
		$target_klien_beli = $req->target_klien_beli_ubah;

        if(empty($model = RPJ::where('id', $req->id_rpj)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke @ field di tabel RPB dg asiggment value dari hasil req di atas

		$model->tahun =$tahun;
        $model->bulan =$bulan;
		$model->id_jasa =$id_jasa;
		$model->target_jasa_terjual =$target_jasa_terjual;
		$model->target_klien_beli =$target_klien_beli;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
        if($model->save())
        {
            return redirect('RAB')->with('message_sucess','Anda baru saja mengubah data rencana penjualan jasa');
        }else
        {
            return redirect('RAB')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

	public function deleteRPJ(Request $req, $id)
    {
        $model = RPJ::findOrFail($id);
        if($model->delete())
        {
            return redirect('RAB')->with('message_success','Anda telah menghapus rencana penjualan jasa');
        }else
        {
            return redirect('RAB')->with('message_fail','Terjadi kesalahan, silahkan coba ..!!');
        }
    }

	//-----Rencana Pengeluaran---

	public function storeROUT(Request $req)
    {
        $this->validate($req,[
       'tahun'=> 'required',
		   'bulan'=> 'required',
		   'id_subsub_akun'=> 'required',
		   'jumlah_pengeluaran'=> 'required',
        ]);

        $tahun = $req->tahun;
        $bulan = $req->bulan;
        $id_subsub_akun = $req->id_subsub_akun;
        $jumlah_pengeluaran = rupiahController($req->jumlah_pengeluaran);

        $model = new ROUT;
        $model->tahun = $tahun;
        $model->bulan = $bulan;
        $model->id_subsub_akun = $id_subsub_akun;
        $model->jumlah_pengeluaran = $jumlah_pengeluaran;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());

        if($model->save()){
            return redirect('RAB')->with('message_success', 'Ada telah menambahkan rencana pengeluaran perusahaan');
        }else{
            return redirect('RAB')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang rencana penjualan barang Perusahaan Anda');
        }
    }

	public function editROUT($id)
    {
        if(empty($data_rout = ROUT::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_rout'=> $data_rout,

        ];
        return response()->json($data);

    }

	public function updateROUT (Request $req)
    {
        $this->validate($req,[
			'tahun_ubah'=>'required',
      'bulan_ubah'=> 'required',
			'id_subsub_akun_ubah'=> 'required',
			'jumlah_pengeluaran_ubah'=> 'required',
      'id_rout'=> 'required'
        ]);

		$tahun = $req->tahun_ubah;
		$bulan = $req->bulan_ubah;
		$id_subsub_akun = $req->id_subsub_akun_ubah;
		$jumlah_pengeluaran = rupiahController($req->jumlah_pengeluaran_ubah);

        if(empty($model = ROUT::where('id', $req->id_rout)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke @ field di tabel ROUT dg asiggment value dari hasil req di atas

		$model->tahun =$tahun;
    $model->bulan =$bulan;
		$model->id_subsub_akun =$id_subsub_akun;
		$model->jumlah_pengeluaran =$jumlah_pengeluaran;
    $model->id_perusahaan = $this->id_perusahaan;
    $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
        if($model->save())
        {
            return redirect('RAB')->with('message_success','Anda baru saja mengubah data rencana pengeluaran perusahaan');
        }else
        {
            return redirect('RAB')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

	public function deleteROUT(Request $req, $id)
    {
        $model = ROUT::findOrFail($id);
        if($model->delete())
        {
            return redirect('RAB')->with('message_success','Anda telah menghapus rencana pengeluaran perusahaan');
        }else
        {
            return redirect('RAB')->with('message_fail','Terjadi kesalahan, silahkan coba ..!!');
        }
    }
}
