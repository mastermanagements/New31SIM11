<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatans;

class Jabatan extends Controller
{
    //
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

    public function create($id)
    {
        if(empty($data_usaha=usaha::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
           return abort(404);
        }

        $data=[
            'usaha'=> $data_usaha
        ];
        return view('user/superadmin_ukm/master/section/jabatan_perusahaan/create_page', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'nm_jabatan' => 'required',
            'level_jabatan' => 'required|numeric',
            'id_perusahaan' => 'required|numeric',
        ]);

        $model = new jabatans;
        $model->nm_jabatan = $req->nm_jabatan;
        $model->level_jabatan = $req->level_jabatan;
        $model->id_perusahaan = $req->id_perusahaan;
        $model->id_user_ukm = $this->id_superadmin;

        if ($model->save())
        {
            return redirect('pilih-usaha/'.$req->id_perusahaan.'/daftar-jabatan')->with('message_success','Anda baru saja menambahka jabatan');
        }
        return redirect('pilih-usaha/'.$req->id_perusahaan.'/daftar-jabatan')->with('message_fail','Terjadi kesalahan, Jabatan gagal untuk ditambahakn');

    }

    public function edit($id_perusahaan, $id_jabatan)
    {
        if(empty($data_usaha=usaha::where('id', $id_perusahaan)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }

        if(empty($data_jabatan= jabatans::where('id', $id_jabatan)->where('id_perusahaan', $data_usaha->id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }

        $data=[
            'usaha'=> $data_usaha,
            'jabatan'=> $data_jabatan
        ];
        return view('user/superadmin_ukm/master/section/jabatan_perusahaan/edit_page', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'nm_jabatan' => 'required',
            'level_jabatan' => 'required|numeric',
            'id_perusahaan' => 'required|numeric',
        ]);

        $model = jabatans::find($id);
        $model->nm_jabatan = $req->nm_jabatan;
        $model->level_jabatan = $req->level_jabatan;
        $model->id_perusahaan = $req->id_perusahaan;
        $model->id_user_ukm = $this->id_superadmin;

        if ($model->save())
        {
            return redirect('pilih-usaha/'.$req->id_perusahaan.'/daftar-jabatan')->with('message_success','Anda baru saja mengubah jabatan');
        }
        return redirect('pilih-usaha/'.$req->id_perusahaan.'/daftar-jabatan')->with('message_fail','Terjadi kesalahan, Jabatan gagal diubah');

    }

    public function delete(Request $req, $id)
    {
        $model = jabatans::find($id);
        if ($model->delete())
        {
            return redirect('pilih-usaha/'.$model->id_perusahaan.'/daftar-jabatan')->with('message_success','Anda baru saja menghapus jabatan');
        }
        return redirect('pilih-usaha/'.$model->id_perusahaan.'/daftar-jabatan')->with('message_fail','Terjadi kesalahan, Jabatan gagal dihapus');

    }
}
