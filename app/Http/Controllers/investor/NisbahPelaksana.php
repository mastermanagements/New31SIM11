<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DateYears;
use Illuminate\Support\Facades\DB;
use Session;
use App\Model\Investor\Pelaksana as P;
use App\Model\Investor\BulanDevidenM as BDM;
use App\Model\Investor\DividenPelaksana as DP;

class NisbahPelaksana extends Controller
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

    public function index(){
        Session::put('menu-nisbah','nisbah_pelaksana');
        $data = [
            'ymd'=>$this->costumDate(),
            'pelaksana'=> P::all()->where('id_perusahaan', $this->id_perusahaan),
            'BDM'=> BDM::all()->where('id_perusahaan', $this->id_perusahaan)->groupBy('thn_dividen'),
            'data'=> DP::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        //dd($data['ymd']);
        return view('user.investor.section.nisbah.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            "id_pelaksana" => "required",
            "id_bulan_dividen" => "required"
        ]);

        $model = new DP();
        $model->id_pelaksana = $req->id_pelaksana;
        $model->id_bulan_dividen = $req->id_bulan_dividen;
        $models_pelaksana = P::find($req->id_pelaksana);
        $models_bulan_dividen_m = BDM::find($req->id_bulan_dividen);
        $model->besar_dividen =($models_pelaksana->persen_saham/100)*$models_bulan_dividen_m->nisbah_pelaksana;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Nisbah-pelaksana')->with('message_success', 'Anda telah menambahkan Nisbah pelaksana');
        }else{
            return redirect('Nisbah-pelaksana')->with('message_fail', 'Maaf, Nisbah Pelaksana tidak dapat ditambahkan');
        }

    }

    public function edit($id){
        if(empty($model=DP::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            "id_pelaksana" => "required",
            "id_bulan_dividen" => "required"
        ]);

        $model = DP::find($req->id);
        $model->id_pelaksana = $req->id_pelaksana;
        $model->id_bulan_dividen = $req->id_bulan_dividen;
        $models_pelaksana = P::find($req->id_pelaksana);
        $models_bulan_dividen_m = BDM::find($req->id_bulan_dividen);
        $model->besar_dividen =($models_pelaksana->persen_saham/100)*$models_bulan_dividen_m->nisbah_pelaksana;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Nisbah-pelaksana')->with('message_success', 'Anda telah mengubah Nisbah pelaksana');
        }else{
            return redirect('Nisbah-pelaksana')->with('message_fail', 'Maaf, Nisbah Pelaksana tidak dapat diubah');
        }

    }

    public function delete(Request $req, $id){
        $model = DP::find($req->id);
        if($model->delete()){
            return redirect('Nisbah-pelaksana')->with('message_success', 'Anda telah menghapus Nisbah pelaksana');
        }else{
            return redirect('Nisbah-pelaksana')->with('message_fail', 'Maaf, Nisbah Pelaksana tidak dapat dihapus');
        }
    }

    public function data_pelaksana(Request $req,$id_pelaksana){

        if(empty($model= DP::all()->where('id_pelaksana', $id_pelaksana)->where('id_perusahaan', $this->id_perusahaan))){
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
        $total_laba_rugi = 0;
        $total_alokasi = 0;
        $total_net_kas = 0;
        $total_nisbah_pemodal = 0;
        $total_bagi_hasil = 0;
        foreach ($container_bulan as $key_bulan => $bulan) {
            $result = $this->getDividenBulanan($model, $key_bulan, $thn);

            $laba_rugi=0;
            $alokasi_kas=0;
            $net_kas=0;
            $nisba_pelaksana=0;
            $besar_dividen=0;
            $button = '';
            if(!empty($result)){
                $laba_rugi = $result[$key_bulan]->laba_rugi;
                $alokasi_kas = $result[$key_bulan]->alokasi_kas;
                $net_kas = $result[$key_bulan]->net_kas;
                $besar_dividen = $result[$key_bulan]->besar_dividen;
                $nisba_pelaksana = $result[$key_bulan]->nisbah_pelaksana;

                $url = 'delete-nisbah-pelaksana/'. $result[$key_bulan]->id_dividen;
                $token = $req->session()->token();
                $button = ' <form action="/'.$url.'/" method="post">
                                                        <input type="hidden" name="_method" value="put">
                                                        <input type="hidden" name="_token" value="'.$token.'">
                                                        <button type="button" class="btn btn-warning" onclick="edit_dividen_investor('.$result[$key_bulan]->id_dividen.')">ubah</button>
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm(\'Apakah anda akan menghapus data ini ...?\')" >hapus</button>
                                </form>';
            }

            $total_laba_rugi += $laba_rugi;
            $total_alokasi += $alokasi_kas;
            $total_net_kas += $net_kas;
            $total_nisbah_pemodal +=$nisba_pelaksana;
            $total_bagi_hasil +=$besar_dividen;

            $array_column = array();
            $array_column[] = $no++;
            $array_column[] = $bulan;
            $array_column[] = $laba_rugi;
            $array_column[] = $alokasi_kas;
            $array_column[] = $net_kas;
            $array_column[] = $nisba_pelaksana;
            $array_column[] = $besar_dividen;
            $array_column[] = $button;
            $array_row[] = $array_column;
        }
        return response()->json(array('data'=>$array_row,'button'=>$this->buttonYear($id_pelaksana),
            'total_laba_rugi'=> $total_laba_rugi,'total_alokasi_kas'=> $total_alokasi,
            'total_net_kas'=>$total_net_kas,'total_nisbah_pelaku'=>$total_nisbah_pemodal,'total_bagi_hasil_pelaku'=>$total_bagi_hasil
            ,'thn'=> $thn));
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
        $query = DB::table('i_dividen_pelaksana')
            ->select('i_dividen_pelaksana.id_pelaksana','i_deviden_bulan_m.thn_dividen')
            ->join('i_deviden_bulan_m','i_dividen_pelaksana.id_bulan_dividen','=','i_deviden_bulan_m.id')
            ->where('id_pelaksana','=', $id)
            ->groupBy('i_deviden_bulan_m.thn_dividen')->get();

        $array_button = array();

        if(!empty($query)){
            foreach ($query as $value)
            {
                $array_button[] = array('id_pelaksana'=>$value->id_pelaksana,'tahun'=>$value->thn_dividen);
            }
            return $array_button;
        }
    }
}
