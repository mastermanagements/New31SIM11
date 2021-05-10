<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\GroupKlien as GK;
use Session;
class GroupKlien extends Controller
{
    //

    public function store(Request $req)
    {
        $this->validate($req,[
            'nama_group'=> 'required'
        ]);

        $model = new GK();
        $model->nama_group = $req->nama_group;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if($model->save()){
            return redirect('Klien')->with('meessage_success', 'Group klien telah ditambahkan')->with('tab3','tab3');
        }else{
            return redirect('Klien')->with('message_fail','Group gagal ditambahkan')->with('tab3','tab3');
        }

    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'nama_group'=> 'required'
        ]);

        $model = GK::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->nama_group = $req->nama_group;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if($model->save()){
            return redirect('Klien')->with('meessage_success', 'Group klien telah diubah')->with('tab3','tab3');
        }else{
            return redirect('Klien')->with('message_fail','Group gagal diubah')->with('tab3','tab3');
        }
    }

    public function destroy($id)
    {
        $model = GK::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->save()){
            return redirect('Klien')->with('meessage_success', 'Group klien telah dihapus')->with('tab3','tab3');
        }else{
            return redirect('Klien')->with('message_fail','Group gagal dihapus')->with('tab3','tab3');
        }
    }
}
