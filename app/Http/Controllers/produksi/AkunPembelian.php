<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Keuangan\KetTransaksi;
use Session;
use App\Model\Produksi\AkunPembelian as AkunP;
use App\Http\utils\JenisAkunPembelian;

class AkunPembelian extends Controller
{
    //

    private  $jenis_akun;

    public function __construct()
    {
        $this->jenis_akun = JenisAkunPembelian::$jenis_akun;
    }


    public function index()
    {
        return "akun pembelian";
    }

    public function create()
    {
        $data = [
            'jenis_jurnal'=> $this->jenis_akun,
            'keterangan_transaksi'=>KetTransaksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.belibarang.akun_pembelian.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'jenis_jurnal'=> 'required',
            'id_ket_transaksi'=> 'required',
        ]);
        $model =  AkunP::updateOrCreate(
            [
                'jenis_jurnal'=> $req->jenis_jurnal,
                'id_ket_transaksi'=> $req->id_ket_transaksi,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan')
            ],
            [
              'jenis_transaksi'=>'0',
              'id_karyawan'=> Session::get('id_karyawan')
            ]
        );
        if($model->save()){
            return redirect('Pembelian')->with('message_success','Akun Pembelian telah disimpan')->with('tab6','tab6');
        }else{
            return redirect('Pembelian')->with('message_error','Gagal menambahkan akun pembelian')->with('tab6','tab6');
        }
    }

    public function edit($id)
    {
        $data = [
            'data'=>AkunP::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'jenis_jurnal'=> $this->jenis_akun,
            'keterangan_transaksi'=>KetTransaksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.belibarang.akun_pembelian.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'jenis_jurnal'=> 'required',
            'id_ket_transaksi'=> 'required',
        ]);

        $model = AkunP::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->jenis_jurnal = $req->jenis_jurnal;
        $model->id_ket_transaksi = $req->id_ket_transaksi;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->jenis_transaksi = '0';
        if($model->save()){
            return redirect('Pembelian')->with('message_success','Anda telah berhasil mengubah data akun pembelian')->with('tab6','tab6');
        }else{
            return redirect('Pembelian')->with('message_error','Gagal, mengubah data akun pembelian')->with('tab6','tab6');
        }
    }

    public function delete($id){
        $model = AkunP::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('Pembelian')->with('message_success','Anda telah berhasil menghapus data akun pembelian')->with('tab6','tab6');
        }else{
            return redirect('Pembelian')->with('message_error','Gagal, menghapus data akun pembelian')->with('tab6','tab6');
        }
    }
}
