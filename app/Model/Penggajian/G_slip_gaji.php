<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_slip_gaji extends Model
{
    protected $table="g_slip_gaji";

    protected $fillable=['id_ky','periode','id_perusahaan','id_karyawan'];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }

    public function lembur(){
        return $this->hasOne('App\Model\Penggajian\G_lembur','id_slip');
    }

    public function tambahanGaji(){
        return $this->hasMany('App\Model\Penggajian\G_tambahan_gaji','id_slip');
    }

    public function PotonganTambahan(){
        return $this->hasMany('App\Model\Penggajian\G_potongan_tambahan','id_slip');
    }
}
