<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\BentukInvestor as BI;

class BentukInvestor extends Controller
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
            $this->id_con=[
                'id_perusahaan'=> $this->id_perusahaan,
                'id_karyawan' => $this->id_karyawan
            ];
            return $next($req);
        });
	}

    public function index(){
        $data = [
            'data'=> BI::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.bentukInvestor.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'bentuk_investasi'=> 'required'
        ]);

        $dataReq = $req->except(['id','_token']);
        $model = new BI(
            array_merge($dataReq, $this->id_con)
        );
        if($model->save()){
            return redirect('Bentuk-Investor')->with('message_success','Anda telah menambahkan data investor');
        }else{
            return redirect('Bentuk-Investor')->with('message_fail','Maaf, data investor tidak disimpan');
        }
    }

    public function edit($id){
        if(empty($model = BI::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'id'=>'required',
            'bentuk_investasi'=> 'required'
        ]);

        $dataReq = $req->except(['_token']);
        $model = BI::find($req->id)->update(
            array_merge($dataReq, $this->id_con)
        );
        if($model){
            return redirect('Bentuk-Investor')->with('message_success','Anda telah mengubah data investor');
        }else{
            return redirect('Bentuk-Investor')->with('message_fail','Maaf, data investor tidak diubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = BI::find($id);
        if($model->delete()){
            return redirect('Bentuk-Investor')->with('message_success','Anda telah menghapus data investor');
        }else{
            return redirect('Bentuk-Investor')->with('message_fail','Maaf, data investor tidak dihapus');
        }
    }
}
