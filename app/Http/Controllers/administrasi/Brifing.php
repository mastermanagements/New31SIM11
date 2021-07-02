<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Karyawan\Bagian as bagians;
use App\Model\Administrasi\UsulanBrifing as brifings;
use App\Model\Administrasi\JenisBrifing as jenis_rapat;
use App\Model\Administrasi\Rapat as rapat;
class Brifing extends Controller
{

    private $id_karyawan;
    private $id_perusahaan;
    private $jenis_keterangan = array('Masukan','Solusi','Kesimpulan');

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

    public function ambilEventBrifing($id_devisi)
    {

        if(!empty($id_devisi)) {
            $data_brifing = brifings::where('id_perusahaan', $this->id_perusahaan)->where('id_divisi', $id_devisi)->groupBy('tgl_usulan_brif')->get();
        }
        else {
            $data_brifing = brifings::where('id_perusahaan', $this->id_perusahaan)->groupBy('tgl_usulan_brif')->get();
        }
        $column = array();
        foreach ($data_brifing as $value){
            $row[]=[
                'title'=> 'Lihat Usulan Brifing',
                'start'=> $value->tgl_usulan_brif
            ];
            $column= $row;
        }
        return response()->json($column);
    }

    public function ambilEventBrifingByTanggal(Request $req)
    {
        $tanggal = date('Y-m-d', strtotime($req->tgl_usulan_brif));
        $id_divisi = $req->id_divisi;
        $data_brifing = brifings::all()->where('tgl_usulan_brif', $tanggal)->where('id_perusahaan', $this->id_perusahaan)->where('id_divisi', $id_divisi);
        $column = array();
        foreach ($data_brifing as $key)
        {
            $row=array();
            $row['id']= $key->id;
            $row['materi']= $key->materi;
            $row['tgl_usulan_brif']= $key->tgl_usulan_brif;
            $row['nama_ky']= $key->getKaryawan->nama_ky;
            $row['pas_foto']= $key->getKaryawan->pas_foto;
            $row['id_ky_login']= $this->id_karyawan;
            $row['id_ky_usulan']= $key->id_karyawan;
            $row['time_created']= date('H:i:s', strtotime($key->created_at));
            $row['reply'] = $this->getViewMsg($key->id);
            $column[] = $row;
        }
        return response()->json($column);
    }

    public function index()
    {
        $data = [
            'data_bagian_devisi'=> bagians::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_jenis_brifing' => jenis_rapat::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_keterangan'=> $this->jenis_keterangan
        ];
        return view('user.administrasi.section.Brifing.page_default', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'materi'=> 'required',
            'tgl_usulan_brif'=> 'required',
            'id_divisi'=>'required',
            'id_jenis_rapat'=> 'required'
        ]);
        $tgl_usulan_brif =  date('Y-m-d', strtotime($request->tgl_usulan_brif));
        $materi =$request->materi;
        $id_divisi =$request->id_divisi;
        $jenis_rapat = $request->id_jenis_rapat;

        $model = new brifings;
        $model->materi = $materi;
        $model->id_jenis_rapat = $jenis_rapat;
        $model->tgl_usulan_brif = $tgl_usulan_brif;
        $model->id_divisi= $id_divisi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save())
        {
            $data = [
                'message'=> 'Anda telah menambah usulan brifing',
                'status'=>true
            ];
            return response()->json($data);
        }

        $data = [
            'message'=> 'Gagal menambah usulan ',
            'status'=>false
        ];
        return response()->json($data);
    }

    public function destroy(Request $req, $id)
    {
        if(empty($model = brifings::where('id', $req->id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
            $data = [
                'message'=> 'Anda telah menghapus usulan brifing',
                'status'=>true
            ];
            return response()->json($data);
        }

        $data = [
            'message'=> 'Gagal menghapus usulan brifing',
            'status'=>false
        ];
        return response()->json($data);
    }

    //store brifing
    public function store_brifing(Request $req)
    {

        $this->validate($req,[
           'keterangan'=> 'required',
           'pilihan_rapat' => 'required',
           'id_usulan_brifing' => 'required',
           'tgl_rapat' => 'required',
        ]);

        $keterangan = $req->keterangan;
        $pilihan_rapat = $req->pilihan_rapat;
        $tgl_rapat = date('Y-m-d', strtotime($req->tgl_rapat));
        $id_ub = $req->id_usulan_brifing;
        $model = new rapat;
        $model->id_ub =$id_ub;
        $model->tgl_rapat =$tgl_rapat;
        $model->pilihan_rapat =$pilihan_rapat;
        $model->keterangan =$keterangan;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            $data = [
                'msg'=> 'balasan baru saja dibuat',
                'status'=> 'true'
            ];
            return response()->json($data);
        }else{
            $data = [
                'msg'=> 'gagal meload balasan',
                'status'=> 'fail'
            ];
            return response()->json($data);
        }
    }

    public function get_brifing($id){
        if(empty($data_brifing = rapat::all()->where('id_ub', $id)->where('id_perusahaan', $this->id_perusahaan))){
            return abort(404);
        }

        $columns = array();
        foreach ($data_brifing as $value){
            $row = array();
            $row['id']=$value->id;
            $row['id_ub']=$value->id_ub;
            $row['tgl_rapat']= date('d-m-Y', strtotime($value->tgl_rapat));
            $row['pilihan_rapat']= $value->pilihan_rapat;
            $row['keterangan']= $value->keterangan;
            $row['nama_ky']= $value->getKy->nama_ky;

            $columns[] = $row;
        }
        return response()->json($columns);
    }

    public function getViewMsg($id_rmb){
        $modal = brifings::where('id', $id_rmb)->where('id_perusahaan', $this->id_perusahaan)->first();
        $msg ="";
        if(!empty($modal)){
        foreach ($modal->getRapat as $value){

            if($value->pilihan_rapat=="Masukan"){
                $icon ="fa-comment bg-red";
            }else if($value->pilihan_rapat=="Solusi"){
                $icon ="fa-comment-o bg-red";
            }else if($value->pilihan_rapat=="Kesimpulan"){
                $icon ="fa-commenting-o bg-red";
            }

            if($value->id_karyawan == $this->id_karyawan){
                $tombol_hapus="<a class='btn btn-primary btn-xs' href='#' onclick='deleteReply($value->id)'><i class='fa fa-close'></i> </a>";
            }else{
                $tombol_hapus ="";
            }

            $msg .= "<li> 
                        <i class=\"fa ".$icon." \"></i>
                        <div class=\"timeline-item\">
                        <span class=\"time\"><i class=\"fa fa-clock-o\"></i> ".date('H:i:s', strtotime($value->created_at))."   </span>
                        <h3 class=\"timeline-header\"><a href=\"#\">".$value->getKy->nama_ky."</a> </h3>
                            <div class=\"timeline-body\">
                              <b> #".$value->pilihan_rapat." </b>
                               <br>
                               ".$value->keterangan."
                            </div>
                        <div class=\"timeline-footer\">
                            ".$tombol_hapus."
                          </div>
                        </div>
                    </li>";
            }
        }
        return $msg;
    }

    public function delete_brifing(Request $req, $id){
        $this->validate($req,[
            '_token'=> 'required'
        ]);

        if(empty($model=rapat::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete()){
            $data = [
                'msg'=> 'balasan baru saja dihapus',
                'status'=> 'true'
            ];
            return response()->json($data);
        }else{
            $data = [
                'msg'=> 'gagal meload balasan',
                'status'=> 'fail'
            ];
            return response()->json($data);
        }
    }
}
