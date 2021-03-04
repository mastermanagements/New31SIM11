<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_usaha extends Model
{
    //
    protected $table="u_perusahaan";

    protected $fillable = ['nm_usaha','singkatan_usaha','alamat','id_prov','id_kab','kode_pos','telp','hp','wa','teleg','fp','ig','twitter','tiktok','email','jenis_kantor','badan_usaha','jenis_usaha','bidang_usaha','spesifik_usaha','jenis_jasa','web','logo','id_user_ukm'];

    public function getProvinsi(){
        return $this->belongsTo('App\Model\Superadmin_sim\U_provinsi','id_prov');
    }
    public function getKabupaten(){
        return $this->belongsTo('App\Model\Superadmin_sim\U_kabupaten','id_kab');
    }

    public function getUserData()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_user_ukm','id_user_ukm');
    }


}
