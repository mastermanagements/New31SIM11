<?php

namespace App\Http\Controllers\hrd;

use function GuzzleHttp\Psr7\_parse_request_uri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hrd\H_item_wawancara as itemWancara;
use Session;

class ItemWawancara extends Controller
{
    //
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
        $data=[
            'itemWawancara' => itemWancara::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.tes.wawancara.itemWawancara.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'item_wawancara'=> 'required'
        ]);

        $item_wawancara = $req->item_wawancara;

        $model = new itemWancara;
        $model->item_wawancara = $item_wawancara;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('item-wawancara')->with('message_success', 'Anda telah menambah item wawancara');
        }else{
            return redirect('item-wawancara')->with('message_fail', 'Telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function edit($id){
        if(empty($model = itemWancara::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req, [
            'item_wawancara_ubah'=> 'required',
            'id_item_wawancara' => 'required'
        ]);

        $item_wawancara = $req->item_wawancara_ubah;

        $model = itemWancara::find($req->id_item_wawancara);
        $model->item_wawancara = $item_wawancara;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('item-wawancara')->with('message_success', 'Anda telah mengubah item wawancara');
        }else{
            return redirect('item-wawancara')->with('message_fail', 'Telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function delete(Request $req, $id)
    {

       if(empty($model = itemWancara::where('id',$id))){
           return abort(404);
       }

        if($model->delete()){
            return redirect('item-wawancara')->with('message_success', 'Anda telah menghapus item wawancara');
        }else{
            return redirect('item-wawancara')->with('message_fail', 'Telah terjadi kesalahan silahkan coba lagi');
        }
    }
}
