<?php

namespace App\Http\Controllers\produksi;

use App\Http\utils\HeaderReport;
use App\Model\Produksi\PSO;
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
        $no_surat = SettingNoSurat::no_po();
        $model = TawarBeli::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $barang_penawaran = TawarBeli::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
       return view('user.produksi.section.belibarang.pesanan_barang.page_rincian_barang_penawaran', ['penawaran_pembelian' => $model, 'supplier' => $supplier, 'barang_penawaran' => $barang_penawaran,'no_surat'=>$no_surat]);
    }

    public function store(Request $req)
    { //dd($req->all());
        $this->validate($req, [
            'no_po' => 'required',
            'tgl_po' => 'required',
            'id_supplier' => 'required',
        ]);

        $tgl_po = tanggalController($req->tgl_po);
        if($req->tgl_kirim == NULL){
          $tgl_kirim = null;
        } else {
          $tgl_kirim = tanggalController($req->tgl_dikirim);
        }

        $model = PB::updateOrCreate(
            [
                'no_po' => $req->no_po,
                'id_perusahaan' => Session::get('id_perusahaan_karyawan')
            ],
            [
              // 'id_tawar_beli' => $req->id_tawar_beli,
                'tgl_po' => $tgl_po,
                'id_supplier' => $req->id_supplier,
                'tgl_krm' => $tgl_kirim,
                'id_karyawan' => Session::get('id_karyawan')

            ]
        );
        //dd($model);
        if ($model) {
            /*if (!empty($model->id_tawar_beli)) {
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
            */
            return redirect('Pembelian')->with('message_success', 'anda telah membuat nota pesanan pembelian')->with('tab2','tab2');
        } else {
            return redirect('Pembelian')->with('message_error', 'gagal,membuat nota pesanan pembelian')->with('tab2','tab2');
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
    { //dd($req->all());
        $this->validate($req, [
            'no_po' => 'required',
            'tgl_po' => 'required',
            'id_supplier' => 'required',
            //'tgl_krm' => 'required',
        ]);

        if($req->tgl_krm == null){
          $tgl_dikirim = null;
        } else {
          $tgl_dikirim = tanggalController($req->tgl_krm);
        }
        $model = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        //$model->id_tawar_beli = $req->id_tawar_beli;
        $model->no_po = $req->no_po;
        $model->tgl_po = tanggalController($req->tgl_po);
        $model->id_supplier = $req->id_supplier;
        $model->tgl_krm = $tgl_dikirim;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        //dd($model);
        if ($model->save()) {
            return redirect('Pembelian')->with('message_success', 'anda telah mengubah nota pesanan pembelian')->with('tab2','tab2');
        } else {
            return redirect('Pembelian')->with('message_error', 'gagal, mengubah pesanan pembelian')->with('tab2','tab2');
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
                //on off tombol bayar
                if($data->dp_po == $data->linkToBayar->jumlah_bayar){
                    $tombol_bayar = "<a href='".url('bayar/'.$data->id.'/bayar-po/0')."' class='btn btn-primary'> Bayar</a>";
                }
            }
            if(!empty($data->linkToBayar->jumlah_bayar)){
                $jumlah_bayar = rupiahView($data->linkToBayar->jumlah_bayar);
            }

            $column = [];
            $column[] = $no++;
            $column[] = $data->no_po;
            $column[] = $data->linkToSupplier->nama_suplier;
            $column[] = $data->tgl_po;
            $column[] = $tgl_bayar;
            $column[] = rupiahview($data->dp_po);
            $column[] = $jumlah_bayar;
            $column[] = $bukti_bayar;
            $column[] = $konfirmasi;
            $column[] = $tombol_bayar;
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
                $sisa_hutang = $data->kurang_bayar;
                if($sisa_hutang==$data->linkToBayar->jumlah_bayar){
                    $status = "lunas";
                }
            }

            $column = [];
            $column[] = $no++;
            $column[] = $data->no_order;
            $column[] = $data->linkToSuppliers->nama_suplier;
            $column[] = $data->tgl_order;
            $column[] = rupiahView($data->total);
            $column[] = rupiahView($data->bayar);
            $column[] = rupiahView($data->kurang_bayar);
            $metode_bayar = '';
            if($data->metode_bayar == '0'){
                $metode_bayar = 'Tunai';
            }else{
                $metode_bayar = 'Kredit';
            }
            $column[] = $metode_bayar;
            $column[] = $tgl_bayar;
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
            'harga_beli' => 'required',
            'jumlah_beli' => 'required',
        ]);


        $harga_peritem = rupiahController($req->jumlah_beli) * rupiahController($req->harga_beli);
        if ($req->diskon != 0)
        {
            $nilai_diskon = $req->diskon / 100;
        } else {
            $nilai_diskon = 0;
        }
        $jumlah_harga = $harga_peritem - ($harga_peritem * $nilai_diskon);

        $model_po = new DetailPO;

        $model_po->id_po = $id;
        $model_po->id_barang = $req->id_barang;
        $model_po->harga_beli =rupiahController($req->harga_beli);
        $model_po->jumlah_beli = $req->jumlah_beli;
        $model_po->diskon_item = $req->diskon;
        $model_po->jumlah_harga = rupiahController($jumlah_harga);
        $model_po->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model_po->id_karyawan = Session::get('id_karyawan');
