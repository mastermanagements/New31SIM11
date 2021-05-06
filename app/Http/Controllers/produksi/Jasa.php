<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Jasa as jasas;
use App\Model\Produksi\Satuan as satuans;
use App\Model\Produksi\ProsesBisnis as probis;
use App\Model\Produksi\SKJasa as skjasas;
use App\Model\Produksi\Barang as barangs;
use App\Model\Marketing\Promo;

use Session;

class Jasa extends Controller
{

     private $id_perusahaan;
     private $id_karyawan;
     private $waktu_selesai = ['0'=>'Pasti','1'=>'Estimasi'];
     private $metode_promo = ['Promo Barang','Promo Jasa'];

       public function __construct(){
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
                'data_jasa'=>jasas::all()->where('id_perusahaan', $this->id_perusahaan),
                'proses_bisnis'=>probis::all()->where('id_perusahaan', $this->id_perusahaan),
                'skjasa'=>skjasas::all()->where('id_perusahaan', $this->id_perusahaan),
                'metode_promo'=>$this->metode_promo,
                'promo_jasa'=>Promo::where('id_perusahaan', $this->id_perusahaan)->where('jenis_promo','1')->get()
              ];
              //dd ($data['skjasa']);
              if(empty(Session::get('tab2')) && empty(Session::get('tab3')) && empty(Session::get('tab6'))){
                  Session::flash('tab1','tab1');
              }

              if(!empty(Session::get('tab2'))){
                  Session::flash('tab2',Session::get('tab2'));
              }

              if(!empty(Session::get('tab3'))){
                  Session::flash('tab3',Session::get('tab3'));
              }

              if(!empty(Session::get('tab6'))){
                  Session::flash('tab6',Session::get('tab6'));
              }

      return view('user.produksi.section.jasa.page_default', $data);
    }

    public function create()
    {
      $satuan = satuans::all();
      $waktu_selesai = $this->waktu_selesai;
        return view('user.produksi.section.jasa.page_create', ['satuan'=>$satuan], ['waktu_selesai'=>$waktu_selesai]);
    }

    public function store(Request $request)
    { //dd($req->all());
      $this->validate($request,[
          'nm_layanan'=> 'required',
          'peritem' => 'required',
          'id_satuan'=> 'required',
          'waktu_kerja' => 'required',
          'satuan_waktu' => 'required',
          'waktu_selesai' => 'required',
          'biaya' => 'required'
      ]);

     $model = new jasas();
     $model->nm_layanan = $request->nm_layanan;
     $model->peritem = $request->peritem;
     $model->id_satuan = $request->id_satuan;
     $model->waktu_kerja = $request->waktu_kerja;
     $model->satuan_waktu = $request->satuan_waktu;
     $model->waktu_selesai = $request->waktu_selesai;
     $model->biaya = $request->biaya;
     $model->ket = $request->ket;
     $model->id_karyawan = $this->id_karyawan;
     $model->id_perusahaan = $this->id_perusahaan;

     if($model->save())
     {
        return redirect('Jasa')->with('message_success','Berhasil tambah data layanan jasa');
      }else{
          return redirect('Jasa')->with('message_fail','Gagal tambah data layanan jasa');
      }

    }

    public function edit($id)
    {
      $data = ['data_jasa'=> jasas::findorFail($id),
              'satuan'=> satuans::all(),
              'waktu_selesai'=>$this->waktu_selesai
              ];

      return view('user.produksi.section.jasa.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
          'nm_layanan'=>'required',
          'peritem'=>'required',
          'id_satuan'=>'required',
          'waktu_kerja'=>'required',
          'satuan_waktu'=>'required',
          'waktu_selesai'=>'required',
          'biaya'=>'required'
      ]);

      $model = jasas::where('id_perusahaan', $this->id_perusahaan)->find($id);
      $model->nm_layanan = $req->nm_layanan;
      $model->peritem = $req->peritem;
      $model->id_satuan = $req->id_satuan;
      $model->waktu_kerja = $req->waktu_kerja;
      $model->satuan_waktu = $req->satuan_waktu;
      $model->waktu_selesai = $req->waktu_selesai;
      $model->biaya = $req->biaya;
      $model->ket = $req->ket;
      $model->id_karyawan = $this->id_karyawan;

      if($model->save()){
          return redirect('Jasa')->with('message_success','Data layanan telah diubah');
      }else{
          return redirect('Jasa')->with('message_fail','Data layanan gagal diubah');
      }
    }

    public function destroy(Request $req, $id)
    {
        $model = jasas::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id); //bisa jg pake findorFail($id);
        if($model->delete()){
            return redirect('Jasa')->with('message_success','Berhasil menghapus data layanan jasa');
        }else{
            return redirect('Jasa')->with('message_fail','Gagal, menghapus layanan jasa');
        }
    }
}
