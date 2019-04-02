<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Karyawan\Bagian as bagians;
use App\Model\Karyawan\Devisi as devisis;
class Devisi extends Controller
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
        $data= [
            'Bagian'=>bagians::where('id_perusahaan', $this->id_perusahaan)->paginate(9)
        ];

        return view('user.karyawan.section.Devisi.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'nm_devisi' => 'required',
            'id_bagian'=> 'required'
        ]);

        $nm_devisi = $req->nm_devisi;
        $id_bagian = $req->id_bagian;
        $model = new devisis;
        $model->id_bagian_p = $id_bagian;
        $model->nm_devisi = $nm_devisi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Divisi')->with('message_sucess','Anda baru saja menambahkan devisi '.$nm_devisi);
        }else
        {
            return redirect('Divisi')->with('message_fail','Terjadi kesalahan, Silahkan input ulang..!');
        }
    }

    public function edit($id)
    {
        if(empty($data_divisi = devisis::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_devisi'=>$data_divisi
        ];
        return response()->json($data);
    }

    public function update(Request $req)
    {

        $this->validate($req,[
            'nm_divisi_ubah' => 'required',
            'id_bagian_ubah'=> 'required',
            'id_devisi'=> 'required'
        ]);

        $nm_devisi = $req->nm_divisi_ubah;
        $id_bagian = $req->id_bagian_ubah;

        if(empty($model = devisis::where('id', $req->id_devisi)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $model->id_bagian_p = $id_bagian;
        $model->nm_devisi = $nm_devisi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Divisi')->with('message_sucess','Anda baru saja mengubah devisi '.$nm_devisi);
        }else
        {
            return redirect('Divisi')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

    public function delete(Request $req, $id)
    {
        if(empty($model = devisis::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
           $res = [
               'message'=> 'Anda baru saja menghapus divisi :'. $req->nm_divisi,
               'status'=> true
           ];
           return response()->json($res);
        }else
        {
            $res = [
                'message'=> 'Terjadi Kesalahan, Silahkan hapus ulang data divisi anda',
                'status'=> true
            ];
            return response()->json($res);
        }
    }

}