<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_alamat_sekarang extends Model
{

    protected $table = "h_alamat_sek";

    protected $fillable = ['id_ky','alamat_sek','id_prov','id_kab','id_perusahaan','id_karyawan'];

    public function getProvinsi()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_provinsi','id_prov');
    }

    public function getKabupaten()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_kabupaten','id_kab');
    }

}
