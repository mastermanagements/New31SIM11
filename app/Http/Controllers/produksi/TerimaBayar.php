<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PSO;
use App\Model\Produksi\PSales;
use App\Model\Produksi\PTerimaBayar;
use Session;


class TerimaBayar extends Controller
{
    //
    private $metode_bayar = [
        'Transfer Bank',
        'Cek',
        'Langsung/Tunai',
        'Return barang jual',
    ];

    private $jenis_pembayaran = [
        'Bayar SO',
        'Bayar Sales',
        'return Barang'
    ];

    public function form_terima_bayar($jenis_bayar,$id){
        if($jenis_bayar == 0){
            $data = PSO::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        }elseif($jenis_bayar == 1){
            $data = PSales::where('id_perusahaa', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        }
        $data = [
            'data' => $data,
            'metode_bayar'=> $this->metode_bayar,
            'jenis_bayar'=> $this->jenis_pembayaran,
            'jenis_bayars'=> $jenis_bayar,
        ];
//        dd($data);
        return view('user.produksi.section.jualbarang.TerimaBayar.page_create',$data);
    }

    public function store(Request $req){
        $this->validate($req, [
            'id'=>'required',
            'no_transaksi'=>'required',
            'klien'=>'required',
            'tgl_bayar'=>'required',
            'metode_bayar'=>'required',
            'bank_asal'=>'required',
            'rek_asal'=>'required',
            'nama_asal'=>'required',
            'bank_tujuan'=>'required',
            'no_rek_tujuan'=>'required',
            'jumlah_bayar'=>'required',
            'terima_bukti'=>'required',
        ]);
        $set_id_so = 0;
        $set_id_sales = 0;
        $set_id_return = 0;
        if($req->jenis_bayar == 0){
            $set_id_so = $req->id;
        }else if($req->jenis_bayar == 1){
            $set_id_sales = $req->id;
        }else if($req->jenis_bayar == 2){
            $set_id_return =$req->id;
        }
        $model =PTerimaBayar::updateOrCreate(
            [
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                'id_so'=> $set_id_so,
                'id_sales'=> $set_id_sales,
                'id_return_barang'=> $set_id_return,
            ],
            [
                'jenis_bayar'=>$req->jenis_bayar,
                'tgl_bayar'=>date('Y-m-d', strtotime($req->tgl_bayar)),
                'metode_bayar'=> $req->metode_bayar,
                'bank_asal'=>$req->bank_asal,
                'rek_asal'=>$req->rek_asal,
                'nama_asal'=>$req->nama_asal,
                'bank_tujuan'=>$req->bank_tujuan,
                'no_rek_tujuan'=>$req->no_rek_tujuan,
                'jumlah_bayar'=>$req->jumlah_bayar,
                'terima_bukti'=>$req->terima_bukti,
            ]
        );
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Data telah disimpan');
        }else{
            return redirect('Penjualan')->with('message_fail','Data gagal disimpan');
        }
    }
}
