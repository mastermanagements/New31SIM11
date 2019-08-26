<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_predikat_penilaian as Hpp;
use App\Model\Superadmin_ukm\H_karyawan as H_ky;

class PredikatPenilaian extends Controller
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
                return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function store(Request $req){
        $this->validate($req,[
            'skor_awal' => 'required',
            'skor_akhir' => 'required',
            'predikat' => 'required',
            'kenaikan' => 'required',
        ]);

        $model = new Hpp();
        $model->skor_awal = $req->skor_awal;
        $model->skor_akhir = $req->skor_akhir;
        $model->predikat = $req->predikat;
        $model->kenaikan = $req->kenaikan;
        $model->fasilitas_lain = $req->fasilitas_lain;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Kompensasi-Kinerja')->with('message_success','Anda Telah menambah Predikat Penilian');
        }else{
            return redirect('Kompensasi-Kinerja')->with('message_fail','Maaf, Predikat Penilaian Gagal untuk ditambahakn');
        }
    }

    public function edit($id){
        if(empty($model = Hpp::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'skor_awal' => 'required',
            'skor_akhir' => 'required',
            'predikat' => 'required',
            'kenaikan' => 'required',
            'id' => 'required',
        ]);

        $model = Hpp::find($req->id);
        $model->skor_awal = $req->skor_awal;
        $model->skor_akhir = $req->skor_akhir;
        $model->predikat = $req->predikat;
        $model->kenaikan = $req->kenaikan;
        $model->fasilitas_lain = $req->fasilitas_lain;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Kompensasi-Kinerja')->with('message_success','Anda Telah mengubah Predikat Penilian');
        }else{
            return redirect('Kompensasi-Kinerja')->with('message_fail','Maaf, Predikat Penilaian Gagal untuk diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = Hpp::find($id);

        if($model->delete()){
            return redirect('Kompensasi-Kinerja')->with('message_success','Anda Telah menghapus Predikat Penilian');
        }else{
            return redirect('Kompensasi-Kinerja')->with('message_fail','Maaf, Predikat Penilaian Gagal untuk dihapus');
        }
    }

    public function data_kompensasisi($tahuns)
    {
        $tahun = $tahuns;

        $data_ky = H_ky::all()->where('id_perusahaan', $this->id_perusahaan);
        $row = array();
        $no=1;
        $predikats="";
        $kenaikan_gaji="";
        $fasilitas="";
        foreach ($data_ky as $ky){
            $column =array();
            $column[] = $no++;
            $column[] = $tahun;
            $column[] = $ky->nama_ky;
            $nilai_akhir_kompentensi = ($ky->get_MannyTesKemanajerialan->where('thn_tes_km', $tahun)->sum('nilai_km') + $ky->get_MannyTesTeknis->where('thn_tes_kt', $tahun)->sum('nilai_kt'))/2;
            $nilai_total_kinerja = ($ky->get_MannyKpiKaryawan->where('year', $tahun)->sum('skor_akhir')*0.6) + ($nilai_akhir_kompentensi * 0.4);
            $column[] = $nilai_total_kinerja;
            if(!empty($nilai_total_kinerja)){
                $predikat = Hpp::where('id_perusahaan', $this->id_perusahaan)->where('skor_awal','<',$nilai_total_kinerja)->where('skor_akhir','>',$nilai_total_kinerja)->first();
                if(!empty($predikat)){
                    $predikats= $predikat->predikat;
                    $kenaikan_gaji= $predikat->kenaikan."%";
                    $fasilitas = $predikat->fasilitas_lain;
                }
            }
            $column[] = $predikats;
            $column[] = $kenaikan_gaji;
            $column[] = $fasilitas ;
            $row[]=$column;
        }

        return response()->json(array('data'=>$row));
    }


}
