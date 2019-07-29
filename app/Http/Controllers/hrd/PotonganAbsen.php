<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_potongan_tetap as hpt;
use App\Model\Hrd\H_absensi as abs;
use App\Model\Hrd\PotonganAbsen as PA;

class PotonganAbsen extends Controller
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
        $data = [
            'absensi'=> abs::all()->where('id_perusahaan', $this->id_perusahaan)->sortBy('periode'),
            'pt'=> hpt::all()->where('id_perusahaan', $this->id_perusahaan),
            'PA'=> PA::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
         return view('user.hrd.section.PotonganAbsen.page_default', $data);
    }

    public function store(Request $req){
         $this->validate($req,[
            'periode'=>'required',
           'id_absensi' => 'required',
           'id_potongan_tetap' => 'required',
           'jumlah_item_p' => 'required',
        ]);

        $model = new PA();
        $model->periode = date('Y-m-d', strtotime($req->periode));
        $model->id_absensi = $req->id_absensi;
        $model->id_potongan_tetap = $req->id_potongan_tetap;
        $model->jumlah_item_p = $req->jumlah_item_p;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Potongan-absen')->with('message_success','Anda telah menambahkan data potongan absen');
        }else{
            return redirect('Potongan-absen')->with('message_fail','Maaf, Data potongan absen tidak tersimpan');
        }
    }

    public function edit($id){
        if(empty($model = PA::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'id'=>'required',
            'periode'=>'required',
            'id_absensi' => 'required',
            'id_potongan_tetap' => 'required',
            'jumlah_item_p' => 'required',
        ]);

        $model = PA::find($req->id);
        $model->periode = date('Y-m-d', strtotime($req->periode));
        $model->id_absensi = $req->id_absensi;
        $model->id_potongan_tetap = $req->id_potongan_tetap;
        $model->jumlah_item_p = $req->jumlah_item_p;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Potongan-absen')->with('message_success','Anda telah mengubah data potongan absen');
        }else{
            return redirect('Potongan-absen')->with('message_fail','Maaf, Data potongan absen tidak terubah');
        }
    }

    public function delete(Request $req, $id){
        $model = PA::find($id);
        if($model->save()){
            return redirect('Potongan-absen')->with('message_success','Anda telah menghapus data potongan absen');
        }else{
            return redirect('Potongan-absen')->with('message_fail','Maaf, Data potongan absen tidak terhapus');
        }
    }
}
