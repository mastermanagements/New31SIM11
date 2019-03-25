<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Karyawan\JobDecs as JD;
use Session;

class JobDecs extends Controller
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

    public function index()
    {
        $data_JD = [
           'data_jd'=>JD::where('id_karyawan', $this->id_karyawan)->where('id_perusahaan', $this->id_perusahaan)->paginate(6)
        ];
        return view('user.karyawan.section.JobDecs.page_default', $data_JD);
    }

    public function create()
    {
        $data_jab = [
            'jabatan' =>jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];

        return view('user.karyawan.section.JobDecs.page_create', $data_jab);
    }

     public function store(Request $req)
    {
       $this->validate($req,[
          'id_jabatan_p' => 'required',
          'job_desc' => 'required'
       ]);

       $id_jabatan_p = $req->id_jabatan_p;
       $job_desc = $req->job_desc;

       $model = new JD;
       $model->id_jabatan_p = $id_jabatan_p;
       $model->job_desc = $job_desc;
       $model->id_perusahaan = $this->id_perusahaan;
       $model->id_karyawan = $this->id_karyawan;


        if($model->save())
        {
            return redirect('Job-Desc')->with('message_success','Anda telah menambah Job Decs');
        }else
        {
            return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan silahkan masukan kembali Job Decs anda..!');
        }
    }

    public function edit($id)
    {
        if(empty($JD = JD::where('id', $id)->where('id_karyawan',$this->id_karyawan)->first()))
        {
            return abort(404);
        }

        $data_jab = [
            'jabatan' =>jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
            'jobDecks' => $JD
        ];

        return view('user.karyawan.section.JobDecs.page_edit', $data_jab);
    }


    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'id_jabatan_p' => 'required',
            'job_desc' => 'required'
        ]);

        $id_jabatan_p = $req->id_jabatan_p;
        $job_desc = $req->job_desc;

        $model = JD::find($id);
        $model->id_jabatan_p = $id_jabatan_p;
        $model->job_desc = $job_desc;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;


        if($model->save())
        {
            return redirect('Job-Desc')->with('message_success','Anda telah mengubah Job Decs');
        }else
        {
            return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan silahkan mengubah kembali Job Decs anda..!');
        }
    }

    public function delete(Request $req, $id)
    {
        if(empty($JD = JD::where('id', $id)->where('id_karyawan',$this->id_karyawan)->first()))
        {
            return abort(404);
        }
        if($JD->delete())
        {
            return redirect('Job-Desc')->with('message_success','Anda telah menghapus Job Decs');
        }else
        {
            return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan silahkan menghapus kembali Job Decs anda..!');
        }
    }
}
