<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class SkalaTunjangan extends Model
{
    //

    protected $table='g_skala_tunjangan';

    protected $fillable=['id_jabatan','id_item_tunjangan','status_tunjangan','besar_tunjangan',
        'id_perusahaan','id_karyawan'];

    public function jabatan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p','id_jabatan');
    }

    public function item_tunjangan(){
        return $this->belongsTo('App\Model\Penggajian\ItemTunjangan','id_item_tunjangan');
    }
}
