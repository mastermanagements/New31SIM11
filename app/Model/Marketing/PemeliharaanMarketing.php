<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class PemeliharaanMarketing extends Model
{
    protected $table="m_pemeliharaan_marketing";

    protected $fillable = ['tgl_menghubungi','id_barang','id_jasa','id_klien','menghubungi_via','pesan_marketer','respon_klien','tindak_lanjut','id_bagian','id_divisi','status_closing','status_percakapan','id_perusahaan','id_karyawan'];

    public function getKlien(){
        return $this->hasMany('App\Model\Administrasi\a_klien','id_klien');
    }
	public function getBarang(){
        return $this->hasOne('App\Model\Produksi\p_barang','id_barang');
    }
	public function getJasa(){
        return $this->hasOne('App\Model\Produksi\p_jasa','id_jasa');
    }
}
