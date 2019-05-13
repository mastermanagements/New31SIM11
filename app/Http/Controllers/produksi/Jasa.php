<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\Jasa as jasas;
use App\Model\Superadmin_sim\P_kategori_produk as kategori_produk;

class Jasa extends Controller
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
          'data_jasa'=> jasas::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(30)
        ];
        return view('user.produksi.section.jasa.page_default', $data);
    }
    public function Cari_jasa(Request $req){
        $nm_jasa = $req->nm_jasa;
        $data = [
          'data_jasa'=> jasas::where('id_perusahaan', $this->id_perusahaan)->where('nm_jasa',"LIKE","%{$nm_jasa}%")->paginate(30)
        ];
        return view('user.produksi.section.jasa.page_default', $data);
    }

    public function create(){
        $data = [
          'kategori_jasa'=> kategori_produk::all()
        ];
        return view('user.produksi.section.jasa.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_kategori'=>'required',
            'nm_jasa'=> 'required',
            'harga_jasa' => 'required',
            'rincian_jasa' => 'required'
        ]);

        $id_kategori_produk = $req->id_kategori;
        $id_subkategori_produk = $req->id_subkategori_produk;
        $id_subsubkategori_produk = $req->id_subsubkategori_produk;
        $nm_jasa = $req->nm_jasa;
        $harga_jasa = $req->harga_jasa;
        $rincian_jasa = $req->rincian_jasa;

        $model = new jasas();
        $model->id_kategori_produk =$id_kategori_produk;
        $model->id_subkategori_produk =$id_subkategori_produk;
        $model->id_subsubkategori_produk =$id_subsubkategori_produk;
        $model->nm_jasa =$nm_jasa;
        $model->harga_jasa =$harga_jasa;
        $model->rincian_jasa =$rincian_jasa;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save()){
            return redirect('Jasa')->with('message_success', 'Anda telah menambahkan Jasa Baru');
        }else{
            return redirect('Jasa')->with('message_fail', 'Terjadi kesalahan silahkan coba lagi ... !!');
        }
    }

    public function edit($id){
        if(empty($data_jasa = jasas::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'kategori_jasa'=> kategori_produk::all(),
            'data_jasa'=> $data_jasa
        ];
        return view('user.produksi.section.jasa.page_edit', $data);
    }

    public function update(Request $req,$id){
        $this->validate($req,[
            'id_kategori'=>'required',
            'nm_jasa'=> 'required',
            'harga_jasa' => 'required',
            'rincian_jasa' => 'required'
        ]);

        $id_kategori_produk = $req->id_kategori;
        $id_subkategori_produk = $req->id_subkategori_produk;
        $id_subsubkategori_produk = $req->id_subsubkategori_produk;
        $nm_jasa = $req->nm_jasa;
        $harga_jasa = $req->harga_jasa;
        $rincian_jasa = $req->rincian_jasa;

        $model = jasas::find($id);
        $model->id_kategori_produk =$id_kategori_produk;
        $model->id_subkategori_produk =$id_subkategori_produk;
        $model->id_subsubkategori_produk =$id_subsubkategori_produk;
        $model->nm_jasa =$nm_jasa;
        $model->harga_jasa =$harga_jasa;
        $model->rincian_jasa =$rincian_jasa;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save()){
            return redirect('Jasa')->with('message_success', 'Anda telah mengubah Jasa Baru');
        }else{
            return redirect('Jasa')->with('message_fail', 'Terjadi kesalahan silahkan coba lagi ... !!');
        }
    }

    public function destroy(Request $req, $id)
    {
        if(empty($model = jasas::where('id', $id)))
        {
            return abort(404);
        }
        if($model->delete()){
            return redirect('Jasa')->with('message_success', 'Anda telah menghapus Jasa Baru');
        }else{
            return redirect('Jasa')->with('message_fail', 'Terjadi kesalahan silahkan coba lagi ... !!');
        }
    }

}
