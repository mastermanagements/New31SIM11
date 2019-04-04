<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Administrasi\A_Jenis_Proposal as jenis_proposal;
use App\Model\Administrasi\Proposal as proposals;

class Proposal extends Controller
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
        $data=[
            'data_proposal'=> proposals::where('id_perusahaan', $this->id_perusahaan)->paginate(20)
        ];
        return view('user.administrasi.section.proposal.page_default', $data);
    }

    public function create()
    {
        $data_pass = [
          'jenis_proposal'=>jenis_proposal::all()->where('id_perusahaan', $this->id_perusahaan)
        ];

        return view('user.administrasi.section.proposal.page_create', $data_pass);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'id_jenis_prop' => 'required',
            'judul_prop' => 'required',
            'tgl_prop' =>'required',
            'ditujukan' => 'required'
        ]);

        $id_jenis_prop = $req->id_jenis_prop;
        $judul_prop = $req->judul_prop;
        $tgl_prop = date('Y-m-d', strtotime($req->tgl_prop));
        $ditujukan = $req->ditujukan;

        $model = new proposals;
        $model->id_jenis_prop = $id_jenis_prop;
        $model->judul_prop = $judul_prop;
        $model->tgl_prop = $tgl_prop;
        $model->ditujukan = $ditujukan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Proposal')->with('message_success', 'Anda baru saja benambah proposal baru');
        }else{
            return redirect('Proposal')->with('message_fail', 'Terjadi kesalahan, Silahkan coba lagi');
        }
    }

    public function edit($id)
    {
        if(empty($data_proposal = proposals::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data_pass = [
            'jenis_proposal'=>jenis_proposal::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_proposal'=> $data_proposal
        ];

        return view('user.administrasi.section.proposal.page_edit', $data_pass);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'id_jenis_prop' => 'required',
            'judul_prop' => 'required',
            'tgl_prop' =>'required',
            'ditujukan' => 'required'
        ]);

        $id_jenis_prop = $req->id_jenis_prop;
        $judul_prop = $req->judul_prop;
        $tgl_prop = date('Y-m-d', strtotime($req->tgl_prop));
        $ditujukan = $req->ditujukan;

        $model = proposals::find($id);
        $model->id_jenis_prop = $id_jenis_prop;
        $model->judul_prop = $judul_prop;
        $model->tgl_prop = $tgl_prop;
        $model->ditujukan = $ditujukan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Proposal')->with('message_success', 'Anda baru saja mengubah proposal');
        }else{
            return redirect('Proposal')->with('message_fail', 'Terjadi kesalahan, Silahkan coba lagi');
        }
    }


    public function delete(Request $req, $id)
    {
        $model = proposals::find($id);
        if($model->delete())
        {
            return redirect('Proposal')->with('message_success', 'Anda baru saja menghapus proposal anda');
        }else{
            return redirect('Proposal')->with('message_fail', 'Terjadi kesalahan, Silahkan coba lagi');
        }
    }

}
