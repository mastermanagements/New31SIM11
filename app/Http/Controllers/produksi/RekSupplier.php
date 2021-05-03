<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\RekSupplier as rek_sup;
use App\Model\Produksi\Supplier as suppries;
use Session;

class RekSupplier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function store(Request $req)
    {
      $this->validate($req,[
          'nama_bank' => 'required',
          'no_rek' => 'required',
          'atas_nama' => 'required',
        //  'kcp' => 'required',
          'id_supplier' => 'required'
      ]);

      $nama_bank= $req->nama_bank;
      $no_rek= $req->no_rek;
      $atas_nama= $req->atas_nama;
      $id_supplier= $req->id_supplier;
      $kcp = $req->kcp;

      $model = new rek_sup;
      $model->nama_bank = $nama_bank;
      $model->no_rek = $no_rek;
      $model->atas_nama = $atas_nama;
      $model->kcp = $kcp;
      $model->id_supplier = $id_supplier;
      $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
      $model->id_karyawan = Session::get('id_karyawan');

      if($model->save())
      {
              return redirect('Supplier')->with('message_success','Berhasil tambah rekening supplier');
          }else{
              return redirect('Supplier')->with('message_error','Gagal tambah rekening supplier');
          }
    }

    public function edit($id)
    {
      $data = ['rek_supplier'=> rek_sup::findorFail($id),
              'supplier'=> suppries::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get()
              ];
          //  dd($data['supplier']);
      return view('user.produksi.section.supplier.rek_supplier.page_edit', $data);
    }


    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'id_supplier'=>'required',
        'nama_bank' => 'required',
        'no_rek' => 'required',
        'atas_nama' => 'required',
      //  'kcp' => 'required'
      ]);

      $id_supplier = $req->id_supplier;
      $nama_bank= $req->nama_bank;
      $no_rek= $req->no_rek;
      $atas_nama= $req->atas_nama;
      $kcp= $req->kcp;

      $model = rek_sup::findOrFail($id);

      $model->id_supplier = $id_supplier;
      $model->no_rek = $no_rek;
      $model->nama_bank = $nama_bank;
      $model->atas_nama = $atas_nama;
      $model->kcp = $kcp;
      $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
      $model->id_karyawan = Session::get('id_karyawan');

      if($model->save())
      {
              return redirect('Supplier')->with('message_success','Berhasil update rekening supplier');
          }else{
              return redirect('Supplier')->with('message_error','Gagal update rekening supplier');
          }
    }

    public function destroy($id)
    {
        $model = rek_sup::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id); //bisa jg pake findorFail($id);
        if($model->delete()){
            return redirect('Supplier')->with('message_success','Berhasil menghapus data rekening supplier');
        }else{
            return redirect('Supplier')->with('message_fail','Gagal, menghapus rekening supplier');
        }
    }
}
