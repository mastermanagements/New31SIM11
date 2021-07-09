<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\JenisPemeliharaan;
use App\Model\Produksi\Jasa as jasa;
use App\Model\Produksi\Pemeliharaan as pemeliharaans;
use App\Model\Produksi\Proyek as proyeks;
use Session;

class Pemeliharaan extends Controller
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

   /*  public function index()
    {
        $data = [
          'jenis_pemeliharaan' => JenisPemeliharaan::all()->where('id_perusahaan', $this->id_perusahaan),
          'data_pemeliaraan'=> pemeliharaans::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(15)
        ];
        return view('user.produksi.section.pemeliharaan.page_default', $data);
    } */

    public function show(Request $req)
    {
        $req_nama_pemeliharaan = $req->cari_nama_pemeliharaan;
        $data = [
          //'jenis_pemeliharaan' => JenisPemeliharaan::all()->where('id_perusahaan', $this->id_perusahaan),
          'data_pemeliaraan'=> pemeliharaans::where('nm_pemeliharaan', 'Like',"%{$req_nama_pemeliharaan}%")->where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(15)
        ];
        return view('user.produksi.section.pemeliharaan.page_default', $data);
    }

    public function create()
    {
        $data = [
			 'proyeks'=> proyeks::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(),
           // 'jasa'=> jasa::all()->where('id_perusahaan', $this->id_perusahaan),
           // 'jenis_pemeliharaan'=> JenisPemeliharaan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.produksi.section.pemeliharaan.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
           // 'id_jasa'=>'required',
           // 'id_jenis_pem'=>'required',
           // 'nm_pemeliharaan'=>'required',
			'id_proyek'=>'required',
            'jangka_waktu'=>'required',
            'biaya_pem'=>'required',
            'ket'=>'required',
        ]);

       // $id_jasa = $req->id_jasa;
       // $id_jenis_pem = $req->id_jenis_pem;
       // $nm_pemeliharaan = $req->nm_pemeliharaan;
		$id_proyek = $req->id_proyek;
        $jangka_waktu = $req->jangka_waktu;
        $biaya_pem= $req->biaya_pem;
        $ket= $req->ket;

        $model = new pemeliharaans;
		$model->id_proyek= $id_proyek;
        //$model->id_jasa=$id_jasa;
       // $model->id_jenis_pem=$id_jenis_pem;
        //$model->nm_pemeliharaan=$nm_pemeliharaan;
        $model->jangka_waktu=$jangka_waktu;
        $model->biaya_pem=rupiahController($biaya_pem);
        $model->ket=$ket;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            return redirect('Proyek')->with('message_success', 'Anda baru saja menambahkan pemeliharaan baru')->with('tab5','tab5');
        }else{
            return redirect('Proyek')->with('message_fail', 'Maaf, Telah terhadi kesalahan silahkan coba')->with('tab5','tab5');
        }
    }

    public function edit($id)
    {
        if(empty($model = pemeliharaans::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'jasa'=> jasa::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_pemeliharaan'=> JenisPemeliharaan::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_pemeliharaan'=> $model
        ];
        return view('user.produksi.section.pemeliharaan.page_edit', $data);
    }


    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'id_jasa'=>'required',
            'id_jenis_pem'=>'required',
            'nm_pemeliharaan'=>'required',
            'jangka_waktu'=>'required',
            'biaya_pem'=>'required',
            'ket'=>'required',
        ]);

        $id_jasa = $req->id_jasa;
        $id_jenis_pem = $req->id_jenis_pem;
        $nm_pemeliharaan = $req->nm_pemeliharaan;
        $jangka_waktu = $req->jangka_waktu;
        $biaya_pem= $req->biaya_pem;
        $ket= $req->ket;

        $model = pemeliharaans::find($id);
        $model->id_jasa=$id_jasa;
        $model->id_jenis_pem=$id_jenis_pem;
        $model->nm_pemeliharaan=$nm_pemeliharaan;
        $model->jangka_waktu=$jangka_waktu;
        $model->biaya_pem=$biaya_pem;
        $model->ket=$ket;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            return redirect('Pemeliharaan')->with('message_success', 'Anda baru saja mengubah pemeliharaan');
        }else{
            return redirect('Pemeliharaan')->with('message_fail', 'Maaf, Telah terhadi kesalahan silahkan coba');
        }
    }

    public function delete(Request $req, $id)
    {

        if(empty($model = pemeliharaans::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete()){
            return redirect('Pemeliharaan')->with('message_success', 'Anda baru saja menghapus pemeliharaan');
        }else{
            return redirect('Pemeliharaan')->with('message_fail', 'Maaf, Telah terhadi kesalahan silahkan coba');
        }
    }
}
