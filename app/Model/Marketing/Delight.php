<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class Delight extends Model
{
    protected $table="m_delight";

    protected $fillable = ['id_klien','tool_delight','content_delight'];
	
	public function getKlien()
    {
        return $this->belongsTo('App\Model\Administrasi\Klien','id_klien');
    }
}
