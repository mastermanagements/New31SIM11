<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PesananPembelian;
use Session;
use App\Model\Produksi\Bayar as bayar_;
use App\Model\Produksi\POrder;
use App\Model\Produksi\RekUkm as rek_ukm;
use App\Model\Produksi\RekSupplier as rek_sup;
class Bayar extends Controller
{
    //
    private $metode_bayar = [
      'Transfer Bank',
      'Cek',
      'Tunai'
    ];

    private $pembayaran = [
        'Pre-Order',
        'Order'
    ];

    private function url($jenis_pembayaran){
        if($jenis_pembayaran==0){
            $url = 'bayar-po';
        }else{
            $url = 'bayar-order';
        }
        return $url;
    }

    public function show_po($id, $jenis_pembayaran){
        $data = [
            'metode_bayar'=> $this->metode_bayar,
            'label_jenis_pembayaran'=>$this->pembayaran[$jenis_pembayaran],
            'jenis_pembayaran'=>$jenis_pembayaran,
            'data'=> $data=PesananPembelian::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'id_po'=> $data->id,
            'url'=>$this->url($jenis_pembayaran),
            'tgl_bayar'=> date('d-m-Y'),
            'rek_asal'=>rek_ukm::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->get(),
            'rek_tujuan'=>rek_sup::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->get()
        ];
        return view('user.produksi.section.belibarang.bayar.page_bayar', $data);
    }

    public function show_order($id, $jenis_pembayaran){

        $data_porder=POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);

        #inisialisasi jumlah bayar
        $jumlah_bayar = 0;

        # cek metode pembayaran
        # jika metode tunail
        if($data_porder->metode_bayar==0){
            #jika tunai maka ambil dari p_order.bayar
            $jumlah_bayar = $data_porder->bayar;
        }
        else{
            #jika hutang ambil dari p_order.kurang_barangg
            $jumlah_bayar = $data_porder->kurang_bayar;
        }

        $data = [
            'metode_bayar'=> $this->metode_bayar,
            'label_jenis_pembayaran'=>$this->pembayaran[$jenis_pembayaran],
            'jenis_pembayaran'=>$jenis_pembayaran,
            'data'=> $data_porder,
            'id_order'=> $data_porder->id,
            'url'=>$this->url($jenis_pembayaran),
            'jumlah_bayar'=> $jumlah_bayar,
            'tgl_bayar'=> date('d-m-Y'),
            'rek_asal'=>rek_ukm::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->get(),
            'rek_tujuan'=>rek_sup::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->get()
        ];
        return view('user.produksi.section.belibarang.bayar.page_order', $data);
    }

    public function bayar_po(Request $req){
      //dd($req->all());
        $this->validate($req,[
            'id_po'=> 'required',
            'jenis_bayar'=> 'required',
            'tgl_bayar'=> 'required',
            'metode_bayar'=> 'required',
            'jumlah_bayar'=> 'required',
            'bank_asal'=> 'required',
            'bank_tujuan'=> 'required',
        ]);

        $model = new bayar_(
            [
                'id_po'=> $req->id_po,
                'metode_bayar'=> $req->metode_bayar,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                'id_karyawan'=> Session::get('id_karyawan'),
                'jenis_bayar'=>$req->jenis_bayar,
                'tgl_bayar'=> tanggalController($req->tgl_bayar),
                'bank_asal' => $req->bank_asal,
                'bank_tujuan'=> $req->bank_tujuan,
                'jumlah_bayar'=> rupiahController($req->jumlah_bayar),
            ]
        );

        if($model->save()){
            return redirect('Pembelian')->with('message_success','Nota pembayaran telah disimpan')->with('tab4','tab4');
        }else{
            return redirect('Pembelian')->with('message_fail','Nota pembayaran gagal disimpan')->with('tab4','tab4');
        }
    }

    public function show_rincian($id){
        $data_porder=POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        return view('user.produksi.section.belibarang.bayar.page_rincian_bayar',['data'=> $data_porder]);
    }

    public function bayar_order(Request $req){
      //dd($req->all());
        $this->validate($req,[
            'id_order'=> 'required',
            'jenis_bayar'=> 'required',
            'tgl_bayar'=> 'required',
            'metode_bayar'=> 'required',
            'jumlah_bayar'=> 'required',
            'bank_asal'=> 'required',
            'bank_tujuan'=> 'required',

        ]);

        $model = new bayar_(
            [
                'id_order'=> $req->id_order,
                'metode_bayar'=> $req->metode_bayar,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                'id_karyawan'=> Session::get('id_karyawan'),
                'jenis_bayar'=>$req->jenis_bayar,
                'tgl_bayar'=> tanggalController($req->tgl_bayar),
                'bank_asal' => $req->bank_asal,
                'bank_tujuan'=> $req->bank_tujuan,
                'jumlah_bayar'=> rupiahController($req->jumlah_bayar),
            ]
        );
      //  dd($model);
          if($model->save()){
            return redirect('Pembelian')->with('message_success','Nota pembayaran telah disimpan');
        }else{
            return redirect('Pembelian')->with('message_fail','Nota pembayaran gagal disimpan');
        }
    }

}
