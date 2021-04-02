<?php

namespace App\Http\Controllers\marketing;

use App\Model\Produksi\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Marketing\Promo as prom;
use Session;
use App\Model\Produksi\Jasa;
use App\Model\Marketing\DetailPromo;

class Promo extends Controller
{


    public function store(Request $req){
        $this->validate($req,[
            'nm_promo'=> 'required',
            'jenis_promo'=> 'required',
            'tgl_awal_promo'=> 'required',
            'tgl_akhir_promo'=> 'required',
            'syarat'=> 'required',
            'fasilitas'=> 'required',
        ]);

        $model = new prom();
        $model->jenis_promo = $req->jenis_promo;
        $model->nama_promo = $req->nm_promo;
        $model->syarat = $req->syarat;
        $model->fasilitas_promo = $req->fasilitas;
        $model->tgl_dibuat = $req->tgl_awal_promo;
        $model->tgl_berlaku = $req->tgl_akhir_promo;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');

        if(($req->jenis_promo == 0) AND ($model->save()))
        {
            return redirect('Barang')->with('message_sucess','Promo Barang telah dibuat')->with('tab6','tab6');
        }elseif(($req->jenis_promo == 1) AND ($model->save())){
            return redirect('Jasa')->with('message_sucess','Promo Jasa telah dibuat')->with('tab6','tab6');
        }


    }

    public function edit($id){
        $model = prom::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        return response()->json($model);
    }

    public function delete_promo(Request $req, $id){
        $this->validate($req,[
            '_token'=>'required'
        ]);
        $model = prom::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);

        if(($model->jenis_promo == 0) AND ($model->delete()))
        {
            return redirect('Barang')->with('tab6','tab6')->with('message_sucess','Promo Barang telah dihapus');
        }elseif(($model->jenis_promo == 1) AND ($model->delete())){
            return redirect('Jasa')->with('tab6','tab6')->with('message_sucess','Promo Jasa telah dihapus');
        }
    }

    public function update(Request $req, $id){

         $this->validate($req,[
            'nm_promo'=> 'required',
            'jenis_promo'=> 'required',
            'tgl_awal_promo'=> 'required',
            'tgl_akhir_promo'=> 'required',
            'syarat'=> 'required',
            'fasilitas'=> 'required',
        ]);

        $model = prom::findOrFail($id);
        $model->jenis_promo = $req->jenis_promo;
        $model->nama_promo = $req->nm_promo;
        $model->syarat = $req->syarat;
        $model->fasilitas_promo = $req->fasilitas;
        $model->tgl_dibuat = $req->tgl_awal_promo;
        $model->tgl_berlaku = $req->tgl_akhir_promo;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');

        if(($req->jenis_promo == 0) AND ($model->save()))
        {
            return redirect('Barang')->with('message_sucess','Promo Barang telah diupdate')->with('tab6','tab6');
        }elseif(($req->jenis_promo == 1) AND ($model->save())){
            return redirect('Jasa')->with('message_sucess','Promo Jasa telah diupdate')->with('tab6','tab6');
        }
    }


    public function rincian_promo($id){
        try{
            $model = prom::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);

            $barang = null;
            $jasa = null;
            if($model->jenis_promo==0){
                $barang = Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
                return view('user.produksi.section.promosi.barang.page_create', ['detail_promo'=> $model,'data'=> $model,'barang'=> $barang]);
            }else{
                $jasa = Jasa::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
                return view('user.produksi.section.promosi.jasa.page_create', ['detail_promo'=> $model,'data'=> $model,'jasa'=> $jasa]);
            }

        }   catch (Throwable $e){
            return false;
        }
    }

    public function rincian_promo_store(Request $req, $id){
        $this->validate($req,[
           '_token'=> 'required',
            'diskon'=> 'required',
            'minimum_beli'=> 'required',
        ]);
        $model = prom::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);

        $model_detail_promo =new DetailPromo();

        if($model->jenis_promo==0){
            $model_detail_promo->id_barang = $req->id_barang;
        }else{
            $model_detail_promo->id_jasa= $req->id_jasa;
        }
        $model_detail_promo->hpp = 0;
        $model_detail_promo->diskon = $req->diskon;
        $model_detail_promo->minimum_beli = $req->minimum_beli;
        $model_detail_promo->id_promo = $id;
        $model_detail_promo->id_perusahaan= Session::get('id_perusahaan_karyawan');
        $model_detail_promo->id_karyawan = Session::get('id_karyawan');

        if($model_detail_promo->save()){
            return redirect()->back()->with('message_success','promo telah ditambahkan');
        }else{
            return redirect()->back()->with('message_error','promo gagal ditambahkan');
        }
    }

    public function barang_promo_update(Request $req, $id){
        $this->validate($req,[
            '_token'=> 'required',
            'diskon'=> 'required',
            'minimum_beli'=> 'required',
        ]);
        $model_detail_promo =DetailPromo::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model = prom::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($model_detail_promo->id_promo);
        if($model->jenis_promo==0){
            $model_detail_promo->id_barang = $req->id_barang;
        }else{
            $model_detail_promo->id_jasa= $req->id_jasa;
        }
        $model_detail_promo->hpp = 0;
        $model_detail_promo->diskon = $req->diskon;
        $model_detail_promo->minimum_beli = $req->minimum_beli;
        $model_detail_promo->id_perusahaan= Session::get('id_perusahaan_karyawan');
        $model_detail_promo->id_karyawan= Session::get('id_karyawan');

        if($model_detail_promo->save()){
            return redirect()->back()->with('message_success','barang promo telah diubah');
        }else{
            return redirect()->back()->with('message_error','barang promo gagal ditambahkan');
        }
    }

    public function barang_promo_delete($id){

        $model_detail_promo =DetailPromo::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model_detail_promo->delete()){
            return redirect()->back()->with('message_success','barang promo telah dihapus');
        }else{
            return redirect()->back()->with('message_error','barang promo gagal didihapus');
        }
    }
}
