<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\H_karyawan as data_karyawan;
use App\Model\Penggajian\G_tunjangan_gaji as gtg;
use App\Model\Penggajian\SkalaTunjangan as ST;

use Session;

class TunjanganGaji extends Controller
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

    public function index()
    {
        return "Tunjangan gaji";
    }

    public function create(Request $req,$id){
        if(empty($model = data_karyawan::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'data'=> $model,
            'year'=> $req->year,
            'itemTunjangan'=> ST::all()->where('id_perusahaan', $this->id_perusahaan)
        ];

        return view('user.penggajian.section.daftar_gaji.page_tunjangan_create', $data);
    }

    public function store(Request $req)
    {

        $this->validate($req,[
           'id_ky' =>'required',
           'periode' =>'required',
           'id_skala_tunjangan' =>'required',
        ]);

        foreach ($req->id_skala_tunjangan as $id_skala_t){
            if(!empty($id_skala_t)){
                $model = new gtg();
                $model->periode = $req->periode;
                $model->id_ky = $req->id_ky;
                $model->id_skala_tunjangan = $id_skala_t;
                $model->id_perusahaan = $this->id_perusahaan;
                $model->id_karyawan = $this->id_karyawan;
                $model->save();
            }
        }
        return redirect('detail-daftar-tunjangan/'.$req->id_ky)->with('message_success', 'Tunjangan telah berhasil diproses');
    }

    public function edit($id){
        if(empty($model=gtg::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            $model,
            $model->skalaTunjangan
        ];
        return response()->json($data);
    }

    public function update(Request $req)
    {

        $this->validate($req,[
            'id_ubah' =>'required',
            'periode' =>'required',
            'besar_tunjangan' =>'required',
        ]);
        $model = gtg::find($req->id)->update(array_merge($req->all(),
            ['id_perusahaan'=> $this->id_perusahaan,'id_karyawan'=>$this->id_karyawan]
        ));
        if($model){
            return redirect('detail-daftar-tunjangan/'.$req->id_ky)->with('message_success', 'Anda telah mengubah tunjagan baru');
        }else{
            return redirect('detail-daftar-tunjangan/'.$req->id_ky)->with('message_fail', 'Maaf, data mengubah tidak dapat disimpan');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = gtg::find($id);
        if($model->delete()){
            return redirect('detail-daftar-tunjangan/'.$model->id_ky)->with('message_success', 'Anda telah menghapus tunjagan baru');
        }else{
            return redirect('detail-daftar-tunjangan/'.$model->id_ky)->with('message_fail', 'Maaf, data menghapus tidak dapat disimpan');
        }
    }


    public function updateStatusAktifon($id)
    {
        $model = gtg::find($id);
        $model->status_aktif='1';
        if($model->save()){
            $thn = date('Y',strtotime($model->periode));
//            $models = gtg::where('id','!=',$model->id)->where('id_perusahaan', $this->id_perusahaan)
//                ->whereRaw("year(periode) == {$thn}")->update(['status_tunjangan'=>'0']);
            return redirect('detail-daftar-tunjangan/'.$model->id_ky)->with('message_success', 'Anda telah mengubah status tunjagan baru');
        }else{
            return redirect('detail-daftar-tunjangan/'.$model->id_ky)->with('message_fail', 'Maaf, data status tunjangan tidak dapat di ubah');
        }
    }


    public function updateStatusAktifof($id)
    {
        $model = gtg::find($id);
        $model->status_aktif='0';
        if($model->save()){
            $thn = date('Y',strtotime($model->periode));
//            $models = gtg::where('id','!=',$model->id)->where('id_perusahaan', $this->id_perusahaan)
//                ->whereRaw("year(periode) == {$thn}")->update(['status_tunjangan'=>'0']);
            return redirect('detail-daftar-tunjangan/'.$model->id_ky)->with('message_success', 'Anda telah mengubah status tunjagan baru');
        }else{
            return redirect('detail-daftar-tunjangan/'.$model->id_ky)->with('message_fail', 'Maaf, data status tunjangan tidak dapat di ubah');
        }
    }

}
