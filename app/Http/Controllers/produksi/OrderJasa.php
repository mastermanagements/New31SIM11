<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\OrderJasa as OJ;
use App\Model\Produksi\DetailOrderJasa as DOJ;
use App\Model\Administrasi\Klien as kliens;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\Jasa as jasas;
use App\Model\Produksi\PelaksanaanJasa as PJ;
use App\Model\Produksi\ProsesBisnis as probis;

//use Illuminate\Support\Facades\DB;

use Session;

class OrderJasa extends Controller
{
    private $id_perusahaan;
    private $id_karyawan;
    private $status_perproses = ['1'=>'Lanjut Service','2'=>'Cancel Service','3'=>'Gagal Service','4'=>'Berhasil Service'];
    private $status_konfirm = ['Belum Konfirm ke Klien','Sudah Konfirm ke Klien'];
    private $status_ambil = ['Belum diambil','Sudah diambil'];

    public function __construct(){
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
      $data = [
                'order_jasa'=>OJ::all()->where('id_perusahaan', $this->id_perusahaan),
                'klien'=>kliens::all()->where('id_perusahaan', $this->id_perusahaan),
                'status_perproses'=>$this->status_perproses,
                'status_konfirm'=>$this->status_konfirm,
                'status_ambil'=>$this->status_ambil,
                'list_service'=>DOJ::where('id_perusahaan', $this->id_perusahaan )->where('status_service', '1')->groupBy('id_order_jasa')->get(),
                'detail_order_jasa'=>DOJ::all()->where('id_perusahaan', $this->id_perusahaan),
                'pelaksanaan_jasa'=>PJ::all()->where('id_perusahaan', $this->id_perusahaan),
                'proses_bisnis'=>probis::all()->where('id_perusahaan', $this->id_perusahaan),
                'karyawan'=>$this->id_karyawan
              ];

              //dd ($data['detail_order_jasa']);

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
     //$model->status_service = $request->status_service;
     $model->id_karyawan = $this->id_karyawan;
     $model->id_perusahaan = $this->id_perusahaan;
     //dd($model);
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
        $model_insert_doj->id_perusahaan = $this->id_perusahaan;
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

    public function ubah_status_service(Request $req, $id)
    {
        if(empty($data_doj = DOJ::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data_doj->status_service = '1';
        if($data_doj->save())
        {
            $data = [
                'message'=> 'Order jasa mulai di proses',
                'status' => 'true'
            ];
            return response()->json($data);
        }
    }

    public function store_doservice (Request $req)
   {
      $this->validate($req,[
         'id_detail_oj' => 'required',
         'tgl_jam_mulai' => 'required',
         'id_proses_bisnis' => 'required',
         'yg_mengerjakan'=>'required'
      ]);

      $id_detail_oj = $req->id_detail_oj;
      $tgl_jam_mulai = $req->tgl_jam_mulai;
      $id_proses_bisnis = $req->id_proses_bisnis;
      $yg_mengerjakan = $req->yg_mengerjakan;

      //ambil data dr tabel PelaksanaanJasa yg id_detail_oj nya = yg di postkan dan id_proses_bisnisnya = yg di postkan
      $data = PJ::where('id_detail_oj',$id_detail_oj)->where('id_proses_bisnis', $id_proses_bisnis)->where('id_perusahaan', $this->id_perusahaan)->first();
      //jika hasil di atas ada, maka tampilkan pesan error, pesan bisnis sdh Ada
      //  dd($data);
      if($data){
        return redirect('Order-Jasa')->with('message_fail','Gagal tambah proses bisnis pada pengerjaan layanan ini, proses bisnis yg diinput sudah ada, ganti dengan proses bisnis yang lain')->with('tab2','tab2');
      } else {
        // jika tdk, maka save()
        $model = new PJ;
        $model->id_detail_oj = $id_detail_oj;
        $model->tgl_jam_mulai = $tgl_jam_mulai;
        $model->id_proses_bisnis = $id_proses_bisnis;
        $model->yg_mengerjakan = $yg_mengerjakan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        $model->save();
      }

       if($model->save())
       {
           return redirect('Order-Jasa')->with('message_success','Berhasil tambah proses bisnis pada pengerjaan layanan jasa')->with('tab2','tab2');
       }else
       {
           return redirect('Order-Jasa')->with('message_fail','Gagal tambah proses bisnis pada pengerjaan layanan jasa')->with('tab2','tab2');
       }
   }

   public function editPLAwal($id)
     {
         if(empty($data_pl = PJ::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
             return abort(404);
         }
         $data = [
           'data_pl'=> $data_pl,

         ];
         return response()->json($data);
     }

     public function updatePLAwal(Request $req)
       {
        //dd($req->all());
           $this->validate($req,[
           'id_pl'=>'required',
           'tgl_jam_do'=>'required',
           'what_do'=> 'required'

           ]);

       $id_pl = $req->id_pl;
       $tgl_jam_do = $req->tgl_jam_do;
       $what_do = $req->what_do;


           if(empty($model = PJ::where('id', $id_pl)->where('id_perusahaan', $this->id_perusahaan)->first())){
             //dd($model);
               return abort(404);
           }
       //insert ke @ field di tabel TT dg asiggment value dari hasil req di atas
       $model->tgl_jam_do = $tgl_jam_do;
       $model->what_do =$what_do;
       $model->id_karyawan = $this->id_karyawan;
       //dd($req->all());
           if($model->save())
           {
              return redirect('Order-Jasa')->with('message_success','Berhasil input item pekerjaan jasa')->with('tab2','tab2');
           }else
           {
               return redirect('Order-Jasa')->with('message_fail','Terjadi kesalahan, Silahkan ulangi lagi..!')->with('tab2','tab2');
           }
       }

       public function editPLSelesai($id)
         {
             if(empty($data_pl = PJ::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
                 return abort(404);
             }
             $data = [
               'data_pl'=> $data_pl
             ];
             return response()->json($data);
         }

         public function updatePLSelesai(Request $req)
           {
           // dd($req->all());
               $this->validate($req,[
               'id_pl'=>'required',
               'tgl_jam_finish'=>'required',
               'what_result'=> 'required'
               ]);

           $id_pl = $req->id_pl;
           $tgl_jam_finish = $req->tgl_jam_finish;
           $what_result = $req->what_result;

               if(empty($model = PJ::where('id', $id_pl)->where('id_perusahaan', $this->id_perusahaan)->first())){
                 //dd($model);
                   return abort(404);
               }
           //insert ke @ field di tabel TT dg asiggment value dari hasil req di atas
           $model->tgl_jam_finish = $tgl_jam_finish;
           $model->what_result =$what_result;
           $model->id_perusahaan = $this->id_perusahaan;
           $model->id_karyawan = $this->id_karyawan;
           //dd($req->all());
               if($model->save())
               {
                  return redirect('Order-Jasa')->with('message_success','Berhasil input hasil pekerjaan jasa')->with('tab2','tab2');
               }else
               {
                   return redirect('Order-Jasa')->with('message_fail','Terjadi kesalahan, Silahkan ulangi lagi..!')->with('tab2','tab2');
               }
           }


           public function editPLConfirm($id)
             {
                 if(empty($data_pl = PJ::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
                     return abort(404);
                 }
                 $data = [
                   'data_pl'=> $data_pl

                 ];
                 return response()->json($data);
             }

             public function updatePLConfirm(Request $req)
               {
               // dd($req->all());
                   $this->validate($req,[
                   'id_pl'=>'required',
                   'tgl_jam_konfirm'=>'required',
                   'what_respon'=> 'required'

                   ]);

               $id_pl = $req->id_pl;
               $tgl_jam_konfirm = $req->tgl_jam_konfirm;
               $what_respon = $req->what_respon;


                   if(empty($model = PJ::where('id', $id_pl)->where('id_perusahaan', $this->id_perusahaan)->first())){
                     //dd($model);
                       return abort(404);
                   }
               //insert ke @ field di tabel TT dg asiggment value dari hasil req di atas
               $model->tgl_jam_konfirm = $tgl_jam_konfirm;
               $model->what_respon =$what_respon;
               $model->yg_mengkonfirmasi =$this->id_karyawan;
               $model->id_perusahaan = $this->id_perusahaan;
               $model->id_karyawan = $this->id_karyawan;
               //dd($req->all());
                   if($model->save())
                   {
                      return redirect('Order-Jasa')->with('message_success','Berhasil Konfirmasi hasil pekerjaan')->with('tab2','tab2');
                   }else
                   {
                       return redirect('Order-Jasa')->with('message_fail','Terjadi kesalahan, Silahkan ulangi lagi..!')->with('tab2','tab2');
                   }
               }

               public function editPLStatusAkhir($id)
                 {
                     if(empty($data_pl = PJ::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
                         return abort(404);
                     }
                     $data = [
                       'data_pl'=> $data_pl,
                       'status_perproses'=>$this->status_perproses
                     ];
                     return response()->json($data);
                 }

                 public function updatePLStatusAkhir(Request $req)
                   {
                   // dd($req->all());
                       $this->validate($req,[
                       'id_pl'=>'required',
                       'status_perproses'=> 'required'
                       ]);

                   $id_pl = $req->id_pl;
                   $status_perproses = $req->status_perproses;

                       if(empty($model = PJ::where('id', $id_pl)->where('id_perusahaan', $this->id_perusahaan)->first())){
                         //dd($model);
                           return abort(404);
                       }
                   //insert ke @ field di tabel TT dg asiggment value dari hasil req di atas

                   $model->status_perproses =$status_perproses;
                   $model->id_perusahaan = $this->id_perusahaan;
                   $model->id_karyawan = $this->id_karyawan;
                   //dd($req->all());
                       if($model->save())
                       {
                          return redirect('Order-Jasa')->with('message_success','Berhasil Ubah status service pada proses bisnis ini')->with('tab2','tab2');
                       }else
                       {
                           return redirect('Order-Jasa')->with('message_fail','Terjadi kesalahan, Silahkan ulangi lagi..!')->with('tab2','tab2');
                       }
                   }
}
