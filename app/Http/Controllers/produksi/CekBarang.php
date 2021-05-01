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

    //proses cek brg : store ke p_cek_brg dan p_detail_cek_brg, update p_order.status_cekbarang = 1
    public function store(Request $req)
    { //dd($req->all());
        $this->validate ($req,[
          'id_barang'=>'required',
          'harga_beli'=> 'required',
          'diskon_item'=> 'required',
          'jumlah_beli'=>'required',
          'jumlah_harga'=> 'required',
          'jum_sesuai'=> 'required',
          'jum_no_sesuai'=> 'required',
          'jum_kualitas_sesuai'=> 'required',
          'jum_kualitas_no_sesuai'=> 'required',
          'id_order'=>'required'
        ]);
        $id_order = $req->id_order;
        $current_date = date('Y-m-d');

        //insert to p_cek_brg
        $model = new Cek_Barang;
        $model->id_order = $id_order;
        $model->tgl_konfirm_cek = $current_date;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        $model->save();

        //insert to p_detail_cek_brg
        $id_cek_barang = $model->id;
        //dd($id_cek_barang);

        if($model){


        foreach ($req->id_barang as $key => $value)
        {
            $model_d = new Detail_Cek_Barang;
            $model_d->id_order = $id_order;
            $model_d->id_cek_barang = $id_cek_barang;
            $model_d->id_barang = $value;
            $model_d->harga_beli = rupiahController($req->harga_beli[$key]);
            $model_d->jumlah_beli = rupiahController($req->jumlah_beli[$key]);
            $model_d->jumlah_harga = rupiahController($req->jumlah_harga[$key]);
            $model_d->jum_sesuai = $req->jum_sesuai[$key];
            $model_d->jum_no_sesuai = $req->jum_no_sesuai[$key];
            $model_d->jum_kualitas_sesuai = $req->jum_kualitas_sesuai[$key];
            $model_d->jum_kualitas_no_sesuai = $req->jum_kualitas_no_sesuai[$key];
            $model_d->ket = $req->ket[$key];
            $model_d->id_perusahaan = Session::get('id_perusahaan_karyawan');
            $model_d->id_karyawan = Session::get('id_karyawan');
            $model_d->save();
        }

      }
      if($model_d){
            $model_o = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_order);
            $model_o->status_cekbarang = '1';
            $model_o->save();
      }
      return redirect('Pembelian')->with('message_success','Proses Pengecekkan pembelian Barang berhasil')->with('tab3','tab3');
  }

    //proses status return : update p_detail_cek_brg, update p_cek_brg.tgl_respon_supplier, p_order.respon_supplier =1
    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'id_barang'=>'required',
            'harga_beli'=> 'required',
            'diskon_item'=> 'required',
            'jumlah_beli'=>'required',
            'jumlah_harga'=> 'required',
            'jum_sesuai'=> 'required',
            'jum_no_sesuai'=> 'required',
            'jum_kualitas_sesuai'=> 'required',
            'jum_kualitas_no_sesuai'=> 'required',


        ]);

        $current_date = date('Y-m-d');

        $model = Cek_Barang::updateOrCreate(
            [
                'id_order'=> $id,
                'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
            ],
            [
                'tgl_respon_supplier'=> $current_date,
                'id_karyawan'=> Session::get('id_karyawan')
            ]
        );

        if($model){
        foreach ($req->id_barang as $key => $value) {
                # code...
                $model_detail_barang = Detail_Cek_Barang::updateOrCreate(
                    [
                        'id_order'=> $id,
                        'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
                        'id_barang'=> $value,
                        'id_cek_barang'=> $model->id,
                        'id_detail_po'=> $req->id_detail_barang[$key]
                    ],
                    [
                        'harga_beli'=>  rupiahController($req->harga_beli[$key]),
                        'diskon_item'=> $req->diskon_item[$key],
                        'jumlah_beli'=> rupiahController($req->jumlah_beli[$key]),
                        'jumlah_harga'=> rupiahController($req->jumlah_harga[$key]),
                        'jum_sesuai'=> $req->jum_sesuai[$key],
                        'jum_no_sesuai'=> $req->jum_no_sesuai[$key],
                        'jum_kualitas_sesuai'=> $req->jum_kualitas_sesuai[$key],
                        'jum_kualitas_no_sesuai'=> $req->jum_kualitas_no_sesuai[$key],

                        'status_return'=> $req->respon[$key],
                        'alasan_ditolak'=> $req->alasan[$key],
                        'ket'=> $req->ket[$key],

                        'id_karyawan'=> Session::get('id_karyawan')
                    ]

                );
              //  dd($req->all());
            }
        }
        if($model_detail_barang){
              $model_o = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_order);
              $model_o->status_supplier = '1';
              $model_o->save();
        }

        return redirect('Pembelian')->with('message_success','Update Status Retrun Barang berhasil')->with('tab3','tab3');
    }
}
