<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Investor\PeriodeInvestasi as PI;
use Session;
use App\Investasi\I_data_investor as idi;
use App\Model\Investor\JualSahamInvestor as JSI;
use App\Traits\ProsesDaftarInvestasi;
use App\Model\Investor\BentukInvestor as BI;

class JualSahamInvestor extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    private  $id_con;
    use ProsesDaftarInvestasi;


    private function makeNewDesignObject($array){
        $newObject = new \stdClass();
        $newObject->tgl_invest =  $array['tgl_jual_s'];
        $newObject->id_periode_invest =  $array['id_periode_invest'];
        $newObject->id_investor =  $array['id_investor_penjual'];
        $newObject->jumlah_saham =  $array['sisa_saham'];
        $newObject->id_bentuk_invest =  $array['id_bentuk_invest'];
        $newObject->ket =  $array['ket'];
        $newObject->id =  $array['id'];
        return $newObject;
    }

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
            $this->id_con=[
                'id_perusahaan'=> $this->id_perusahaan,
                'id_karyawan' => $this->id_karyawan
            ];
            return $next($req);
        });
    }

    public function index(){
        Session::put('menu-jual-saham','saham-investor');
        $data = [
            'periode_inves'=> PI::all()->where('id_perusahaan'),
            'investor' =>idi::all()->where('id_perusahaan', $this->id_perusahaan),
            'bentuk_investor'=> BI::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=> JSI::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.JualSaham.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
          "tgl_jual_s" => "required",
          "id_periode_invest" => "required",
          "id_investor_penjual" => "required",
          "jumlah_dijual" => "required",
          "id_investor_pembeli" => "required",
          "id_bentuk_invest" => "required"
        ]);
        $jumlah_saham_periode_sebelumnya = 0;
        $cek_investasi_periode_terakhir = idi::where('id', $req->id_investor_penjual)->first()->dataInvestasi->last();
        if(!empty($cek_investasi_periode_terakhir)){
            $jumlah_saham_periode_sebelumnya = $cek_investasi_periode_terakhir->jumlah_saham;
        }
        $sisa_saham_penjual = $jumlah_saham_periode_sebelumnya-$req->jumlah_dijual;


        $model = new JSI();
        $model->tgl_jual_s = date('Y-m-d', strtotime($req->tgl_jual_s));
        $model->id_periode_invest = $req->id_periode_invest;
        $model->id_investor_penjual = $req->id_investor_penjual;
        $model->lembar_saham_penjual = $jumlah_saham_periode_sebelumnya;
        $model->jumlah_dijual = $req->jumlah_dijual;
        $model->id_investor_pembeli = $req->id_investor_pembeli;
        $model->sisa_saham_dijual = $sisa_saham_penjual;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        $arrayToObjectJual = [
            'tgl_jual_s'=>date('Y-m-d', strtotime($req->tgl_jual_s)),
            'id_periode_invest'=>$req->id_periode_invest,
            'id_investor_penjual'=>$req->id_investor_penjual,
            'sisa_saham'=>$sisa_saham_penjual,
            'id_bentuk_invest'=>$req->id_bentuk_invest,
            'ket'=>"Dijual",
            'id'=>"",
        ];

        $arrayToObjectBeli = [
            'tgl_jual_s'=>date('Y-m-d', strtotime($req->tgl_jual_s)),
            'id_periode_invest'=>$req->id_periode_invest,
            'id_investor_penjual'=>$req->id_investor_pembeli,
            'sisa_saham'=>$req->jumlah_dijual,
            'id_bentuk_invest'=>$req->id_bentuk_invest,
            'ket'=>"Dibeli",
            'id'=>"",
        ];
        $newObjectJual = $this->makeNewDesignObject($arrayToObjectJual);
        $newObjectBeli = $this->makeNewDesignObject($arrayToObjectBeli);
        if($model->save()){
            $this->storeInvestasi($newObjectJual, $this->id_con);
            $this->storeInvestasi($newObjectBeli, $this->id_con);
            return redirect('saham-investor')->with('message_success','Anda telah menambahkan data saham yang dijual, data ini akan otomatis ditambahkan ke dalam daftar investasi');
        }else{
            return redirect('saham-investor')->with('message_fail','Maaf, data saham yang dijual tidak dapat disimpan');
        }
    }

    public function edit($id)
    {
        if(empty($model = JSI::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return $model;
    }

    public function update(Request $req){
        $this->validate($req,[
            "tgl_jual_s" => "required",
            "id_periode_invest" => "required",
            "id_investor_penjual" => "required",
            "jumlah_dijual" => "required",
            "id_investor_pembeli" => "required",
            "id_bentuk_invest" => "required",
            "id" => "required"
        ]);

        $model = JSI::find($req->id);
        $jumlah_saham_periode_sebelumnya = $model->lembar_saham_penjual;
        $sisa_saham_penjual = $model->lembar_saham_penjual-$req->jumlah_dijual;
        $model->tgl_jual_s = date('Y-m-d', strtotime($req->tgl_jual_s));
        $model->id_periode_invest = $req->id_periode_invest;
        $model->id_investor_penjual = $req->id_investor_penjual;
        $model->lembar_saham_penjual = $jumlah_saham_periode_sebelumnya;
        $model->jumlah_dijual = $req->jumlah_dijual;
        $model->id_investor_pembeli = $req->id_investor_pembeli;
        $model->sisa_saham_dijual = $sisa_saham_penjual;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;


        $data_id_jual = $this->show_data(['id_investor'=>$req->id_investor_penjual,'id_periode_invest'=>$req->id_periode_invest,'id_perusahaan'=>$this->id_perusahaan]);
        $data_id_beli = $this->show_data(['id_investor'=>$req->id_investor_pembeli,'id_periode_invest'=>$req->id_periode_invest,'id_perusahaan'=>$this->id_perusahaan]);
        $arrayToObjectJual = [
            'tgl_jual_s'=>date('Y-m-d', strtotime($req->tgl_jual_s)),
            'id_periode_invest'=>$req->id_periode_invest,
            'id_investor_penjual'=>$req->id_investor_penjual,
            'sisa_saham'=>$sisa_saham_penjual,
            'id_bentuk_invest'=>$req->id_bentuk_invest,
            'ket'=>"Dijual",
            'id'=>$data_id_jual->id
        ];

        $arrayToObjectBeli = [
            'tgl_jual_s'=>date('Y-m-d', strtotime($req->tgl_jual_s)),
            'id_periode_invest'=>$req->id_periode_invest,
            'id_investor_penjual'=>$req->id_investor_pembeli,
            'sisa_saham'=>$req->jumlah_dijual,
            'id_bentuk_invest'=>$req->id_bentuk_invest,
            'ket'=>"Dibeli",
            'id'=>$data_id_beli->id,
        ];
        $newObjectJual = $this->makeNewDesignObject($arrayToObjectJual);
        $newObjectBeli = $this->makeNewDesignObject($arrayToObjectBeli);
        if($model->save()){
            $this->update($newObjectJual, $this->id_con);
            $this->update($newObjectBeli, $this->id_con);
            return redirect('saham-investor')->with('message_success','Anda telah mengubah data saham yang dijual, data ini akan otomatis ditambahkan ke dalam daftar investasi');
        }else{
            return redirect('saham-investor')->with('message_fail','Maaf, data saham yang dijual tidak dapat diubah');
        }
    }

    public function deletes(Request $req, $id){
        $model = JSI::find($id);
        $arrayJual=[
          'id_investor' =>$model->id_investor_penjual,
          'id_periode_invest'=>$model->id_periode_invest,
        ];
        $arrayBeli=[
          'id_investor' =>$model->id_investor_pembeli,
          'id_periode_invest'=>$model->id_periode_invest,
        ];
        $data_jual=$this->delete(array_merge($arrayJual,$this->id_con));
        $data_beli=$this->delete(array_merge($arrayBeli,$this->id_con));
        if($model->delete()){
            $data_jual->delete();
            $data_beli->delete();
            return redirect('saham-investor')->with('message_success','Anda telah menghapus data penjual saham investor');
        }else{
            return redirect('saham-investor')->with('message_fail','Maaf, anda tidak dapat mengahpaus data penjual saham investor');
        }
    }
}
