<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_ijin_usaha extends Model
{
    //
    protected $table="u_ijin_usaha";

    protected $fillable=['nm_ijin','no_ijin','berlaku','kualifikasi','instansi_pemberi','klasifikasi','file_iu','no_rak','id_perusahaan','id_user_ukm'];

    public function getPerusahaan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_usaha', 'id_perusahaan');
    }
}
