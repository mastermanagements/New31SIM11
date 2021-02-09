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
    //

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
        if($model->save()){
            return redirect('Barang')->with('message_sucess','Even telah dibuat')->with('tab6','tab6');
        }else{
            return redirect('Barang')->with('message_error','Even gagal dibuat')->with('tab6','tab6');
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
        if($model->delete()){
            return redirect('Barang')->with('message_sucess','Even telah dihapus')->with('tab6','tab6');
        }else{
            return redirect('Barang')->with('message_error','Even gagal dihapus')->with('tab6','tab6');
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
        if($model->save()){
            return redirect('Barang')->with('message_sucess','Even telah dibuat')->with('tab6','tab6');
        }else{
            return redirect('Barang')->with('message_error','Even gagal dibuat')->with('tab6','tab6');
        }
    }


    public function barang_promo($id){
        try{
            $model = prom::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);

            $barang = null;
            $jasa = null;
            if($model->jenis_promo==0){
                $barang = Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
            }else{
                $jasa = Jasa::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
            }
            return view('user.produksi.section.barang.promosi.page_create', ['detail_promo'=> $model,'data'=> $model,'barang'=> $barang,'jasa'=> $jasa]);
        }   catch (Throwable $e){
            return false;
        }
    }

    public function barang_promo_store(Request $req, $id){
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
        if($model_detail_promo->save()){
            return redirect()->back()->with('message_success','barang promo telah ditambahkan');
        }else{
            return redirect()->back()->with('message_error','barang promo gagal ditambahkan');
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
