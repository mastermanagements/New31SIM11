<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Administrasi\JenisSurat as jenis_surat;

class JenisSurat extends Controller
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
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index()
    {
        $data_jenis_surat = jenis_surat::all()->where('id_perusahaan', $this->id_perusahaan);
        $colum = array();
        $no = 1;
        foreach ($data_jenis_surat as $jenis_surat)
        {
            $row =array();
            $row[]=$no++;
            $row[]=$jenis_surat->jenis_surat_keluar;
            $row[]='<button class="btn btn-warning" onclick="ubahJenisBarang('.$jenis_surat->id.')">ubah</button>'.
                '<button class="btn btn-danger" onclick="hapusJenisBarang('.$jenis_surat->id.')">hapus</button>';
            $colum[]= $row;
        }
        $output = array('data'=> $colum);
        return response()->json($output);
    }

    public function store(Request $req)
    {
        $jenis_surat = $req->jenis_surat_keluar;
        $model = new jenis_surat;
        $model->jenis_surat_keluar = $jenis_surat;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('Surat')->with('message_success','Anda telah menambahkan jenis surat baru');
        }else
            {
                return redirect('Surat')->with('message_fail','Terjadi kesalaha, Silahkan menambah jenis surat baru');
            }
    }

    public function edit($id)
    {
        if(empty($data_jenis_surat =  jenis_surat::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data'=>  $data_jenis_surat
        ];

        return response()->json($data);
    }

    public function update(Request $req)
    {
        $id = $req->id;
        $jenis_surat = $req->jenis_surat_keluar_ubah;
        $model = jenis_surat::find($id);
        $model->jenis_surat_keluar = $jenis_surat;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('Surat')->with('message_success','Anda telah mengubah jenis surat baru');
        }else
        {
            return redirect('Surat')->with('message_fail','Terjadi kesalaha, Silahkan mengubah jenis surat baru');
        }
    }

    public function delete(Request $req)
    {
        $id = $req->id;
        if(empty($model = jenis_surat::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        if($model->delete())
        {
            $data =[
                'message'=> 'anda  telah menghapus jenis surat',
                'status'=> 'true'
            ];
            return response()->json($data);
        }else
        {
            $data =[
                'message'=> 'anda  telah gagal jenis surat',
                'status'=> 'false'
            ];
            return response()->json($data);
        }
    }

}
