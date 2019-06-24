<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class SatuanKPI extends Model
{
    protected $table = "h_satuan_kpi";

    protected $fillable = ["satuan_kpi","id_perusahaan","id_karyawan"];

}
