<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hrd\H_item_keahlian as item_keahlian;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use Session;

class ItemKeahlian extends Controller
{
    //
    //
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
            return $next($req);
        });
    }

    public function index()
    {
        $data = [
            'jabatan'=> jabatan::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(15)
        ];

        return view('user.hrd.section.tes.keahlian.itemkeahlian.page_default', $data);
    }

    public function store(Request $req)
    {

        $this->validate($req, [
            'item_keahlian'=> 'required',
            'id_jabatan_p'=>'required'
        ]);

        $item_keahlian =  $req->item_keahlian;
        $id_jabatan_p = $req->id_jabatan_p;

        $model = new item_keahlian();
        $model->id_jabatan_p=$id_jabatan_p;
        $model->item_tes_keahlian=$item_keahlian;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            return redirect('item-keahlian')->with('message_success', 'Anda telah menambahkan item Keahlian');
        }else{
            return redirect('item-keahlian')->with('message_fail', 'Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function edit($id)
    {
        if(empty($model = item_keahlian::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {

        $this->validate($req, [
            'item_keahlian_ubah'=> 'required',
            'id_item_keahlian'=>'required'
        ]);

        $item_keahlian =  $req->item_keahlian_ubah;
        $id_item_keahlian =  $req->id_item_keahlian;

        $model = item_keahlian::find($id_item_keahlian);
        $model->item_tes_keahlian=$item_keahlian;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            return redirect('item-keahlian')->with('message_success', 'Anda telah mengubah item Keahlian');
        }else{
            return redirect('item-keahlian')->with('message_fail', 'Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function delete(Request $req){
       $this->validate($req,[
           'id_item'=> 'required'
       ]);

       $id_item = $req->id_item;
        if(empty($model = item_keahlian::where('id', $id_item)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete()){
            $feetback = [
                'message'=> 'Anda telah menghapus item',
                'status'=> true
            ];
            return response()->json($feetback);
        }else{
            $feetback = [
                'message'=> 'Gagal menghapus item',
                'status'=> false
            ];
            return response()->json($feetback);
        }

    }
}
