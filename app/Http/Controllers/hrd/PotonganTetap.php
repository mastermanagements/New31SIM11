<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_potongan_tetap as hpt;
class PotonganTetap extends Controller
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

    public function index(){
        $data =[
            'data'=> hpt::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.PotonganTetap.page_default', $data);
    }

    public function store(Request $req)
    {
         $this->validate($req,[
            'nm_potongan'=>'required',
            'satuan_potongan'=>'required',
            'status_potongan'=>'required',
            'besar_potongan'=>'required',
        ]);

        $model = new hpt();
        $model->nm_potongan= $req->nm_potongan;
        $model->satuan_potongan= $req->satuan_potongan;
        $model->status_potongan= $req->status_potongan;
        $model->besar_potongan= $req->besar_potongan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save()){
            return redirect('Potongan-tetap')->with('message_success','Anda telah menambahkan Potongan tetap');
        }else{
            return redirect('Potongan-tetap')->with('message_fail','Maaf, Potongan tetap tidak dapat disimpan');
        }
    }

    public function edit($id)
    {
        if(empty($model= hpt::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'id'=>'required',
            'nm_potongan'=>'required',
            'satuan_potongan'=>'required',
            'status_potongan'=>'required',
            'besar_potongan'=>'required',
        ]);

        $model = hpt::find($req->id);
        $model->nm_potongan= $req->nm_potongan;
        $model->satuan_potongan= $req->satuan_potongan;
        $model->status_potongan= $req->status_potongan;
        $model->besar_potongan= $req->besar_potongan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save()){
            return redirect('Potongan-tetap')->with('message_success','Anda telah mengubah Potongan tetap');
        }else{
            return redirect('Potongan-tetap')->with('message_fail','Maaf, Potongan tetap tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = hpt::find($id);
        if($model->delete()){
            return redirect('Potongan-tetap')->with('message_success','Anda telah menghapus Potongan tetap');
        }else{
            return redirect('Potongan-tetap')->with('message_fail','Maaf, Potongan tetap tidak dapat dihapus');
        }
    }
}
