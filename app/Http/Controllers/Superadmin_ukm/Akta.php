<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use App\Model\Superadmin_ukm\U_Akta as aktas;

class Akta extends Controller
{
    //
    private $id_superadmin;

    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('/')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            return $next($req);
        });
    }

    public function create()
    {
        $data = [
            'usaha'=> usaha::all()->where('id_user_ukm', $this->id_superadmin)
        ];
        return view('user/superadmin_ukm/master/section/akta_perusahaan/akta_create_page', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'id_perusahaan'=>'required',
            'no_akta'=>'required',
            'tgl_akta' => 'required',
            'notaris' => 'required',
            'file_akta' => 'required|file|mimes:rar,zip'
        ]);

        $id_perusahaan = $req->id_perusahaan;
        $no_akta = $req->no_akta;
        $tgl_akta =  date('Y-m-d', strtotime($req->tgl_akta));
        $notaris = $req->notaris;
        $file_akta = $req->file_akta;
        $no_rak = $req->no_rak;
        $ket = $req->ket;
        $name_file =  time().'.'.$file_akta->getClientOriginalExtension();

        //buat objek baru
        $model = new aktas;
        //assignment value $req to field
        $model->no_akta = $no_akta;
        $model->tgl_akta = $tgl_akta;
        $model->notaris = $notaris;
        $model->no_rak = $no_rak;
        $model->file_akta = $name_file;
        $model->ket = $ket;
        $model->id_perusahaan = $id_perusahaan;
        $model->id_user_ukm = $this->id_superadmin;

        /*if(!empty($model->file_akta))
        {
            $file_path =public_path('fileAkta').'/' . $model->file_akta;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }*/
        if ($model->save())
        {
            if ($file_akta->move(public_path('fileAkta'), $name_file)) {
                return redirect('akta')->with('message_success','Berhasil menyimpan akta');
            }else{
                return redirect('akta')->with('message_error','Gagal menyimpan akta file akta');
            }
            return redirect('akta')->with('message_success','Berhasil mengubah akta');
        }
    }

    public function edit($id)
    {
        $data_akta = aktas::where('id', $id)->where('id_user_ukm', $this->id_superadmin)->first();

        $data_pass = [
          'akta'=>$data_akta
        ];

      return view('user.superadmin_ukm.master.section.akta_perusahaan.edit_page', $data_pass);
    }

    public function update(Request $req, $id)
    {
      //dd($req->all());
      //validasi
      $this->validate($req, ['no_akta'=>'required', 'tgl_akta'=>'required', 'notaris'=>'required', 'file_akta' => 'nullable|file|mimes:rar,zip']);
      //assignment request
      $id_perusahaan = $req->id_perusahaan;
      $no_akta = $req->no_akta;
      $tgl_akta = date('Y-m-d', strtotime($req->tgl_akta));
      $notaris = $req->notaris;
      $rak = $req->no_rak;
      $file_akta = $req->file_akta;

      $ket = $req->ket;

      //get data $//
      $model = aktas::findOrFail($id);
      //insert field dg  variabel assignment request
      if(!empty($file_akta)){
          $name_file =  time().'.'.$file_akta->getClientOriginalExtension();

      }else{
          //ambil file lama
          $name_file = $model->file_akta;
      }

      $model->no_akta = $no_akta;
      $model->tgl_akta = $tgl_akta;
      $model->notaris = $notaris;
      $model->no_rak = $rak;
      $model->file_akta = $name_file;
      $model->ket = $ket;
      $model->id_perusahaan = $id_perusahaan;
      $model->id_user_ukm = $this->id_superadmin;

      if(!empty($model->file_akta))
      {
          $file_path =public_path('fileAkta').'/' . $model->file_akta;
          if (file_exists($file_path)) {
              @unlink($file_path);
          }
      }
      //save
      if ($model->save())
      {
        if(!empty($file_akta))
        {
          if ($file_akta->move(public_path('fileAkta'), $name_file)) {
              return redirect('akta')->with('message_success','Berhasil update akta');
          }else{
              return redirect('akta')->with('message_error','Gagal update akta');
          }
        }

          return redirect('akta')->with('message_success','Berhasil mengubah akta');
      }
    return redirect('unggah-ijin')->with('message_error','Terjadi kesalangan, isi dengan benar');
  }
}
