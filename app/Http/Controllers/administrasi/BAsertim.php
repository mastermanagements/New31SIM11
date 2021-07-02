<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\BAsertim as basertims;
use App\Model\Administrasi\SPKKontrak as spk;
use Session;

class BAsertim extends Controller
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

    public function ambilDataBAsertimByIDspk($idSpk){
        if(empty($data_sertim = basertims::where('id_perusahaan',$this->id_perusahaan)->where('id_spk', $idSpk))){
            return abort(404);
        }
        return $data_sertim;
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
            'dataSertim'=> $this->ambilDataBAsertimByIDspk($idspk)->paginate(30),
            'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BAsertim.page_default', $data);
    }

    public function cari_sertim(Request $req)
    {
       $idspk = $req->id_spk;
        $isi = $req->isi_sertim;
        $data=[
            'dataSertim'=> $this->ambilDataBAsertimByIDspk($idspk)->where('isi_basertim','LIKE',"%{$isi}%")->paginate(30),
            'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BAsertim.page_default', $data);
    }

    public function IndexMenu(Request $req)
    {
       $idspk = $req->id_spk;
        $data=[
            'dataSertim'=> $this->ambilDataBAsertimByIDspk($idspk)->paginate(30),
            'spk'=> $this->ambilDataSPKById($idspk)->first()
        ];
        return view('user.administrasi.section.BAsertim.page_default', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idSpk)
    {

        if(empty($data_spk = $this->ambilDataSPKById($idSpk)->first())){
            return abort(404);
        }

        $data = [
            'save'=> 'save',
            'dataSertim'=> $this->ambilDataBAsertimByIDspk($idSpk)->paginate(30),
            'spk'=> $data_spk
        ];
        return view('user.administrasi.section.BAsertim.page_default', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'isi_basertim'=> 'required',
            'id_spk'=> 'required',
        ]);

        $isi_basertim = $request->isi_basertim;
        $id_spk= $request->id_spk;
        if($request->hasFile('file_basertim')){
            $file_basertim = $request->file_basertim;
            $extention= $file_basertim->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileName = uniqid().time().'.'.$extention;
                $file_basertim->move(public_path('fileBaSertim'),$fileName);
            }else{
                return redirect('BA-Serah-Terima/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileName = "";
        }

        if($request->hasFile('scan_file')){
            $file_scan = $request->scan_file;
            $extention= $file_scan->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileScanName = uniqid().time().'.'.$extention;
                $file_scan->move(public_path('fileBaSertimScan'),$fileScanName);
            }else{
                return redirect('BA-Serah-Terima/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileScanName = "";
        }

        $model = new basertims;
        $model->id_spk = $id_spk;
        $model->isi_basertim = $isi_basertim;
        $model->file_basertim = $fileName;
        $model->scan_file = $fileScanName;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('BA-Serah-Terima/'.$request->id_spk)->with('message_success','Anda telah menambah Ba. Serah Terima');
        }else{
            return redirect('BA-Serah-Terima/'.$request->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$idSpk)
    {
        if(empty($data_BAsertim= $this->ambilDataBAsertimByIDspk($idSpk)->where('id', $id)->first())){
            return abort(404);
        }

        $data = [
            'save'=> 'update',
            'dataSertimById'=> $data_BAsertim,
            'dataSertim'=> $this->ambilDataBAsertimByIDspk($idSpk)->paginate(30),
            'spk'=> $this->ambilDataSPKById($idSpk)->first()
        ];
        return view('user.administrasi.section.BAsertim.page_default', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'isi_basertim'=> 'required',
            'id_spk'=> 'required',
        ]);

        $isi_basertim = $request->isi_basertim;
        $id_spk= $request->id_spk;

        $model = basertims::find($id);

        if(!empty($model->file_basertim))
        {
            $file_path =public_path('fileBaSertim').'/' . $model->file_basertim;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileBaSertimScan').'/' . $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($request->hasFile('file_basertim')){
            $file_basertim = $request->file_basertim;
            $extention= $file_basertim->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileName = uniqid().time().'.'.$extention;
                $file_basertim->move(public_path('fileBaSertim'),$fileName);
            }else{
                return redirect('BA-Serah-Terima/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileName = "";
        }

        if($request->hasFile('scan_file')){
            $file_scan = $request->scan_file;
            $extention= $file_scan->getClientOriginalExtension();
            if($extention  == "zip" or $extention ="rar"){
                $fileScanName = uniqid().time().'.'.$extention;
                $file_scan->move(public_path('fileBaSertimScan'),$fileScanName);
            }else{
                return redirect('BA-Serah-Terima/'.$request->id_spk)->with('message_fail','Jenis file anda tidak diizikan');
            }
        }else{
            $fileScanName = "";
        }


        $model->id_spk = $id_spk;
        $model->isi_basertim = $isi_basertim;
        $model->file_basertim = $fileName;
        $model->scan_file = $fileScanName;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('BA-Serah-Terima/'.$request->id_spk)->with('message_success','Anda telah mengubah Ba. Serah Terima');
        }else{
            return redirect('BA-Serah-Terima/'.$request->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

       $model = basertims::find($id);

        if(!empty($model->file_basertim))
        {
            $file_path =public_path('fileBaSertim').'/' . $model->file_basertim;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileBaSertimScan').'/' . $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }


        if($model->delete())
        {
            return redirect('BA-Serah-Terima/'.$model->id_spk)->with('message_success','Anda telah menghapus Ba. Serah Terima');
        }else{
            return redirect('BA-Serah-Terima/'.$model->id_spk)->with('message_fail','Terjadi Kesalahan, silahkan coba ulang');
        }
    }
}
