<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\PokokCF as pcf;
use App\Model\Penggajian\ItemCF as icf;

class ItemCf extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;

    public function __construct()
    {
        $this->middleware(function($req, $next)
        {
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
        $data=[
            'data'=> icf::all()->where('id_perusahaan', $this->id_perusahaan),
            'pokok_cf'=> pcf::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.ContentCF.itemCF.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'id_pccf'=> 'required',
           'item_ccf'=> 'required',
        ]);

        $model = new icf();
        $model->id_pccf = $req->id_pccf;
        $model->item_ccf = $req->item_ccf;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('item-cf')->with('message_success', 'Anda telah menambahkan item Cf');
        }else{
            return redirect('item-cf')->with('message_fail', 'Maaf, Gagal menambahkan item Cf');
        }
    }

    public function edit($id)
    {
        if(empty($model = icf::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'id_pccf'=> 'required',
            'item_ccf'=> 'required',
            'id'=> 'required',
        ]);

        $model = icf::find($req->id);
        $model->id_pccf = $req->id_pccf;
        $model->item_ccf = $req->item_ccf;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('item-cf')->with('message_success', 'Anda telah mengubah item Cf');
        }else{
            return redirect('item-cf')->with('message_fail', 'Maaf, Gagal mengubah item Cf');
        }
    }

    public function delete(Request $req,$id){
        $model = icf::find($id);
        if($model->delete()){
            return redirect('item-cf')->with('message_success', 'Anda telah menghapus item Cf');
        }else{
            return redirect('item-cf')->with('message_fail', 'Maaf, Gagal menghapus item Cf');
        }
    }
}
