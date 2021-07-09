<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\BApenyelesaian as bapenye;
use App\Model\Administrasi\SPKKontrak as spk;
use Session;

class BApenyelesaian extends Controller
{

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

    public function ambilDataBApenyelesaianByIDspk($idSpk){
        if(empty($data_penyelesaian = bapenye::where('id_perusahaan',$this->id_perusahaan)->where('id_spk', $idSpk))){
           return abort(404);
        }
        return $data_penyelesaian;
    }

    public function ambilDataSPKById($idSpk){
        if(empty($data_spk = spk::where('id_perusahaan',$this->id_perusahaan)->where('id', $idSpk))){
            return abort(404);
        }
        return $data_spk;
    }

    public function index($idspk)
    {
        $data=[
          'dataPenye'=> $this->ambilDataBApenyelesaianByIDspk($idspk)->paginate(30),
          'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BApenyelesaian.page_default', $data);
    }

    public function cari_penye(Request $req)
    {
        $idspk = $req->id_spk;
        $isi = $req->isi_bapeny;
        $data=[
            'dataPenye'=> $this->ambilDataBApenyelesaianByIDspk($idspk)->where('isi_bapeny','LIKE',"%{$isi}%")->paginate(30),
            'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BApenyelesaian.page_default', $data);
    }

    public function menu_modal(Request $req)
    {
        $idspk  = $req->id;
        $data=[
          'dataPenye'=> $this->ambilDataBApenyelesaianByIDspk($idspk)->paginate(30),
          'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BApenyelesaian.page_default', $data);
    }




    public function create($idSpk)
    {
        $data = [
            'save'=> 'save',
            'dataPenye'=> $this->ambilDataBApenyelesaianByIDspk($idSpk)->paginate(30),
            'spk'=> $this->ambilDataSPKById($idSpk)->first()
        ];
        return view('user.administrasi.section.BApenyelesaian.page_default', $data);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'isi_bapeny'=> 'required',
            'id_spk'=> 'required',
        ]);

        $isi_bapeny = $request->isi_bapeny;
        $id_spk= $request->id_spk;
        if($request->hasFile('file_bapey')){
            $file_bapey = $request->file_bapey;
            $extention= $file_bapey->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileName = uniqid().time().'.'.$extention;
                $file_bapey->move(public_path('fileBapey'),$fileName);
            }else{
                return redirect('BA-Penyelesaian/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileName = "";
        }

        if($request->hasFile('scan_file')){
            $file_scan = $request->scan_file;
            $extention= $file_scan->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileScanName = uniqid().time().'.'.$extention;
                $file_scan->move(public_path('fileScanBapey'),$fileScanName);
            }else{
                return redirect('BA-Penyelesaian/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileScanName = "";
        }

        $model = new bapenye;
        $model->id_spk = $id_spk;
        $model->isi_bapeny = $isi_bapeny;
        $model->file_bapeny = $fileName;
        $model->scan_file = $fileScanName;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('BA-Penyelesaian/'.$request->id_spk)->with('message_success','Anda telah menambah Ba. Penyelesaian');
        }else{
            return redirect('BA-Penyelesaian/'.$request->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id,$idSpk)
    {
        if(empty($data_BApenye = $this->ambilDataBApenyelesaianByIDspk($idSpk)->where('id', $id)->first())){
            return abort(404);
        }

        $data = [
            'save'=> 'update',
            'dataPenyeById'=> $data_BApenye,
            'dataPenye'=> $this->ambilDataBApenyelesaianByIDspk($idSpk)->paginate(30),
            'spk'=> $this->ambilDataSPKById($idSpk)->first()
        ];
        return view('user.administrasi.section.BApenyelesaian.page_default', $data);
    }


    public function update(Request $request, $id)
    {
      //  dd($request->all());
        $this->validate($request,[
            'isi_bapeny'=> 'required',
            'id_spk'=> 'required',
        ]);

        $isi_bapeny = $request->isi_bapeny;
        $id_spk= $request->id_spk;

        $model = bapenye::find($id);

        if(!empty($model->file_bapeny))
        {
            $file_path =public_path('fileBapey').'/' . $model->file_bapeny;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileScanBapey').'/' . $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($request->hasFile('file_bapey')){
            $file_bapey = $request->file_bapey;
            $extention= $file_bapey->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileName = uniqid().time().'.'.$extention;
                $file_bapey->move(public_path('fileBapey'),$fileName);
            }else{
                return redirect('BA-Penyelesaian/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileName = "";
        }

        if($request->hasFile('scan_file')){
            $file_scan = $request->scan_file;
            $extention= $file_scan->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileScanName = uniqid().time().'.'.$extention;
                $file_scan->move(public_path('fileScanBapey'),$fileScanName);
            }else{
                return redirect('BA-Penyelesaian/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileScanName = "";
        }

        $model = bapenye::find($id);
        $model->id_spk = $id_spk;
        $model->isi_bapeny = $isi_bapeny;
        $model->file_bapeny = $fileName;
        $model->scan_file = $fileScanName;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('BA-Penyelesaian/'.$request->id_spk)->with('message_success','Anda telah mengubah Ba. Penyelesaian');
        }else{
            return redirect('BA-Penyelesaian/'.$request->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }


    public function destroy($id)
    {
        if(empty($model = bapenye::find($id))){
            return abort(404);
        }


        if(!empty($model->file_bapeny))
        {
            $file_path =public_path('fileBapey').'/' . $model->file_bapeny;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileScanBapey').'/' . $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($model->delete())
        {
            return redirect('BA-Penyelesaian/'.$model->id_spk)->with('message_success','Anda telah menghapus Ba. Penyelesaian');
        }else{
            return redirect('BA-Penyelesaian/'.$model->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }
}
