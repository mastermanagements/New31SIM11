<?php

namespace App\Http\Controllers\produksi;

use App\Http\utils\data_pembelian\CekPembelianBarang;
use App\Http\utils\HeaderReport;
use App\Http\utils\StokGudang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\POrder as p_order;
use App\Model\Produksi\Supplier;
use App\Model\Produksi\PesananPembelian;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Produksi\Cek_Barang;
use App\Model\Produksi\Detail_Cek_Barang;
use App\Model\MasukGudang;
use App\Model\Gudang;
use App\Model\DetailMasukGudang;
use stdClass;

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

    public function show($id)
    {
        $data = [
            'supplier' => Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian' => PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'data_order' => p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'barang' => Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'metode_pembayaran' => $this->metode_bayar,
            'kondisi' => $this->kondisi,
            'gudang' => Gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get()

        ];
        //  dd($data['detail_cek_brg']);
        return view('user.produksi.section.belibarang.cek_barang.page_rincian_barang', $data);
    }

    public function showCek($id)
    {
        $data = [
            'supplier' => Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian' => PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'data_order' => p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'barang' => Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'metode_pembayaran' => $this->metode_bayar,
            'kondisi' => $this->kondisi,
            'respon' => $this->respon
        ];
        //dd($data['detail_cek_brg']);
        return view('user.produksi.section.belibarang.status_return.page_rincian_barang', $data);
    }

    //proses cek brg : store ke p_cek_brg dan p_detail_cek_brg, update p_order.status_cekbarang = 1
    public function store(Request $req)
    {

        $this->validate($req, [
            'id_barang' => 'required',
            'harga_beli' => 'required',
            'diskon_item' => 'required',
            'jumlah_beli' => 'required',
            'jumlah_harga' => 'required',
            'jum_sesuai' => 'required',
            'jum_no_sesuai' => 'required',
            'jum_kualitas_sesuai' => 'required',
            'jum_kualitas_no_sesuai' => 'required',
            'id_order' => 'required'
        ]);
        $id_order = $req->id_order;
        $current_date = date('Y-m-d');

        //insert to p_cek_brg
        $model = Cek_Barang::updateOrCreate(
            [
                'id_order' => $id_order,
                'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
            ],
            [
                'tgl_konfirm_cek' => $current_date,
                'id_karyawan' => Session::get('id_karyawan')
            ]
        );

        //insert to p_detail_cek_brg
        $id_cek_barang = $model->id;
        //dd($id_cek_barang);

        if ($model) {
            foreach ($req->id_barang as $key => $value) {
                $model_d = Detail_Cek_Barang::updateOrCreate(
                    [
                        'id_order'=>$id_order,
                        'id_cek_barang'=>$id_cek_barang,
                        'id_barang'=>$value,
                        'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
                        'id_karyawan'=>Session::get('id_karyawan'),
                    ],[
                        'harga_beli'=>rupiahController($req->harga_beli[$key]),
                        'jumlah_beli'=>rupiahController($req->jumlah_beli[$key]),
                        'jumlah_harga'=>rupiahController($req->jumlah_harga[$key]),
                        'jum_sesuai'=>$req->jum_sesuai[$key],
                        'jum_no_sesuai'=>$req->jum_no_sesuai[$key],
                        'jum_kualitas_sesuai'=>$req->jum_kualitas_sesuai[$key],
                        'jum_kualitas_no_sesuai'=>$req->jum_kualitas_no_sesuai[$key],
                        'ket'=>$req->ket[$key],
                    ]
                );
            }
            $this->transfers_barang($req);
        }

        if ($model_d) {
            $model_o = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_order);
            $model_o->status_cekbarang = '1';
            $model_o->save();
        }
        return redirect('Pembelian')->with('message_success', 'Proses Pengecekkan pembelian Barang berhasil')->with('tab3', 'tab3');
    }

    //proses status return : update p_detail_cek_brg, update p_cek_brg.tgl_respon_supplier, p_order.respon_supplier =1
    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'id_barang' => 'required',
            'harga_beli' => 'required',
            'diskon_item' => 'required',
            'jumlah_beli' => 'required',
            'jumlah_harga' => 'required',
            'jum_sesuai' => 'required',
            'jum_no_sesuai' => 'required',
            'jum_kualitas_sesuai' => 'required',
            'jum_kualitas_no_sesuai' => 'required',


        ]);

        $current_date = date('Y-m-d');

        $model = Cek_Barang::updateOrCreate(
            [
                'id_order' => $id,
                'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
            ],
            [
                'tgl_respon_supplier' => $current_date,
                'id_karyawan' => Session::get('id_karyawan')
            ]
        );

        if ($model) {
            foreach ($req->id_barang as $key => $value) {
                # code...
                $model_detail_barang = Detail_Cek_Barang::updateOrCreate(
                    [
                        'id_order' => $id,
                        'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
                        'id_barang' => $value,
                        'id_cek_barang' => $model->id,
                        'id_detail_po' => $req->id_detail_barang[$key]
                    ],
                    [
                        'harga_beli' => rupiahController($req->harga_beli[$key]),
                        'diskon_item' => $req->diskon_item[$key],
                        'jumlah_beli' => rupiahController($req->jumlah_beli[$key]),
                        'jumlah_harga' => rupiahController($req->jumlah_harga[$key]),
                        'jum_sesuai' => $req->jum_sesuai[$key],
                        'jum_no_sesuai' => $req->jum_no_sesuai[$key],
                        'jum_kualitas_sesuai' => $req->jum_kualitas_sesuai[$key],
                        'jum_kualitas_no_sesuai' => $req->jum_kualitas_no_sesuai[$key],

                        'status_return' => $req->respon[$key],
                        'alasan_ditolak' => $req->alasan[$key],
                        'ket' => $req->ket[$key],

                        'id_karyawan' => Session::get('id_karyawan')
                    ]

                );
                //  dd($req->all());
            }
        }
        if ($model_detail_barang) {
            $model_o = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_order);
            $model_o->status_supplier = '1';
            $model_o->save();
        }

        return redirect('Pembelian')->with('message_success', 'Update Status Retrun Barang berhasil')->with('tab3', 'tab3');
    }

    private function transfers_barang($req)
    {
        if (!empty($req->transfer_gudang)) {

            if ($req->transfer_gudang == "transfer") {
                $masuk_gudang = MasukGudang::updateOrCreate(
                    [
                        'id_order' => $req->id_order,
                        'id_gudang' => $req->id_gudang,
                        'id_perusahaan' => Session::get('id_perusahaan_karyawan')
                    ],
                    [
                        'tgl_transaksi' => $req->tgl_transaksi,
                        'nama_pengirim' => $req->nama_pengirim,
                        'id_karyawan' => Session::get('id_karyawan')
                    ]
                );

                if ($masuk_gudang) {
                    $this->transfer_detail_barang($masuk_gudang);
                }
            }
        }
    }

    private function transfer_detail_barang($model_gudang_masuk)
    {
        // Ambil detail barang dari table p_detail_cek_barang
        if (!empty($data = $model_gudang_masuk->linkToOrder->linkToCekBarangDetail)) {

            foreach ($data as $item_detail_cek_barang) {
                $array = [];
                $stok_gudang = new StokGudang();
                $detail_masuk_gudang = DetailMasukGudang::updateOrCreate(
                    [
                        'id_masuk_gudang' => $model_gudang_masuk->id,
                        'id_barang' => $item_detail_cek_barang->id_barang,
                        'id_perusahaan' => Session::get('id_perusahaan_karyawan')
                    ],
                    [
                        'jumlah' => $item_detail_cek_barang->jum_kualitas_sesuai,
                        'id_karyawan' => Session::get('id_karyawan')
                    ]
                );
                if ($detail_masuk_gudang) {
                    $array['id_gudang'] = $model_gudang_masuk->id_gudang;
                    $array['id_barang'] = $item_detail_cek_barang->id_barang;
                    $array['jumlah'] = $detail_masuk_gudang->jumlah;
                    $stok_gudang->IOStok($array, 'masuk');
                }
            }
        }
    }

    public function laporan_cek_pembelian_barang(Request $req)
    {
        $pengecekan_pembelian_class = new CekPembelianBarang();
        $data_pengecekan_barang = $pengecekan_pembelian_class->Data_pengecekanBarang($req);
       if ($req->action == 'preview') {
            return view('user.produksi.section.laporan.pengecekkan_barang.page_show', ['data' => $data_pengecekan_barang ]);
        } elseif ($req->action == 'print') {
            $header = HeaderReport::header_format_2('layouts.header_print.header_print1', 'LAPORAN PENGECEKKAN BARANG');
            return view('user.produksi.section.laporan.pengecekkan_barang.cetak', ['data' => $data_pengecekan_barang, 'header' => $header]);
        } else {
            return view('user.produksi.section.laporan.pengecekkan_barang.page_show', ['data' => $data_pengecekan_barang]);
        }
    }
}
