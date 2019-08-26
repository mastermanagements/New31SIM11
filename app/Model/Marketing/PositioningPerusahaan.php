<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class PositioningPerusahaan extends Model
{
    protected $table="m_positioning_perusahaan";

    protected $fillable = ['id_kompetitor','id_barang','id_jasa','plus_produk_k','value_produk_k','minus_produk_k','posisi_k','plus_produk_p','value_produk_p','minus_produk_p','posisi_p'];
	
	public function getKompetitor(){
        return $this->belongsTo('App\Model\Superadmin_ukm\U_Kompetitor','id_kompetitor');
    }
	public function getBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
	public function getJasa(){
        return $this->belongsTo('App\Model\Produksi\Jasa','id_jasa');
    }
	public function getPosisiMarketingK(){
        return $this->belongsTo('App\Model\Marketing\PositioningMarketing','posisi_k');
    }
	public function getPosisiMarketingP(){
        return $this->belongsTo('App\Model\Marketing\PositioningMarketing','posisi_p');
    }
	
}
