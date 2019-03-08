<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_jabatan_p extends Model
{
    //
    protected $table="u_jabatan_p";
    protected $fillable = ['nm_jabatan','id_perusahaan','id_user_ukm','level_jabatan'];

    public function getPerusahaan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_usaha', 'id_perusahaan');
    }
}
