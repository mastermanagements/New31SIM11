<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\PSO;
use App\Model\Produksi\PSales;
use App\Model\Produksi\PTerimaBayar;
use App\Model\Produksi\RekUkm as rek_ukm;
use App\Model\Administrasi\RekKlien as rek_klien;
use Session;


class TerimaBayar extends Controller
{
    //
    private $metode_bayar = [
        'Transfer Bank',
        'Cek',
        'Langsung/Tunai'
        //'Return barang jual',
    ];

    private $jenis_pembayaran = [
        'Bayar Pesanan Penjualan',
        'Bayar Penjualan'
      //  'return Barang'
    ];

    public function form_terima_bayar($jenis_bayar,$id){
        if($jenis_bayar == 0){
            $data = PSO::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        }elseif($jenis_bayar == 1){
            $data = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        }
        $data = [
            'data' => $data,
            'metode_bayar'=> $this->metode_bayar,
            'jenis_bayar'=> $this->jenis_pembayaran,
            'jenis_bayars'=> $jenis_bayar,
            'rek_asal'=>rek_klien::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->get(),
            'rek_tujuan'=>rek_ukm::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->get()
        ];
//        dd($data);
        return view('user.produksi.section.jualbarang.TerimaBayar.page_create',$data);
    }

    public function rincian($jenis_bayar,$id){

        if($jenis_bayar == 0){
            $data = PSO::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        }elseif($jenis_bayar == 1){
            $data = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        }

        $data = [
            'data' => $data,
        ];
        return view('user.produksi.section.jualbarang.TerimaBayar.page_rincian',$data);
    }

    public function store(Request $req){
      //dd($req->all());
        $this->validate($req, [
            'id'=>'required',
            'tgl_bayar'=>'required',
            'metode_bayar'=>'required',
            'bank_asal'=>'required',
            'bank_tujuan'=>'required',
            'jumlah_bayar'=>'required',
            'bukti_bayar'=> 'required|image|mimes:jpg,jpeg,png'

        ]);
        $set_id_so = 0;
        $set_id_sales = 0;
        $set_id_return = 0;
        if($req->jenis_bayar == 0){
            $set_id_so = $req->id;
        }else if($req->jenis_bayar == 1){
            $set_id_sales = $req->id;
        }else if($req->jenis_bayar == 2){
            $set_id_return =$req->id;
        }
        $bukti_bayar=  $req->bukti_bayar;

            $nama_file_bukti= time()."-buktibayar.".$bukti_bayar->getClientOriginalExtension();
            
        $model =new PTerimaBayar(
            [
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                'id_karyawan'=> Session::get('id_karyawan'),
                'id_so'=> $set_id_so,
                'id_sales'=> $set_id_sales,
                'id_return_barang'=> $set_id_return,
                'jenis_bayar'=>$req->jenis_bayar,
                'tgl_bayar'=>date('Y-m-d', strtotime($req->tgl_bayar)),
                'metode_bayar'=> $req->metode_bayar,
                'bank_asal'=>$req->bank_asal,
                'bank_tujuan'=>$req->bank_tujuan,
                'jumlah_bayar'=>rupiahController($req->jumlah_bayar),
                'bukti_bayar'=>$nama_file_bukti,
            ]
        );

        if($model->save())
        {
          if($bukti_bayar->move(public_path('buktiBayar')))
            {
            return redirect('Penjualan')->with('message_success','Berhasil menambah data pembayaran')->with('tab5','tab5');
            }else{
                return redirect('Penjualan')->with('message_error','Gagal menyimpan data pembayaran')->with('tab5','tab5');
            }

            return redirect('Penjualan')->with('message_success','Berhasil mengubah Data Karyawan');
        }
    }

    public function edit($jenis_bayars,$id){
        if($jenis_bayars == 0){
            $data = PSO::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        }elseif($jenis_bayars == 1){
            $data = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        }

        $data = [
            'data' => $data,
            'metode_bayar'=> $this->metode_bayar,
            'jenis_bayar'=> $this->jenis_pembayaran,
            'jenis_bayars'=> $jenis_bayars,
        ];
        return view('user.produksi.section.jualbarang.TerimaBayar.page_edit',$data);
    }

    public function update(Request $req, $id){
        $this->validate($req, [
            'id'=>'required',
            'no_transaksi'=>'required',
            'klien'=>'required',
            'tgl_bayar'=>'required',
            'metode_bayar'=>'required',
            'bank_asal'=>'required',
            'rek_asal'=>'required',
            'nama_asal'=>'required',
            'bank_tujuan'=>'required',
            'no_rek_tujuan'=>'required',
            'jumlah_bayar'=>'required',
            'terima_bukti'=>'required',
        ]);
        $set_id_so = 0;
        $set_id_sales = 0;
        $set_id_return = 0;
        if($req->jenis_bayar == 0){
            $set_id_so = $req->id;
        }else if($req->jenis_bayar == 1){
            $set_id_sales = $req->id;
        }else if($req->jenis_bayar == 2){
            $set_id_return =$req->id;
        }
        $model =PTerimaBayar::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
            $model->id_perusahaan= Session::get('id_perusahaan_karyawan');
            $model->id_so= $set_id_so;
            $model->id_sales= $set_id_sales;
            $model->id_return_barang= $set_id_return;
            $model->jenis_bayar= $req->jenis_bayar;
            $model->tgl_bayar= date('Y-m-d', strtotime($req->tgl_bayar));
            $model->metode_bayar= $req->metode_bayar;
            $model->bank_asal= $req->bank_asal;
            $model->rek_asal= $req->rek_asal;
            $model->nama_asal= $req->nama_asal;
            $model->bank_tujuan=$req->bank_tujuan;
            $model->no_rek_tujuan= $req->no_rek_tujuan;
            $model->jumlah_bayar=$req->jumlah_bayar;
            $model->terima_bukti= $req->terima_bukti;
        if($model->save()){
            return redirect('Penjualan')->with('message_success','Data telah disimpan');
        }else{
            return redirect('Penjualan')->with('message_fail','Data gagal disimpan');
        }
    }

    public function destroy($id)
    {
        $model =PTerimaBayar::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findorFail($id);
        //dd($model);
        if($model->delete()){
            return redirect('Penjualan')->with('message_success','Data telah disimpan')->with('tab5','tab5');
        }else{
            return redirect('Penjualan')->with('message_fail','Data gagal disimpan')->with('tab5','tab5');
        }
    }
}
