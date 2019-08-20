<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class MediaMarketing extends Model
{
    protected $table="m_media_marketing";

    protected $fillable = ['jenis_media','media_marketing'];
}
