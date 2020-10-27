<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 12/10/2020
 * Time: 8:31
 */

namespace App\Http\utils\data;
use App\Model\Keuangan\Jurnal;
use Session;
class JurnalUmum
{

    public static $date_awal;
    public static $date_akhir;

    public static function data_jurnal_umum($array)
    {
        try{

            if(!empty(self::$date_awal) && !empty(self::$date_akhir)){
                $model_jurnal = Jurnal::whereBetween('tgl_jurnal',[self::$date_awal, self::$date_akhir])->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
            }else{
                $model_jurnal = Jurnal::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
            }
            $row=array();
            $total_sum_debet =0;
            $total_sum_kredit=0;
            foreach ($model_jurnal as $data_jurnal){
                $column = array();
                $nilai_debet = 0;
                $nilai_kredit = 0;
                $column['no_transaksi'] = $data_jurnal->no_transaksi;
                $column['tanggal'] = date('d-m-Y', strtotime($data_jurnal->tgl_jurnal));
                $column['kode_akun'] = $data_jurnal->akun->kode_akun_aktif;
                $column['nama_akun'] = $data_jurnal->akun->nm_akun_aktif;
                $column['keterangan'] = $data_jurnal->keterangan->nm_transaksi;

                if($data_jurnal->debet_kredit==0){
                    $nilai_debet = $data_jurnal->jumlah_transaksi;
                }elseif($data_jurnal->debet_kredit==1){
                    $nilai_kredit = $data_jurnal->jumlah_transaksi;
                }

                $column['debet'] = $nilai_debet;
                $column['kredit'] = $nilai_kredit;
                $column['id_akun'] = $data_jurnal->akun->id;
                $column['id_akun_ukm'] = $data_jurnal->akun->sub_akun->id_akun_ukm;
                $column['posisi_saldo'] = $data_jurnal->akun->posisi_saldo;

                $total_sum_debet+=$nilai_debet;
                $total_sum_kredit+=$nilai_kredit;

                $row[]=$column;
            }

            return ['data_jurnal'=>$row, 'total_debet'=> number_format($total_sum_debet,2,',','.'), 'total_kredit'=> number_format($total_sum_kredit,2,',','.')];
        }catch (Throwable $e){
            return false;
        }

        return 'Data Jurnal empty';
    }

}