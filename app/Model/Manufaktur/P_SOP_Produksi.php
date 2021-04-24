<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_SOP_Produksi extends Model
{
    //
    protected $table = "p_sop_produksi";

    protected $fillable = ['nama_sop','id_perusahaan'];
}
