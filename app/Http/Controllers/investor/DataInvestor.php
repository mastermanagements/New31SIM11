<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Investasi\I_data_investor as DI;

class DataInvestor extends Controller
{

    private $id_karyawan;
    private $id_perusahaan;
    private  $id_con;

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
            $this->id_con=[
                'id_perusahaan'=> $this->id_perusahaan,
                'id_karyawan' => $this->id_karyawan
            ];
            return $next($req);
        });
    }


    private $jenkel = ['-','Pria','Wanita'];

    private $agama = ['Islam','Kristen Protestan','Katolik','Hindu','Buddha','Kong Hu Cu'];

    private $status_perkawinan = ['Belum Kawin','Sudah Kawin','Janda', 'Duda'];

    public function index(){
        $data = [
            'DI'=>DI::where('id_perusahaan', $this->id_perusahaan)->paginate(30)
        ];
        return view('user.investor.section.dataKaryawan.page_default', $data);
    }

    public function create(){
        $data = [
            'jenkel'=>$this->jenkel,
            'agama'=> $this->agama,
            'status_perkawinan'=> $this->status_perkawinan
        ];
        return view('user.investor.section.dataKaryawan.page_create', $data);
    }

    public function store(Request $req){
       $this->validate($req,[
            'nik' => 'required',
            'nm_investor' => 'required',
            'password' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kel' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
        ]);
        $data_rek = $req->except(['nik','_token']);
        $data_rek['tgl_lahir'] = date('Y-m-d', strtotime($req->tgl_lahir));
        $model = DI::updateOrCreate(
            array_merge(['nik'=> $req->nik], $this->id_con),
            $data_rek
        );

        if($model->save()){
            return redirect('Data-Investor')->with('message_success','Anda telah menambahkan data investor');
        }else{
            return redirect('Data-Investor')->with('message_fail','Maaf, data investor gagal disimpan');
        }
    }

    public function edit($id){
        if(empty($model = DI::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'jenkel'=>$this->jenkel,
            'agama'=> $this->agama,
            'status_perkawinan'=> $this->status_perkawinan,
            'data'=> $model
        ];
        return view('user.investor.section.dataKaryawan.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'nik' => 'required',
            'nm_investor' => 'required',
            'password' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kel' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
        ]);
        $data_rek = $req->except(['nik','_token']);
        $data_rek['tgl_lahir'] = date('Y-m-d', strtotime($req->tgl_lahir));
        $model = DI::find($id)->update(
            array_merge($data_rek, $this->id_con)
        );

        if($model){
            return redirect('Data-Investor')->with('message_success','Anda telah mengubah data investor');
        }else{
            return redirect('Data-Investor')->with('message_fail','Maaf, data investor gagal disimpan');
        }
    }

    public function delete(Request $req, $id){
        $model = DI::find($id);
        if(!empty($model->file_ktp))
        {
            $file_path =public_path('ktpInvest').'/' . $model->file_ktp;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        if($model->delete()){
            return redirect('Data-Investor')->with('message_success','Anda telah menghapus data investor');
        }else{
            return redirect('Data-Investor')->with('message_fail','Maaf, data investor gagal dihapus');
        }
    }

    public function uploadEktp(Request $req){
        $this->validate($req, [
            'id_inves' => 'required',
            'file_ktp' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        $file_ktp = $req->file_ktp;

        $name_file = uniqid().time().'.'.$file_ktp->getClientOriginalExtension();
        $model = DI::find($req->id_inves);

        if(!empty($model->file_ktp))
        {
            $file_path =public_path('ktpInvest').'/' . $model->file_ktp;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        $model->file_ktp=$name_file;
        if($model->save()){
            $file_ktp->move(public_path('ktpInvest'), $name_file);
            return redirect('Data-Investor')->with('message_success','Anda telah meunggah softcopy ktp investor');
        }else{
            return redirect('Data-Investor')->with('message_fail','Maaf, Softcopy ktp investor gagal diunggah');
        }
    }

    public function uploadPasFotoInvest(Request $req){

        $this->validate($req, [
            'id_invess' => 'required',
            'file_pas_foto' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        $file_pas_foto = $req->file_pas_foto;

        $name_file = uniqid().time().'.'.$file_pas_foto->getClientOriginalExtension();
        $model = DI::find($req->id_invess);

        if(!empty($model->pas_photo))
        {
            $file_path =public_path('filePasFotoInves').'/' . $model->pas_photo;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        $model->pas_photo=$name_file;
        if($model->save()){
            $file_pas_foto->move(public_path('filePasFotoInves'), $name_file);
            return redirect('Data-Investor')->with('message_success','Anda telah meunggah softcopy pas foto investor');
        }else{
            return redirect('Data-Investor')->with('message_fail','Maaf, Softcopy pas foto investor gagal diunggah');
        }
    }
}
