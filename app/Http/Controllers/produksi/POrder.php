<?php

namespace App\Http\Controllers\produksi;

use App\Http\utils\HeaderReport;
use App\Http\Controllers\keuangan\JurnalUmum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PesananPembelian;
use App\Model\Produksi\DetailPO;
use App\Model\Produksi\Supplier;
use App\Model\Produksi\POrder as p_order;
use App\Model\Produksi\DetailOrder;
use Illuminate\Database\Eloquent\Model;
use App\Model\Produksi\Barang;
use App\Http\utils\SettingNoSurat;
use Session;
use App\Http\utils\JenisAkunPembelian;
use App\Http\utils\Stok;
use Illuminate\Support\Facades\DB;

class POrder extends Controller
{
    //
    private $metode_bayar = [
        'Tunai',
        'Kredit'
    ];

    public function index()
    {
      return redirect('Pembelian')->with('tab3','tab3');
    }

    public function show($id)
    {
        $data =[
            'supplier'=> Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian'=>PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'data_order'=> p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'detail_order'=> DetailOrder::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('id_order', $id),
            'barang'=>Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'metode_pembayaran'=> $this->metode_bayar


        ];
        //  dd($data['detail_order']);
        return view('user.produksi.section.belibarang.order_pembelian.page_rincian_barang', $data);
    }

