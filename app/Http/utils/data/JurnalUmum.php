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

    private static function sortFunction( $a, $b ) {
        return strtotime($a["tanggal"]) - strtotime($b["tanggal"]);
    }

    public static function data_jurnal_umum($array)
    {
        try{

            if(!empty(self::$date_awal) && !empty(self::$date_akhir)){
                $model_jurnal = Jurnal::whereBetween('tgl_jurnal',[self::$date_awal, self::$date_akhir])->whereIn('jenis_jurnal',['0','1','2'])->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
            }else if(!empty($array['tgl_awal']) && !empty($array['tgl_akhir'])){
                $model_jurnal = Jurnal::whereBetween('tgl_jurnal', [$array['tgl_awal'], $array['tgl_akhir']])->whereIn('jenis_jurnal',['0','1','2'])->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
            }else{
                if(!empty($array['thn_berjalan'])){
                    $model_jurnal = Jurnal::whereYear('tgl_jurnal',$array['thn_berjalan'])->whereIn('jenis_jurnal',['0','1','2'])->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
                }else{
                    $model_jurnal = Jurnal::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereIn('jenis_jurnal',['0','1','2'])->get();
                }
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
				if(!empty($data_jurnal->akun->kode_akun_aktif)) {
					$column['kode_akun'] = $data_jurnal->akun->kode_akun_aktif;
				}
				if(!empty($data_jurnal->akun->nm_akun_aktif)) {
					$column['nama_akun'] = $data_jurnal->akun->nm_akun_aktif;
				}
					$column['keterangan'] = $data_jurnal->keterangan->nm_transaksi;
	
                if($data_jurnal->debet_kredit==0){
                    $nilai_debet = $data_jurnal->jumlah_transaksi;
                }elseif($data_jurnal->debet_kredit==1){
                    $nilai_kredit = $data_jurnal->jumlah_transaksi;
                }

                $column['debet'] = $nilai_debet;
                $column['kredit'] = $nilai_kredit;
				if(!empty($data_jurnal->akun->id)){
					$column['id_akun'] = $data_jurnal->akun->id;
				}	
				if(!empty($data_jurnal->akun->sub_akun->id_akun_ukm)){
					$column['id_akun_ukm'] = $data_jurnal->akun->sub_akun->id_akun_ukm;
				}
                
                $column['id_aktif_ukm'] = $data_jurnal->id_akun_aktif;
                $column['tgl_jurnal'] = $data_jurnal->tgl_jurnal;
                $column['debet_kredit'] = $data_jurnal->debet_kredit;

                # Posisi saldo adalah gabungan posisi saldo dari akun, sub akun, sub sub akun.
				if(!empty($data_jurnal->akun->posisi_saldo)){
                $column['posisi_saldo'] = $data_jurnal->akun->posisi_saldo;
				}
                if(!empty($data_jurnal->akun->sub_akun->posisi_saldo)){
                    $column['posisi_akun_saldo'] = $data_jurnal->akun->sub_akun->linktoakunUkm->posisi_saldo;
                }else{
                    $column['posisi_akun_saldo'] ='';
                }

                if(!empty($data_jurnal->akun->sub_akun->posisi_saldo)){
                    $column['posisi_akun_sub_saldo'] = $data_jurnal->akun->sub_akun->posisi_saldo;
                }else{
                    $column['posisi_akun_sub_saldo'] ='';
                }

                if(!empty($data_jurnal->akun->sub_sub_akun->posisi_saldo)){
                    $column['posisi_akun_sub_sub_saldo'] = $data_jurnal->akun->sub_sub_akun->posisi_saldo;
                    $column['status_alur_kas'] = $data_jurnal->akun->status_alur_kas;
                }else{
                    $column['posisi_akun_sub_sub_saldo'] ='';
                    $column['status_alur_kas'] = 0;
                }
                $total_sum_debet+=$nilai_debet;
                $total_sum_kredit+=$nilai_kredit;

                $row[]=$column;
            }

            usort($row,'self::sortFunction');
            return ['data_jurnal'=>$row, 'total_debet'=> number_format($total_sum_debet,2,',','.'), 'total_kredit'=> number_format($total_sum_kredit,2,',','.')];
        }catch (Throwable $e){
            return false;
        }

        return 'Data Jurnal empty';
    }

}