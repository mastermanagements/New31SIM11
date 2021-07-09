<?php

namespace App\Http\Controllers\hrd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hrd\H_kompetensi_manajerial as Hkm;
use App\Model\Hrd\H_item_kmanajerial as hikm;
use Session;

class ItemKmanajerial extends Controller
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
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index(){
        $data = [
            'Hkm' => Hkm::all()->where('id_perusahaan', $this->id_perusahaan),
            'data' => hikm::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.itemKManajerial.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_kompetesi_m'=> 'required',
            'item_kompetensi_m'=> 'required',
        ]);

        $model= new hikm();
        $model->id_kompetensi_m = $req->id_kompetesi_m;
        $model->item_kompetensi_m = $req->item_kompetensi_m;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('item-kompetensi-manajerial')->with('message_success','Anda telah menambahkan item manajerial baru');
        }else{
            return redirect('item-kompetensi-manajerial')->with('message_fail','gagal menambahkan item baru');
        }

    }

    public function edit($id){
        if(empty($model = hikm::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'id_kompetesi_m'=> 'required',
            'item_kompetensi_m'=> 'required',
            'id'=> 'required',
        ]);

        $model= hikm::find($req->id);
        $model->id_kompetensi_m = $req->id_kompetesi_m;
        $model->item_kompetensi_m = $req->item_kompetensi_m;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('item-kompetensi-manajerial')->with('message_success','Anda telah mengubah item manajerial');
        }else{
            return redirect('item-kompetensi-manajerial')->with('message_fail','gagal menghapus item baru');
        }

    }

    public function delete(Request $req,$id){
        $model= hikm::find($id);
        if($model->delete()){
            return redirect('item-kompetensi-manajerial')->with('message_success','Anda telah menghapus item manajerial');
        }else{
            return redirect('item-kompetensi-manajerial')->with('message_fail','gagal menghapus item baru');
        }
    }
}
