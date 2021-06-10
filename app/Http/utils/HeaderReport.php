<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 6/7/2021
 * Time: 1:12 PM
 */

namespace App\Http\utils;
use App\Model\Superadmin_ukm\U_usaha;
use Session;
use View;
class HeaderReport
{
    public static function header($views=null,$tgl_awal=null,$tgl_akhir= null,$title= null)
    {
        $array=[];
        $array['title']= $title;
        $array['perusahaan'] = U_usaha::findOrFail(Session::get('id_perusahaan_karyawan'));
        $array['tgl_awal']= date('d-m-Y', strtotime($tgl_awal));
        $array['tgl_akhir']= date('d-m-Y', strtotime($tgl_akhir));
        return self::render_partial($views, $array);
    }

    public static function header_format_2($views=null,$title= null)
    {
        $array=[];
        $array['title']= $title;
        $array['perusahaan'] = U_usaha::findOrFail(Session::get('id_perusahaan_karyawan'));
        return self::render_partial($views, $array);
    }

    public static function render_partial($view,$array){
        return (string)View::make($view, array('data'=>$array));
    }
}