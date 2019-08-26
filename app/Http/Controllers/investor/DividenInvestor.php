<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\Traits\DateYears;
use App\Investasi\I_data_investor as DI;
use App\Model\Investor\DevidePerbulan as DP;
use App\Model\Investor\SahamReal as SR;
use App\Model\Investor\DividenInvestor as DIV;

class DividenInvestor extends Controller
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

    public function index()
    {
        Session::put('menu-dividen','investor');
        $data = [
            'ymd'=>$this->costumDate(),
            'data_investasi'=> DI::all()->where('id_perusahaan', $this->id_perusahaan),
            'dividen_bulanan'=> DP::all()->where('id_perusahaan', $this->id_perusahaan)->sortBy('thn_dividen'),
            'data_dividen_investor'=> DIV::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.dividen.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            "id_daftar_investor" => "required",
            "id_bulan_dividen" => "required"
        ]);

        $model_saham_real = SR::where('status','aktif')->first();
        $daftar_investasi = $model_saham_real->periode_invest->dataInvetasi->where('id_investor', $req->id_daftar_investor)->first();
        if(empty($daftar_investasi->persentase)){
            return redirect('Dividen-Investor')->with('message_fail','Persentase Dalam daftar investasi belum dimasukan');
        }
        $model_dividen_bulanan = DP::find($req->id_bulan_dividen);
        $besar_dividen = $daftar_investasi->persentase * $model_dividen_bulanan->net_kas;

        $model_DI = new DIV();
        $model_DI->id_daftar_investor = $req->id_daftar_investor;
        $model_DI->id_bulan_dividen = $req->id_bulan_dividen;
        $model_DI->besar_dividen = $besar_dividen;
        $model_DI->id_perusahaan = $this->id_perusahaan;
        $model_DI->id_karyawan = $this->id_karyawan;

        if($model_DI->save()){
            return redirect('Dividen-Investor')->with('message_success', 'Anda telah menambahkan dividen investor');
        }else{
            return redirect('Dividen-Investor')->with('message_fail', 'Maaf, Data dividen investor tidak dapat disimpan');
        }
    }

    public function edit($id){
        if(empty($model = DIV::where('id_perusahaan', $this->id_perusahaan)->where('id',$id)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            "id_daftar_investor" => "required",
            "id_bulan_dividen" => "required",
            "id" => "required"
        ]);

        $model_saham_real = SR::where('status','aktif')->first();
        $daftar_investasi = $model_saham_real->periode_invest->dataInvetasi->where('id_investor', $req->id_daftar_investor)->first();
        if(empty($daftar_investasi->persentase)){
            return redirect('Dividen-Investor')->with('message_fail','Persentase Dalam daftar investasi belum dimasukan');
        }
        $model_dividen_bulanan = DP::find($req->id_bulan_dividen);
        $besar_dividen = $daftar_investasi->persentase * $model_dividen_bulanan->net_kas;

        $model_DI = DIV::find($req->id);
        $model_DI->id_daftar_investor = $req->id_daftar_investor;
        $model_DI->id_bulan_dividen = $req->id_bulan_dividen;
        $model_DI->besar_dividen = $besar_dividen;
        $model_DI->id_perusahaan = $this->id_perusahaan;
        $model_DI->id_karyawan = $this->id_karyawan;

        if($model_DI->save()){
            return redirect('Dividen-Investor')->with('message_success', 'Anda telah mengubah dividen investor');
        }else{
            return redirect('Dividen-Investor')->with('message_fail', 'Maaf, Data dividen investor tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        $model_DI = DIV::find($id);
        if($model_DI->delete()){
            return redirect('Dividen-Investor')->with('message_success', 'Anda telah menghapus dividen investor');
        }else{
            return redirect('Dividen-Investor')->with('message_fail', 'Maaf, Data dividen investor tidak dapat dihapus');
        }
    }

    public function lihat_data_dividen(Request $req,$id_investor){

        if(empty($model= DIV::all()->where('id_daftar_investor', $id_investor)->where('id_perusahaan', $this->id_perusahaan))){
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
                $result = $this->getDataDividenBulanan($model, $key_bulan,$thn);
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
        return response()->json(array('data'=>$array_row,'button'=>$this->buttonYear($id_investor), 'thn'=> $thn));
    }

    public function getDataDividenBulanan($model, $bulan, $tahun){
        $bulan_c = array();
        foreach ($model as $data){
            $data_bulanan_dviden = $data->bulan_dividen->where('id', $data->id_bulan_dividen)->whereMonth("bln_dividen","=", $bulan)->whereYear('thn_dividen','=', $tahun)->first();
            if(!empty($data_bulanan_dviden)){
                $data_bulanan_dviden->besar_dividen = $data->besar_dividen;
                $data_bulanan_dviden->id_dividen = $data->id;
                $bulan_c = array($bulan=>$data_bulanan_dviden);
            }
        }
       return $bulan_c;
    }

    public function buttonYear($id){
        $query = DB::table('i_bulan_dividen_s')
            ->select('i_dividen_investor.id_daftar_investor','i_bulan_dividen_s.thn_dividen')
            ->join('i_dividen_investor','i_dividen_investor.id_bulan_dividen','=','i_bulan_dividen_s.id')
            ->where('id_daftar_investor','=', $id)
            ->groupBy('i_bulan_dividen_s.thn_dividen')->get();

        $array_button = array();

        if(!empty($query)){
            foreach ($query as $value)
            {
                $array_button[] = array('id_investor'=>$value->id_daftar_investor,'tahun'=>$value->thn_dividen);
            }
            return $array_button;
        }
    }

}
