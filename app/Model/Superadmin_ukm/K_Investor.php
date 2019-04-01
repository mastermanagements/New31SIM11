<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class K_Investor extends Model
{
    //
    protected $table = "k_investor";

    protected $fillable = ['nm_investor','no_ktp','password','alamat','id_prov','id_kab','hp','wa','jum_saham','file_ktp','nm_ahli_waris','no_hp_aw','alamat_aw','id_perusahaan','id_user_ukm'];

    public function getUserData()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_user_ukm','id_user_ukm');
    }

    public function getUserProvinsi()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_provinsi','id_prov');
    }

    public function getUserKabupaten()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_kabupaten','id_kab');
    }
}
