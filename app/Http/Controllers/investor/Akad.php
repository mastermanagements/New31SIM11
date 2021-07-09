<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\Akad as A;
class Akad extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    private  $id_con;

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
            $this->id_con=[
                'id_perusahaan'=> $this->id_perusahaan,
                'id_karyawan' => $this->id_karyawan
            ];
            return $next($req);
        });
    }

    public function index(){
        $data =[
            'data'=> A::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.akad.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req, [
            'file_akad' => 'required|file|mimes:rar,zip',
            'nm_file' => 'required'
        ]);

        $file_akad = $req->file_akad;
        $name_file = uniqid().time().'.'.$file_akad->getClientOriginalExtension();

        $model =new A();
        $model->file_akad = $name_file;
        $model->nm_file = $req->nm_file;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            $file_akad->move(public_path('fileAkad'), $name_file);
            return redirect('Akad')->with('message_sucess', 'anda telah menambahkan berkas akta baru');
        }else{
            return redirect('Akad')->with('message_fail', 'Maad, file akad anda tidak dapat disimpan');
        }
    }


    public function delete(Request $req, $id)
    {
        $model = A::find($id);
        if(!empty($model->file_akad))
        {
            $file_path =public_path('fileAkad').'/' . $model->file_akad;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($model->delete())
        {
            return redirect('Akad')->with('message_success','Berhasil menghapus File Akad');
        }
        else
        {
            return redirect('Akad')->with('message_fail','Maaf, file akad tidak dapat terhapus');
        }

    }
    
}
