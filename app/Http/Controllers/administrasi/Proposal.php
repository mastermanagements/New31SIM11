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

   /*  public function index()
    {
        $data=[
            'data_proposal'=> proposals::where('id_perusahaan', $this->id_perusahaan)->paginate(20)
        ];
        return view('user.administrasi.section.proposal.page_default', $data);
    } */

    public function cari(Request $req)
    {
        $this->validate($req,[
           'judul_proposal' => 'required'
        ]);
        $judul_proposal = $req->judul_proposal;
        $data=[
            'data_proposal'=> proposals::where('judul_prop','LIKE', "%{$judul_proposal}%")->where('id_perusahaan', $this->id_perusahaan)->paginate(20)
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
            return redirect('Surat')->with('message_success', 'Anda baru saja benambah proposal baru')->with('tab3','tab3');
        }else{
            return redirect('Surat')->with('message_fail', 'Terjadi kesalahan, Silahkan coba lagi')->with('tab3','tab3');
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
            return redirect('Surat')->with('message_success', 'Anda baru saja mengubah proposal')->with('tab3','tab3');
        }else{
            return redirect('Surat')->with('message_fail', 'Terjadi kesalahan, Silahkan coba lagi')->with('tab3','tab3');
        }
    }


    public function delete(Request $req, $id)
    {
        $model = proposals::find($id);
        if($model->delete())
        {
            return redirect('Surat')->with('message_success', 'Anda baru saja menghapus proposal anda')->with('tab3','tab3');
        }else{
            return redirect('Surat')->with('message_fail', 'Terjadi kesalahan, Silahkan coba lagi')->with('tab3','tab3');
        }
    }

    public function uploadCoverProposal(Request $req)
    {

        $this->validate($req, [
            'id_cover_proposal' => 'required',
            'cover_prop' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        $id = $req->id_cover_proposal;
        $cover_proposal = $req->cover_prop;
        $name_file =  time().'_coverProposal.'.$cover_proposal->getClientOriginalExtension();

        $model = proposals::findOrFail($id);
        if(!empty($model->cover_prop)){
            $file_path = public_path('coverDirectori').'/'.$model->cover_prop;
            if(file_exists($file_path))
            {
                @unlink($file_path);
            }
        }

        $model->cover_prop = $name_file;

        if($model->save())
        {
            if ($cover_proposal->move(public_path('coverDirectori'), $name_file)) {
                return redirect('Surat')->with('message_success','Berhasil cover proposal telah berhasil diunggah')->with('tab3','tab3');
            }else{
                return redirect('Surat')->with('message_error','Gagal meng-unggul cover proposal')->with('tab3','tab3');
            }
        }

    }


    public function uploadDocProposal(Request $req)
    {
       $this->validate($req, [
            'id_doc_proposal' => 'required',
            'doc_prop' => 'required|file|mimes:rar,zip'
        ]);

        $id = $req->id_doc_proposal;
        $doc_proposal = $req->doc_prop;
        $name_file =  uniqid().time().'.'. $doc_proposal->getClientOriginalExtension();

        $model = proposals::findOrFail($id);
        if(!empty($model->file_prop)){
            $file_path = public_path('documentDirectori').'/'.$model->file_prop;
            if(file_exists($file_path))
            {
                @unlink($file_path);
            }
        }

        $model->file_prop = $name_file;

        if($model->save())
        {
            if ($doc_proposal->move(public_path('documentDirectori'), $name_file)) {
                return redirect('Surat')->with('message_success','Berhasil cover proposal telah berhasil diunggah')->with('tab3','tab3');
            }else{
                return redirect('Surat')->with('message_error','Gagal meng-unggul cover proposal')->with('tab3','tab3');
            }
        }
    }

    public function ubah_status_proposal(Request $req, $id)
    {
        if(empty($data_proposal = proposals::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $status_proposal = $data_proposal->status_prop;
        if($status_proposal == '0'){
            $status_proposal = '1';
        }else{
            $status_proposal = '0';
        }
        $data_proposal->status_prop = $status_proposal;
        if($data_proposal->save())
        {
            $data = [
                'message'=> 'Anda telah mengubah data status proposal',
                'status' => 'true'
            ];
            return response()->json($data);
        }else{
            $data = [
                'message'=> 'Status Proposal tidak bisa diubah',
                'status' => 'false'
            ];
            return response()->json($data);
        }
    }
}
