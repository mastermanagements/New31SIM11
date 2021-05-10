<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\RekKlien as rek_klien;
use App\Model\Administrasi\Klien as kliens;
use Session;

class RekKlien extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $req)
     {
       //dd($req->all());
     $this->validate($req,[
         'nama_bank' => 'required',
         'no_rek' => 'required',
         'atas_nama' => 'required',
         //'kcp' => 'required',
         'id_klien' => 'required'
     ]);

     $nama_bank= $req->nama_bank;
     $no_rek= $req->no_rek;
     $atas_nama= $req->atas_nama;
     $id_klien= $req->id_klien;
     $kcp = $req->kcp;

     $model = new rek_klien;
     $model->nama_bank = $nama_bank;
     $model->no_rek = $no_rek;
     $model->atas_nama = $atas_nama;
     $model->kcp = $kcp;
     $model->id_klien = $id_klien;
     $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
     $model->id_karyawan = Session::get('id_karyawan');

     if($model->save())
     {
             return redirect('Klien')->with('message_success','Berhasil tambah rekening Klien')->with('tab4','tab4');
         }else{
             return redirect('Klien')->with('message_error','Gagal tambah rekening Klien')->with('tab4','tab4');
         }
   }

   public function edit($id)
   {
     $data = ['rek_klien'=> rek_klien::findorFail($id),
             'klien'=> kliens::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get()
             ];
         //  dd($data['supplier']);
     return view('user.administrasi.section.klien.modal.page_edit', $data);
   }


   public function update(Request $req, $id)
   {
     $this->validate($req,[
       'id_klien'=>'required',
       'nama_bank' => 'required',
       'no_rek' => 'required',
       'atas_nama' => 'required',
       //'kcp' => 'required'
     ]);

     $id_klien = $req->id_klien;
     $nama_bank= $req->nama_bank;
     $no_rek= $req->no_rek;
     $atas_nama= $req->atas_nama;
     $kcp= $req->kcp;

     $model = rek_klien::findOrFail($id);

     $model->id_klien = $id_klien;
     $model->no_rek = $no_rek;
     $model->nama_bank = $nama_bank;
     $model->atas_nama = $atas_nama;
     $model->kcp = $kcp;
     $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
     $model->id_karyawan = Session::get('id_karyawan');

     if($model->save())
     {
             return redirect('Klien')->with('message_success','Berhasil update rekening Klien')->with('tab4','tab4');
         }else{
             return redirect('Klien')->with('message_error','Gagal update rekening Klien')->with('tab4','tab4');
         }
   }

   public function destroy($id)
   {
       $model = rek_klien::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id); //bisa jg pake findorFail($id);
       if($model->delete()){
           return redirect('Klien')->with('message_success','Berhasil menghapus data rekening Klien')->with('tab4','tab4');
       }else{
           return redirect('Klien')->with('message_fail','Gagal, menghapus rekening Klien')->with('tab4','tab4');
       }
   }
}
