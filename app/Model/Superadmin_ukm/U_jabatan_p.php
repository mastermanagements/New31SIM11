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

    public function item_keahlian()
    {
        return $this->hasMany('App\Model\Hrd\H_item_keahlian', 'id_jabatan_p');
    }
	 public function getJobdesc()
    {
        return $this->hasMany('App\Model\Karyawan\JobDecs', 'id_jabatan_p');
    }

    public function Cf(){
        return $this->hasMany('App\Model\Penggajian\CompansableFators','id_jabatan');
    }

    public function skorBaseItem()
    {
        return $this->hasOne('App\Model\Penggajian\SkorPosisiCF','id_jabatan');
    }
}
