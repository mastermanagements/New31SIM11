<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_Kompetitor extends Model
{
    protected $table = "u_kompetitor";

    protected $fillable = ['nm_kompetitor','badan_hukum','bidang_usaha','alamat','id_prov','id_kab','cp','telp','hp','wa','teleg','email','web','akun_fb','fanspages','twitter','ig'];

	public function getProv()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_provinsi','id_prov');
    }
	public function getKab()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_kabupaten','id_kab');
    }
}