    public function create()
    {
        $data =[
            'no_surat'=> SettingNoSurat::no_order(),
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

        //
        $no_order = $req->no_order;
        $tgl_order = tanggalController($req->tgl_order);
        $id_po = $req->id_po;
        $id_supplier = $req->id_supplier;
        $tgl_tiba = tanggalController($req->tgl_tiba);

        //insert ke p_order
        $model = new p_order;
        //
        $model->no_order = $no_order;
        $model->tgl_order =   $tgl_order;
        $model->id_po =   $id_po;
        $model->id_supplier =   $id_supplier;
        $model->tgl_tiba =   $tgl_tiba;
        $model->id_perusahaan =   Session::get('id_perusahaan_karyawan');
        $model->id_karyawan =   Session::get('id_karyawan');

        $model->save();
        //insert ke p_detail_order
        //cek jika id_po tdk kosong
        if($id_po !== NULL)
        {
          //ambil data dari p_detail_po yg id_ponya = dg $req->id_po
          $model_po = DetailPO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('id_po', $id_po)->get();

            foreach($model_po as  $value)
            {
                $id_order = $model->id;
                $id_barang = $value->id_barang;
                $harga_beli = $value->harga_beli;
                $jumlah_beli = $value->jumlah_beli;
                $diskon_item = $value->diskon_item;
                $jumlah_harga = $value->jumlah_harga;
                $id_perusahaan = Session::get('id_perusahaan_karyawan');
                $id_karyawan = Session::get('id_karyawan');

                $model_do = DB::table('p_detail_order')->insert(array(
                      'id_order'=>$id_order,
                      'id_barang'=>$id_barang,
                      'harga_beli'=>$harga_beli,
                      'jumlah_beli'=>$jumlah_beli,
                      'diskon_item'=>$diskon_item,
                      'jumlah_harga'=>$jumlah_harga,
                      'id_perusahaan'=>$id_perusahaan,
                      'id_karyawan'=>$id_karyawan
                ));
                /*if($model->save()){
                    Stok::updateStokAkhirPorder($model);
                }*/
              }

        }

        if($model->save()){
            return redirect('Pembelian')->with('message_success','data pembelian telah disimpan')->with('tab3','tab3');
        }else{
            return redirect('Pembelian')->with('message_error','data pembelian gagal disimpan')->with('tab3','tab3');
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
        $model->tgl_order = tanggalController($req->tgl_order);
        $model->id_po = $req->id_po;
        $model->id_supplier = $req->id_supplier;
        $model->tgl_tiba = tanggalController($req->tgl_tiba);

        if($model->save()){
            return redirect('Pembelian')->with('message_success','data pembelian telah disimpan')->with('tab3','tab3');
        }else{
            return redirect('Pembelian')->with('message_error','data pembelian gagal disimpan')->with('tab3','tab3');
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

    public function tambahDetailOrder(Request $req, $id)
    {
      $this->validate($req, [
          'id_barang' => 'required',
          'id_order' => 'required',
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

      if($req->expire_date == NULL){
        $expire_date = null;
      } else {
        $expire_date = tanggalController($req->expire_date);
      }

      $model_o = new DetailOrder;

      $model_o->id_order = $id;
      $model_o->id_barang = $req->id_barang;
      $model_o->harga_beli = rupiahController($req->harga_beli);
      $model_o->jumlah_beli =$req->jumlah_beli;
      $model_o->diskon_item = $req->diskon;
      $model_o->jumlah_harga = rupiahController($jumlah_harga);

      $model_o->expire_date = $expire_date;

      $model_o->id_perusahaan = Session::get('id_perusahaan_karyawan');
      $model_o->id_karyawan = Session::get('id_karyawan');
      if ($model_o->save()) {
          $update_stok = Stok::updateStokAkhirPembelian($model_o);
          if ($req->redirect == true) {
              return redirect()->back()->with('message_success', 'anda telah menambahkan item baru');
          }
      } else {
          return redirect()->back()->with('message_success', 'gagal menambahkan item baru');
      }

    }

    public function ubah_detail_order(Request $req, $id)
    {
         # code...
         $this->validate($req,[
            'id_barang'=> 'required',
            'jumlah_beli'=> 'required',
            'harga_beli'=>'required'
        ]);

        $id_barang = $req->id_barang;
        $harga_beli = rupiahController($req->harga_beli);
        $jumlah_beli = rupiahController($req->jumlah_beli);
        $diskon_item = rupiahController($req->diskon_item);

        if($req->expire_date == NULL){
          $expire_date = null;
        } else {
          $expire_date = tanggalController($req->expire_date);
        }

        $persen_diskon_item = $diskon_item/$harga_beli*100;
        $total_diskon = $diskon_item * $jumlah_beli;

        $sub_total = ($harga_beli  * $jumlah_beli) - $total_diskon;

            $model = DetailOrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);

            $model->id_barang = $id_barang;
            $model->harga_beli = $harga_beli;
            $model->jumlah_beli = $jumlah_beli;
            $model->diskon_item = $persen_diskon_item ;
            $model->jumlah_harga = $sub_total;
            $model->expire_date = $expire_date;
            $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
            $model->id_karyawan = Session::get('id_karyawan');


        if($model->save()){
//                $update_stok = Stok::updateStokAkhirPembelian($model);
        }

        return redirect()->back()->with('message_success','Data barang pembelian telah disimpan');
//          return redirect('Pembelian')->with('message_success', 'anda telah mengubah rincian pembelian')->with('tab3','tab3');
    }

    public function simpan_rincian_pembelian(Request $req, $id)
    {
           //=============================================================================
        $this->validate($req,[
            'bayar'=> 'required',
            'sub_total'=>'required'
        ]);
        //request assignment
        $diskon_tambahan = rupiahController($req->diskon_tambahan);
        $pajak = $req->pajak;
        $ongkir = rupiahController($req->onkir);
        $bayar = rupiahController($req->bayar);
        $dp_po = rupiahController($req->uang_muka);
        $metode_bayar = $req->metode_bayar;
        $tgl_jatuh_tempo = tanggalController($req->tgl_jatuh_tempo);
        $ket = $req->ket;
         $total_pajak =0;
        //$sub_total = total_belanja
        $sub_total = $req->sub_total;
        if(!empty($pajak)){
            $total_pajak = $sub_total *($pajak / 100);
        }
        //ketentuan mencari total_order (total_order) = sub_total + pajak + ongkir - diskon_tambahan
        $total_order = ($sub_total + $total_pajak + $ongkir) - $diskon_tambahan;

        //hutang/krg_bayar = sub_total - (bayar + uang_muka)
        $kurang_bayar = $total_order - ($bayar + $dp_po );

        //cek checkbox value on false
        if ($req->jurnal_otomatis == 'on') {
        // update p_order + insert jurnal umum
            $check_data_pembelian = JenisAkunPembelian::CheckAkunPembelian();
            #check akun pembelian kalau kosong == false
          if($check_data_pembelian==false){
              return redirect()->back()->with('message_fail','Isilah terlebih dahulu akun pembelian');
          }

          #Ambil Jenis Jurnal
          $jenis_jurnal = 0;
          $jenis_akun_pembelian = JenisAkunPembelian::rule($req->all(), 2);

          $model = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);

          if($req->onkir !=0){
             JenisAkunPembelian::$status_ongkir =true;
          }


          $model->diskon_tambahan = $diskon_tambahan;
          $model->pajak = $pajak;
          $model->dp_po = $dp_po;
          $model->bayar = $bayar;
          $model->kurang_bayar = $kurang_bayar;
          $model->metode_bayar = $metode_bayar;
          $model->tgl_jatuh_tempo = $tgl_jatuh_tempo;
          $model->ongkir = $ongkir;
          $model->ket = $ket;
          $model->total = $total_order;
          $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
          $model->id_karyawan = Session::get('id_karyawan');

          if($model->save()){
              # Insert Data Ke Jurnal
              if(is_array($jenis_akun_pembelian) == true){
                  $req->merge([
                      'ongkir'=> $ongkir,
                      'total_sebelum_pajak'=>$pajak,
                      'total'=> $total_order,
                      'tgl_order'=> $model->tgl_order,
                      'no_order'=>$model->no_order,
                      'id_pembelian'=> $model->id
                  ]);
                  JenisAkunPembelian::$new_request = $req;
                  $response =JenisAkunPembelian::get_akun_pembelian($jenis_akun_pembelian);
                  if(!empty($response)){
                      if($response['status']==false){
                        return redirect()->back()->with('message_fail',$response['message']);
                      }else{
                          return redirect()->back()->with('message_success','Data barang pembelian telah disimpan');
                      }
                  }else{
                    return redirect()->back()->with('message_success','Data barang pembelian telah disimpan');
                  }
              }
              }else{
                  return redirect()->back()->with('message_fail','data pembelian gagal disimpan');
              }
          //jika tanpa jurnal otomatis
        } else{
              $model = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
              $model->diskon_tambahan = $diskon_tambahan;
              $model->pajak = $pajak;
              $model->dp_po = $dp_po;
              $model->bayar = $bayar;
              $model->kurang_bayar = $kurang_bayar;
              $model->metode_bayar = $metode_bayar;
              $model->tgl_jatuh_tempo = $tgl_jatuh_tempo;
              $model->ongkir = $ongkir;
              $model->ket = $ket;
              $model->total = $total_order;
              $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
              $model->id_karyawan = Session::get('id_karyawan');

              if ($model->save()) {
                  return redirect()->back()->with('message_success', 'berhasil menambah data pembelian barang')->with('tab3','tab3');
              } else {
                  return redirect()->with('message_fail', 'gagal,membuat data pembelian barang')->with('tab3','tab3');
              }
        }
    }

    public function hapusDetailOrder(Request $req, $id)
    {
        $model = DetailOrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if ($model->delete()) {
            Stok::DeleteStokAkhirPembelian($model);
            return redirect()->back()->with('message_success', 'hapus barang pembelian berhasil');
        } else {
            return redirect()->back()->with('message_success', 'gagal hapus barang pembelian');
        }
    }
	
	 public function CetakPembelian($id)
    {
        $model_pb = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        return view('user.produksi.section.belibarang.order_pembelian.cetak', ['data'=> $model_pb, 'header'=>HeaderReport::header_format_2('layouts.header_print.header_print1','PEMBELIAN')]);
    }



}
