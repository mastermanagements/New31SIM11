<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Administrasi\A_Jenis_Proposal as jenis_proposal;

class JenisProposal extends Controller
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
        $data_jenis_surat = jenis_proposal::all()->where('id_perusahaan', $this->id_perusahaan);
        $column = array();
        $no = 1;
        foreach ($data_jenis_surat as $value)
        {
            $row = array();
            $row[] = $no++;
            $row[] = $value->jenis_proposal;
            $row[] = '<button class="btn btn-warning" onclick="UbahJenisProposal('.$value->id.')"> ubah </button>'.
            '<button class="btn btn-danger" onclick="HapusJenisProposal('.$value->id.')"> hapus </button>';
            $column[] = $row;
        }
        $output = array('data'=> $column);
        return response()->json($output);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'jenis_proposal' => 'required'
        ]);
        $jenis_proposal = $req->jenis_proposal;
        $model = new jenis_proposal;
        $model->jenis_proposal = $jenis_proposal;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save())
        {
            return redirect('Proposal')->with('message_success','Anda telah menambah jenis proposal baru');
        }
        else
        {
            return redirect('Proposal')->with('message_fail','Terjadi kesalahan, silahkan coba lagi');
        }
    }

    public function edit($id)
    {
        if(empty($data_jenis_proposal = jenis_proposal::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = $data_jenis_proposal;
        return response()->json($data);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'jenis_proposal_ubah' => 'required',
            'id'=> 'required'
        ]);
        $jenis_proposal = $req->jenis_proposal_ubah;
        $id = $req->id;
        $model = jenis_proposal::find($id);
        $model->jenis_proposal = $jenis_proposal;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save())
        {
            return redirect('Proposal')->with('message_success','Anda telah mengubah jenis proposal');
        }
        else
        {
            return redirect('Proposal')->with('message_fail','Terjadi kesalahan, silahkan coba lagi');
        }
    }

    public function delete(Request $req)
    {
        $this->validate($req,[
            'id'=> 'required'
        ]);
        $id = $req->id;
        $model = jenis_proposal::find($id);
        if($model->delete())
        {
            return redirect('Proposal')->with('message_success','Anda telah menghapus jenis proposal');
        }
        else
        {
            return redirect('Proposal')->with('message_fail','Terjadi kesalahan, silahkan coba lagi');
        }
    }

}
