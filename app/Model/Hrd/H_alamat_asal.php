<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_alamat_asal extends Model
{
    //

    protected $table = "h_alamat_asal";

    protected $fillable = ['id_ky','alamat_asal','id_prov','id_kab','id_perusahaan','id_karyawan'];

    public function getProvinsi()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_provinsi','id_prov');
    }

    public function getKabupaten()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_kabupaten','id_kab');
    }

}
