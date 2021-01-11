<?php

namespace App\Http\Controllers\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Produksi\StokOpname as SO;

class StokOpname extends Controller
{
    //
    public function index(){
        $data = [
            'menu'=>'stok_opname',
            'data_barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.inventory.page_default', $data);
    }

    public function cetak(){
        $data = [
            'menu'=>'stok_opname',
            'data_barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.inventory.stok_opname.print_stok_opname', $data);
    }


    public function perbaikanstok($id_barang){
        try{
            $date = date('Y-m-d');
            $data = [
                'menu'=>'perbaikan_stok',
                'date_now'=> $date,
                'data_barang'=> $barang = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_barang),
            ];
            return view('user.produksi.section.inventory.page_default', $data);
        }catch (Throwable $date){
            return false;
        }
    }

    public function tambah_perbaikan_stok(Request $req){
        try{
            $this->validate($req,[
                'id_barang'=> 'required',
                'tgl_so'=> 'required',
                'stok_akhir'=> 'required',
                'bukti_fisik'=> 'required',
                'nm_petugas'=> 'required',
            ]);

            $model = new SO();
            $model->id_barang = $req->id_barang;
            $model->tgl_so = $req->tgl_so;
            $model->stok_akhir = $req->stok_akhir;
            $model->bukti_fisik = $req->bukti_fisik;
            $selisih =$req->stok_akhir - $req->bukti_fisik;
            $model->selisih = $selisih;
            $model->petugas = $req->nm_petugas;
            $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

            if($model->save()){
                $model_barang = Barang::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($model->id_barang);
                $model_barang->stok_akhir = $model->bukti_fisik;
                $model_barang->save();
                return redirect('history-barang')->with('message_success','Anda telah berhasil memperbaiki stok opname');
            }else{
                return redirect('history-barang')->with('message_error','gagal, memperbaiki stok opname');
            }

        }catch (Throwable $e){
            return false;
        }
    }

    # Todo History Update
    public function HistoryStokOpname(){
        $data = [
            'menu'=>'history-barang',
            'barang'=>SO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.inventory.stok_opname.page_history', $data);
    }

    public function UbahHistoryStokUpname($id){
        $data = [
            'menu'=>'ubah-history-barang',
            'data_barang'=>SO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.produksi.section.inventory.page_default', $data);
    }

    public function update_perbaikan_stok(Request $req, $id){
        try{
            $this->validate($req,[
                'id_barang'=> 'required',
                'tgl_so'=> 'required',
                'stok_akhir'=> 'required',
                'bukti_fisik'=> 'required',
                'nm_petugas'=> 'required',
            ]);

            $model = SO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
            $model->id_barang = $req->id_barang;
            $model->tgl_so = $req->tgl_so;
            $model->stok_akhir = $req->stok_akhir;
            $model->bukti_fisik = $req->bukti_fisik;
            $selisih =$req->stok_akhir - $req->bukti_fisik;
            $model->selisih = $selisih;
            $model->petugas = $req->nm_petugas;
            $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

            if($model->save()){
                $model_barang = Barang::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($model->id_barang);
                $model_barang->stok_akhir = $model->bukti_fisik;
                $model_barang->save();
                return redirect('history-barang')->with('message_success','Anda telah berhasil memperbaiki stok opname');
            }else{
                return redirect('history-barang')->with('message_error','gagal, memperbaiki stok opname');
            }

        }catch (Throwable $e){
            return false;
        }
    }
}
