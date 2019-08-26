<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class RmSasaran extends Model
{
    protected $table ="m_rm_sasaran";
	
	protected $fillable =['id_rm_fase','sasaran_klien'];
}
