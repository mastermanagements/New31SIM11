<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Model\Administrasi\JenisArsip as jenis_arsip;
use App\Model\Administrasi\Arsip as arsips;

class Arsip extends Controller
{
    //

    private $id_karyawan;
    private $id_perusahaan;

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
        $data = [
            'data_arsip'=> arsips::where('id_perusahaan', $this->id_perusahaan)->paginate(30),
            'jenis_arsip' => jenis_arsip::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.arsip.page_default', $data);
    }

    public function create()
    {
        $data = [
            'jenis_arsip'=> jenis_arsip::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.arsip.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'id_jenis_arsip' => 'required',
            'ket' => 'required',
            'file_arsip' => 'required|file|mimes:rar,zip',
        ]);

        $id_jenis_arsip=$req->id_jenis_arsip;
        $ket = $req->ket;
        $file_arsip = $req->file_arsip;

        $name_file = uniqid().time().'.'.$file_arsip->getClientOriginalExtension();
        $model = new arsips;
        $model->id_jenis_arsip = $id_jenis_arsip;
        $model->ket = $ket;
        $model->file_arsip =  $name_file;
        $model->id_perusahaan =  $this->id_perusahaan;
        $model->id_karyawan=  $this->id_karyawan;

        if($model->save())
        {
            if ($file_arsip->move(public_path('fileArsip'), $name_file)) {
                return redirect('Arsip')->with('message_success','Berhasil menyimpan Arsip');
            }else{
                return redirect('Arsip')->with('message_error','Gagal menyimpan file Arsip');
            }
            return redirect('Arsip')->with('message_success','Berhasil menambahkan Arsip');

        }
    }

    public function edit($id)
    {
        if(empty($data_arsip =  arsips::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'data_arsip'=> $data_arsip,
            'jenis_arsip'=> jenis_arsip::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.arsip.page_edit', $data);
    }


    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'id_jenis_arsip' => 'required',
            'ket' => 'required',
            'file_arsip' => 'required|file|mimes:rar,zip',
        ]);

        $id_jenis_arsip=$req->id_jenis_arsip;
        $ket = $req->ket;
        $file_arsip = $req->file_arsip;

        $name_file = uniqid().time().'.'.$file_arsip->getClientOriginalExtension();
        $model = arsips::find($id);

        if(!empty($model->file_arsip))
        {
            $file_path =public_path('fileArsip').'/' . $model->file_arsip;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        $model->id_jenis_arsip = $id_jenis_arsip;
        $model->ket = $ket;
        $model->file_arsip =  $name_file;
        $model->id_perusahaan =  $this->id_perusahaan;
        $model->id_karyawan=  $this->id_karyawan;

        if($model->save())
        {
            if ($file_arsip->move(public_path('fileArsip'), $name_file)) {
                return redirect('Arsip')->with('message_success','Berhasil mengubah Arsip');
            }else{
                return redirect('Arsip')->with('message_error','Gagal menyimpan file Arsip');
            }
            return redirect('Arsip')->with('message_success','Berhasil mengubah Arsip');

        }
    }

    public function delete(Request $req, $id)
    {
        $model = arsips::find($id);
        if(!empty($model->file_arsip))
        {
            $file_path =public_path('fileArsip').'/' . $model->file_arsip;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($model->delete())
        {
            return redirect('Arsip')->with('message_success','Berhasil menghapus Arsip');
        }
        else
        {
            return redirect('Arsip')->with('message_fail','Berhasil menghapus Arsip');
        }
    }
}
