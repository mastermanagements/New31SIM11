<?php

namespace App\Http\Controllers\produksi;

use App\Http\utils\JenisAkunPenjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PSO;
use App\Model\Administrasi\Klien;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Produksi\DetailSO as DSO;
class DetailSo extends Controller
{
    //
    public $metode_pembayaran;
    public function __construct()
    {
        $this->metode_pembayaran = JenisAkunPenjualan::$metode_pembayaran;
    }

    public function show($id_so){
        $data = [
            'data'=> PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_so),
            'klien'=> Klien::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'metode_pembayaran' => $this->metode_pembayaran
        ];
        return view('user.produksi.section.jualbarang.detail_so.page_create', $data);
    }

    public function store(Request $req){

        $this->validate($req,[
           'id_so' => 'required',
           'id_barang' => 'required',
            'hpp' => 'required',
            'jumlah_jual' => 'required',
            'diskon_item' => 'required',
            'jumlah_harga' => 'required'
        ]);

        $harga_peritem = rupiahController($req->jumlah_jual) * rupiahController($req->hpp);
        if ($req->diskon_item != 0)
        {
            $nilai_diskon = $req->diskon_item / 100;
        } else {
            $nilai_diskon = 0;
        }
        $jumlah_harga = $harga_peritem - ($harga_peritem * $nilai_diskon);

        $model = new DSO();
        $model->id_so = $req->id_so;
        $model->id_barang = $req->id_barang;
        $model->hpp = rupiahController($req->hpp);
        $model->jumlah_jual = $req->jumlah_jual;
        $model->diskon_item = $req->diskon_item;
        $model->jumlah_harga = rupiahController($jumlah_harga);
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('detail-pSo/'. $model->id_so)->with('message_success', 'Anda telah menambahkan item barang baru');
        }else{
            return redirect('detail-pSo/'. $model->id_so)->with('message_success', 'Gagal, menambahkan item barang baru');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_so' => 'required',
            'id_barang' => 'required',
            'hpp' => 'required',
            'jumlah_jual' => 'required',
            
        ]);
        $total = 0;

        $total = $req->hpp * $req->jumlah_jual;

        if($req->diskon_item != 0 ){
            $diskon = $total * ($req->diskon_item/100);
            $total = $total-$diskon;
        }

        $model = DSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->id_so = $req->id_so;
        $model->id_barang = $req->id_barang;
        $model->hpp = $req->hpp;
        $model->jumlah_jual = $req->jumlah_jual;
        $model->diskon_item = $req->diskon_item;
        $model->jumlah_harga = $total;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('detail-pSo/'. $model->id_so)->with('message_success', 'Anda telah mengubah item barang baru');
        }else{
            return redirect('detail-pSo/'. $model->id_so)->with('message_success', 'Gagal, mengubah item barang baru');
        }
    }

    public function delete(Request $req, $id){
        $model = DSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('detail-pSo/'. $model->id_so)->with('message_success', 'Anda telah mengubah item barang baru');
        }else{
            return redirect('detail-pSo/'. $model->id_so)->with('message_success', 'Gagal, mengubah item barang baru');
        }
    }
}
