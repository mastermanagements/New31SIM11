<?php

namespace App\Http\Controllers\gudang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\KeluarGudang;
use App\Model\DetailKeluarGudang as model_detail_keluar_gudang;
use App\Http\utils\StokGudang;

class DetailKeluarGudang extends Controller
{
    //
    public function show($id_keluar_gudang)
    {
        $stok_gudang = new StokGudang();
        $data = [
            'masuk_gudang' => KeluarGudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_keluar_gudang),
            'stok_gudang' => $stok_gudang->query_gudang(),
            'id_keluar_gudang' => $id_keluar_gudang
        ];
        return view('user.produksi.section.gudang.keluarkan_gudang.detail_keluarkan_gudang', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            "id_keluar_gudang" => "required",
            "id_barang" => "required",
            "jumlah" => "required",
        ]);
        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');

        $model = new model_detail_keluar_gudang($data);
        $stok_gudang = new StokGudang();
        $array = [];
        if ($model->save()) {
            $id_gudang = $model->linkToKeluarGudang->gudang_asal;
            $array['id_gudang'] = $id_gudang;
            $array['id_barang'] = $model->id_barang;
            $array['jumlah'] = $model->jumlah;
            $stok_gudang->IOStok($array, 'keluar');
            return redirect()->back()->with('message_success', 'Barang telah ditambah didalam nota pengeluaran');
        } else {
            return redirect()->back()->with('message_error', 'Gagal, menyimpan data barang');
        }
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            "id_keluar_gudang" => "required",
            "id_barang" => "required",
            "jumlah" => "required",
        ]);
        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');

        $model = model_detail_keluar_gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if ($model->update($data)) {

            return redirect()->back()->with('message_success', 'Barang telah diubah didalam nota pengeluaran');
        } else {
            return redirect()->back()->with('message_error', 'Gagal, mengubah data barang pengeluaran');
        }
    }

    public function destroy($id)
    {
        $stok_gudang = new StokGudang();
        $array = [];
        $model = model_detail_keluar_gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if ($model->delete()) {
            $id_gudang = $model->linkToKeluarGudang->gudang_asal;
            $array['id_gudang'] = $id_gudang;
            $array['id_barang'] = $model->id_barang;
            $array['jumlah'] = $model->jumlah;
            $stok_gudang->IOStok($array, 'masuk');
            return redirect()->back()->with('message_success', 'Barang telah dihapis dari dalam nota pengeluaran');
        } else {
            return redirect()->back()->with('message_error', 'Gagal, menghapus data barang pengeluaran');
        }
    }
}
