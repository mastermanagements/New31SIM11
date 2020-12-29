<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\AturKonversi as p_konversi_barang;
use App\Model\Produksi\HistroyKonversiBrg as p_history_konversi_brg;

class AturKonversi extends Controller
{
    //
    public function index($id){
        try{
            $model = barangs::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
            return view('user.produksi.section.barang.konversi_barang.page_conten',['data'=> $model]);
        }catch (Throwable $e){
            return $e;
        }
    }

    public function create(){
        try{
            $model = barangs::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan'));
            return view('user.produksi.section.barang.konversi_barang.page_create',['data'=> $model]);
        }catch (Throwable $e){
            return $e;
        }
    }

    public function store(Request $req){

        try{
            $this->validate($req,[
                'id_barang_asal'=> 'required',
                'id_barang_tujuan'=> 'required',
                'jumlah_konversi_satuan'=> 'required',
            ]);
            $model = new p_konversi_barang();
            $model->id_barang_asal = $req->id_barang_asal;
            $model->id_barang_tujuan = $req->id_barang_tujuan;
            $model->jumlah_konversi_satuan = $req->jumlah_konversi_satuan;
            $model->id_perusahaan =Session::get('id_perusahaan_karyawan');

            if($model->save()){
                return redirect('Barang')->with('message_success','Barang konversi telah ditambahkan')->with('tab3','tab3');
            }else{
                return redirect('Barang')->with('message_fail','Barang konversi gagal ditambahkan')->with('tab3','tab3');
            }
        }catch (Throwable $e){
            return false;
        }
    }

    public function show($id){
        try{
            $model = p_konversi_barang::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
            return view('user.produksi.section.barang.konversi_barang.page_konversi',['data'=> $model]);
        }catch (Throwable $e){
            return $e;
        }
    }
    public function edit($id){
        try{
            $barang = barangs::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan'));
            $model = p_konversi_barang::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
            return view('user.produksi.section.barang.konversi_barang.page_edit',['konversi'=> $model,'data'=> $barang]);
        }catch (Throwable $e){
            return $e;
        }
    }

    public function update(Request $req, $id){
        try{
            $this->validate($req,[
                'id_barang_asal'=> 'required',
                'id_barang_tujuan'=> 'required',
                'jumlah_konversi_satuan'=> 'required',
            ]);
            $model = p_konversi_barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
            $model->id_barang_asal = $req->id_barang_asal;
            $model->id_barang_tujuan = $req->id_barang_tujuan;
            $model->jumlah_konversi_satuan = $req->jumlah_konversi_satuan;
            $model->id_perusahaan =Session::get('id_perusahaan_karyawan');

            if($model->save()){
                return redirect('Barang')->with('message_success','Barang konversi telah ditambahkan')->with('tab3','tab3');
            }else{
                return redirect('Barang')->with('message_fail','Barang konversi gagal ditambahkan')->with('tab3','tab3');
            }
        }catch (Throwable $e){
            return false;
        }
    }

    public function delete(Request $req, $id){
        try{
            $model = p_konversi_barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
            if($model->delete()){
                return redirect('Barang')->with('message_success','Barang telah telah dihapus')->with('tab3','tab3');
            }else{
                return redirect('Barang')->with('message_fail','Barang telah gagal')->with('tab3','tab3');
            }
        }catch (Throwable $e){
            return false;
        }
    }

    public function konversi(Request $req){
       $this->validate($req,[
            'jumlah_konversi_satuan',
            'tgl_konversi',
            'id_konversi'
        ]);

        try{
            $model_konversi = p_konversi_barang::findOrFail($req->id_konversi);
            $model = new p_history_konversi_brg();
            $model->id_konversi_brg = $model_konversi->id;
            $model->tgl_konversi = $req->tgl_konversi;
            $model->jum_brg_dikonversi = $model_konversi->jumlah_konversi_satuan*$req->jum_brg_dikonversi;
            $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

            if($model->save()){
                return redirect('Barang')->with('message_success','Barang telah dikonversi')->with('tab4','tab4');
            }else{
                return redirect('Barang')->with('message_success','Barang telah dikonversi')->with('tab4','tab4');
            }

        }catch (Throwable $e){
            return false;
        }
    }
}
