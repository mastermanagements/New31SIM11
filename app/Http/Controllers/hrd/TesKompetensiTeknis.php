<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as ky;
use App\Model\Hrd\H_kompetensi_teknis as kt;
use App\Model\Hrd\H_item_teknis as hit;
use App\Model\Hrd\H_tes_kteknis as htk;

class TesKompetensiTeknis extends Controller
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

    public function index(){
        $data = [
            'ky'=>ky::where('id_perusahaan', $this->id_perusahaan)->paginate(15),
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.TesKTeknis.page_default', $data);
    }

    public function show(Request $req){
        $karywan =  $req->nm_ky;
        $data = [
            'ky'=>ky::where('nama_ky','LIKE',"%{$karywan}%")->where('id_perusahaan', $this->id_perusahaan)->paginate(15),
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.TesKTeknis.page_default', $data);
    }

    public function create($id){

        if(empty($model = ky::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'ky'=>$model,
            'kt'=>kt::all()->where('id_perusahaan',$this->id_perusahaan),
            'hit'=>hit::all()->where('id_perusahaan',$this->id_perusahaan),
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.TesKTeknis.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'thn_tes_kt' => 'required',
           'id_kompetensi_t' => 'required',
           'id_item_kt' => 'required',
           'nilai_kt' => 'required',
           'id_ky' => 'required',
        ]);

        $model = new htk();
        $model->thn_tes_kt = $req->thn_tes_kt;
        $model->id_ky = $req->id_ky;
        $model->id_kompetensi_t = $req->id_kompetensi_t;
        $model->id_item_kt = $req->id_item_kt;
        $model->nilai_kt = $req->nilai_kt;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('formulir-tes-kompetensi-teknis/'. $model->id_ky)->with('message_success', 'Anda telah menambahkan penilaian tes kompetensi teknis');
        }else{
            return redirect('formulir-tes-kompetensi-teknis/'. $model->id_ky)->with('message_fail', 'Maaf, data tes kompetensi teknis gagal untuk disimpan');
        }
    }

    public function edit($id)
    {
        if(empty($model = htk::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'thn_tes_kt' => 'required',
            'id_kompetensi_t' => 'required',
            'id_item_kt' => 'required',
            'nilai_kt' => 'required',
            'id_ky' => 'required',
            'id' => 'required',
        ]);

        $model = htk::find($req->id);
        $model->thn_tes_kt = $req->thn_tes_kt;
        $model->id_ky = $req->id_ky;
        $model->id_kompetensi_t = $req->id_kompetensi_t;
        $model->id_item_kt = $req->id_item_kt;
        $model->nilai_kt = $req->nilai_kt;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('formulir-tes-kompetensi-teknis/'. $model->id_ky)->with('message_success', 'Anda telah mengubah penilaian tes kompetensi teknis');
        }else{
            return redirect('formulir-tes-kompetensi-teknis/'. $model->id_ky)->with('message_fail', 'Maaf, data tes kompetensi teknis gagal untuk diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = htk::find($id);
        if($model->delete()){
            return redirect('formulir-tes-kompetensi-teknis/'. $model->id_ky)->with('message_success', 'Anda telah menghapus penilaian tes kompetensi teknis');
        }else{
            return redirect('formulir-tes-kompetensi-teknis/'. $model->id_ky)->with('message_fail', 'Maaf, data tes kompetensi teknis gagal untuk menghapus');
        }
    }
}
