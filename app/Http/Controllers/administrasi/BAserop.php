<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

use App\Model\Administrasi\BAserops as ba_serops;
use App\Model\Administrasi\SPKKontrak as spk;

class BAserop extends Controller
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


    public function ambilDataBASeropByIDspk($idSpk){
        if(empty($data_penyelesaian = ba_serops::where('id_perusahaan',$this->id_perusahaan)->where('id_spk', $idSpk))){
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
            'dataSerops'=> $this->ambilDataBASeropByIDspk($idspk)->paginate(30),
            'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BAserops.page_default', $data);
    }

    public function cari(Request $req)
    {
        $idspk = $req->id_spk;
        $cari = $req->isi_serop;
        $data=[
            'dataSerops'=> $this->ambilDataBASeropByIDspk($idspk)->where('isi_serops','LIKE',"%{$cari}%")->paginate(30),
            'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BAserops.page_default', $data);
    }

    public function MenuIndex(Request $req)
    {
        $idspk = $req->id_spk;
        $data=[
            'dataSerops'=> $this->ambilDataBASeropByIDspk($idspk)->paginate(30),
            'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BAserops.page_default', $data);
    }

    public function create($idSpk)
    {

        if(empty($data_spk = $this->ambilDataSPKById($idSpk)->first())){
            return abort(404);
        }
        $data = [
            'save'=> 'save',
            'dataSerops'=> $this->ambilDataBASeropByIDspk($idSpk)->paginate(30),
            'spk'=> $data_spk
        ];
        return view('user.administrasi.section.BAserops.page_default', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'isi_serops'=> 'required',
            'id_spk'=> 'required',
        ]);

        $isi_baserops = $request->isi_serops;
        $id_spk= $request->id_spk;
        if($request->hasFile('file_serops')){
            $file_serops = $request->file_serops;
            $extention= $file_serops->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileName = uniqid().time().'.'.$extention;
                $file_serops->move(public_path('fileBaSerops'),$fileName);
            }else{
                return redirect('BA-Serah-Terima-Operasional/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileName = "";
        }

        if($request->hasFile('scan_file')){
            $file_scan = $request->scan_file;
            $extention= $file_scan->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileScanName = uniqid().time().'.'.$extention;
                $file_scan->move(public_path('fileScanBaSerops'),$fileScanName);
            }else{
                return redirect('BA-Serah-Terima-Operasional/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileScanName = "";
        }

        $model = new ba_serops;
        $model->id_spk = $id_spk;
        $model->isi_serops = $isi_baserops;
        $model->file_serops = $fileName;
        $model->scan_file = $fileScanName;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('BA-Serah-Terima-Operasional/'.$request->id_spk)->with('message_success','Anda telah menambah Ba. Serah Terima');
        }else{
            return redirect('BA-Serah-Terima-Operasional/'.$request->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }

    public function edit($id,$idSpk)
    {

        if(empty($data_spk = $this->ambilDataSPKById($idSpk)->first())){
            return abort(404);
        }
        $data = [
            'save'=> 'update',
            'dataSerops'=> $this->ambilDataBASeropByIDspk($idSpk)->paginate(30),
            'dataSeropsById'=> $this->ambilDataBASeropByIDspk($idSpk)->where('id', $id)->first(),
            'spk'=> $data_spk
        ];
        return view('user.administrasi.section.BAserops.page_default', $data);
    }

    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'isi_serops'=> 'required',
            'id_spk'=> 'required',
        ]);

        $isi_baserops = $request->isi_serops;
        $id_spk= $request->id_spk;

        $model = ba_serops::find($id);

        if(!empty($model->file_serops))
        {
            $file_path =public_path('fileBaSerops').'/' . $model->file_serops;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileScanBaSerops').'/' . $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($request->hasFile('file_serops')){
            $file_serops = $request->file_serops;
            $extention= $file_serops->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileName = uniqid().time().'.'.$extention;
                $file_serops->move(public_path('fileBaSerops'),$fileName);
            }else{
                return redirect('BA-Serah-Terima-Operasional/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileName = "";
        }

        if($request->hasFile('scan_file')){
            $file_scan = $request->scan_file;
            $extention= $file_scan->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileScanName = uniqid().time().'.'.$extention;
                $file_scan->move(public_path('fileScanBaSerops'),$fileScanName);
            }else{
                return redirect('BA-Serah-Terima-Operasional/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileScanName = "";
        }


        $model->id_spk = $id_spk;
        $model->isi_serops = $isi_baserops;
        $model->file_serops = $fileName;
        $model->scan_file = $fileScanName;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('BA-Serah-Terima-Operasional/'.$request->id_spk)->with('message_success','Anda telah mengubah Ba. Serah Terima');
        }else{
            return redirect('BA-Serah-Terima-Operasional/'.$request->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }

    public function delete(Request $request, $id)
    {

        $model = ba_serops::find($id);

        if(!empty($model->file_serops))
        {
            $file_path =public_path('fileBaSerops').'/' . $model->file_serops;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileScanBaSerops').'/' . $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }


        if($model->delete())
        {
            return redirect('BA-Serah-Terima-Operasional/'.$model->id_spk)->with('message_success','Anda telah menghapus Ba. Serah Terima');
        }else{
            return redirect('BA-Serah-Terima-Operasional/'.$model->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }

}
