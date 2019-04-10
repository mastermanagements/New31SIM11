<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\SPKKontrak as spk;
use App\Model\Administrasi\BAkemajuan as bapem;
use Session;

class BAkemajuan extends Controller
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

    public function form(Request $req)
    {
        $this->validate($req,[
            '_token'=> 'required'
        ]);

        if(empty($data_spk=spk::where('id', $req->id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }else{
            $data_bapem = bapem::where('id_spk', $data_spk->id)->where('id_perusahaan', $this->id_perusahaan)->paginate();
        }

        if(!empty($req->id_bapem) && !empty($data_bapem_get=bapem::where('id', $req->id_bapem)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            $dataBapems = $data_bapem_get;
        }else{
            $dataBapems = [
                'id'=>'null',
                'isi_bapem'=>'null',
                'scan_file'=>'null'
            ];
        }

        $data_pass = [
            'spk'=> $data_spk,
            'save'=> $req->callForm,
            'data_bapem'=> $data_bapem,
            'dataBapemById'=> $dataBapems
        ];
        return view('user.administrasi.section.BAkemajuan.page_default', $data_pass);
    }

    public function cari_bapem(Request $req)
    {
        $this->validate($req,[
            'isi_bapems'=>'required',
            '_token'=> 'required'
        ]);

        if(empty($data_spk=spk::where('id', $req->id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }else{
            $data_bapem = bapem::where('id_spk', $data_spk->id)->where('isi_bapem','LIKE',"%{$req->isi_bapems}%")->where('id_perusahaan', $this->id_perusahaan)->paginate();
        }


        $data_pass = [
            'spk'=> $data_spk,
            'save'=> $req->callForm,
            'data_bapem'=> $data_bapem,
        ];
        return view('user.administrasi.section.BApemeriksaan.page_default', $data_pass);
    }

    public function proses(Request $req)
    {
        dd('asda');
        $this->validate($req,[
            'isi_bakem'=> 'required',
            'id_spk'=> 'required'
        ]);

        $id_spk = $req->id_spk;
        $isi_bapem = $req->isi_bakem;

        if($req->hasFile('file_bakem'))
        {
            $file_bapem = $req->file_bapem;
            $name_files = uniqid().time().'.'.$file_bapem->getClientOriginalExtension();
            $file_bapem->move(public_path('file_bakem'), $name_files);
        }else{
            $name_files = "";
        }

        if($req->hasFile('scan_file'))
        {
            $file_scan_bapem = $req->scan_file;
            $name_files_scan = uniqid().time().'.'.$file_scan_bapem->getClientOriginalExtension();
            $file_scan_bapem->move(public_path('fileScanBAkem'), $name_files_scan);
        }else{
            $name_files_scan = "";
        }

        $model = new bapem;
        $model->id_spk= $id_spk;
        $model->isi_bak	= $isi_bapem;
        $model->file_bakem= $name_files;
        $model->scan_file= $name_files_scan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('BA-Kemajuan?id='.$id_spk)->with('message_success','Anda Baru saja menambahkan BAK');
        }else{
            return redirect('BA-Kemajuan?id='.$id_spk)->with('message_fail','Terjadi Kesalahan, Silahkan coba lagi');
        }
    }

    public function proses_Update(Request $req, $id)
    {
        $this->validate($req,[
            'isi_bapem'=> 'required',
            'id_spk'=> 'required'
        ]);

        $id_spk = $req->id_spk;
        $isi_bapem = $req->isi_bapem;

        $model = bapem::find($id);

        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileBApem').'/' . $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($req->hasFile('file_bapem'))
        {
            $file_bapem = $req->file_bapem;
            $name_files = uniqid().time().'.'.$file_bapem->getClientOriginalExtension();
            $file_bapem->move(public_path('fileBApem'), $name_files);
        }else{
            $name_files = "";
        }


        $model->id_spk= $id_spk;
        $model->isi_bapem= $isi_bapem;
        $model->scan_file= $name_files;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('Ba-Pemeriksaan?id='.$id_spk)->with('message_success','Anda Baru saja menambahkan BAP');
        }else{
            return redirect('Ba-Pemeriksaan?id='.$id_spk)->with('message_fail','Terjadi Kesalahan, Silahkan coba lagi');
        }
    }

    public function proses_delete(Request $req, $id)
    {

        if(empty($model = bapem::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(400);
        }

        $id_spk = $req->id_spk;

        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileBApem').'/' . $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        if($model->delete())
        {
            return redirect('Ba-Pemeriksaan?id='.$id_spk)->with('message_success','Anda Baru saja menambahkan BAP');
        }else{
            return redirect('Ba-Pemeriksaan?id='.$id_spk)->with('message_fail','Terjadi Kesalahan, Silahkan coba lagi');
        }
    }
}
