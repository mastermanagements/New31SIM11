<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_Wawancara extends Model
{
    //
    protected $table = "h_wawancara";

    protected $fillable = ["id_lamaran_p","tgl_wawancara","id_item_wawancara","nilai_akhir","ket","id_perusahaan","id_karyawan"];

    public function item_wawancara(){
        return $this->belongsTo('App\Model\Hrd\H_item_wawancara','id_item_wawancara');
    }
}
