<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class Closing extends Model
{
	protected $table="m_closing";

    protected $fillable = ['id_klien','id_barang','id_jasa'];
	
	public function getKlien()
    {
        return $this->belongsTo('App\Model\Administrasi\Klien','id_klien');
    }
	public function getBarang()
    {
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
	public function getJasa()
    {
        return $this->belongsTo('App\Model\Produksi\Jasa','id_jasa');
    }
}
