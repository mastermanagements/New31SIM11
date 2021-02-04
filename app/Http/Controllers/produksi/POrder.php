<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PesananPembelian;
use App\Model\Produksi\Supplier;
use App\Model\Produksi\POrder as p_order;
use App\Model\Produksi\DetailOrder;
use Session;

class POrder extends Controller
{
    //
    public function show($id)
    {
        $data =[
            'supplier'=> Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian'=>PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'data_order'=> p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.produksi.section.belibarang.order_pembelian.page_rincian_barang', $data);
    }

    public function create()
    {
        $data =[
            'supplier'=> Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian'=>PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get()
        ];
        return view('user.produksi.section.belibarang.order_pembelian.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'no_order'=> 'required',
            'tgl_order'=> 'required',
            'id_supplier'=> 'required',
            'tgl_tiba'=> 'required',
        ]);

        $model = p_order::updateOrcreate(
            [
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                'no_order'=> $req->no_order
            ],
            [
                'tgl_order'=> $req->tgl_order,
                'id_po' => $req->id_po,
                'id_supplier' => $req->id_supplier,
                'tgl_tiba'=> $req->tgl_tiba,
            ]
        );

        if($model->save()){
            return redirect('Pembelian')->with('message_success','data pembelian telah disimpan');
        }else{
            return redirect('Pembelian')->with('message_error','data pembelian gagal disimpan');     
        }
    }

    public function edit($id)
    {
        $data =[
            'supplier'=> Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian'=>PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'data_order'=> p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
    
        return view('user.produksi.section.belibarang.order_pembelian.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'no_order'=> 'required',
            'tgl_order'=> 'required',
            'id_supplier'=> 'required',
            'tgl_tiba'=> 'required',
        ]);

        $model =p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id); 
        $model->no_order = $req->no_order;
        $model->tgl_order = $req->tgl_order;
        $model->id_po = $req->id_po;
        $model->id_supplier = $req->id_supplier;
        $model->tgl_tiba = $req->tgl_tiba;

        if($model->save()){
            return redirect('Pembelian')->with('message_success','data pembelian telah disimpan');
        }else{
            return redirect('Pembelian')->with('message_error','data pembelian gagal disimpan');     
        }
    }

    public function destroy(Request $req, $id)
    {
        # code...
        $model =p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id); 
        if($model->delete()){
            return redirect('Pembelian')->with('message_success','data pembelian telah dihapus');
        }else{
            return redirect('Pembelian')->with('message_error','data pembelian gagal dishapus');     
        }
    }

    public function detail_order(Request $req, $id)
    {
        # code...
        $this->validate($req,[
            'id_barang'=> 'required',
            'jumlah_beli'=> 'required',
            'diskon_item'=> 'required',
            'hpp'=> 'required',
            'jumlah_harga' => 'required'
        ]);

        foreach ($req->id_barang as $key => $id_barang) {
            # code...
            $model = DetailOrder::updateOrCreate(
                [
                    'id_order'=>$id,
                    'id_barang'=>$id_barang,
                    'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
                ],
                [
                    'hpp'=>$req->hpp[$key],
                    'jumlah_beli'=>$req->jumlah_beli[$key],
                    'diskon_item'=>$req->diskon_item[$key],
                    'jumlah_harga'=>$req->jumlah_harga[$key]
                ]
            );
        }
       

        return redirect()->back()->with('message_success','Data barang pembelian telah disimpan');
    }

}
