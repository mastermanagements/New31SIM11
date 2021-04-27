<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\GroupKlien;
use App\Model\Produksi\PDiskon as PD;
use Session;
class PDiskon extends Controller
{
    //
    public function create(){
        $data = [
            'group_klien' =>GroupKlien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.pdiskon.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'jenis_diskon'=> 'required',
           'jumlah_maks_beli' => 'required',
           //'diskon_persen' => 'required',
          // 'diskon_nominal'=>'required',
           'id_group'=>'required',
        ]);

        $model = new PD();
        $model->id_group = $req->id_group;
        $model->jenis_diskon = $req->jenis_diskon;
        $model->jumlah_maks_beli = rupiahController($req->jumlah_maks_beli);
        $model->diskon_persen = $req->diskon_persen;
        $model->diskon_nominal = rupiahController($req->diskon_nominal);
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');

        if($model->save()){
            return redirect('Penjualan')->with('message_success', 'Diskon telah ditambahkan')->with('tab3','tab3');
        }else{
            return redirect('Penjualan')->with('message_fail', 'Diskon gagal ditambahkan')->with('tab3','tab3');
        }
    }

    public function edit($id){
        $data = [
            'group_klien' =>GroupKlien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pdiskon' =>PD::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
        ];
        return view('user.produksi.section.jualbarang.pdiskon.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'jenis_diskon'=> 'required',
            'jumlah_maks_beli' => 'required',
            'id_group'=>'required',
        ]);

        $model = PD::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->id_group = $req->id_group;
        $model->jenis_diskon = $req->jenis_diskon;
        $model->jumlah_maks_beli = rupiahController($req->jumlah_maks_beli);
        $model->diskon_persen = $req->diskon_persen;
        $model->diskon_nominal = rupiahController($req->diskon_nominal);
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');

        if($model->save()){
            return redirect('Penjualan')->with('message_success', 'Diskon telah diubah')->with('tab3','tab3');
        }else{
            return redirect('Penjualan')->with('message_fail', 'Diskon gagal diubah')->with('tab3','tab3');
        }
    }

    public function destroy(Request $req, $id){
        $model = PD::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
   dd($model);
        if($model->delete()){
            return redirect('Penjualan')->with('message_success', 'Diskon telah diubah')->with('tab3','tab3');
        }else{
            return redirect('Penjualan')->with('message_fail', 'Diskon gagal diubah')->with('tab3','tab3');
        }
    }
}
