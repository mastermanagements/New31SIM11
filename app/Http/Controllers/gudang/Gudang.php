<?php

namespace App\Http\Controllers\gudang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Gudang as model_gudang;
use Session;

class Gudang extends Controller
{
    //
    public function index()
    {
        $data = [
            'gudang' => model_gudang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.gudang.page_default', $data);
    }

    public function create()
    {
        return view('user.produksi.section.gudang.page_create');
    }

    private function check_gudang()
    {
        $gudang = model_gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_gudang', '1')->count('id');
        if ($gudang >= 1) {
            return true;
        }
     }

    public function store(Request $req)
    {
        $this->validate($req, [
            'gudang' => 'required',
            'jenis_gudang' => 'required',
        ]);
        if($req->jenis_gudang=='1'){
            if($this->check_gudang()==true)
            {
                return redirect('gudang')->with('message_success', 'Gudang show room yang bisa disimpan 1 data saja');
            }
        }
        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $gudang = new model_gudang($data);
        if ($gudang->save()) {
            return redirect('gudang')->with('message_success', 'Gudang telah ditambahkan');
        } else {
            return redirect('gudang')->with('message_error', 'Data gudang gagal disimpan');
        }
    }

    public function edit($id)
    {
        $data = [
            'data' => model_gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id)
        ];
        return view('user.produksi.section.gudang.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'gudang' => 'required',
            'jenis_gudang' => 'required',
        ]);
        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $gudang = model_gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if ($gudang->update($data)) {
            return redirect('gudang')->with('message_success', 'Gudang telah diubah');
        } else {
            return redirect('gudang')->with('message_error', 'Data gudang gagal diubah');
        }
    }

    public function destroy(Request $req, $id)
    {
        $gudang = model_gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if ($gudang->delete()) {
            return redirect('gudang')->with('message_success', 'Gudang telah dihapus');
        } else {
            return redirect('gudang')->with('message_error', 'Data gudang gagal dihapus');
        }
    }
}
