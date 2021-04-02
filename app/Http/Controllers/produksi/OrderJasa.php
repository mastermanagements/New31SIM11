<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\OrderJasa as OJ;
use App\Model\Produksi\DetailOrderJasa as DOJ;
use App\Model\Administrasi\Klien as kliens;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\Jasa as jasas;
use Session;

class OrderJasa extends Controller
{
    private $id_perusahaan;
    private $id_karyawan;
    private $status_service = ['Baru masuk','Sedang dikerjakan','Lanjut service','Cancel service','Gagal service','Berhasil service','Selesai quality control','Perbaikan ulang','Perbaikan garansi'];
    private $status_konfirm = ['Belum Konfirm ke Klien','Sudah Konfirm ke Klien'];
    private $status_ambil = ['Belum diambil','Sudah diambil'];

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
                'order_jasa'=>OJ::all()->where('id_perusahaan', $this->id_perusahaan),
                'klien'=>kliens::all()->where('id_perusahaan', $this->id_perusahaan),
                'status_service'=>$this->status_service,
                'status_konfirm'=>$this->status_konfirm,
                'status_ambil'=>$this->status_ambil
              ];
              //dd ($data['skjasa']);
              if(empty(Session::get('tab2'))) {
                  Session::flash('tab1','tab1');
              }

              if(!empty(Session::get('tab2'))){
                  Session::flash('tab2',Session::get('tab2'));
              }


      return view('user.produksi.section.jasa.order_jasa.page_default', $data);
    }


    public function create()
    {
      $data = kliens::all()->where('id_perusahaan', $this->id_perusahaan);
            //dd($data['klien']);
          return view('user.produksi.section.jasa.order_jasa.page_create', ['klien'=>$data]);

    }

    public function store(Request $request)
    {
      $this->validate($request,[
          'tgl_order'=> 'required',
          'id_klien' => 'required'

      ]);

     $model = new OJ();
     $model->tgl_order = tanggalController($request->tgl_order);
     $model->id_klien = $request->id_klien;
     $model->status_service = $request->status_service;
     $model->id_karyawan = $this->id_karyawan;
     $model->id_perusahaan = $this->id_perusahaan;

     if($model->save())
     {
        return redirect('Order-Jasa')->with('message_success','Berhasil tambah order jasa');
      }else{
          return redirect('Order-Jasa')->with('message_fail','Gagal tambah data order jasa');
      }

    }


    public function edit($id)
    {
      $data = ['order_jasa'=> OJ::findorFail($id),
              'klien'=> kliens::all()->where('id_perusahaan', $this->id_perusahaan)
              ];

      return view('user.produksi.section.jasa.order_jasa.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
          'tgl_order'=>'required',
          'id_klien'=>'required'
      ]);

      $model = OJ::where('id_perusahaan', $this->id_perusahaan)->find($id);
      $model->tgl_order = tanggalController($req->tgl_order);
      $model->id_klien = $req->id_klien;
      $model->id_karyawan = $this->id_karyawan;

      if($model->save()){
          return redirect('Order-Jasa')->with('message_success','Data order jasa telah diubah');
      }else{
          return redirect('Order-Jasa')->with('message_fail','Data order jasa  gagal diubah');
      }
    }


    public function destroy($id)
    {
      $model = OJ::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id); //bisa jg pake findorFail($id);
      if($model->delete()){
          return redirect('Order-Jasa')->with('message_success','Berhasil menghapus data order jasa');
      }else{
          return redirect('Order-Jasa')->with('message_fail','Gagal, menghapus order  jasa');
      }
    }

    public function rincian_orderjasa($id)
    {
      $data = [
          'order_jasa'=> OJ::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFaiL($id),
          'barang'=> barangs::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
          'jasa'=> jasas::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
          'perusahaan'=>Session::get('id_perusahaan_karyawan'),
          'grand_total'=>DOJ::where('id_perusahaan', $this->id_perusahaan)->sum('total_biaya'),
      ];
      //dd($data['jasa']);
      return view('user.produksi.section.jasa.rincian_order_jasa.page_create', $data);
    }

    public function rincian_orderjasa_store(Request $req, $id){
        $this->validate($req,[
           'id_jasa'=> 'required',
           'qty'=> 'required',
           'biaya'=> 'required',
           'diskon'=> 'required',
           'total_biaya'=>'required'
        ]);
        $model = OJ::where('id_perusahaan', $this->id_perusahaan)->findOrFail($id);

        $model_insert_doj =new DOJ();

        $model_insert_doj->id_order_jasa = $id;
        $model_insert_doj->id_jasa = $req->id_jasa;
        $model_insert_doj->id_barang = $req->id_barang;
        $model_insert_doj->qty = $req->qty;
        $model_insert_doj->biaya = $req->biaya;
        $model_insert_doj->diskon = $req->diskon;
        $model_insert_doj->total_biaya = $req->total_biaya;
        $model_insert_doj->ket = $req->ket;
        $model_insert_doj->id_karyawan = $this->id_karyawan;

        if($model_insert_doj->save()){
            return redirect()->back()->with('message_success','rincian order jasa telah ditambahkan');
        }else{
            return redirect()->back()->with('message_error','rincian order jasa gagal ditambahkan');
        }
    }

    public function rincian_orderjasa_update(Request $req, $id){
        $this->validate($req,[
          'id_jasa'=> 'required',
          'qty'=> 'required',
          'biaya'=> 'required',
          'diskon'=> 'required'
        ]);

        $total_biaya = 0;
        $model_rincian_oj = DOJ::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);

        $model_rincian_oj->id_jasa = $req->id_jasa;
        $model_rincian_oj->id_barang = $req->id_barang;
        $model_rincian_oj->biaya = $req->biaya;
        $model_rincian_oj->qty = $req->qty;
        $model_rincian_oj->diskon = $req->diskon;
        $model_rincian_oj->ket = $req->ket;

        $total_biaya = $req->biaya * $req->qty;

        if($req->diskon!=0){
            $diskon = $total_biaya*($req->diskon/100);
            $total_biaya = $total_biaya - $diskon;
        }
        $model_rincian_oj->total_biaya= $total_biaya;
        $model_rincian_oj->id_perusahaan= $this->id_perusahaan;
        $model_rincian_oj->id_karyawan = $this->id_karyawan;

        if($model_rincian_oj->save()){
            return redirect()->back()->with('message_success','data telah di upate');
        }else{
            return redirect()->back()->with('message_error','data gagal diupdate');
        }
    }

    public function uangmuka_orderjasa_store(Request $req, $id){
        $this->validate($req,[
           'uang_muka'=> 'required'
        ]);
        $model = OJ::where('id_perusahaan', $this->id_perusahaan)->findOrFail($id);
        $model->uang_muka = $req->uang_muka;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect()->back()->with('message_success','uang muka order jasa telah ditambahkan');
        }else{
            return redirect()->back()->with('message_error','uang muka order jasa gagal ditambahkan');
        }
    }
    public function rincian_orderjasa_delete(Request $req, $id)
    {
        $model = DOJ::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id); //bisa jg pake findorFail($id);
        if($model->delete()){
            return redirect()->back()->with('message_success','Berhasil menghapus data item order layanan');
        }else{
            return redirect()->back()->with('message_fail','Gagal, menghapus order jasa');
        }
    }

}
