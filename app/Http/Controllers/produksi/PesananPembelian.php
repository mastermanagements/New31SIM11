<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\TawarBeli;
use Session;
use App\Model\Produksi\Supplier;
use App\Model\Produksi\PesananPembelian as PB;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\DetailPO;
class PesananPembelian extends Controller
{
    public function index(){
        $model = TawarBeli::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        return view('user.produksi.section.belibarang.pesanan_barang.page_create', ['penawaran_pembelian'=> $model,'supplier'=> $supplier]);
    }

    public function store(Request $req){
        $this->validate($req,[
            'no_po' => 'required',
            'tgl_po' => 'required',
            'id_supplier' => 'required',
        ]);
//        dd($req->all());
        $model = new PB();
        $model->id_tawar_beli = $req->id_tawar_beli;
        $model->no_po = $req->no_po;
        $model->tgl_po = $req->tgl_po;
        $model->id_supplier = $req->id_supplier;
        $model->tgl_krm = $req->tgl_dikirim;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect()->back()->with('message_success','anda telah membuat nota pesanan pembelian');
        }else{
            return redirect()->back()->with('message_error','gagal,membuat nota pesanan pembelian');
        }
    }


    public function show($id_pembelian){
        $model_pb = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_pembelian);
        $model = TawarBeli::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $barangs = barangs::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        return view('user.produksi.section.belibarang.pesanan_barang.page_edit', ['barang'=>$barangs,'data'=>$model_pb,'penawaran_pembelian'=> $model,'supplier'=> $supplier]);
    }

    public function tambah_Pesanan_pembelian(Request $req, $id){

        $this->validate($req,[
           'id_barang'=>'required',
           'id_po'=>'required',
           'hpp'=>'required',
           'hpp'=>'required',
           'jumlah_beli'=>'required',
        ]);


        $model_po = new DetailPO();
        $model_po->id_po = $id;
        $model_po->id_barang = $req->id_barang;
        $model_po->hpp = $req->hpp;
        $model_po->jumlah_beli = $req->jumlah_beli;

        $total_harga = $req->jumlah_beli*$req->hpp;
        if($req->diskon!=0){
            $total_setelah_diskon = $req->diskon/100;
        }else{
            $total_setelah_diskon= $req->diskon;
        }
        $model_po->diskon_item =$total_setelah_diskon;
        $jumlah_harga = $total_harga-($total_harga*$total_setelah_diskon);
        $model_po->jumlah_harga =$jumlah_harga;
        $model_po->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model_po->save()){
            return redirect()->back()->with('message_success','anda telah menambahkan item baru');
        }else{
            return redirect()->back()->with('message_success','gagal menambahkan item baru');
        }

    }

    public function ubah_Pesanan_pembelian(Request $req, $id){

        $this->validate($req,[
           'id_barang'=>'required',
           'hpp'=>'required',
           'hpp'=>'required',
           'jumlah_beli'=>'required',
        ]);


        $model_po = DetailPO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model_po->id_barang = $req->id_barang;
        $model_po->hpp = $req->hpp;
        $model_po->jumlah_beli = $req->jumlah_beli;
        $total_harga = $req->jumlah_beli*$req->hpp;
        if($req->diskon!=0){
            $total_setelah_diskon = $req->diskon/100;
        }else{
            $total_setelah_diskon= $req->diskon;
        }
        $model_po->diskon_item =$total_setelah_diskon;
        $jumlah_harga = $total_harga-($total_harga*$total_setelah_diskon);
        $model_po->jumlah_harga =$jumlah_harga;
        $model_po->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model_po->save()){
            return redirect()->back()->with('message_success','anda telah mengubah item baru');
        }else{
            return redirect()->back()->with('message_success','gagal mengubah item baru');
        }
    }

    public function ubah_Pesanan_pembelian_po(Request $req, $id){

        $this->validate($req,[
            'diskon_tambahan'=>'required',
            'pajak'=>'required',
            'uang_muka'=>'required',
            'kurang_bayar'=>'required',
        ]);
        $total_pajak = 0;
        $total_diskon= 0;
        $model = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model->diskon_tambahan = $req->diskon_tambahan;
        if($req->pajak!=0){
            $total_pajak = $req->pajak/100;
        }

        if($req->diskon_tambahan!=0){
            $total_diskon = $req->diskon_tambahan/100;
        }

        $model->pajak = $total_pajak;
        $model->dp_po = $req->uang_muka;
        $model->kurang_bayar = $req->kurang_bayar;
        $model->ket = $req->ket;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect('Pembelian')->with('message_success','anda telah membuat nota pesanan pembelian');
        }else{
            return redirect('Pembelian')->with('message_error','gagal,membuat nota pesanan pembelian');
        }
    }

    public function hapus_Pesanan_pembelian(Request $req, $id){
        $model_po = DetailPO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if($model_po->delete()){
            return redirect()->back()->with('message_success','anda telah mengubah item baru');
        }else{
            return redirect()->back()->with('message_success','gagal mengubah item baru');
        }
    }
}
