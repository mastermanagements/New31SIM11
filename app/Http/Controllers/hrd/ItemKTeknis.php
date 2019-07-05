<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_kompetensi_teknis as hkt;
use App\Model\Hrd\H_item_teknis as hit;

class ItemKTeknis extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;

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
            return $next($req);
        });
    }


    public function index(){
        $data = [
            'htk'=>hkt::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=> hit::all()->where('id_perusahaan',$this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.itemTeknis.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'id_kompetesi_m'=> 'required',
           'item_kompetensi_t'=> 'required',
        ]);

        $model = new hit();
        $model->id_kompetensi_teknis = $req->id_kompetesi_m;
        $model->item_kompetensi_t = $req->item_kompetensi_t;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('item-teknis')->with('message_success','Anda telah menambahkan item kompetensi teknis');
        }else{
            return redirect('item-teknis')->with('message_fail','Maaf, Item kompetensi teknis gagal disimpan');
        }
    }

    public function edit($id){
        if(empty($mode=hit::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($mode);
    }

    public function update(Request $req){
        $this->validate($req,[
            'id_kompetesi_m'=> 'required',
            'item_kompetensi_t'=> 'required',
            'id'=> 'required',
        ]);

        $model = hit::find($req->id);
        $model->id_kompetensi_teknis = $req->id_kompetesi_m;
        $model->item_kompetensi_t = $req->item_kompetensi_t;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('item-teknis')->with('message_success','Anda telah mengubah item kompetensi teknis');
        }else{
            return redirect('item-teknis')->with('message_fail','Maaf, Item kompetensi teknis gagal diubah');
        }
    }

    public function delete(Request $req, $id){

        $model = hit::find($req->id);
        if($model->delete()){
            return redirect('item-teknis')->with('message_success','Anda telah menghapus item kompetensi teknis');
        }else{
            return redirect('item-teknis')->with('message_fail','Maaf, Item kompetensi teknis gagal dihapus');
        }
    }

}
