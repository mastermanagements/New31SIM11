<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Karyawan\Bagian as bagians;
use App\Model\Administrasi\UsulanBrifing as brifings;
class Brifing extends Controller
{

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

    public function ambilEventBrifing($id_devisi)
    {
        if(!empty($id_devisi)) {
            $data_brifing = brifings::where('id_perusahaan', $this->id_perusahaan)->where('id_divisi', $id_devisi)->groupBy('tgl_usulan_brif')->get();
        }
        else {
            $data_brifing = brifings::where('id_perusahaan', $this->id_perusahaan)->groupBy('tgl_usulan_brif')->get();
        }
        $column = array();
        foreach ($data_brifing as $value){
          $row[]=[
               'title'=> 'Lihat Usulan Brifing',
               'start'=> $value->tgl_usulan_brif
           ];
          $column= $row;
         }
        return response()->json($column);
    }

    public function ambilEventBrifingByTanggal(Request $req)
    {
        $tanggal = date('Y-m-d', strtotime($req->tgl_usulan_brif));
        $id_divisi = $req->id_divisi;
        $data_brifing = brifings::all()->where('tgl_usulan_brif', $tanggal)->where('id_perusahaan', $this->id_perusahaan)->where('id_divisi', $id_divisi);
        $column = array();
        foreach ($data_brifing as $key)
        {
            $row=array();
            $row['id']= $key->id;
            $row['materi']= $key->materi;
            $row['tgl_usulan_brif']= $key->tgl_usulan_brif;
            $row['nama_ky']= $key->getKaryawan->nama_ky;
            $row['pas_foto']= $key->getKaryawan->pas_foto;
            $row['id_ky_login']= $this->id_karyawan;
            $row['id_ky_usulan']= $key->id_karyawan;

            $column[] = $row;
        }
        return response()->json($column);
    }

    public function index()
    {
        $data = [
            'data_bagian_devisi'=> bagians::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.Brifing.page_default', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'materi'=> 'required',
            'tgl_usulan_brif'=> 'required',
            'id_divisi'=>'required'
        ]);
        $tgl_usulan_brif =  date('Y-m-d', strtotime($request->tgl_usulan_brif));
        $materi =$request->materi;
        $id_divisi =$request->id_divisi;

        $model = new brifings;
        $model->materi = $materi;
        $model->tgl_usulan_brif = $tgl_usulan_brif;
        $model->id_divisi= $id_divisi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save())
        {
            $data = [
               'message'=> 'Anda telah menambah usulan brifing',
               'status'=>true
            ];
            return response()->json($data);
        }

        $data = [
            'message'=> 'Gagal menambah usulan ',
            'status'=>false
        ];
        return response()->json($data);
    }

    public function destroy(Request $req, $id)
    {
        if(empty($model = brifings::where('id', $req->id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
            $data = [
                'message'=> 'Anda telah menghapus usulan brifing',
                'status'=>true
            ];
            return response()->json($data);
        }

        $data = [
            'message'=> 'Gagal menghapus usulan brifing',
            'status'=>false
        ];
        return response()->json($data);
    }
}
