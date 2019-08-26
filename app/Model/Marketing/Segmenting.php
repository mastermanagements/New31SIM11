<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class Segmenting extends Model
{
    protected $table="m_segmenting";

    protected $fillable = ['item_segmenting','jenis_marketing'];
	
}
