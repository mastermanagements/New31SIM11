<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Keuangan\KetTransaksi;
use Session;
use App\Model\Manufaktur\AkunManufaktur as AkunManufakturModel;
class AkunManufaktur extends Controller
{
    //
    private $jenis_transaksi = [
        'Pemakaian bahan baku',
        'Penambahan persediaan brg jadi',
        'Penambahan persediaan brg dlm proses'
    ];

    public function create(){
        $data = [
            'jenis_jurnal'=> $this->jenis_transaksi,
            'keterangan_transaksi'=> KetTransaksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.manufaktur.pages.akun_manufaktur.page_create', $data);
    }

    public function store(Request $req)
    {
         $this->validate($req,[
            'jenis_jurnal'=> 'required',
            'id_ket_transaksi'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = new AkunManufakturModel($data);
        if($model->save()){
            return redirect('manufaktur')->with('message_success','Akun manufaktur telah disimpan');
        }else{
            return redirect('manufaktur')->with('message_fail','Akun manufaktur gagal disimpan');
        }
    }

    public function edit($id){
        $data = [
            'jenis_jurnal'=> $this->jenis_transaksi,
            'keterangan_transaksi'=> KetTransaksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> AkunManufakturModel::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.manufaktur.pages.akun_manufaktur.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
         $this->validate($req,[
            'jenis_jurnal'=> 'required',
            'id_ket_transaksi'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = AkunManufakturModel::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Akun manufaktur telah diubah');
        }else{
            return redirect('manufaktur')->with('message_fail','Akun manufaktur gagal diubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = AkunManufakturModel::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if($model->delete()){
            return redirect('manufaktur')->with('message_success','Akun manufaktur telah dihapus');
        }else{
            return redirect('manufaktur')->with('message_fail','Akun manufaktur gagal dihapus');
        }
    }
}
