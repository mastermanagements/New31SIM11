<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\TawarBeli;
use Session;
use App\Model\Produksi\Supplier;
use App\Model\Produksi\PesananPembelian as PB;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\DetailPO;
use Illuminate\Database\Eloquent\Model;
use App\Model\Produksi\POrder;
use App\Http\utils\SettingNoSurat;
use App\Http\utils\JenisAkunPembelian;

class PesananPembelian extends Controller
{
    public function index()
    {
        $no_surat = SettingNoSurat::no_po();
        $model = TawarBeli::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        return view('user.produksi.section.belibarang.pesanan_barang.page_create', ['penawaran_pembelian' => $model,'no_surat'=>$no_surat, 'supplier' => $supplier]);
    }

    #Todo Rincian Barang Penawaran
    public function RincianBarangPenawaran($id)
    {
        $model = TawarBeli::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $barang_penawaran = TawarBeli::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
       return view('user.produksi.section.belibarang.pesanan_barang.page_rincian_barang_penawaran', ['penawaran_pembelian' => $model, 'supplier' => $supplier, 'barang_penawaran' => $barang_penawaran]);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'no_po' => 'required',
            'tgl_po' => 'required',
            'id_supplier' => 'required',
        ]);

      
        $model = PB::updateOrCreate(
            [
                'no_po' => $req->no_po,
                'id_perusahaan' => Session::get('id_perusahaan_karyawan')
            ],
            [
                'id_tawar_beli' => $req->id_tawar_beli,
                'tgl_po' => $req->tgl_po,
                'id_supplier' => $req->id_supplier,
                'tgl_krm' => $req->tgl_dikirim,
            ]
        );

        if ($model) {
            if (!empty($model->id_tawar_beli)) {
                foreach ($req->id_barang as $key => $id_barang) {

                    $n_request = new Request([
                        'id_barang' => $id_barang,
                        'id_po' => $model->id,
                        'hpp' => $req->hpp[$key],
                        'diskon' => $req->diskon[$key],
                        'jumlah_beli' => $req->jumlah_beli[$key],
                        'redirect' => false, // setting redirect, false tidak menjalankan redirect yang ada pada function tambah pesanan pembelian
                    ]);
                    $this->tambah_Pesanan_pembelian($n_request, $model->id); # kirim request ke function tambah pesanan pembelian

                }
            }
            return redirect()->back()->with('message_success', 'anda telah membuat nota pesanan pembelian');
        } else {
            return redirect()->back()->with('message_error', 'gagal,membuat nota pesanan pembelian');
        }
       
    }

    public function edit($id)
    {
        $model_pb = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model = TawarBeli::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $barangs = barangs::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        return view('user.produksi.section.belibarang.pesanan_barang.page_edit_pesanan', ['barang' => $barangs, 'data' => $model_pb, 'penawaran_pembelian' => $model, 'supplier' => $supplier]);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'no_po' => 'required',
            'tgl_po' => 'required',
            'id_supplier' => 'required',
        ]);


        $model = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model->id_tawar_beli = $req->id_tawar_beli;
        $model->no_po = $req->no_po;
        $model->tgl_po = $req->tgl_po;
        $model->id_supplier = $req->id_supplier;
        $model->tgl_krm = $req->tgl_dikirim;
        $model->diskon_tambahan = $req->diskon_tambahan;
        $model->pajak = $req->pajak;
        $model->dp_po = $req->uang_muka;
        $model->kurang_bayar = $req->kurang_bayar;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if ($model->save()) {
            return redirect('Pembelian')->with('message_success', 'anda telah mengubah nota pesanan pembelian');
        } else {
            return redirect('Pembelian')->with('message_error', 'gagal, mengubah pesanan pembelian');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if ($model->delete()) {
            return redirect('Pembelian')->with('message_success', 'anda telah menghapus nota pesanan pembelian');
        } else {
            return redirect('Pembelian')->with('message_error', 'gagal,menghapus pesanan pembelian');
        }
    }

    public function show($id_pembelian)
    {
        $model_pb = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_pembelian);
        $model = TawarBeli::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $barangs = barangs::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        return view('user.produksi.section.belibarang.pesanan_barang.page_edit', ['barang' => $barangs, 'data' => $model_pb, 'penawaran_pembelian' => $model, 'supplier' => $supplier]);
    }

    private function data_pesanan(){
        $model_pb = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
        $array = [];
        $no=1;
        $bukti_bayar = "";
        foreach ($model_pb as $data)
        {
            $tgl_bayar = "";
            $konfirmasi = "no";
            if(!empty($data->linkToBayar))
            {
                $tgl_bayar = date('d-m-Y', strtotime($data->linkToBayar->tgl_bayar));
                $konfirmasi = "yes";
                $bukti_bayar = "<a href='".url('bayar/'.$data->linkToBayar->id.'/bayar-po/1')."' class='btn btn-primary'> Bukti Bayar</a>";
            }

            $column = [];
            $column[] = $no++;
            $column[] = $data->no_po;
            $column[] = $data->linkToSupplier->nama_suplier;
            $column[] = $data->tgl_po;
            $column[] = $tgl_bayar;
            $column[] = $data->dp_po;
            $column[] = $data->linkToDetailPO->sum('jumlah_harga');
            $column[] = $bukti_bayar;
            $column[] = $konfirmasi;
            $column[] = "<a href='".url('bayar/'.$data->id.'/bayar-po/0')."' class='btn btn-primary'> bayar</a>";
            $array[] = $column;
        }

        return response()->json(['data'=> $array]);
    }
 
    private function data_order()
    {
        $model_order = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
        $array = [];
        $no=1;
        foreach ($model_order as $data){

            $tgl_bayar = "";
            $konfirmasi = "no";
            $status = "belum lunas";
            $bukti_bayar = "";
            if(!empty($data->linkToBayar)){
                $tgl_bayar = date('d-m-Y', strtotime($data->linkToBayar->tgl_bayar));
                $konfirmasi = "yes";
                $bukti_bayar = "<a href='".url('bayar/'.$data->linkToBayar->id.'/bayar-order/1')."' class='btn btn-primary'> Bukti Bayar</a>";

                #cari sisa hutang
                $sisa_hutang = $data->bayar+$data->kurang_bayar;
                if($sisa_hutang==$data->linkToBayar->jumlah_bayar){
                    $status = "lunas";
                }
            }

            $column = [];
            $column[] = $no++;
            $column[] = $data->no_order;
            $column[] = $data->linkToSuppliers->nama_suplier;
            $column[] = $data->tgl_order;
            $column[] = $tgl_bayar;
            $column[] = $data->total;
            $column[] = $data->bayar;
            $column[] = $data->kurang_bayar;
            $metode_bayar = '';
            if($data->metode_bayar == '0'){
                $metode_bayar = 'Tunai';
            }else{
                $metode_bayar = 'Kredit';
            }
            $column[] = $metode_bayar;
            $column[] = $bukti_bayar;
            $column[] = $konfirmasi;
            $column[] = $status;
            $column[] = "<a href='".url('bayar/'.$data->id.'/bayar-order/1')."' class='btn btn-primary'> bayar</a><a href='".url('rincian-pembayaran/'.$data->id)."' target='_blank' class='btn btn-primary'> rincian</a>";
            $array[] = $column;
        }    
        return response()->json(['data'=>$array]);
    }


    public function show_pesanan_pembelian($jenis_pembelian_pembayaran)
    {
        if($jenis_pembelian_pembayaran == 0)
        {
           return $this->data_pesanan();
        }
        else{
           return $this->data_order();
        }
    }
   
    public function tambah_Pesanan_pembelian(Request $req, $id)
    {

        $this->validate($req, [
            'id_barang' => 'required',
            'id_po' => 'required',
            'hpp' => 'required',
            'jumlah_beli' => 'required',
        ]);


        $total_harga = $req->jumlah_beli * $req->hpp;
        if ($req->diskon != 0)
        {
            $total_setelah_diskon = $req->diskon / 100;
        } else {
            $total_setelah_diskon = $req->diskon;
        }
        $jumlah_harga = $total_harga - ($total_harga * $total_setelah_diskon);

        $model_po = DetailPO::updateOrCreate(
            [
                'id_po' => $id,
                'id_barang' => $req->id_barang,
                'id_perusahaan' => Session::get('id_perusahaan_karyawan')
            ],
            [
                'hpp' => $req->hpp,
                'jumlah_beli' => $req->jumlah_beli,
                'diskon_item' => $total_setelah_diskon,
                'jumlah_harga' => $jumlah_harga,
            ]
        );

        if ($model_po) {
            if ($req->redirect == true) {
                return redirect()->back()->with('message_success', 'anda telah menambahkan item baru');
            }
        } else {
            return redirect()->back()->with('message_success', 'gagal menambahkan item baru');
        }
    }

    public function ubah_Pesanan_pembelian(Request $req, $id)
    {

        $this->validate($req, [
            'id_barang' => 'required',
            'hpp' => 'required',
           'jumlah_beli' => 'required',
        ]);


        $model_po = DetailPO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model_po->id_barang = $req->id_barang;
        $model_po->hpp = $req->hpp;
        $model_po->jumlah_beli = $req->jumlah_beli;
        $total_harga = $req->jumlah_beli * $req->hpp;
        if ($req->diskon != 0) {
            $total_setelah_diskon = $req->diskon / 100;
        } else {
            $total_setelah_diskon = $req->diskon;
        }
        $model_po->diskon_item = $total_setelah_diskon;
        $jumlah_harga = $total_harga - ($total_harga * $total_setelah_diskon);
        $model_po->jumlah_harga = $jumlah_harga;
        $model_po->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if ($model_po->save()) {
            return redirect()->back()->with('message_success', 'anda telah mengubah item baru');
        } else {
            return redirect()->back()->with('message_success', 'gagal mengubah item baru');
        }
    }

    public function ubah_Pesanan_pembelian_po(Request $req, $id)
    {
        $this->validate($req, [
            'diskon_tambahan' => 'required',
            'pajak' => 'required',
            'uang_muka' => 'required',
            'kurang_bayar' => 'required',
        ]);
        $total_pajak = 0;
        $total_diskon = 0;

        $check_data_pembelian = JenisAkunPembelian::CheckAkunPembelian();
        #check akun pembelian kalau kosong == false
        if($check_data_pembelian==false){
            return redirect()->back()->with('message_fail','Isilah terlebih dahulu akun pembelian');
        }

        $jenis_akun_pembelian = JenisAkunPembelian::rule($req->all(), 1);

        $model = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model->diskon_tambahan = $req->diskon_tambahan;

        if ($req->diskon_tambahan != 0) {
            $diskon = $req->diskon_tambahan / 100;
            $total_diskon = $req->sub_total * $diskon;
        }

        $total = $req->sub_total - $total_diskon;
        $total_akhir = $total;

        if ($req->pajak != 0) {
            $total_pajak = $total_akhir*($req->pajak / 100);
            JenisAkunPembelian::$status_pajak = true;
        }

        $model->pajak = $req->pajak;
        $model->dp_po = $req->uang_muka;
        $model->kurang_bayar = $req->kurang_bayar;
        $model->ket = $req->ket;
        $model->total =$total_akhir;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if ($model->save()) {
            # Insert Data Ke Jurnal
            if(is_array($jenis_akun_pembelian) == true){
                $req->merge([
                    'total_sebelum_pajak'=>$total_pajak,
                    'total'=> $total_akhir,
                    'tgl_order'=> $model->tgl_po,
                    'no_order'=>$model->no_po,
                    'id_pesanan'=> $model->id
                ]);
                JenisAkunPembelian::$new_request = $req;
                JenisAkunPembelian::get_akun_pembelian($jenis_akun_pembelian);
            }
            return redirect('Pembelian')->with('message_success', 'anda telah membuat nota pesanan pembelian');
        } else {
            return redirect('Pembelian')->with('message_error', 'gagal,membuat nota pesanan pembelian');
        }
    }

    public function hapus_Pesanan_pembelian(Request $req, $id)
    {
        $model_po = DetailPO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if ($model_po->delete()) {
            return redirect()->back()->with('message_success', 'anda telah mengubah item baru');
        } else {
            return redirect()->back()->with('message_success', 'gagal mengubah item baru');
        }
    }

}
