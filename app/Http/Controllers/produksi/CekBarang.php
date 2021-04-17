<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\POrder as p_order;
use App\Model\Produksi\Supplier;
use App\Model\Produksi\PesananPembelian;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Produksi\Cek_Barang;
use App\Model\Produksi\Detail_Cek_Barang;
class CekBarang extends Controller
{
    //
    private $metode_bayar = [
        'Tunai',
        'Kredit'
    ];

    private $kondisi = [
        'sesuai',
        'tidak sesuai'
    ];

    private $respon = [
        'Terima',
        'Di Tolak'
    ];

    public function show($id){
        $data =[
            'supplier'=> Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian'=>PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'data_order'=> p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'barang'=>Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'metode_pembayaran'=> $this->metode_bayar,
            'kondisi'=>$this->kondisi

        ];
      //  dd($data['detail_cek_brg']);
        return view('user.produksi.section.belibarang.cek_barang.page_rincian_barang', $data);
    }

    public function showCek($id){
        $data =[
            'supplier'=> Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian'=>PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'data_order'=> p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'barang'=>Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'metode_pembayaran'=> $this->metode_bayar,
            'kondisi'=>$this->kondisi,
            'respon'=>$this->respon
        ];
        //dd($data['detail_cek_brg']);
        return view('user.produksi.section.belibarang.status_return.page_rincian_barang', $data);
    }

    public function update(Request $req, $id)
    { //dd($req->all());
        # code...

        $this->validate($req, [
            'id_barang'=>'required',
            'harga_beli'=> 'required',
            'diskon_item'=> 'required',
            'jumlah_beli'=>'required',
            'jumlah_harga'=> 'required',
            'cek_jumlah'=> 'required',
            'cek_kondisi' => 'required',
        ]);

        $current_date = date('Y-m-d');

        $model = Cek_Barang::updateOrCreate(
            [
                'id_order'=> $id,
                'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
            ],
            [
                'tgl_konfirm_cek'=> $current_date,
                'id_karyawan'=> Session::get('id_karyawan')
            ]
        );
        // dd($req->all());
        if($model){
        foreach ($req->id_barang as $key => $value) {
                # code...
                $model_detail_barang = Detail_Cek_Barang::updateOrCreate(
                    [
                        'id_order'=> $id,
                        'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
                        'id_barang'=> $value,
                        'id_cek_barang'=> $model->id
                    ],
                    [
                        'harga_beli'=>  rupiahController($req->harga_beli[$key]),
                        'diskon_item'=> $req->diskon_item[$key],
                        'jumlah_beli'=> rupiahController($req->jumlah_beli[$key]),
                        'jumlah_harga'=> rupiahController($req->jumlah_harga[$key]),
                        'cek_jumlah'=> $req->cek_jumlah[$key],
                        'cek_kualitas'=> $req->cek_kondisi[$key],
                        'status_return'=> $req->respon[$key],
                        'alasan_ditolak'=> $req->alasan[$key],
                        'ket'=> $req->ket[$key],
                        'id_karyawan'=> Session::get('id_karyawan')
                    ]

                );
              //  dd($req->all());
            }
        }
        //
          if($model_detail_barang){
                $model_o = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
                $model_o->status_cekbarang = '1';
                $model_o->save();
          }


        return redirect('Pembelian')->with('message_success','Update Status Retrun Barang berhasil')->with('tab3','tab3');
    }
}
