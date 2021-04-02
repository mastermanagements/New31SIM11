<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as klien;
use App\Model\Produksi\KomisiSales as komisi_sales;
use App\Model\Produksi\PSO;
use App\Model\Produksi\PSales as PS;
use App\Model\Produksi\Barang;
use Session;
use App\Http\utils\JenisAkunPenjualan;

class PSales extends Controller
{
    //
    private $metode_bayar = [
        'Tunai',
        'Kredit',
        'Transfer Bank',
    ];
    public function create(){
        $pass = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_create', $pass);
    }

    public function show($id_p_sales){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $pass = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> $model,
            'metode_pembayaran'=>$this->metode_bayar,
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_show', $pass);
    }

    public function complain($id_p_sales){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $pass = [
            'data'=> $model,
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),

        ];
        return view('user.produksi.section.jualbarang.penjualan.page_complain', $pass);
    }

    public function store(Request $req){
        $this->validate($req,[
            'no_sales'=> 'required',
            'tgl_sales'=> 'required',
            'id_klien' => 'required',
            'tgl_kirim' => 'required',
            'id_komisi_sales'=> 'required'
        ]);

        $model = new PS();
        $model->tgl_sales = date('Y/m/d', strtotime($req->tgl_sales));
        $model->no_sales = $req->no_sales;
        $model->id_klien = $req->id_klien;
        $model->tgl_kirim = date('Y/m/d', strtotime($req->tgl_kirim));
        $model->id_komisi_sales = $req->id_komisi_sales;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if($model->save()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah disimpan');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal disimpan');
        }
    }

    public function edit($id_p_sales){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $pass = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> $model,
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_edit', $pass);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'no_sales'=> 'required',
            'tgl_sales'=> 'required',
            'id_klien' => 'required',
            'tgl_kirim' => 'required',
            'id_komisi_sales'=> 'required'
        ]);

        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->tgl_sales = date('Y/m/d', strtotime($req->tgl_sales));
        $model->no_sales = $req->no_sales;
        $model->id_klien = $req->id_klien;
        $model->tgl_kirim = date('Y/m/d', strtotime($req->tgl_kirim));
        $model->id_komisi_sales = $req->id_komisi_sales;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if($model->save()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah diubah');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal diubah');
        }
    }

    public function destroy(Request $req, $id){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah dihapus');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal dihapus');
        }
    }

    public function updateDetail(Request $req, $id_p_sales){
        $this->validate($req,[
            'diskon_tambahan'=> 'required',
            'pajak'=> 'required',
            'biaya_tambahan' => 'required',
            'jatuh_tempo' => 'required',
            'total'=> 'required',
            'hutang'=> 'required',
        ]);


        $check_data_penjualan = JenisAkunPenjualan::CheckAkunPenjualan();
        #check akun pembelian kalau kosong == false
        if($check_data_penjualan==false){
            return redirect()->back()->with('message_fail','Isilah terlebih dahulu akun penjualan');
        }


        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $model->diskon_tambahan = $req->diskon_tambahan;
        $model->pajak = $req->pajak;
        $model->bayar = $req->total;
        $model->kurang_bayar = $req->hutang;
        $model->biaya_tambahan = $req->biaya_tambahan;
        $model->tgl_jatuh_tempo = $req->jatuh_tempo;
        $model->keterangan = $req->ket;

        #Ambil Jenis Jurnal
        $jenis_jurnal = 0;
        $n_req=$req->merge( ['ongkir'=> $model->ongkir]);
        $jenis_akun_penjualan = JenisAkunPenjualan::rule($n_req, 2);
        if ($model->pajak !=0){
            JenisAkunPenjualan::$status_pajak = true;
        }

        if ($model->ongkir){
            JenisAkunPenjualan::$status_ongkir = true;
        }
        if($model->save()){

            if(is_array($jenis_akun_penjualan) == true){
                $req->merge([
                    'ongkir'=> $req->onkir,
                    'total_sebelum_pajak'=>$model->pajak,
                    'total'=> $model->total,
                    'tgl_order'=> $model->tgl_sales,
                    'no_order'=>$model->no_sales,
                    'id_penjualan'=> $model->id
                ]);
                JenisAkunPenjualan::$new_request = $req;
                JenisAkunPenjualan::get_akun_penjualan($jenis_akun_penjualan);
            }

            return redirect('Penjualan')->with('message_success','Data penjualan telah diubah');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal diubah');
        }
    }

}
