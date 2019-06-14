<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_tes_keahlian extends Model
{
    //
    protected $table="h_tes_keahlian";

    protected $fillable=['id_lamaran_p','id_item_tes_keahlian','nilai_akhir','ket','id_perusahaan','id_karyawan'];

    public function item_tes_keahlian()
    {
        return $this->belongsTo('App\Model\Hrd\H_item_keahlian', 'id_item_tes_keahlian');
    }
}
