<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\Return_;
use Session;
use App\Model\Investor\PersenKas as PK;
use App\Model\Investor\Nisbah as N;
use App\Model\Investor\BulanDevidenM as BDM;
use App\Traits\DateYears;

class BesarNisbah extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;
    private  $id_con;
    use DateYears;
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

    public function getPeriodeByear($year){
        $data = BDM::all()->where('id_perusahaan', $this->id_perusahaan)->where('thn_dividen', $year);
        $container_button = array();
        foreach ($data as $key => $value){
            $container_button[] = '<button class="btn btn-primary" style="margin:5px " onclick="lihatPriode('.$value->id_periode_invest.')"> '.$value->periode_invest->nm_periode.' </button>';
        }
        return $container_button;
    }

    public function getDataByDatePeriode(Request $req,$id){
        $year = $req->year;
        $data = BDM::all()->where('id_periode_invest', $id)->where('id_perusahaan', $this->id_perusahaan)->where('thn_dividen', $year);
        $no = 1;
        $row = array();
        foreach ($data as $value){
            $column = array();
            $column[] = $no++;
            $column[] = $value->periode_invest->nm_periode;
            $column[] = $value->thn_dividen;
            $column[] = $this->costumDate()->month->semua_bulan[$value->bln_dividen];
            $column[] = $value->laba_rugi;
            $column[] = $value->net_kas;
            $column[] = $value->nisbah_pelaksana;
            $column[] = $value->nisbah_pemodal;
            $url = 'delete-divine-bulananM/'.$value->id;
            $token = $req->session()->token();
            $column[] = '<form action="/'.$url.'/" method="post">
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" name="_token" value="'.$token.'">
                                    <button type="button" class="btn btn-warning" onclick="edit_divide_per_bulanM('.$value->id.')">ubah</button>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm(\'apakah anda akan menghapus data ini ... ?\')">hapus</button>
                           </form>';
            $row[] = $column;
        }
        return response()->json(array('data'=>$row,'button'=> $this->getPeriodeByear($year)));
    }

    public function  getDataByDate(Request $req,$year){
        $data = BDM::all()->where('id_perusahaan', $this->id_perusahaan)->where('thn_dividen', $year);
        $no = 1;
        $row = array();
        foreach ($data as $value){
            $column = array();
            $column[] = $no++;
            $column[] = $value->periode_invest->nm_periode;
            $column[] = $value->thn_dividen;
            $column[] = $this->costumDate()->month->semua_bulan[$value->bln_dividen];
            $column[] = $value->laba_rugi;
            $column[] = $value->net_kas;
            $column[] = $value->nisbah_pelaksana;
            $column[] = $value->nisbah_pemodal;
            $url = 'delete-divine-bulananM/'.$value->id;
            $token = $req->session()->token();
            $column[] = '<form action="/'.$url.'/" method="post">
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" name="_token" value="'.$token.'">
                                    <button type="button" class="btn btn-warning" onclick="edit_divide_per_bulanM('.$value->id.')">ubah</button>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm(\'apakah anda akan menghapus data ini ... ?\')">hapus</button>
                           </form>';
            $row[] = $column;
        }
        return response()->json(array('data'=>$row,'button'=> $this->getPeriodeByear($year)));
    }

    public function store(Request $req){
        $this->validate($req,[
            "thn" => "required",
          "bln_dividen" => "required",
          "id_periode_invest" => "required",
          "laba_rugi" => "required"
        ]);

        $thn = $req->thn;
        $bln_dividen = $req->bln_dividen;
        $laba_rugi = $req->laba_rugi;
        $id_periode_invest = $req->id_periode_invest;
        if($laba_rugi < 0){
            $alokasi = 0;
        }else{
            $persenkas = PK::where('id_perusahaan', $this->id_perusahaan)->where('thn', $thn)->first();
            if(empty($persenkas)){
                $alokasi = 0;
                return redirect('Nisbah')->with('message_fail','pengaturan persen kas untuk tahun '.$thn.' belum dimasukan');
            }else{
                $alokasi =($laba_rugi* $persenkas->persen_kas)/100;
            }
        }
        $netkas = $laba_rugi-$alokasi;
        $nisbah = N::where('id_periode_invest',$id_periode_invest)->where('id_perusahaan', $this->id_perusahaan)->first();
        $nisbah_pelaksana = ($nisbah->pelaksana/100)*$netkas;
        $nisbah_pemodal = ($nisbah->pemodal/100)*$netkas;
        $model = BDM::updateOrCreate(
            ['id_periode_invest'=> $id_periode_invest, 'thn_dividen'=>$thn, 'bln_dividen'=>$bln_dividen,'id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan],
            ['laba_rugi'=> $laba_rugi, 'alokasi_kas'=>$alokasi,'net_kas'=>$netkas,'nisbah_pelaksana'=> $nisbah_pelaksana,'nisbah_pemodal'=> $nisbah_pemodal]
        );

        if($model->save()){
            return redirect('Nisbah')->with('message_success','Anda telah menambahkan Besar nisbah')->with('yearInput', $thn);
        }else{
            return redirect('Nisbah')->with('message_fail','Maaf, besar nisbah tidak dapat disimpan');
        }
    }

    public function edit($id){
        if(empty($model = BDM::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            "thn" => "required",
            "bln_dividen" => "required",
            "id_periode_invest" => "required",
            "laba_rugi" => "required",
            "id" => "required",
        ]);

        $thn = $req->thn;
        $bln_dividen = $req->bln_dividen;
        $laba_rugi = $req->laba_rugi;
        $id_periode_invest = $req->id_periode_invest;
        if($laba_rugi < 0){
            $alokasi = 0;
        }else{
            $persenkas = PK::where('id_perusahaan', $this->id_perusahaan)->where('thn', $thn)->first();
            if(empty($persenkas)){
                $alokasi = 0;
                return redirect('Nisbah')->with('message_fail','pengaturan persen kas untuk tahun '.$thn.' belum dimasukan');
            }else{
                $alokasi =($laba_rugi* $persenkas->persen_kas)/100;
            }
        }
        $netkas = $laba_rugi-$alokasi;
        $nisbah = N::where('id_periode_invest',$id_periode_invest)->where('id_perusahaan', $this->id_perusahaan)->first();
        $nisbah_pelaksana = ($nisbah->pelaksana/100)*$netkas;
        $nisbah_pemodal = ($nisbah->pemodal/100)*$netkas;

        $model = BDM::find($req->id);
        $model->id_periode_invest = $id_periode_invest;
        $model->thn_dividen= $thn;
        $model->bln_dividen= $bln_dividen;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        $model->laba_rugi= $laba_rugi;
        $model->alokasi_kas= $alokasi;
        $model->net_kas= $netkas;
        $model->nisbah_pelaksana= $nisbah_pelaksana;
        $model->nisbah_pemodal= $nisbah_pemodal;

        if($model->save()){
            return redirect('Nisbah')->with('message_success','Anda telah mengubah Besar nisbah');
        }else{
            return redirect('Nisbah')->with('message_fail','Maaf, besar nisbah tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        if(empty($model = BDM::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($model->delete()){
            return redirect('Nisbah')->with('message_success','Anda telah menghapus Besar nisbah');
        }else{
            return redirect('Nisbah')->with('message_fail','Maaf, besar nisbah tidak dapat diubah');
        }
    }
}
