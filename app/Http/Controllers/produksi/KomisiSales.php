<?php

namespace App\Http\Controllers\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hrd\H_Karyawan;
use Session;
use App\Model\Produksi\KomisiSales as komisi_sale;
class KomisiSales extends Controller
{
    //
    public function index(){
        $data =[
            'komisi'=> komisi_sale::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
        return view('user.produksi.section.jualbarang.komisi_sales.page_default', $data);
    }

    public function create(){
        $data = [
            'karyawan'=> H_Karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
        return view('user.produksi.section.jualbarang.komisi_sales.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_ky'=> 'required',
            'jenis_komisi'=> 'required',
            'besar_komisi' => 'required'
        ]);

       $model = new komisi_sale();
       $model->id_ky = $req->id_ky;
       $model->jenis_komisi = $req->jenis_komisi;
       $model->persen_komisi = $req->besar_komisi;
       $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
       if($model->save()){
           return redirect('komisi-sales')->with('message_success','Berhasil menyimpan data komisi sale baru');
       }else{
           return redirect('komisi-sales')->with('message_fail','Gagal, menyimpan komisi ');
       }
    }

    public function edit($id)
    {
        $data = [
            'karyawan'=> H_Karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi'=> komisi_sale::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
        ];
        return view('user.produksi.section.jualbarang.komisi_sales.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_ky'=> 'required',
            'jenis_komisi'=> 'required',
            'besar_komisi' => 'required'
        ]);

        $model = komisi_sale::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->id_ky = $req->id_ky;
        $model->jenis_komisi = $req->jenis_komisi;
        $model->persen_komisi = $req->besar_komisi;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if($model->save()){
            return redirect('komisi-sales')->with('message_success','Berhasil mengubah data komisi sale baru');
        }else{
            return redirect('komisi-sales')->with('message_fail','Gagal, mengubah komisi');
        }
    }

    public function destroy(Request $req, $id){
        $model = komisi_sale::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('komisi-sales')->with('message_success','Berhasil menghapus data komisi sale baru');
        }else{
            return redirect('komisi-sales')->with('message_fail','Gagal, menghapus komisi');
        }
    }
}
