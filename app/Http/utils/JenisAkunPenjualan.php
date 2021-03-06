<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 24/02/2021
 * Time: 11:21
 */

namespace App\Http\utils;
use App\Model\Produksi\AkunPenjualan;
use Session;
use App\Model\Keuangan\Jurnal;

class JenisAkunPenjualan
{

    public static $new_request=false;
    public static $status_pajak;
    public static $metode_transaksi;
    public static $status_ongkir;

    # jenis Jurnal
    public static $jenis_jurnal = [
        'Pesanan Penjualan tunai',
        //'Pesanan Penjualan transfer',
        'Pesanan Penjualan tunai dengan pajak',
        //'Pesanan Penjualan transfer dg pajak',
        'Penjualan tunai tanpa pajak',
        'Penjualan tunai dengan pajak',
        'Penjualan kredit tanpa pajak',
        'Penjualan kredit dengan pajak',
        'Potongan penjualan tunai',
        'Beban angkut penjualan',
        'Return penjualan mengambalikan kas',
        'Return penjualan kurangi piutang',
        'Return penjualan kurangi piutang',
        'Return penjualan mengembalikan barang',
    ];

    # Metode Pembayaran
    public static $metode_pembayaran = [
        'Tunai',
        'Kredit'
        //'Transfer Bank',
    ];

    # Check Akun penjualan
    public static function CheckAkunPenjualan()
    {
        $data = AkunPenjualan::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->count();
		//dd($data);
	   if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }

    public static function rule($request, $metode_transaksi = null){
        # Initialisasi
        $initial_jenis = array();
        self::$metode_transaksi = $metode_transaksi;
        if($metode_transaksi == 1){ // Pesanan penjualan
            # Pesanan penjualan tunai tampa pajak
            if($request['pajak']==0){
                $jenis_array = [
                    0 => 'Pesanan Penjualan tunai',
                ];
                array_push($initial_jenis, $jenis_array);//add to initial_jenis
            }


            # Pesanan penjualan tunai dengan pajak
            if($request['pajak']!=0){
                $jenis_array = [
                    1 => 'Pesanan Penjualan tunai dengan pajak',
                ];
                array_push($initial_jenis, $jenis_array);//add to initial_jenis
            }


        }else if($metode_transaksi == 2){ // Penjualan

            # Pembelian tunai tanpa pajak (metode bayar : 0 = Tunai)
            if($request['metode_bayar']==0 && $request['pajak']==0){
                $jenis_array = [
                  4=>'Penjualan tunai tanpa pajak',
                ];
                array_push($initial_jenis, $jenis_array);//add to initial_jenis
            }

            # Pembelian tunai dengan pajak (metode bayar : 0 = Tunai)
            if($request['metode_bayar']==0 && $request['pajak'] !=0){
                $jenis_array= [
                   5=>'Penjualan tunai dengan pajak',
                ];
                array_push($initial_jenis, $jenis_array);//add to initial_jenis
            }

            # Pembelian kredit tanpa pajak (metode bayar : 1 = kredit)
            if($request['metode_bayar']==1 && $request['pajak'] ==0){
                $jenis_array= [
                    6=>'Penjualan kredit dengan pajak',
                ];
                array_push($initial_jenis, $jenis_array);//add to initial_jenis
            }

            # Pembelian kredit dengan pajak (metode bayar : 1 = kredit)
            if($request['metode_bayar']==1 && $request['pajak'] !=0){
                $jenis_array= [
                   7=>'Penjualan kredit dengan pajak',
                ];
                array_push($initial_jenis, $jenis_array);//add to initial_jenis
            }

            # Beban angkut pembelian
            if($request['ongkir'] !=0){
                $jenis_array= [
                  9=>'Beban angkut penjualan',
                ];
                array_push($initial_jenis, $jenis_array); //add to initial_jenis
            }
        }else if($metode_transaksi == 3){
            # Return pembelian tunai

            # Return pembelian kredit
        }

        # kembalikan nilai balik initial_jenis
        # 1. Kalau kosong kembalian kan false
        # 2. Kalau tidak kembalikan array $initial_jenis
        if(empty($initial_jenis)){
            return false;
        }else{
            return $initial_jenis;
        }
    }

    # Function export jurnal di pindahkan disini agar lebih mudah digunakan dengan kontroller lain.
    private static function set_data($index_jenis_barang){
        $model = AkunPenjualan::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_jurnal',''.$index_jenis_barang)->first();
        $new_q = self::$new_request;
        if(!empty($model)){
            $data = $model->linkToOneKetTransaksi->dataAkun->toArray();

            $last_key=null;
            $total_sebelum_sesudah_pajak =0;
            if(self::$status_pajak == true){
                $build_array = self::group_array($data);
                $last_key = array_key_last($build_array[0]); // Jika ada akun pajak diasumsikan di array terakhir
            }


            $total = 0;
            foreach ($data as $key=>$akun){

                // menyamakan key terakhir untuk meletakkan besaran pajak
                if(!empty($last_key)){
                    if($last_key == $key){
                        $total = $new_q['total_sebelum_pajak'];
                    }else{
                        $total += $new_q['total'];
                    }
                }else{
                //  Jika bukan pajak maka total yang akan diambil sudah dijumlahkan
                    $total = $new_q['total'];
                }

                if ($index_jenis_barang == 8)
                {
                    $total = $new_q['ongkir'];
                }

                if(self::$metode_transaksi==1){
                    $metode_transaksi='Pesanan Penjualan';
                }else if(self::$metode_transaksi==2){
                    $metode_transaksi='Penjualan';
                }

                $njurnal = Jurnal::updateOrCreate(
                    [
                        'id_pesanan_penjualan'=>$new_q['id_pesanan_penjualan'],
                        'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                        'id_ket_transaksi' => $akun['id_ket_transaksi'],
                        'id_akun_aktif'=> $akun['id_akun_aktif'],
                    ]
                    ,[
                        'jenis_jurnal'=>'1',
                        'tgl_jurnal'=> $new_q->tgl_order,
                        'no_transaksi'=> $new_q->no_order,
                        'ket'=>$metode_transaksi.'/'.$new_q->no_order,
                        'debet_kredit'=> $akun['posisi_akun'],
                        'jumlah_transaksi'=>$total,
                        'id_karyawan'=>Session::get('id_karyawan'),
                    ]
                );

                if(self::$metode_transaksi==1){
                    $njurnal->id_pesanan_penjualan = $new_q['id_pesanan_penjualan'];
                }else if(self::$metode_transaksi==2){
                    $njurnal->id_penjualan=$new_q['id_penjualan'];
                }
                $njurnal->save();
            }
        }
    }

    public static function get_akun_penjualan($array){

        foreach ($array as $data)
        {
            if (self::cek_akun_penjualan(array_keys($data)[0]) == true){
                self::set_data(array_keys($data)[0]);
            }else{
                return [
                    'message'=>'Akun belum diisi',
                    'status'=> false
                ];
            }
        }
    }

    public static function cek_akun_penjualan($index_jenis_barang){
        $model = AkunPenjualan::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_jurnal',''.$index_jenis_barang)->first();
		//dd($model);
        if(!empty($model)){
            return true;
        }else{
            return false;
        }
    }


    private static function group_array($array){
        $new_array = [];
        foreach ($array as $key=> $item){
            $new_array[$item['posisi_akun']][$key]= $item;
        }
        return $new_array;
    }

}
