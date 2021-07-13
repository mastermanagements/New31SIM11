<?php

namespace App\Http\Controllers\produksi;

use App\Http\utils\data_pembelian\ReturnPembelianbarang;
use App\Http\utils\HeaderReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\POrder;
use App\Model\Produksi\Detail_Cek_Barang as dcb;
use App\Model\Produksi\ReturnPembelian as return_pembelian;
use App\Model\Produksi\Supplier;
use Session;
class ReturnPembelian extends Controller
{
    //
    private $data = [
        'Return Barang',
        'Potong Hutang',
        'Return Uang'
    ];


    public function show($id_order){
        $model = POrder::findOrFail($id_order);
      //  $model = dcb::findorFail($id_order);
        $data = ['data'=> $model,'bentuk_return'=> $this->data];

        //dd($model);
        return view('user.produksi.section.belibarang.return_pembelian.page_create', $data);
    }

    public function preview($id_order){
        $model = POrder::findOrFail($id_order);
        $data = ['data'=> $model,'bentuk_return'=> $this->data];
        return view('user.produksi.section.belibarang.return_pembelian.page_preview', $data);
    }

    public function store(Request $req){

    //dd($req->all());
        $this->validate($req, [
            'id_order'=> 'required',
            'jenis_return'=> 'required',
            'tgl_return'=> 'required',
            'ongkir_return' => 'required',
        ]);

        $model = return_pembelian::updateOrCreate(
            [
                'id_order'=> $req->id_order,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan')
            ],
            [
                'tgl_return'=> tanggalController($req->tgl_return),
                'jenis_return'=> $req->jenis_return,
                'ongkir_return'=> rupiahController($req->ongkir_return),
                'id_karyawan'=> Session::get('id_karyawan')
            ]
        );

        if($model){
            return redirect('Pembelian')->with('message_success','Data return telah disimpan')->with('tab5','tab5');
        }
    }

    public function laporan_return_pembelian_barang(Request $req)
    {
        $pengecekan_pembelian_class = new ReturnPembelianbarang();
        $data_pengecekan_barang = $pengecekan_pembelian_class->data_return_pembelian($req);
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if ($req->action == 'preview') {
            return view('user.produksi.section.laporan.return_barang.page_show', ['data' => $data_pengecekan_barang, 'supplier'=>$supplier]);
        } elseif ($req->action == 'print') {
            $header = HeaderReport::header_format_2('layouts.header_print.header_print1', 'LAPORAN RETURN PEMBELIAN BARANG');
            return view('user.produksi.section.laporan.return_barang.cetak', ['data' => $data_pengecekan_barang, 'header' => $header]);
        } else {
            return view('user.produksi.section.laporan.return_barang.page_show', ['data' => $data_pengecekan_barang, 'supplier'=>$supplier]);
        }
    }
}
