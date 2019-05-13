<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\JualJasa as jualJasas;
use App\Model\Administrasi\Klien as klien;
use App\Model\Produksi\Jasa as jasa;
use Session;

class Jualjasa extends Controller
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
            'data_klien'=>klien::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_jasa'=>jualJasas::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(30)
        ];
        return view('user.produksi.section.jualjasa.page_default', $data);
    }
    public function cari_jual_jasa(Request $request)
    {
        $id_klien = $request->id_klien;
        $data = [
            'data_klien'=>klien::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_jasa'=>jualJasas::where('id_perusahaan', $this->id_perusahaan)->where('id_klien', $id_klien)->paginate(30)
        ];
        return view('user.produksi.section.jualjasa.page_default', $data);
    }

    public function create(){
        $data =[
            'data_klien'=> klien::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_jasa'=> jasa::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.produksi.section.jualjasa.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'id_klien' => 'required',
           'id_jasa' => 'required',
           'detail_pesanan' => 'required',
           'harga_jual' => 'required',
        ]);

        $id_klien = $req->id_klien;
        $id_jasa = $req->id_jasa;
        $detail_pesanan = $req->detail_pesanan;
        $harga_jual = $req->harga_jual;

        $model = new jualJasas;
        $model->id_klien= $id_klien;
        $model->id_jasa= $id_jasa;
        $model->detail_pesanan= $detail_pesanan;
        $model->harga_jual= $harga_jual;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Jual-Jasa')->with('message_success', 'Anda telah menambahkan jual jasa baru');
        }else{
            return redirect('Jual-Jasa')->with('message_fail', 'Maaf telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function edit($id){

        if(empty($data = jualJasas::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data =[
            'data_klien'=> klien::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_jasa'=> jasa::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_jualjasa'=>$data ,
        ];
        return view('user.produksi.section.jualjasa.page_edit', $data);
    }


    public function update(Request $req, $id){
        $this->validate($req,[
            'id_klien' => 'required',
            'id_jasa' => 'required',
            'detail_pesanan' => 'required',
            'harga_jual' => 'required',
        ]);

        $id_klien = $req->id_klien;
        $id_jasa = $req->id_jasa;
        $detail_pesanan = $req->detail_pesanan;
        $harga_jual = $req->harga_jual;

        $model = jualJasas::find($id);
        $model->id_klien= $id_klien;
        $model->id_jasa= $id_jasa;
        $model->detail_pesanan= $detail_pesanan;
        $model->harga_jual= $harga_jual;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Jual-Jasa')->with('message_success', 'Anda telah mengubah jual jasa baru');
        }else{
            return redirect('Jual-Jasa')->with('message_fail', 'Maaf telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function delete(Request $req, $id){
         if(empty($model = jualJasas::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
             return abort(404);
         }
        if($model->delete()){
            return redirect('Jual-Jasa')->with('message_success', 'Anda telah menghapus jual jasa baru');
        }else{
            return redirect('Jual-Jasa')->with('message_fail', 'Maaf telah terjadi kesalahan silahkan coba lagi');
        }
    }
}
