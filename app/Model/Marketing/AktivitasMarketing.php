<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class AktivitasMarketing extends Model
{
    protected $table="m_aktivitas_marketing";

    protected $fillable = ['aktivitas_utama'];
}