//        dd($model_po);
        if ($model_po->save()) {
            if ($req->redirect == true) {
                return redirect()->back()->with('message_success', 'anda telah menambahkan item baru');
            }
        } else {
            return redirect()->back()->with('message_fail', 'gagal menambahkan item pesanan pembelian baru');
        }
    }

    public function ubah_Pesanan_pembelian(Request $req, $id)
    {

        $this->validate($req, [
          'id_barang' => 'required',
           'jumlah_beli' => 'required',
           'harga_beli'=>'required',
           'diskon_item'=>'required'
        ]);

        $id_barang = $req->id_barang;
        $harga_beli = rupiahController($req->harga_beli);
        $jumlah_beli = rupiahController($req->jumlah_beli);
        $diskon_item = $req->diskon_item;
        $nilai_diskon = $harga_beli*$diskon_item/100;

        $sub_total = ($harga_beli  * $jumlah_beli) - $nilai_diskon;

        $model_po = DetailPO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        //request

        $model_po->id_barang = $id_barang;
        $model_po->harga_beli = $harga_beli;
        $model_po->jumlah_beli = $jumlah_beli;
        $model_po->diskon_item = $diskon_item ;
        $model_po->jumlah_harga = rupiahController($sub_total);
        $model_po->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model_po->id_karyawan = Session::get('id_karyawan');

        if ($model_po->save()) {
            return redirect()->back()->with('message_success', 'anda telah mengubah item baru')->with('tab2','tab2');
        } else {
            return redirect('Pembelian')->with('message_success', 'gagal mengubah item baru')->with('tab2','tab2');
        }
    }

    public function ubah_Pesanan_pembelian_po(Request $req, $id)
    {

        $this->validate($req, [
            //'diskon_tambahan' => 'required',
            //'pajak' => 'required',
            'uang_muka' => 'required',
            'kurang_bayar' => 'required',
        ]);

        //request assignment
        $diskon_tambahan = rupiahController($req->diskon_tambahan);
        $pajak = $req->pajak;
        $dp_po = rupiahController($req->uang_muka);
        $ket = $req->ket;

        //sub_total = total_belanja_po
        $sub_total = $req->sub_total;

        $total_pajak = $sub_total * $pajak / 100;
        //total_po = sub_total + pajak -diskon_tambahan   :
        $total_po = $sub_total + $total_pajak - $diskon_tambahan ;

        //krg bayar = total_po - uang_muka
        $kurang_bayar = $total_po - $dp_po;

        //cek checkbox value on false
        if ($req->jurnal_otomatis == 'on') {
          // update po + insert jurnal umum
          $check_data_pembelian = JenisAkunPembelian::CheckAkunPembelian();
          #check akun pembelian kalau kosong == false
          if($check_data_pembelian==false){
          return redirect('Pembelian')->with('message_fail','Isilah terlebih dahulu akun pembelian')->with('tab2','tab2');
          }

          $jenis_akun_pembelian = JenisAkunPembelian::rule($req->all(), 1);

          $model = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);


          if ($pajak != 0) {
              JenisAkunPembelian::$status_pajak = true;
          }

          $model->diskon_tambahan = $diskon_tambahan;
          $model->pajak = $pajak;
          $model->dp_po = $dp_po;
          $model->kurang_bayar = $kurang_bayar;
          $model->ket = $ket;
          $model->total =rupiahController($total_po);
          $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
          $model->id_karyawan = Session::get('id_karyawan');

          if ($model->save()) {
              # Insert Data Ke Jurnal
              if(is_array($jenis_akun_pembelian) == true){
                  $req->merge([
                      'total_sebelum_pajak'=>$total_pajak,
                      'total'=> $total_po,
                      'tgl_order'=> $model->tgl_po,
                      'no_order'=>$model->no_po,
                      'id_pesanan'=> $model->id
                  ]);
                  JenisAkunPembelian::$new_request = $req;
                  $response =JenisAkunPembelian::get_akun_pembelian($jenis_akun_pembelian);
                  if(!empty($response)){
                      if($response['status']==false){
                          return redirect()->back()->with('message_fail','Akun Pesanan Belum dibuat');
                      }else{
                          return redirect()->back()->with('message_success','Data Pesanan telah disimpan');
                      }
                  }else{
                      return redirect()->back()->with('message_success','Data Pembelian telah disimpan');
                  }
              }
                  return redirect('Pembelian')->with('message_success', 'anda telah membuat nota pesanan pembelian')->with('tab2','tab2');
                } else {
                    return redirect('Pembelian')->with('message_error', 'gagal,membuat nota pesanan pembelian')->with('tab2','tab2');
                }

            //jika tanpa jurnal otomatis
          } else {
            $model = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
            //insert values to table
            $model->diskon_tambahan = $diskon_tambahan;
            $model->pajak = $pajak;
            $model->dp_po = $dp_po;
            $model->kurang_bayar = $kurang_bayar;
            $model->ket = $ket;
            $model->total = rupiahController($total_po);
            $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
            $model->id_karyawan = Session::get('id_karyawan');

            if ($model->save()) {

                return redirect()->back()->with('message_success', 'berhasil memuat nota pesanan pembelian')->with('tab2','tab2');
            } else {
                return redirect()->back->with('message_fail', 'gagal,membuat nota pesanan pembelian')->with('tab2','tab2');
            }

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

    public function CetakPesananPembelian($id)
    {
        $model_pb = PB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        return view('user.produksi.section.belibarang.pesanan_barang.cetak', ['data'=> $model_pb, 'header'=>HeaderReport::header_format_2('layouts.header_print.header_print1','PESANAN PEMBELIAN')]);
    }

}
