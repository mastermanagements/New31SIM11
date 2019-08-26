<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\PeriodeInvestasi as PI;
use App\Model\Investor\Nisbah as Ns;
use App\Traits\DateYears;

class Nisbah extends Controller
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
        Session::put('menu-nisbah','besar-nisbah');
        $data = [
            'pi'=> PI::all()->where('id_perusahaan', $this->id_perusahaan),
            'ymd'=>$this->costumDate()
        ];
        return view('user.investor.section.nisbah.page_default', $data);
    }

    public function store(Request $req){

        $this->validate($req,[
          "id_periode_invest" => "required",
          "pelaksana" => "required|min:0|max:100",
          "pemodal" => "required|min:0|max:100"
        ]);
        $maxs =$req->pelaksana + $req->pemodal;
        if ($maxs > 100){
            return redirect('Nisbah')->with('message_fail','Total nisbah lebih boleh dari 100%');
        }

        $model = Ns::updateOrCreate(
            ['id_periode_invest'=> $req->id_periode_invest, 'id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan],
            ['pelaksana'=> $req->pelaksana,'pemodal'=> $req->pemodal]
        );

        if($model->save()){
            return redirect('Nisbah')->with('message_success','Anda telah menambahkan nisbah');
        }else{
            return redirect('Nisbah')->with('message_fail','Maaf, nisbah tidak daat disimpan');
        }

    }
}
