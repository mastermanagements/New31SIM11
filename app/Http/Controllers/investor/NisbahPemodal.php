<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\DateYears;
use Session;
use App\Model\Investor\BulanDevidenM as BDM;
use App\Model\Investor\Pemodal as p;
use App\Model\Investor\DividenPemodal as DP;

class NisbahPemodal extends Controller
{
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

    public function index()
    {
        Session::put('menu-nisbah','nisbah_pemodal');
        $data = [
            'ymd'=>$this->costumDate(),
            'BDM'=> BDM::all()->where('id_perusahaan', $this->id_perusahaan)->groupBy('thn_dividen'),
            'pemodal' =>p::all()->where('id_perusahaan', $this->id_perusahaan),
            'data' => DP::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
         return view('user.investor.section.nisbah.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            "id_pemodal" => "required",
            "id_bulan_dividen" => "required"
        ]);

        $model = new DP();
        $model->id_pemodal = $req->id_pemodal;
        $model->id_bulan_dividen = $req->id_bulan_dividen;

        $model_pemodal = p::find($req->id_pemodal);
        $models_bulan_dividen_m = BDM::find($req->id_bulan_dividen);
        $model->besar_dividen = $model_pemodal->persen_saham*$models_bulan_dividen_m->net_kas;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Nisbah-pemodal')->with('message_success','Anda telah menambahkan Nisbah Pemodal');
        }else{
            return redirect('Nisbah-pemodal')->with('message_fail','Maaf,gagal menambahkan Nisbah Pemodal');
        }
    }

    public function edit($id){
        if(empty($model = DP::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            "id_pemodal" => "required",
            "id_bulan_dividen" => "required",
            "id" => "required"
        ]);

        $model = DP::find($req->id);
        $model->id_pemodal = $req->id_pemodal;
        $model->id_bulan_dividen = $req->id_bulan_dividen;

        $model_pemodal = p::find($req->id_pemodal);
        $models_bulan_dividen_m = BDM::find($req->id_bulan_dividen);
        $model->besar_dividen = $model_pemodal->persen_saham*$models_bulan_dividen_m->net_kas;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Nisbah-pemodal')->with('message_success','Anda telah mengubah Nisbah Pemodal');
        }else{
            return redirect('Nisbah-pemodal')->with('message_fail','Maaf,gagal mengubah Nisbah Pemodal');
        }
    }

    public function delete(Request $req, $id){
        $model = DP::find($id);
        if($model->delete()){
            return redirect('Nisbah-pemodal')->with('message_success','Anda telah menghapus Nisbah Pemodal');
        }else{
            return redirect('Nisbah-pemodal')->with('message_fail','Maaf,gagal menghapus Nisbah Pemodal');
        }
    }

    public function data_pemodal(Request $req,$id_pemodal){

        if(empty($model= DP::all()->where('id_pemodal', $id_pemodal)->where('id_perusahaan', $this->id_perusahaan))){
            return abort(404);
        }

        $bulan = $this->costumDate()->month->semua_bulan;
        $container_bulan = $bulan;

        if(empty($req->thn)){
            $thn =$this->costumDate()->year;
        }else{
            $thn = $req->thn;
        }

        $array_row = array();
        $no=1;

        foreach ($container_bulan as $key_bulan => $bulan) {
            $result = $this->getDividenBulanan($model, $key_bulan, $thn);

            $laba_rugi=0;
            $alokasi_kas=0;
            $net_kas=0;
            $besar_dividen=0;
            $button = '';
            if(!empty($result)){
                $laba_rugi = $result[$key_bulan]->laba_rugi;
                $alokasi_kas = $result[$key_bulan]->alokasi_kas;
                $net_kas = $result[$key_bulan]->net_kas;
                $besar_dividen = $result[$key_bulan]->besar_dividen;

                $url = 'delete-saham-real/'. $result[$key_bulan]->id_dividen;
                $token = $req->session()->token();
                $button = ' <form action="/'.$url.'/" method="post">
                                                        <input type="hidden" name="_method" value="put">
                                                        <input type="hidden" name="_token" value="'.$token.'">
                                                        <button type="button" class="btn btn-warning" onclick="edit_dividen_investor('.$result[$key_bulan]->id_dividen.')">ubah</button>
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm(\'Apakah anda akan menghapus data ini ...?\')" >hapus</button>
                                </form>';
            }

            $array_column = array();
            $array_column[] = $no++;
            $array_column[] = $bulan;
            $array_column[] = $laba_rugi;
            $array_column[] = $alokasi_kas;
            $array_column[] = $net_kas;
            $array_column[] = $besar_dividen;
            $array_column[] = $button;
            $array_row[] = $array_column;
        }
        return response()->json(array('data'=>$array_row,'button'=>$this->buttonYear($id_pemodal) , 'thn'=> $thn));
    }

    public function getDividenBulanan($model, $bulan, $tahun)
    {
        $bulan_c = array();
        foreach ($model as $data){
            $array_bulan_dividen = $data->bulan_dividen->where('id', $data->id_bulan_dividen)->where('bln_dividen', $bulan)->where('thn_dividen', $tahun)->first();
            if(!empty($array_bulan_dividen)){
                $array_bulan_dividen->besar_dividen = $data->besar_dividen;
                $array_bulan_dividen->id_dividen = $data->id;
                $bulan_c = array($bulan=>$array_bulan_dividen);
            }
        }

        return $bulan_c;
    }

    public function buttonYear($id){
        $query = DB::table('i_dividen_pemodal')
            ->select('i_dividen_pemodal.id_pemodal','i_deviden_bulan_m.thn_dividen')
            ->join('i_deviden_bulan_m','i_dividen_pemodal.id_bulan_dividen','=','i_deviden_bulan_m.id')
            ->where('id_pemodal','=', $id)
            ->groupBy('i_deviden_bulan_m.thn_dividen')->get();

        $array_button = array();

        if(!empty($query)){
            foreach ($query as $value)
            {
                $array_button[] = array('id_pemodal'=>$value->id_pemodal,'tahun'=>$value->thn_dividen);
            }
            return $array_button;
        }
    }
}
