<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as ky;
use App\Model\Penggajian\DaftarGaji as DG;
use App\Model\Hrd\H_predikat_penilaian as Hpp;
use App\Model\Hrd\H_predikat_penilaian as predikat;

class DaftarGaji extends Controller
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
        $data =[
            'ky'=> ky::where('id_perusahaan', $this->id_perusahaan)->paginate(30)
        ];
        return view('user.penggajian.section.daftar_gaji.page_default', $data);
    }

    public function list($id_ky){
        if(empty($model_ky = ky::where('id', $id_ky)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $row = array();

        if(!empty($daftar_gaji=$model_ky->getMannyDaftarGaji)){
            $no=1;

            foreach ($daftar_gaji as $dg){
                $column = array();
                $column['no'] = $no++;
                $besar_gaji=0;

                if($model_ky->get_MannyTesKemanajerialan->where('thn_tes_km', $dg->priode)->count('id')>0)
                {
                    $nilai_akhir_kompentensi = ($model_ky->get_MannyTesKemanajerialan->where('thn_tes_km', $dg->priode)->sum('nilai_km') + $model_ky->get_MannyTesTeknis->where('thn_tes_kt', $dg->priode)->sum('nilai_kt'))/2;
                    $nilai_total_kinerja = ($model_ky->get_MannyKpiKaryawan->where('year', $dg->priode)->sum('skor_akhir')*0.6) + ($nilai_akhir_kompentensi * 0.4);
                    if(!empty($nilai_total_kinerja)){
                        $predikat = Hpp::where('id_perusahaan', $this->id_perusahaan)->where('skor_awal','<',$nilai_total_kinerja)->where('skor_akhir','>',$nilai_total_kinerja)->first();
                        if(!empty($predikat)){
                            $kenaikan_gaji= $predikat->kenaikan;
                            if($kenaikan_gaji < 0)
                            {
                                $besar_gaji =  $dg->besar_gaji + (($kenaikan_gaji/100) *  $dg->besar_gaji);
                            }else{
                                $besar_gaji =  $dg->besar_gaji + ($kenaikan_gaji *  $dg->besar_gaji);
                            }

                        }
                    }
                }else{
                    $besar_gaji= $dg->besar_gaji;
                }

                $column['periode'] = $dg->priode;
                $column['besar_gaji'] = $besar_gaji;
                $column['ket'] = $dg->ket;
                $column['status'] = $dg->status_aktif;
                $column['id'] = $dg->id;
                $row[]=$column;
            }
        }

        $data = [
            'data'=> ky::where('id', $id_ky)->where('id_perusahaan', $this->id_perusahaan)->first(),
            'daftar_gaji'=>$row
        ];

        return view('user.penggajian.section.daftar_gaji.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'periode'=> 'required',
            'id_ky'=> 'required',
            'besar_gaji'=> 'required',
         ]);

        $model = new DG();
        $model->priode =$req->periode;
        $model->id_ky =$req->id_ky;
        $model->besar_gaji =$req->besar_gaji;
        $model->ket =$req->ket;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save()){
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_success','Anda telah menambahkan data gaji baru');
        }else{
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_fail','Maaf, Data Gaji Tidak dapat disimpan');
        }
    }

    public function edit($id){
        if(empty($model = DG::where('id_perusahaan', $this->id_perusahaan)->where('id', $id)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'periode'=> 'required',
            'id_ky'=> 'required',
            'besar_gaji'=> 'required',
            'id'=> 'required',
        ]);

        $model = DG::find($req->id);
        $model->priode =$req->periode;
        $model->id_ky =$req->id_ky;
        $model->besar_gaji =$req->besar_gaji;
        $model->ket =$req->ket;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save()){
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_success','Anda telah mengubah data gaji baru');
        }else{
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_fail','Maaf, Data Gaji Tidak dapat diubah');
        }
    }

    public function update_status(Request $req, $id){
        $this->validate($req,[
            'status'=> 'required',
        ]);

        $model = DG::find($id);
        $model->status_aktif =$req->status;
        if($model->save()){
            $model_ = DG::where('id','!=',$model->id)->where('id_perusahaan', $this->id_perusahaan)
                ->update(['status_aktif' => '0']);

            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_success','Anda telah mengubah status data gaji baru');
        }else{
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_fail','Maaf, statu data gaji Tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = DG::find($id);
        if($model->delete()){
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_success','Anda telah menghapus data gaji baru');
        }else{
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_fail','Maaf, Data Gaji Tidak dapat dihapus');
        }
    }


}
