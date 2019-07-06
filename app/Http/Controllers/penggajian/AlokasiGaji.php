<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\AlokasiGaji as ag;
class AlokasiGaji extends Controller
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
        $data = [
            'data'=>ag::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.alokasi_gaji.page_default', $data);
    }

    public function store(Request $req)
    {
        //dd($req->all());
        $this->validate($req,[
           'thn'=>'required',
           'persen'=>'required',
           'jumlah'=>'required',
        ]);

        $model = new ag();
        $model->thn = $req->thn;
        $model->persen = $req->persen;
        $model->jumlah = $req->jumlah;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Alokasi-Gaji')->with('message_success', 'Anda telah menambahakan alokasi gaji');
        }else{
            return redirect('Alokasi-Gaji')->with('message_fail','Maaf, alokasi gaji tidak tersimpan');
        }
    }

    public function edit($id){
        if(empty($model = ag::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req)
    {
        //dd($req->all());
        $this->validate($req,[
            'thn'=>'required',
            'persen'=>'required',
            'jumlah'=>'required',
            'id'=>'required',
        ]);

        $model = ag::find($req->id);
        $model->thn = $req->thn;
        $model->persen = $req->persen;
        $model->jumlah = $req->jumlah;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Alokasi-Gaji')->with('message_success', 'Anda telah mengubah alokasi gaji');
        }else{
            return redirect('Alokasi-Gaji')->with('message_fail','Maaf, alokasi gaji tidak terubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = ag::find($id);

        if($model->delete()){
            return redirect('Alokasi-Gaji')->with('message_success', 'Anda telah menghapus alokasi gaji');
        }else{
            return redirect('Alokasi-Gaji')->with('message_fail','Maaf, alokasi gaji tidak terhapus');
        }
    }


}
