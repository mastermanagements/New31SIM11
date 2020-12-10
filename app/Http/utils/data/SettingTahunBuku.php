<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 10/12/2020
 * Time: 9:07
 */

namespace App\Http\utils\data;


class SettingTahunBuku
{
    public static function tahun_buku(){
        $tahun_aktif = date('Y');
        return ['thn_berjalan'=> $tahun_aktif];
    }
}