<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\DetailSales as DS;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Administrasi\GroupKlien;
use App\Model\Administrasi\Klien;
class RincianSales extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
      $this->validate($req,[
          'id_sales'=> 'required',
          'id_barang'=> 'required',
          'hpp'=> 'required',
          'jumlah_jual'=> 'required',
          'diskon'=> 'required',
          'jumlah_harga'=> 'required',
      ]);

      $diskon_group = $this->penentuan_diskon($req,$req->id_sales);
      if($diskon_group !=0){
          $diskon = $req->jumlah_harga*($diskon_group/100);
          $total = $req->jumlah_harga-$diskon;
      }
      $model = new DS();
      $model->id_sales = $req->id_sales;
      $model->id_barang = $req->id_barang;
      $model->hpp = $this->check_metode_jual($req);

      $model->jumlah_jual = $req->jumlah_jual;
      $model->diskon = $diskon_group;
      $model->jumlah_harga = $total;
      $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
      if($model->save()){
          return redirect()->back()->with('message_success','Data Barang telah ditambahkan');
      }else{
          return redirect()->back()->with('message_fail','Data Barang gagal ditambahkan');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function check_metode_jual($req){
        $hpp=0;
        $model = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($req->id_barang);
        if(!empty($model)){
            if($model->metode_jual == '0'){
                $hpp = $model->linkToHargaJual->harga_jual;
            }elseif($model->metode_jual=='1'){
                if($req->jumlah_jual <= $model->linkToHargaBaseOneJumlah->jumlah_maks_brg){
                    $hpp = $model->linkToHargaBaseOneJumlah->harga_jual;
                }
            }
        }
        return $hpp;
    }

    private function penentuan_diskon_sebenarnya($req, $diskon_nominal){
        $total_sebenarnya = ($req->jumlah_jual * $req->jumlah_harga);
        $total_setelah_diskon = ($req->jumlah_jual * $req->jumlah_harga) - $diskon_nominal;
        $diskon = (($total_setelah_diskon / $total_sebenarnya)*100)-100;
        return $diskon;
    }

    private function penentuan_diskon($req,$id_sales){
        $model = DS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_sales);
        $model_group_klien = $model->linkToSales->linkToKlien->linkToMannyGroupKlien;
        #initial diskon
        $diskon = 0;
        $data_p_diskon = null;
        # Jika Model Group Klien Kosong
        if(empty($model_group_klien)){
            # Penjualan Normal Tampa diskon
            $diskon = 0;
        }
        # Jika model group tidak kosong
        else if(!empty($model_group_klien)){
            # Ambil record dari data p diskon
            $data_p_diskon= $model_group_klien->linkToPDiskon;
        }
        if($data_p_diskon !=null){
            # Cek Jenis diskon =0
            if($data_p_diskon->jenis_diskon =='0'){
                if(($model->sum('jumlah_jual') <= $data_p_diskon->jumlah_maks_beli) && $data_p_diskon->diskon_persen ==null){
                    $diskon = $this->penentuan_diskon_sebenarnya($req,$data_p_diskon->diskon_nominal);
                }

                if(($model->sum('jumlah_jual') <= $data_p_diskon->jumlah_maks_bel) && $data_p_diskon->diskon_persen !=null){
                    $diskon = $data_p_diskon->diskon_persen;
                }
            }
            else if($data_p_diskon->jenis_diskon =='1'){
                if($data_p_diskon->diskon_persen == null){
                    $diskon = $diskon = $this->penentuan_diskon_sebenarnya($req,$data_p_diskon->diskon_nominal);
                }else{
                    $diskon = $data_p_diskon->diskon_persen;
                }
            }
        }

        return $diskon;
    }
}
