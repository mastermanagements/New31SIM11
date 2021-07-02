<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\Supplier as suppries;
use App\Model\Produksi\RekSupplier as rek_sup;

class Supplier extends Controller
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
        $data=[
            'data_supplier'=> suppries::all()->where('id_perusahaan', $this->id_perusahaan)->sortByDesc('created_at'),
            'rek_supplier'=> rek_sup::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.produksi.section.supplier.page_default', $data);
    }

    public function create(){
        return view('user.produksi.section.supplier.page_create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'nm_supplier' => 'required'
        ]);

        $nm_supplier = $request->nm_supplier;
        $cp_suplier = $request->cp_suplier;
        $telp_suplier = $request->telp_suplier;
        $hp_suplier = $request->hp_suplier;
        $wa_suplier = $request->wa_suplier;

        $model=new suppries;
        $model->nama_suplier= $nm_supplier;
        $model->cp_suplier= $cp_suplier;
        $model->telp_suplier= $telp_suplier;
        $model->hp_suplier= $hp_suplier;
        $model->wa_suplier= $wa_suplier;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Supplier')->with('message_success', 'Anda telah menambah supplier baru');
        }else{
            return redirect('Supplier')->with('message_fail', 'Maaf terjadi kesalahan, silahkan coba lagi untuk menambah supplier');
        }
    }

    public function edit(Request $req, $id){
        if(empty($data=suppries::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_supplier'=> $data
        ];
        return view('user.produksi.section.supplier.page_edit',$data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nm_supplier' => 'required'
        ]);

        $nm_supplier = $request->nm_supplier;
        $cp_suplier = $request->cp_suplier;
        $telp_suplier = $request->telp_suplier;
        $hp_suplier = $request->hp_suplier;
        $wa_suplier = $request->wa_suplier;

        $model=suppries::find($id);
        $model->nama_suplier= $nm_supplier;
        $model->cp_suplier= $cp_suplier;
        $model->telp_suplier= $telp_suplier;
        $model->hp_suplier= $hp_suplier;
        $model->wa_suplier= $wa_suplier;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Supplier')->with('message_success', 'Anda telah mengubah supplier baru');
        }else{
            return redirect('Supplier')->with('message_fail', 'Maaf terjadi kesalahan, silahkan coba lagi untuk mengubah supplier');
        }
    }

    public function delete(Request $request, $id)
    {
        if(empty($model=suppries::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($model->delete()){
            return redirect('Supplier')->with('message_success', 'Anda telah mengubah supplier baru');
        }else{
            return redirect('Supplier')->with('message_fail', 'Maaf terjadi kesalahan, silahkan coba lagi untuk mengubah supplier');
        }
    }

}
