<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as ky;
use App\Model\Hrd\H_kompetensi_manajerial as hkm;
use App\Model\Hrd\H_item_kmanajerial as him;
use App\Model\Hrd\H_tes_manajerial as htm;

class TesKemanajerial extends Controller
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

    public function show(Request $req){
        $nama= $req->nm_ky;
        $data = [
            'ky'=>ky::where('nama_ky','LIKE',"%{$nama}%")->where('id_perusahaan', $this->id_perusahaan)->paginate(15),
            'hkm' =>  hkm::all()->where('id_perusahaan', $this->id_perusahaan),
            'him'=> him::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.TesKemanajerialan.page_default', $data);
    }

    public function index(){
        $data = [
            'ky'=>ky::where('id_perusahaan', $this->id_perusahaan)->paginate(15),
            'hkm' =>  hkm::all()->where('id_perusahaan', $this->id_perusahaan),
            'him'=> him::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.TesKemanajerialan.page_default', $data);
    }

    public function create($id){
        if(empty($model_ky=ky::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'ky'=>$model_ky,
            'hkm' =>  hkm::all()->where('id_perusahaan', $this->id_perusahaan),
            'him'=> him::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.TesKemanajerialan.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'thn_tes_km'=> 'required',
           'id_kompetensi_m'=> 'required',
           'id_item_km'=> 'required',
           'nilai_km1'=> 'required',
           'id_ky'=> 'required',
        ]);

        $model = new htm();
        $model->thn_tes_km=$req->thn_tes_km;
        $model->id_ky=$req->id_ky;
        $model->id_kompetensi_m=$req->id_item_km;
        $model->id_item_km=$req->id_item_km;
        $model->nilai_km=$req->nilai_km1;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            return redirect('formulir-tes-kemanajerialan/'. $model->id_ky)->with('message_success', 'Anda telah menambahkan data penilaian tes');
        }else{
            return redirect('formulir-tes-kemanajerialan/'. $model->id_ky)->with('message_fail', 'Maaf, Data Penilaian gagal untuk ditaambahkan');
        }

    }

    public function edit($id){
        if(empty($model = htm::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){

        $this->validate($req,[
            'thn_tes_km'=> 'required',
            'id_kompetensi_m'=> 'required',
            'id_item_km'=> 'required',
            'nilai_km1'=> 'required',
            'id_ky'=> 'required',
            'id'=> 'required',
        ]);

        $model = htm::find($req->id);
        $model->thn_tes_km=$req->thn_tes_km;
        $model->id_ky=$req->id_ky;
        $model->id_kompetensi_m=$req->id_item_km;
        $model->id_item_km=$req->id_item_km;
        $model->nilai_km=$req->nilai_km1;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            return redirect('formulir-tes-kemanajerialan/'. $model->id_ky)->with('message_success', 'Anda telah mengubah data penilaian tes');
        }else{
            return redirect('formulir-tes-kemanajerialan/'. $model->id_ky)->with('message_fail', 'Maaf, Data Penilaian gagal untuk diubah');
        }

    }


    public function delete(Request $req, $id){
        $model = htm::find($req->id);
        if($model->delete()){
            return redirect('formulir-tes-kemanajerialan/'. $model->id_ky)->with('message_success', 'Anda telah menghapus data penilaian tes');
        }else{
            return redirect('formulir-tes-kemanajerialan/'. $model->id_ky)->with('message_fail', 'Maaf, Data Penilaian gagal untuk dihapus');
        }

    }


}
