<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 10/12/2020
 * Time: 9:07
 */

namespace App\Http\utils\data;
use App\Model\Keuangan\TahunBuku;

class SettingTahunBuku
{
    public static function tahun_buku(){
        $tahun_buku = TahunBuku::where('status','1')->first();
        if(!empty($tahun_buku)){
            $tahun_aktif = $tahun_buku->thn_buku;
        }else{
            $tahun_aktif = date('Y');
        }
        return ['thn_berjalan'=> $tahun_aktif];
    }
}