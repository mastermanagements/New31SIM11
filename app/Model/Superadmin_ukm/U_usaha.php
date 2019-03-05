<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_usaha extends Model
{
    //
    protected $table="u_perusahaan";

    protected $fillable = ['nm_usaha','alamat','id_prov','id_kab','kode_pos','telp','hp','wa','teleg','email','jenis_usaha','web','logo','id_user_ukm'];

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
