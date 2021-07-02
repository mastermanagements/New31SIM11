<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hrd\H_loker as lokers;
use Session;

class Loker extends Controller
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

    public function index()
    {
        $data=[
          'loker'=> lokers::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate()
        ];
        return view('user.hrd.section.loker.page_default',$data );
    }

    public function create()
    {
        return view('user.hrd.section.loker.page_create');
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'nm_loker'=> 'required',
           'detail'=> 'required',
           'tgl_buka'=> 'required',
           'tgl_selesai'=> 'required',
           'jumlah_pelamar'=> 'required',
        ]);

        $nm_loker = $req->nm_loker;
        $detail = $req->detail;
        $tgl_buka = date('Y-m-d', strtotime($req->tgl_buka));
        $tgl_selesai = date('Y-m-d', strtotime($req->tgl_selesai));
        $jumlah_pelamar = $req->jumlah_pelamar;

        $model = new lokers;
        $model->nm_loker = $nm_loker;
        $model->detail = $detail;
        $model->tgl_buka = $tgl_buka;
        $model->tgl_selesai =  $tgl_selesai;
        $model->jumlah_pelamar = $jumlah_pelamar;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Rekruitmen')->with('message_success', 'Anda Baru saja menambahkan rekrutmen baru');
        }else{
            return redirect('Rekruitmen')->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }

    public function edit($id)
    {
        if(empty($model= lokers::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'data'=> $model
        ];
        return view('user.hrd.section.loker.page_edit', $data );
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'nm_loker'=> 'required',
            'detail'=> 'required',
            'tgl_buka'=> 'required',
            'tgl_selesai'=> 'required',
            'jumlah_pelamar'=> 'required',
        ]);

        $nm_loker = $req->nm_loker;
        $detail = $req->detail;
        $tgl_buka = date('Y-m-d', strtotime($req->tgl_buka));
        $tgl_selesai = date('Y-m-d', strtotime($req->tgl_selesai));
        $jumlah_pelamar = $req->jumlah_pelamar;

        $model = lokers::find($id);
        $model->nm_loker = $nm_loker;
        $model->detail = $detail;
        $model->tgl_buka = $tgl_buka;
        $model->tgl_selesai =  $tgl_selesai;
        $model->jumlah_pelamar = $jumlah_pelamar;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Rekruitmen')->with('message_success', 'Anda Baru saja mengubah rekrutmen baru');
        }else{
            return redirect('Rekruitmen')->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }


    public function delete($id)
    {

        if(empty($model = lokers::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete()){
            return redirect('Rekruitmen')->with('message_success', 'Anda Baru saja mengahapus rekrutmen baru');
        }else{
            return redirect('Rekruitmen')->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }

    public function upload_image(Request $req){
        $this->validate($req, [
            'idLoker' => 'required',
            'file_loker' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        $id=$req->idLoker;
        $file_loker = $req->file_loker;
        $name_file =  time().'_fileLoker.'.$file_loker->getClientOriginalExtension();

        $model = lokers::findOrFail($id);
        if(!empty($model->file_loker)){
            $file_path = public_path('fileLoker').'/'.$model->file_loker;
            if(file_exists($file_path))
            {
                @unlink($file_path);
            }
        }

        $model->file_loker = $name_file;
        if($model->save()){
            $file_loker->move(public_path('fileLoker'), $name_file);
            return redirect('Rekruitmen')->with('message_success', 'unggah file rekrutment berhasil');
        }else{
            return redirect('Rekruitmen')->with('message_fail', 'unggah tidak berhasil');
        }
    }

    public function show($id){
        if(empty($model = lokers::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data= [
          'model'=> $model
        ];

        return view('user.hrd.section.loker.page_detail', $data);
    }

    public function search(Request $req){
        $nama_loker = $req->nm_loker;
        $data=[
            'loker'=> lokers::where('id_perusahaan', $this->id_perusahaan)->where('nm_loker','LIKE',"%{$nama_loker}%")->orderBy('created_at','desc')->paginate()
        ];
        return view('user.hrd.section.loker.page_default',$data );
    }
}
