<?php

namespace App\Http\Controllers\produksi;

use App\Http\utils\Stok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\DetailSales as DS;
use App\Model\Produksi\Barang;
use App\Model\Produksi\HargaJualBaseOnJumlah as harga_jum;
use App\Model\Produksi\PDiskon;
use Session;
use App\Model\Produksi\PSales;
use App\Model\Administrasi\GroupKlien;
use App\Model\Administrasi\Klien;

class DetailSales extends Controller
{
    //
    private function check_metode_jual($req){
      //penentuan harga jual
        $hpp=0;
        $model = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($req->id_barang);

        if(!empty($model)){
          //jika p_barang.metode_jual =  0 (harga jual satu harga)
            if($model->metode_jual == '0'){
              //ambil p_harga_jual_satuan.harga_jual
                $hpp = $model->linkToHargaJual->harga_jual;
                //dd($hpp);
             //jika p_barang.metode_jual = 1 (harga jual based on jumlah beli)

           }elseif($model->metode_jual=='1'){
             $model_b = harga_jum::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('id_barang',$req->id_barang)->get();
             //dd($model_b);
             foreach($model_b as $b){
               if($req->jumlah_jual <= $b->jumlah_maks_brg){
                 $hpp = $b['harga_jual'];
                 break;
                 //dd($hpp);

                }

              }

            }
        }
        return $hpp;

    }

    private function penentuan_diskon_sebenarnya($req, $diskon_nominal){
        #persentase diskon

        $harga_jual_satuan= $this->check_metode_jual($req);
        $diskon = ($diskon_nominal / $harga_jual_satuan)*100;
        $diskon = round($diskon,2);
        return $diskon;

    }

    private function penentuan_diskon($req,$id_sales){
      //ambil p_sales.id
        $model = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id_sales);
        //dd($model);
        //ambil jenis group klien dari klien yg beli di p_sales.id_klien->p_klien.id_group->a_group_klien.id
        //1. diskon berdasarkan group klien (member)
        $model_group_klien = $model->linkToKlien->linkToMannyGroupKlien;
        $model_diskon_klien = $model->linkToKlien;
        //dd($model_group_klien);
        //dd($model_diskon_klien);
        #initial diskon
        $diskon = 0;
        $data_p_diskon = null;
        # Jika Model Group Klien Kosong (klien biasa) dan tdk ada status diskon
        if(empty($model_group_klien) AND ($model_diskon_klien->status_diskon =='1')){
            # Penjualan Normal Tampa diskon group tapi bisa jadi diskon di input manual
            //$diskon = 0;
            $diskon = $req->diskon_item;
            //dd($diskon);

          # jika diskon berdasarkan jumlah penjualan tapi bukan member
          }elseif(empty($model_group_klien) AND ($model_diskon_klien->status_diskon =='0')){
          $model_d = PDiskon::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_diskon', '0')->get();
          //dd($model_d);

            foreach($model_d as $d){
              #jika diskon nominal
              if($req->jumlah_jual <= $d->jumlah_maks_beli  && $d->diskon_persen =='0'){
                $diskon = $this->penentuan_diskon_sebenarnya($req,$d->diskon_nominal);
                break;

               #jika diskon persen
             }elseif($req->jumlah_jual <= $d->jumlah_maks_beli  && $d->diskon_nominal =='0'){
                $diskon = $d->diskon_persen;
                break;
              }
            }
          }

        # Jika diskon berdasarkan  member
        else if(!empty($model_group_klien)){
            # Ambil record dari data p diskon (p_diskon.id_group = p_group.id)
            $data_p_diskon= $model_group_klien->linkToPDiskon;
            //dd($data_p_diskon);
        }
        if($data_p_diskon !=null){
            # Cek Jenis diskon =1 (meber)
              if($data_p_diskon->jenis_diskon =='1'){
                  if($data_p_diskon->diskon_persen == '0'){
                      $diskon = $this->penentuan_diskon_sebenarnya($req,$data_p_diskon->diskon_nominal);
                  }else{
                      $diskon = $data_p_diskon->diskon_persen;
                      //dd($diskon);
                  }
              }


        }

        return $diskon;
        //dd($diskon);
    }

    public function store(Request $req){

         $this->validate($req,[
            'id_sales'=> 'required',
            'id_barang'=> 'required',
            //'hpp'=> 'required',
            'jumlah_jual'=> 'required',
            'diskon_item'=> 'required',
            'jumlah_harga'=> 'required',
        ]);

        //panggil harga_jual
        $hpp = $this->check_metode_jual($req);
        //panggil nilai diskon
        $diskon_group = $this->penentuan_diskon($req,$req->id_sales);
        //dd($diskon_group);
            $diskon_peritem = $hpp * ($diskon_group/100);

            $diskon_total = $diskon_peritem * $req->jumlah_jual;

            $total = $hpp*$req->jumlah_jual -$diskon_total;

        $model = new DS();
        $model->id_sales = $req->id_sales;
        $model->id_barang = $req->id_barang;
        $model->hpp = $hpp ;
        //dd($model->hpp);
        $model->jumlah_jual = $req->jumlah_jual;
        $model->diskon = $diskon_group;
        //dd($model->diskon);
        $model->jumlah_harga = $total;
        //dd($model->jumlah_harga);
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            Stok::UpdateStokAkhirPenjualan($model);
            return redirect()->back()->with('message_success','Data Barang telah ditambahkan');
        }else{
            return redirect()->back()->with('message_fail','Data Barang gagal ditambahkan');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            //'id_barang'=> 'required',
            'hpp'=> 'required',
            'jumlah_jual'=> 'required',
            'diskon'=> 'required',
            //'jumlah_harga'=> 'required',
        ]);

        $model = DS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrfail($id);
/*<<<<<<< HEAD
        $diskon_group = $this->penentuan_diskon($req,$model->id_sales);
        $total = 0;
        $total =  $this->check_metode_jual($req)*$req->jumlah_jual;
        if($diskon_group !=0){
            $diskon = $total*($diskon_group/100);
            $total = $total-$diskon;
        }
=======*/

            $hpp = rupiahController($req->hpp);
            $diskon = $req->diskon;
            $diskon_peritem = $hpp * ($diskon/100);

            $diskon_total = $diskon_peritem * $req->jumlah_jual;

            $total = $hpp*$req->jumlah_jual -$diskon_total;
//>>>>>>> master

        $model->id_barang = $req->id_barang;
        $model->hpp =  $hpp;
        $model->jumlah_jual = $req->jumlah_jual;
        $model->diskon = $diskon;
        $model->jumlah_harga = $total;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect()->back()->with('message_success','Data Barang telah diubah');
        }else{
            return redirect()->back()->with('message_fail','Data Barang gagal diubah');
        }
    }

    public function destroy($id)
    {
        $model = DS::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrfail($id);
        if($model->delete()){
            Stok::DeleteStokAkhirPenjualan($model);
            return redirect()->back()->with('message_success','Data Barang telah dihapus');
        }else{
            return redirect()->back()->with('message_fail','Data Barang gagal dihapus');
        }
    }
}
