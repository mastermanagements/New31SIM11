<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\BentukInvestor as BI;

class BentukInvestor extends Controller
{


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
