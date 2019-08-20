<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class RmFase extends Model
{
    protected $table ="m_rm_fase";
	
	protected $fillable =['id_rm','tgl_rencana_terbit','fase_marketing','id_barang','id_jasa','id_media_marketing','id_submedia_marketing','id_content_marketing'];
	
	public function getMediaMarketing(){
        return $this->belongsTo('App\Model\Marketing\MediaMarketing','id_media_marketing');
    }
	public function getSubMediaMarketing(){
        return $this->belongsTo('App\Model\Marketing\SubMediaMarketing','id_submedia_marketing');
    }
	public function getContentMarketing(){
        return $this->belongsTo('App\Model\Marketing\ContentMarketing','id_content_marketing');
    }
	
	/* public function getRmProduct(){
		return $this->hasOne('App\Model\Marketing\RmProduk','id_rm_fase');
	} */
	public function getBarang()
    {
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
	public function getJasa()
    {
        return $this->belongsTo('App\Model\Produksi\Jasa','id_jasa');
    }
	public function getPelMarketing()
    {
        return $this->hasMany('App\Model\Marketing\PelMarketing','id_rm_fase');
    }
}

