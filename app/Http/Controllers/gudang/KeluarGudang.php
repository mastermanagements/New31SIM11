<?php

namespace App\Http\Controllers\gudang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\utils\StokGudang;
use Session;
use App\Model\Gudang;
use App\Model\Hrd\H_Karyawan as karyawan;
use App\Model\KeluarGudang as model_keluar_gudang;

class KeluarGudang extends Controller
{
    //

    public function show($id_gudang)
    {
        $data_gudang = new StokGudang();
        $gudang = [
            'id_gudang' => $id_gudang,
            'data_stok_gudang' => $data_gudang->query_gudang($id_gudang),
            'gudang_tujuan' => Gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_gudang', '1')->get(),
            'karyawan' => karyawan::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get()
        ];
        return view('user.produksi.section.gudang.keluarkan_gudang.page_default', $gudang);
    }

    public function daftar_nota($gudang_asal){
        $model = model_keluar_gudang::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->where('gudang_asal', $gudang_asal);
        return view('user.produksi.section.gudang.keluarkan_gudang.daftar_nota_keluarkan_barang', ['data'=> $model]);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            "gudang_asal" => "required",
            "tgl_transaksi" => "required",
            "nama_pengirim" => "required",
            "nama_penerima" => "required",
            "gudang_tujuan" => "required",
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $keluar_gudang = new model_keluar_gudang($data);
        if ($keluar_gudang->save()) {
            return redirect('stok-gudang')->with('message_success', 'Nota pengeluara barang telah dibuat');
        } else {
            return redirect('stok-gudang')->with('message_error', 'Nota pengeluara barang gagal dibuat');
        }
    }
}
