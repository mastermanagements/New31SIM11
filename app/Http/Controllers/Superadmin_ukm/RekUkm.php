<?php

namespace App\Http\Controllers\Superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\RekUkm as rek_ukm;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use Session;

class RekUkm extends Controller
{
    private $id_superadmin;

    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
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
      return view('user/superadmin_ukm/master/section/rek_ukm/rek_ukm_create_page', $data);
    }


    public function store(Request $req)
    {
        $this->validate($req,[
            'id_perusahaan'=>'required',
            'nama_bank' => 'required',
            'no_rek' => 'required',
            'atas_nama' => 'required',
            'kcp' => 'required'
        ]);

        $id_perusahaan = $req->id_perusahaan;
        $nama_bank= $req->nama_bank;
        $no_rek= $req->no_rek;
        $atas_nama= $req->atas_nama;
        $kcp= $req->kcp;

        $model = new rek_ukm;
        $model->nama_bank = $nama_bank;
        $model->no_rek = $no_rek;
        $model->atas_nama = $atas_nama;
        $model->kcp = $kcp;
        $model->id_perusahaan = $id_perusahaan;
        $model->id_user_ukm = $this->id_superadmin;

        if($model->save())
        {
                return redirect('rek-ukm')->with('message_success','Berhasil tambah rekening perusahaan');
            }else{
                return redirect('rek-ukm')->with('message_error','Gagal tambah rekening perusahaan');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
      if(empty($rek_ukm = rek_ukm::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first() )){
          abort(404);
      }
      $data = [
          'usaha'=> usaha::all()->where('id_user_ukm', $this->id_superadmin),
          'rek_ukm'=> $rek_ukm
      ];
      return view('user/superadmin_ukm/master/section/rek_ukm/rek_ukm_edit_page', $data);
    }


    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'id_perusahaan'=>'required',
        'nama_bank' => 'required',
        'no_rek' => 'required',
        'atas_nama' => 'required',
        'kcp' => 'required'
      ]);

      $id_perusahaan = $req->id_perusahaan;
      $nama_bank= $req->nama_bank;
      $no_rek= $req->no_rek;
      $atas_nama= $req->atas_nama;
      $kcp= $req->kcp;

      $model = rek_ukm::findOrFail($id);

      $model->nama_bank = $nama_bank;
      $model->no_rek = $no_rek;
      $model->atas_nama = $atas_nama;
      $model->kcp = $kcp;
      $model->id_perusahaan = $id_perusahaan;
      $model->id_user_ukm = $this->id_superadmin;

      if($model->save())
      {
              return redirect('rek-ukm')->with('message_success','Berhasil update rekening perusahaan');
          }else{
              return redirect('rek-ukm')->with('message_error','Gagal update rekening perusahaan');
          }
    }


    public function destroy($id)
    {
      $model = rek_ukm::findOrFail($id);

      if($model->delete())
      {
             return redirect('rek-ukm')->with('message_success','Berhasil delete rekening perusahaan');
        }else{
             return redirect('rek-ukm')->with('message_error','Gagal delet rekening perusahaan');
        }

    }
}
