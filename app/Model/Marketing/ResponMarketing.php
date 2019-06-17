<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class ResponMarketing extends Model
{
    protected $table="m_respon_marketing";

    protected $fillable = ['id_klien','tgl_percakapan','id_promo','id_barang','id_jasa','info_dari','kebutuhan_klien','tindak_lanjut','id_bagian','id_divisi','status_closing','status_percakapan','id_perusahaan','id_karyawan'];

    public function getKlien(){
        return $this->hasMany('App\Model\Administrasi\a_klien','id_klien');
    }
	public function getPromo(){
        return $this->hasOne('App\Model\Marketing\m_promo_marketing','id_promo');
    }
	public function getBarang(){
        return $this->hasOne('App\Model\Produksi\p_barang','id_barang');
    }
	public function getJasa(){
        return $this->hasOne('App\Model\Produksi\p_jasa','id_jasa');
    }
	
}
