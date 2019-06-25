<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_Kpi extends Model
{
    //
    protected $table="h_kpi";

    protected $fillable = [
            "id_aku",
            "nm_kpi",
            "bobot_kpi",
            "targat_kpi",
            "id_satuan_kpi",
            "id_jenis_kpi",
            "id_perusahaan",
            "id_karyawan"
    ];

    public function aku(){
        return $this->belongsTo('App\Model\Hrd\H_aku','id_aku');
    }
    public function satuan(){
        return $this->belongsTo('App\Model\Hrd\SatuanKPI','id_satuan_kpi');
    }

    public function jenis(){
        return $this->belongsTo('App\Model\Hrd\JenisKPI','id_jenis_kpi');
    }
}
