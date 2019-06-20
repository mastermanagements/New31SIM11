<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_aspek_pa as AP;
class AspekPenilaian extends Controller
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

    public function index(){
        $data = [
            'data'=> AP::all()->where('id_perusahaan',$this->id_perusahaan)
        ];
        return view("user.hrd.section.penilaian_karyawan.PA.AspekPenilaian.page_default", $data);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
           'nm_aspek'=> 'required',
           'bobot'=> 'required',
        ]);

        $model = new AP();
        $model->nm_aspek = $req->nm_aspek;
        $model->bobot = $req->bobot;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Aspek-Pa')->with('message_success', 'Anda telah menambahkan aspek penilaian baru');
        }else{
            return redirect('Aspek-Pa')->with('message_fail', 'Maaf, Penilaian Baru gagal disimpan');
        }
    }

    public function edit($id){
        if(empty($model = AP::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req, [
            'id'=>'required',
            'nm_aspek'=> 'required',
            'bobot'=> 'required',
        ]);

        $model = AP::find($req->id);
        $model->nm_aspek = $req->nm_aspek;
        $model->bobot = $req->bobot;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Aspek-Pa')->with('message_success', 'Anda telah mengubah aspek penilaian ');
        }else{
            return redirect('Aspek-Pa')->with('message_fail', 'Maaf,Aspek Penilaian gagal diubah');
        }
    }

    public function deletes(Request $req, $id)
    {
        $model = AP::find($id);
        if($model->delete()){
            return redirect('Aspek-Pa')->with('message_success', 'Anda telah menghapus aspek penilaian ');
        }else{
            return redirect('Aspek-Pa')->with('message_fail', 'Maaf,Aspek Penilaian gagal dihapus');
        }
    }
}
