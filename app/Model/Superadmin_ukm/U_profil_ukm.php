<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_profil_ukm extends Model
{
    //

    protected $table='u_profil';

    protected $fillable = ['id_user_ukm','telp','hp','wa','telegram','foto','provinsi_id','kab_id'];

    public function getUserData()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_user_ukm','id_user_ukm');
    }

    public function getUserProvinsi()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_provinsi','provinsi_id');
    }

    public function getUserKabupaten()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_kabupaten','kab_id');
    }
}
