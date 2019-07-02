<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_kompetensi_teknis extends Model
{
    //
    protected $table="h_kompetensi_teknis";
    protected $fillable = ['id_jenis_kompetensi','id_jabatan','nm_kompetensi_t','id_perusahaan','id_karyawan'];

    public function jenis_kompetensi(){
        return $this->belongsTo('App\Model\Hrd\H_jenis_kompetensi','id_jenis_kompetensi');
    }

    public function jabatan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p','id_jabatan');
    }
}
