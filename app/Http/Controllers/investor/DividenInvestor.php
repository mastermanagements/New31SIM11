<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            'dividen_bulanan'=> DP::all()->where('id_perusahaan', $this->id_perusahaan),
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
}
