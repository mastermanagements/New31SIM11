<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\SKJasa as skjasas;
use Session;

class SKJasa extends Controller
{
  private $id_perusahaan;
  private $id_karyawan;
  private $jenis_sk = ['0'=>'Nota Service','1'=>'Nota Tagihan'];

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

    public function create()
    {
        $jenis_sk = $this->jenis_sk;
        return view('user.produksi.section.syarat_ketentuan.page_create',['jenis_sk'=>$jenis_sk] );
    }


    public function store(Request $req)
    {
        //
        $this->validate($req,[
            'jenis_sk' => 'required',
            'sk' => 'required'
        ]);

        $jenis_sk = $req->jenis_sk;
        $sk = $req->sk;
        $id_perusahaan = $this->id_perusahaan;
        $id_karyawan = $this->id_karyawan;

            //tidak bisa di pake krn satu perusahaan ada 2 data
            //$model = skjasas::updateorCreate(['id_perusahaan'=> $id_perusahaan],['jenis_sk'=>$jenis_sk, 'sk'=>$sk, 'id_karyawan'=>$id_karyawan]);
            $model = new skjasas();
            $model->jenis_sk = $jenis_sk;
            $model->sk = $sk;
            $model->id_perusahaan = $id_perusahaan;
            $model->id_karyawan = $id_karyawan;

          if($model->save())
            {
               return redirect('Jasa')->with('message_success','Berhasil tambah syarat dan ketentuan jasa')->with('tab3','tab3');
             }else{
                 return redirect('Jasa')->with('message_fail','Gagal tambah syarat dan ketentuan jasa')->with('tab3','tab3');
             }
    }



    public function edit($id)
    {
      $data = ['skjasa'=> skjasas::findorFail($id),
              'jenis_sk'=>$this->jenis_sk
              ];

      return view('user.produksi.section.syarat_ketentuan.page_edit', $data);
    }


    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'jenis_sk'=>'required',
            'sk' => 'required'
        ]);

        $model = skjasas::where('id_perusahaan', $this->id_perusahaan)->find($id);
        $model->jenis_sk = $req->jenis_sk;
        $model->sk = $req->sk;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Jasa')->with('message_success','Data Syarat dan Ketentuan Layanan Jasa telah diubah')->with('tab3','tab3');
        }else{
            return redirect('Jasa')->with('message_fail','Syarat dan Ketentuan Layanan Jasa gagal diubah')->with('tab3','tab3');
        }
    }

    public function destroy($id)
    {
        //
        $model = skjasas::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id); //bisa jg pake findorFail($id);
        if($model->delete()){
            return redirect('Jasa')->with('message_success','Berhasil menghapus data pSyarat dan Ketentuan Layanan Jasa telah diubah')->with('tab3','tab3');
        }else{
            return redirect('Jasa')->with('message_fail','Gagal, data Syarat dan Ketentuan Layanan Jasa telah diubah')->with('tab3','tab3');
        }
    }
}
