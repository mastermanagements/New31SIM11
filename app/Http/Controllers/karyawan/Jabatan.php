<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatans;
use Session;

class Jabatan extends Controller
{
  private $id_karyawan;
  private $id_perusahaan;
  private $level_jabatan=['Direksi','Manager','Supervisor','Staf'];

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
      $datak = [
        'jabatan'=>jabatans::where('id_perusahaan', $this->id_perusahaan)->orderBy('level_jabatan')->get(),
        'level_jabatan' => $this->level_jabatan
      ];
      return view('user.karyawan.section.Jabatan.page_default', $datak);
  }

  public function edit($id){
      if(empty($model = jabatans::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
          return abort(404);
      }

      return response()->json($model);
  }

  public function update(Request $req)
  {
      //dd($req->all());
      $this->validate($req,[
          'nm_jabatan'=>'required',
          'level_jabatan'=>'required',
          'id'=>'required',
      ]);

      $model = jabatans::find($req->id);
      $model->nm_jabatan = $req->nm_jabatan;
      $model->level_jabatan = $req->level_jabatan;

      $model->id_perusahaan = $this->id_perusahaan;
      $model->id_karyawan = $this->id_karyawan;

      if($model->save()){
          return redirect('Jabatan')->with('message_success', 'Anda telah mengubah data jabatan');
      }else{
          return redirect('Jabatan')->with('message_fail','Maaf, data jabatan tidak terubah');
      }
  }

  public function store(Request $req)
  {
    //dd($req->all());
    $this->validate($req,[
       'nm_jabatan'=>'required',
       'level_jabatan'=>'required'
    ]);

    $model = new jabatans();
    $model->nm_jabatan = $req->nm_jabatan;
    $model->level_jabatan = $req->level_jabatan;

    $model->id_perusahaan = $this->id_perusahaan;
    $model->id_karyawan = $this->id_karyawan;

    if($model->save()){
        return redirect('Jabatan')->with('message_success', 'Anda telah menambahakan data jabatan');
    }else{
        return redirect('Jabatan')->with('message_fail','Maaf, data jabatan tidak tersimpan');
    }
  }

  public function delete(Request $req, $id)
  {
      $model = jabatans::find($id);

      if($model->delete()){
          return redirect('Jabatan')->with('message_success', 'Anda telah menghapus data jabatan');
      }else{
          return redirect('Jabatan')->with('message_fail','Maaf, data jabatan gagal terhapus');
      }
  }


}
