<?php

namespace App\Model\Superadmin_sim;

use Illuminate\Database\Eloquent\Model;

class U_kabupaten extends Model
{
    //
    protected $table='u_kabupaten';

    protected $fillable=['nama_kabupaten','id_provinsi'];

    public function getProvinsi()
    {
        return $this->belongsTo('App/Model/Superadmin_sim/U_provinsi','id_provinsi');
    }
}
