<?php

namespace App\Http\Controllers\produksi;

use App\Http\utils\HeaderReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as klien;
use App\Model\Produksi\KomisiSales as komisi_sales;
use App\Model\Produksi\PSO;
use App\Model\Produksi\PSales as PS;
use App\Model\Produksi\Barang;
use App\Model\Produksi\ComplainBarangJual as CBJ;
use App\Http\utils\SettingNoSuratSO;
use Session;
use App\Http\utils\JenisAkunPenjualan;

class PSales extends Controller
{
    //
    public $metode_bayar;

    public function __construct()
    {
        $this->metode_bayar = JenisAkunPenjualan::$metode_pembayaran;
    }

    public function create(){
        $pass = [
            'no_surat' => SettingNoSuratSO::no_sale(),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_create', $pass);
    }

    public function show($id_p_sales){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $pass = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> $model,
            'metode_pembayaran'=>$this->metode_bayar,
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_show', $pass);
    }

    public function complain($id_p_sales){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $pass = [
            'data'=> $model,
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'complain_barang' => CBJ::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        //dd($pass['complain_barang']);
        return view('user.produksi.section.jualbarang.penjualan.page_complain', $pass);
    }

    public function store(Request $req){

        $this->validate($req,[
            'no_sales'=> 'required',
            'tgl_sales'=> 'required',
            'id_klien' => 'required',
            //'tgl_kirim' => 'required',
            //'id_komisi_sales'=> 'required'
        ]);

        $model = new PS();
        $model->tgl_sales = date('Y/m/d', strtotime($req->tgl_sales));
        $model->id_so = $req->id_so;
        $model->no_sales = $req->no_sales;
        $model->id_klien = $req->id_klien;
        $model->tgl_kirim = date('Y/m/d', strtotime($req->tgl_kirim));
        $model->id_komisi_sales = $req->id_komisi_sales;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');

        if($model->save()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah disimpan')->with('tab4','tab4');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal disimpan')->with('tab4','tab4');
        }
    }

    public function edit($id_p_sales){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        $pass = [
            'klien'=> klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pesanan_jual' => PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'komisi_sales' => komisi_sales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data'=> $model,
        ];
        return view('user.produksi.section.jualbarang.penjualan.page_edit', $pass);
    }

    public function update(Request $req, $id){
      //dd($req->all());
        $this->validate($req,[
            'no_sales'=> 'required',
            'tgl_sales'=> 'required',
            'id_klien' => 'required',
          //  'tgl_kirim' => 'required',
          //  'id_komisi_sales'=> 'required'
        ]);

        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->tgl_sales = date('Y/m/d', strtotime($req->tgl_sales));
        $model->no_sales = $req->no_sales;
        $model->id_so = $req->id_so;
        $model->id_klien = $req->id_klien;
        $model->tgl_kirim = date('Y/m/d', strtotime($req->tgl_kirim));
        $model->id_komisi_sales = $req->id_komisi_sales;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');

        if($model->save()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah diubah')->with('tab4','tab4');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal diubah')->with('tab4','tab4');
        }
    }

