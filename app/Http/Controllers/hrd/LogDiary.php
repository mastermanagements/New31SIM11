<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_log_diary as log_diary;

class LogDiary extends Controller
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

    public function index(){
        $data =[
            'data'=> log_diary::where('id_perusahaan', $this->id_perusahaan)->paginate(10)
        ];
        return view('user.hrd.section.log_diary.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'tgl_log_diary' => 'required',
            'key_moment' => 'required',
        ]);

        $model = new log_diary();
        $model->tgl_log_diary = date('Y-m-d', strtotime($req->tgl_log_diary));
        $model->key_moment = $req->key_moment;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Log-Diary')->with('message_success','Anda telah menambahkan diary baru');
        }else{
            return redirect('Log-Diary')->with('message_fail','Maaf, Diary gagal untuk disimpan');
        }
    }

    public function edit($id){
        if(empty($model = log_diary::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req, [
            'tgl_log_diary' => 'required',
            'key_moment' => 'required',
            'id' => 'required',
        ]);

        $model = log_diary::find($req->id);
        $model->tgl_log_diary = date('Y-m-d', strtotime($req->tgl_log_diary));
        $model->key_moment = $req->key_moment;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Log-Diary')->with('message_success','Anda telah mengubah diary baru');
        }else{
            return redirect('Log-Diary')->with('message_fail','Maaf, Diary gagal untuk diubah');
        }
    }

    public function delete($id){
        if(empty($model = log_diary::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($model->delete()){
            return redirect('Log-Diary')->with('message_success','Anda telah menghapus diary baru');
        }else{
            return redirect('Log-Diary')->with('message_fail','Maaf, Diary gagal untuk dihapus');
        }
    }

}
