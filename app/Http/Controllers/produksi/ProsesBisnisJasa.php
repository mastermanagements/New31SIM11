<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\ProsesBisnis as PB;
use App\Model\Produksi\Barang as barangs;
use Session ;

class ProsesBisnisJasa extends Controller
{
  private $id_perusahaan;
  private $id_karyawan;

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

    public function create()
    {
      //barang untuk proses bisnis manufaktur
      $barang = barangs::all()->where('id_perusahaan', $this->id_perusahaan);
        return view('user.produksi.section.proses_bisnis.jasa.page_create', $barang);
    }

    public function store(Request $req)
    { //d($req->all());
      $this->validate($req,[
          'proses_bisnis' => 'required',
      ]);

      $proses_bisnis = $req->proses_bisnis;
      $ket = $req->ket;

      foreach ($proses_bisnis as $key => $value)
      {
          $model = new PB();
          $model->id_perusahaan = $this->id_perusahaan;
          $model->id_karyawan = $this->id_karyawan;
          $model->proses_bisnis = $value;
          $model->ket = $ket[$key];
          $model->save();
      }

        if($model->save()== TRUE)
          {
             return redirect('Jasa')->with('message_success','Berhasil tambah data proses bisnis jasa')->with('tab2','tab2');
           }else{
               return redirect('Jasa')->with('message_fail','Gagal tambah data proses bisnis jasa')->with('tab2','tab2');
           }
    }

    public function edit($id)
    {
      $data = [
        'barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
        'data_probis'=> PB::findorFail($id)
      ];
        return view('user.produksi.section.proses_bisnis.jasa.page_edit', $data);
    }


    public function update(Request $req, $id)
    {
      $this->validate($req,[
          'proses_bisnis'=>'required',

      ]);

      $model = PB::where('id_perusahaan', $this->id_perusahaan)->find($id);
      $model->proses_bisnis = $req->proses_bisnis;
      $model->ket = $req->ket;
      $model->id_karyawan = $this->id_karyawan;

      if($model->save()){
          return redirect('Jasa')->with('message_success','Data Proses Bisnis Jasa telah diubah')->with('tab2','tab2');
      }else{
          return redirect('Jasa')->with('message_fail','Data Proses Bisnis Jasa gagal diubah')->with('tab2','tab2');
      }
    }


    public function destroy($id)
    {
        //
        $model = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id); //bisa jg pake findorFail($id);
        if($model->delete()){
            return redirect('Jasa')->with('message_success','Berhasil menghapus data proses bisnis jasa')->with('tab2','tab2');
        }else{
            return redirect('Jasa')->with('message_fail','Gagal, data proses bisnis jasa')->with('tab2','tab2');
        }
    }
}