    public function destroy(Request $req, $id){
        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('Penjualan')->with('message_success','Data penjualan telah dihapus');
        }
        else{
            return redirect('Penjualan')->where('message_fail','Data penjualan gagal dihapus');
        }
    }

    public function updateDetail(Request $req, $id_p_sales){
        dd($req->all());
        $this->validate($req,[
            'bayar' => 'required',
            'sub_total'=> 'required',
        ]);
        //request assignment
        $diskon_tambahan = rupiahController($req->diskon_tambahan);
        $pajak = $req->pajak;
        $ongkir = rupiahController($req->ongkir);
        $bayar = rupiahController($req->bayar);
        $dp_so = rupiahController($req->dp_so);
        $metode_bayar = $req->metode_bayar;

        if($req->tgl_jatuh_tempo == NULL){
            $tgl_jatuh_tempo = NULL;
        }
        else {
          $tgl_jatuh_tempo = tanggalController($req->tgl_jatuh_tempo);
        }

        $ket = $req->ket;

        //$sub_total = total penjualan
        $sub_total = $req->sub_total;

        $total_pajak = $sub_total *($pajak / 100);

        //ketentuan mencari total penjualan net = sub_total + pajak + ongkir - diskon_tambahan
        $total_sales = ($sub_total + $total_pajak + $ongkir) - $diskon_tambahan;

        //hutang/krg_bayar = sub_total - (bayar + uang_muka)
        $kurang_bayar = $total_sales - ($bayar + $dp_so );

        //cek checkbox value on false
        if ($req->jurnal_otomatis == 'on') {
          $check_data_penjualan = JenisAkunPenjualan::CheckAkunPenjualan();
          #check akun penjualan kalau kosong == false
          if($check_data_penjualan==false){
              return redirect()->back()->with('message_fail','Isilah terlebih dahulu akun penjualan');
          }

          $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
          $model->diskon_tambahan = $diskon_tambahan;
          $model->pajak = $pajak;
          $model->dp_so = $dp_so;
          $model->bayar = $bayar;
          $model->kurang_bayar = $kurang_bayar;
          $model->metode_bayar = $metode_bayar;
          $model->ongkir = $ongkir;
          $model->tgl_jatuh_tempo = $tgl_jatuh_tempo;
          $total_net = 0;

          if($model->metode_bayar == 0){
              $total_net = $total_sales;
          }else{
              $total_net = $bayar;
          }

          $model->total = $total_net;
          $model->keterangan = $req->ket;
          $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
          $model->id_karyawan = Session::get('id_karyawan');

          #Ambil Jenis Jurnal
          $jenis_jurnal = 0;
          $n_req=$req->merge( ['ongkir'=> $model->ongkir]);
          $jenis_akun_penjualan = JenisAkunPenjualan::rule($n_req, 2);
          if ($model->pajak !=0){
              JenisAkunPenjualan::$status_pajak = true;
          }

          if ($model->ongkir){
              JenisAkunPenjualan::$status_ongkir = true;

          }
          if($model->save()){

              if(is_array($jenis_akun_penjualan) == true){
                  $req->merge([
                      'ongkir'=> $req->onkir,
                      'total_sebelum_pajak'=>$model->pajak,
                      'total'=> $model->total,
                      'tgl_order'=> $model->tgl_sales,
                      'no_order'=>$model->no_sales,
                      'id_penjualan'=> $model->id
                  ]);
                  JenisAkunPenjualan::$new_request = $req;
                  $response=JenisAkunPenjualan::get_akun_penjualan($jenis_akun_penjualan);
                  if(!empty($response)){
                      if($response['status']==false){
                          return redirect()->back()->with('message_fail','Akun Penjualan Belum dibuat');
                      }else{
                          return redirect()->back()->with('message_success','Data Penjualan telah disimpan');
                      }
                  }else{
                      return redirect()->back()->with('message_success','Data Penjualan telah disimpan');
                  }
              }

              return redirect('Penjualan')->with('message_success','Data penjualan telah diubah');
          }
          else{
              return redirect('Penjualan')->where('message_fail','Data penjualan gagal diubah');
          }

      } else {

        $model = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_p_sales);
        //dd($req->all());
        $model->diskon_tambahan = $diskon_tambahan;
        $model->pajak = $pajak;
        $model->dp_so = $dp_so;
        $model->bayar = $bayar;
        $model->kurang_bayar = $kurang_bayar;
        $model->metode_bayar = $metode_bayar;
        $model->ongkir = $ongkir;
        $model->tgl_jatuh_tempo = $tgl_jatuh_tempo;
        $model->total = $total_sales;
        $model->keterangan = $req->ket;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');

            if ($model->save()) {
                return redirect()->back()->with('message_success', 'berhasil input transaksi penjualan')->with('tab4','tab4');
            } else {
                return redirect('Penjualan')->with('message_error', 'gagal input transaksi penjualan')->with('tab4','tab4');
            }
      }

  }

  public function cetak_nota_penjualan($id_penjualan){
        $penjualan = PS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_penjualan);
        $data = [
            'data'=> $penjualan,
            'header'=> HeaderReport::header_format_2('layouts.header_print.header_print1','INVOICE')
        ];
        return view('user.produksi.section.jualbarang.penjualan.cetak_nota_penjualan', $data);
  }

}
