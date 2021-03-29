<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Keuangan\KetTransaksi;
use App\Model\Produksi\AkunPenjualan as AP;

class AkunPenjualan extends Controller
{
    //
    private $jenis_jurnal = [
        'Pesanan Penjualan tunai',
        'Pesanan Penjualan transfer',
        'Pesanan Penjualan tunai dengan pajak',
        'Pesanan Penjualan transfer dg pajak',
        'Penjualan tunai tanpa pajak',
        'Penjualan tunai dengan pajak',
        'Penjualan kredit tanpa pajak',
        'Penjualan kredit dengan pajak',
        'Potongan penjualan tunai',
        'Beban angkut penjualan',
        'Return penjualan mengambalikan kas',
        'Return penjualan kurangi piutang',
        'Return penjualan kurangi piutang',
        'Return penjualan mengembalikan barang',
    ];

    public function create(){
        $data = [
            'jenis_jurnal'=>$this->jenis_jurnal,
            'akun_transaksi'=> KetTransaksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.AkunPenjualan.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'jenis_jurnal'=> 'required',
           'id_ket_transaksi'=> 'required',
        ]);

        $model_ket_transaksi = KetTransaksi::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($req->id_ket_transaksi);

        $jenis_transaksi=$model_ket_transaksi->jenis_transaksi;
        $id_akun_aktif=$model_ket_transaksi->hasOneAkun->id_akun_aktif;

        $model =new AP(
            [
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                'id_ket_transaksi'=> $req->id_ket_transaksi,
                'jenis_transaksi'=> $jenis_transaksi,
                'id_akun_aktif'=> $id_akun_aktif,
                'jenis_jurnal'=> $req->jenis_jurnal,
            ]
        );

        if(!empty($model->save())){
            return redirect('Penjualan')->with('message_success','Akun penjualan telah disimpan');
        }else{
            return redirect('Penjualan')->with('message_fail','Akun penjualan gagal disimpan');
        }
    }

    public function edit($id){
        $data = [
            'akun_penjualan'=> AP::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'jenis_jurnal'=>$this->jenis_jurnal,
            'akun_transaksi'=> KetTransaksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.AkunPenjualan.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'jenis_jurnal'=> 'required',
            'id_ket_transaksi'=> 'required',
        ]);

        $model_ket_transaksi = KetTransaksi::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($req->id_ket_transaksi);

        $jenis_transaksi=$model_ket_transaksi->jenis_transaksi;
        $id_akun_aktif=$model_ket_transaksi->hasOneAkun->id_akun_aktif;

        $model =AP::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->id_perusahaan=Session::get('id_perusahaan_karyawan');
        $model->id_ket_transaksi= $req->id_ket_transaksi;
        $model->jenis_transaksi= $jenis_transaksi;
        $model->id_akun_aktif= $id_akun_aktif;
        $model->jenis_jurnal=  $req->jenis_jurnal;


        if(!empty($model->save())){
            return redirect('Penjualan')->with('message_success','Akun penjualan telah diubah');
        }else{
            return redirect('Penjualan')->with('message_fail','Akun penjualan gagal disimpan');
        }
    }

    public function destroy($id){
        $model =AP::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if(!empty($model->delete())){
            return redirect('Penjualan')->with('message_success','Akun penjualan telah dihapus');
        }else{
            return redirect('Penjualan')->with('message_fail','Akun penjualan gagal dihapus');
        }
    }
}
