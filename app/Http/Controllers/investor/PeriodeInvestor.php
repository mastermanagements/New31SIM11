<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\PeriodeInvestasi as PI;

class PeriodeInvestor extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    private  $id_con;

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
        $data = [
          'data'=> PI::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.periodeInvestor.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'periode_ke'=> 'required',
            'nm_periode'=> 'required',
            'vesting_periode'=> 'required',
            'nilai_valuasi'=> 'required',
        ]);

        $data_rq = $req->except(['id','_token']);
        $model = new PI(
            array_merge($data_rq,$this->id_con)
        );
        if($model->save()){
            return redirect('Periode-Investasi')->with('message_success','Anda telah menambahkan periode investasi');
        }else{
            return redirect('Periode-Investasi')->with('message_fail','Maaf, periode investaasi tidak dapat ditambahkan');
        }
    }

    public function edit($id){
        if(empty($model = PI::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'id'=> 'required',
            'periode_ke'=> 'required',
            'nm_periode'=> 'required',
            'vesting_periode'=> 'required',
            'nilai_valuasi'=> 'required',
        ]);

        $data_rq = $req->except(['_token']);
        $model = PI::find($req->id)->update(
            array_merge($data_rq,$this->id_con)
        );
        if($model){
            return redirect('Periode-Investasi')->with('message_success','Anda telah mengubah periode investasi');
        }else{
            return redirect('Periode-Investasi')->with('message_fail','Maaf, periode investaasi tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = PI::find($id);
        if($model->delete()){
            return redirect('Periode-Investasi')->with('message_success','Anda telah menghapus periode investasi');
        }else{
            return redirect('Periode-Investasi')->with('message_fail','Maaf, periode investaasi tidak dapat dihapus');
        }
    }

}
