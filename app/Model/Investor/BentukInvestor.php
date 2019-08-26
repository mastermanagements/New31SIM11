<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class BentukInvestor extends Model
{
    //
    protected $table="i_bentuk_investor";

    protected $fillable = ['bentuk_investasi','id_perusahaan','id_karyawan'];
}
