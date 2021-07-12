<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\Cuti as h_cuti;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Hrd\H_request_cuti as R_cuti;

class Permintaan_cuti extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    private $jenis_izin = [
        '0' => 'Cuti',
        '1' => 'Izin',
        '2' => 'Sakit',
    ];
    private $upprove = [
        '0' => 'Masih Diproses',
        '1' => 'Tidak disetujui',
        '2' => 'Disetujui',
    ];

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

    public function create()
    {
        $data = [
            'data_h_cuti'=>h_cuti::all()->where('id_perusahaan', $this->id_perusahaan),
            'karyawan'=>karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_izin'=> $this->jenis_izin,
            'upprove'=> $this->upprove,
        ];
        return view('user.hrd.section.cuti.permintaan_cuti.page_create', $data);
    }

    public function store(Request $req)
    {
       if($req->id_cuti=="null"){
            $id_cuti= null;
        }else{
            $id_cuti = $req->id_cuti;
        }

       $this->validate($req,[
           'tgl_req' => 'required',
           'jenis_izin' => 'required',
           'id_cuti' => 'required',
           'lama_request' => 'required',
           'upprove' => 'required',
           'atasan' => 'required',
        ]);

        $tgl_req = date('Y-m-d', strtotime($req->tgl_req));
        $jenis_izin = $req->jenis_izin;
        $id_cuti = $id_cuti;
        $lama_request= $req->lama_request;
        $upprove= $req->upprove;
        $atasan= $req->atasan;

        $model = new R_cuti();
        $model->tgl_req = $tgl_req;
        $model->jenis_izin = $jenis_izin;
        $model->id_cuti = $id_cuti;
        $model->lama_request = $lama_request;
        $model->upprove = $upprove;
        $model->atasan = $atasan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Cuti')->with('message_success', 'Anda telah memasukan Permintaan Cuti');
        }else{
            return redirect('Cuti')->with('message_fail', 'Maaf, Permintaan cuti tidak tersimpan');
        }

    }

    public function edit($id)
    {
        if(empty($model = R_cuti::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'data_r_cuti'=>$model,
            'data_h_cuti'=>h_cuti::all()->where('id_perusahaan', $this->id_perusahaan),
            'karyawan'=>karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_izin'=> $this->jenis_izin,
            'upprove'=> $this->upprove,
        ];
        return view('user.hrd.section.cuti.permintaan_cuti.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'tgl_req' => 'required',
            'jenis_izin' => 'required',
            'id_cuti' => 'required',
            'lama_request' => 'required',
            'upprove' => 'required',
            'atasan' => 'required',
        ]);

        if($req->id_cuti=="null"){
            $id_cuti= null;
        }else{
            $id_cuti = $req->id_cuti;
        }

        $tgl_req = date('Y-m-d', strtotime($req->tgl_req));
        $jenis_izin = $req->jenis_izin;
        $id_cuti = $id_cuti;
        $lama_request= $req->lama_request;
        $upprove= $req->upprove;
        $atasan= $req->atasan;

        $model = R_cuti::find($id);
        $model->tgl_req = $tgl_req;
        $model->jenis_izin = $jenis_izin;
        $model->id_cuti = $id_cuti;
        $model->lama_request = $lama_request;
        $model->upprove = $upprove;
        $model->atasan = $atasan;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Cuti')->with('message_success', 'Anda telah mengubah Permintaan Cuti');
        }else{
            return redirect('Cuti')->with('message_fail', 'Maaf, Permintaan cuti gagal mengubah');
        }

    }

    public function delete(Request $req, $id)
    {

        $model = R_cuti::find($id);

        if(!empty($model->surat_keterangan))
        {
            $file_path = public_path('filePermintaanCuti/').'/'.$model->surat_keteranganj;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($model->delete()){
            return redirect('Cuti')->with('message_success', 'Anda telah menghapus Permintaan Cuti');
        }else{
            return redirect('Cuti')->with('message_fail', 'Maaf, Permintaan cuti gagal dihapus');
        }

    }

    public function upload(Request $req){
        $this->validate($req,[
           'id_permintaan_cuti' => 'required',
           'surat_keterangan' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $id_permintaan_cuti = $req->id_permintaan_cuti;
        $surat_keterangan = $req->surat_keterangan;

        $name_surat = uniqid().time().'.'.$surat_keterangan->getClientOriginalExtension();

        $model = R_cuti::UpdateOrCreate(
            ['id'=>$id_permintaan_cuti,'id_perusahaan'=>$this->id_perusahaan],
            ['surat_keterangan'=> $name_surat]
        );
        if($model->save()){
            $surat_keterangan->move(public_path('filePermintaanCuti'), $name_surat);
            return redirect('Cuti')->with('message_success', 'Berkas telah terunggah');
        }else{
            return redirect('Cuti')->with('message_fail', 'Maaf, Berkas gagal terunggah');
        }
    }
}
