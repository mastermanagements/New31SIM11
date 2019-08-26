<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_aku extends Model
{
    //
    protected $table="h_aku";

    protected $fillable=["id_jabatan","nm_aku"];

    public function jabatan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p','id_jabatan');
    }
}
