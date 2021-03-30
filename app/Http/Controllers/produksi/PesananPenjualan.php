<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as klien;
use App\Model\Produksi\TawarJual as TJ;
use App\Model\Produksi\PSO;
use App\Http\utils\JenisAkunPenjualan;
use Session;
class PesananPenjualan extends Controller
{
    //
    public function index(){
    }

    public function create(){
        $data = [
            'tawar_jual'=> TJ::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
//        dd("Pesanan penjualan");
        return view('user.produksi.section.jualbarang.pesanan_penjualan.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'no_so'=>'required',
           'tgl_so'=>'required',
           'id_po'=>'required',
           'id_klien'=>'required',
           'tgl_krm'=>'required',
        ]);
        $model = new PSO();
        $model->tgl_so = date('Y-m-d', strtotime($req->tgl_so));
        $model->no_so = $req->no_so;
        if($req->id_po!='null'){
            $model->id_po = $req->id_po;
        }
        $model->id_klien = $req->id_klien;
        $model->tgl_dikirim = date('Y-m-d', strtotime($req->tgl_krm));
        $model->ket = $req->ket;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Nota pesanan penjualan telah disimpan');
        }else{
            return redirect('Penjualan')->with('message_fail','Nota pesanan penjualan gagal disimpan');
        }
    }
    public function edit($id){
        $data = [
            'tawar_jual'=> TJ::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id),
        ];
//        dd("Pesanan penjualan");
        return view('user.produksi.section.jualbarang.pesanan_penjualan.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'no_so'=>'required',
            'tgl_so'=>'required',
            'id_po'=>'required',
            'id_klien'=>'required',
            'tgl_krm'=>'required',
        ]);
        $model = PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model->tgl_so = date('Y-m-d', strtotime($req->tgl_so));
        $model->no_so = $req->no_so;
        if($req->id_po!='null'){
            $model->id_po = $req->id_po;
        }
        $model->id_klien = $req->id_klien;
        $model->tgl_dikirim = date('Y-m-d', strtotime($req->tgl_krm));
        $model->ket = $req->ket;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Nota pesanan penjualan telah disimpan');
        }else{
            return redirect('Penjualan')->with('message_fail','Nota pesanan penjualan gagal disimpan');
        }
    }

    public function destroy(Request $req, $id){
        $model = PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if($model->delete()){
            return redirect('Penjualan')->with('message_success','Nota pesanan penjualan telah dihapus');
        }else{
            return redirect('Penjualan')->with('message_fail','Nota pesanan penjualan gagal dihapus');
        }
    }

    public function updateSO_BaseOnDetailSO(Request $req, $id_so){

        $this->validate($req,[
           'diskon_tambahan'=> 'required',
           'pajak'=> 'required',
           'uang_muka'=> 'required',
           'kurang_bayar'=> 'required',
           'jurnal_otomatis'=> 'required',
           'sub_total'=> 'required',
        ]);

        $total = $req->sub_total;
        $total_pajak = 0;
        #Check Akun Penjualan
        $check_akun_penjualan = JenisAkunPenjualan::CheckAkunPenjualan();
        #check akun pembelian kalau kosong == false
        if($check_akun_penjualan==false){
            return redirect()->back()->with('message_fail','Isilah terlebih dahulu akun penjualan');
        }

        # Set Rule
        $jenis_akun_penjualan = JenisAkunPenjualan::rule($req, 1);

        if($req->diskon_tambahan != 0){
            $diskon = $total * ($req->diskon_tambahan/100);
            $total = $total - $diskon;
        }

        if($req->pajak != 0 ){
            $pajak = ($req->pajak / 100);
            $total_pajak = $total + $pajak;
            # Set pajak true jika pajak tidak 0
            JenisAkunPenjualan::$status_pajak = true;
        }

        $model = PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_so);
        $model->diskon_tambahan = $req->diskon_tambahan;
        $model->pajak = $req->pajak;
        $model->dp_so = $req->uang_muka;
        $model->kurang_bayar = $req->kurang_bayar;
        $model->total = $total;

        if($model->save()){
            if(is_array($jenis_akun_penjualan) == true){
                $req->merge([
                    'total_sebelum_pajak'=>$total_pajak,
                    'total'=> $total,
                    'tgl_order'=> $model->tgl_so,
                    'no_order'=>$model->no_so,
                    'id_pesanan'=> $model->id
                ]);
                JenisAkunPenjualan::$new_request = $req;
                JenisAkunPenjualan::get_akun_penjualan($jenis_akun_penjualan);
            }
            return redirect('detail-pSo/'. $model->id)->with('message_success', 'Berhasil menyimpan data');
        }else{
            return redirect('detail-pSo/'. $model->id)->with('message_fail', 'Gagal menyimpan data');
        }
    }
}
