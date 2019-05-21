<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_jenis_psikotes as jenis_psikotes;
class JenisPsikotes extends Controller
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
          'jenis_psikotes'=> jenis_psikotes::all()->where('id_perusahaan')
        ];
        return view('user.hrd.section.tes.psikotes.jenispsikotes.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'jenis_psikotes'=> 'required'
        ]);

        $jenis_psikotes = $req->jenis_psikotes;
        $model =new jenis_psikotes;
        $model->jenis_psikotes = $jenis_psikotes;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('jenis-psikotes')->with('message_sucess', 'Anda telah menambahkan jenis');
        }else{
            return redirect('jenis-psikotes')->with('message_fail', 'Telah terjadi kesalahan. silahkan coba lagi');
        }
    }

    public function edit($id){
        if(empty($modal = jenis_psikotes::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($modal);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'jenis_psikotes_ubah'=> 'required',
            'id_jenis_psikotes' => 'required'
        ]);

        $jenis_psikotes = $req->jenis_psikotes_ubah;
        $model =jenis_psikotes::find($req->id_jenis_psikotes);
        $model->jenis_psikotes = $jenis_psikotes;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('jenis-psikotes')->with('message_sucess', 'Anda telah mengubah jenis');
        }else{
            return redirect('jenis-psikotes')->with('message_fail', 'Telah terjadi kesalahan. silahkan coba lagi');
        }
    }


    public function delete(Request $req, $id)
    {
        if(empty($modal = jenis_psikotes::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($modal->delete()){
            return redirect('jenis-psikotes')->with('message_sucess', 'Anda telah menghapus jenis psikotes');
        }else{
            return redirect('jenis-psikotes')->with('message_fail', 'Telah terjadi kesalahan. silahkan coba lagi');
        }
    }
}
