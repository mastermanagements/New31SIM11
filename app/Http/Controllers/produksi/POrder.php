<?php

namespace App\Http\Controllers\produksi;

use App\Http\Controllers\keuangan\JurnalUmum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PesananPembelian;
use App\Model\Produksi\Supplier;
use App\Model\Produksi\POrder as p_order;
use App\Model\Produksi\DetailOrder;
use Illuminate\Database\Eloquent\Model;
use App\Model\Produksi\Barang;
use App\Http\utils\SettingNoSurat;
use Session;
use App\Http\utils\JenisAkunPembelian;
use App\Http\utils\Stok;
class POrder extends Controller
{
    //
    private $metode_bayar = [
        'Tunai',
        'Kredit',
        'Transfer Bank',
    ];

    public function show($id)
    {
        $data =[
            'supplier'=> Supplier::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'pesana_pembelian'=>PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'data_order'=> p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'barang'=>Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'metode_pembayaran'=> $this->metode_bayar,
        ];
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
        ]);

     
        foreach ($req->id_barang as $key => $id_barang) {
            # code...

            $jumlah_harga =0;
            $sub_total = 0;
            $diskon=$req->diskon_item[$key];

            if(!empty($diskon)){
                $nilai_diskon = ($req->hpp[$key]+$req->jumlah_beli[$key])*($diskon/100);
                $sub_total = ($req->hpp[$key]+$req->jumlah_beli[$key])+$nilai_diskon;
            }else{
                $sub_total = ($req->hpp[$key]+$req->jumlah_beli[$key]);
            }

            $model = DetailOrder::updateOrCreate(
                [
                    'id_order'=>$id,
                    'id_barang'=>$id_barang,
                    'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
                ],
                [
                    'hpp'=>$req->hpp[$key],
                    'jumlah_beli'=>$req->jumlah_beli[$key],
                    'diskon_item'=>$diskon,
                    'jumlah_harga'=>$sub_total
                ]
            );

            # Todo Update stok akhir barang
            if($model){
                Stok::updateStokAkhirPorder($model);
            }
        }

        return redirect()->back()->with('message_success','Data barang pembelian telah disimpan');
    }

    public function ubah_detail_order(Request $req, $id)
    {
         # code...
         $this->validate($req,[
            'id_barang'=> 'required',
            'jumlah_beli'=> 'required',
            'diskon_item'=> 'required',
            'hpp'=> 'required',
        ]);

        foreach ($req->id_barang as $key => $id_barang) {
            # code...

            $jumlah_harga =0;
            $sub_total = 0;
            $diskon=$req->diskon_item[$key];

            if(!empty($diskon)){
                $nilai_diskon = ($req->hpp[$key]+$req->jumlah_beli[$key])*($diskon/100);
                $sub_total = ($req->hpp[$key]+$req->jumlah_beli[$key])+$nilai_diskon;
            }else{
                $sub_total = ($req->hpp[$key]+$req->jumlah_beli[$key]);
            }

            $model = DetailOrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
            $model->id_order = $model->id_order;
            $model->id_barang = $id_barang; 
            $model->id_perusahaan = Session::get('id_perusahaan_karyawan'); 
            $model->hpp = $req->hpp[$key];
            $model->jumlah_beli = $req->jumlah_beli[$key];
            $model->diskon_item = $diskon;
            $model->jumlah_harga = $sub_total;
            if($model->save()){
                Stok::updateStokAkhirPorder($model);
            }
        }
        return redirect()->back()->with('message_success','Data barang pembelian telah disimpan');
    }

    public function simpan_rincian_pembelian(Request $req, $id)
    {
        $this->validate($req,[
            'tgl_jatuh_tempo'=> 'required',
            'pajak'=> 'required',
            'onkir'=> 'required',
            'bayar'=> 'required',
            // 'kurang_bayar'=>'required',
            'diskon_tambahan'=> 'required',
            'sub_total'=>'required'
        ]);

        $check_data_pembelian = JenisAkunPembelian::CheckAkunPembelian();
        #check akun pembelian kalau kosong == false
        if($check_data_pembelian==false){
            return redirect()->back()->with('message_fail','Isilah terlebih dahulu akun pembelian');
        }

        #Ambil Jenis Jurnal
        $jenis_jurnal = 0;
        $jenis_akun_pembelian = JenisAkunPembelian::rule($req->all(), 2);

        $model = p_order::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        
        $pajak = 0;
        $diskon_tambahan = 0;

//        if($req->diskon_tambahan !=0){
//            $diskon_tambahan = $req->sub_total*($req->diskon_tambahan/100);
//       }
//      $total = ($req->sub_total+$diskon_tambahan+$pajak)-($req->bayar+$req->dp_po+(int)$req->onkir);
//        $sub_total = $req->sub_total-$diskon_tambahan;
//        $total_sebelum_pajak = (($req->bayar+$req->dp_po)-((int)$req->onkir));
//        $total = ($req->bayar+$req->dp_po)-(($sub_total)+(int)$req->onkir);

        if($req->pajak !=0){
//            $pajak = $total*($req->pajak/100);
            JenisAkunPembelian::$status_pajak = true;
        }

        if($req->onkir !=0){
           JenisAkunPembelian::$status_ongkir =true;
        }

        // Total di ambil dari req->total yang telah diproses dalam ajax dari front end
        $total = $req->total;

        $model->diskon_tambahan = $req->diskon_tambahan;
        $model->pajak = $req->pajak;
        $model->dp_po = $req->dp_po;
        $model->bayar = $req->bayar;
        $model->kurang_bayar = $req->kurang_bayar;
        $model->metode_bayar = $req->metode_bayar;
        $model->tgl_jatuh_tempo = date('Y-m-d', strtotime($req->tgl_jatuh_tempo));
        $model->ongkir = $req->onkir;
        $keterangan = "";
        $model->ket = $keterangan;
        $model->total = $total;
        if($model->save()){
            #Insert Data Ke Jurnal
            if(is_array($jenis_akun_pembelian) == true){
                $req->merge([
                    'ongkir'=> $req->onkir,
                    'total_sebelum_pajak'=>$pajak,
                    'total'=> $total,
                    'tgl_order'=> $model->tgl_order,
                    'no_order'=>$model->no_order,
                    'id_pembelian'=> $model->id
                ]);
                JenisAkunPembelian::$new_request = $req;
                JenisAkunPembelian::get_akun_pembelian($jenis_akun_pembelian);
            }

            return redirect()->back()->with('message_success','data pembelian telah disimpan');
        }else{
            return redirect()->back()->with('message_error','data pembelian gagal disimpan');     
        }
    }


}
