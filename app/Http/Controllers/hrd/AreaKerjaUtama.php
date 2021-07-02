<?php

namespace App\Http\Controllers\hrd;

use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Hrd\H_aku as aku;

class AreaKerjaUtama extends Controller
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

    public function index(){
        $data_pass = [
            'data_jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
            'data' => aku::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.AreaPelatihanKerja.page_default', $data_pass);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'id_jabatan'=>'required',
            'nm_aku'=>'required'
        ]);

        $model = new aku();
        $model->id_jabatan = $req->id_jabatan;
        $model->nm_aku = $req->nm_aku;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Area-Kerja-Utama')->with('message_success', 'Anda baru saja menambahkan data Area Kerja Utama baru');
        }else{
            return redirect('Area-Kerja-Utama')->with('message_fail', 'Maaf, Data Tidak tersimpan');
        }
    }

    public function edit($id){
        if(empty($model=aku::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'id_jabatan'=>'required',
            'nm_aku'=>'required',
            'id'=> 'required'
        ]);

        $model = aku::find($req->id);
        $model->id_jabatan = $req->id_jabatan;
        $model->nm_aku = $req->nm_aku;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Area-Kerja-Utama')->with('message_success', 'Anda baru saja mengubah data Area Kerja Utama');
        }else{
            return redirect('Area-Kerja-Utama')->with('message_fail', 'Maaf, Data Tidak mengubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = aku::find($req->id);

        if($model->delete()){
            return redirect('Area-Kerja-Utama')->with('message_success', 'Anda baru saja menghapus data Area Kerja Utama');
        }else{
            return redirect('Area-Kerja-Utama')->with('message_fail', 'Maaf, Data Tidak menghapus');
        }
    }
}
