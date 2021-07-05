<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PSO extends Model
{
    //
    protected $table = "p_so";

    protected $fillable = ['id_tawar_beli','tgl_so','no_so','no_po','id_klien','tgl_dikirim','diskon_tambahan','pajak','dp_so','kurang_bayar','ket','status','id_perusahaan','id_karyawan'];

    public function linkToKlien(){
        return $this->belongsTo('App\Model\Administrasi\Klien', 'id_klien');
    }

    public function linkToDetailPSO(){
        return $this->hasMany('App\Model\Produksi\DetailSO','id_so','id');
    }

    public function linkToPO(){
        return $this->belongsTo('App\Model\Produksi\TawarJual','id_po');
    }

    public function linkToTerimaBayar(){
        return $this->hasOne('App\Model\Produksi\PTerimaBayar','id_so','id');
    }
    public function linkToMannyTerimaBayar(){
        return $this->hasMany('App\Model\Produksi\PTerimaBayar','id_so','id');
    }
	public function linkToUsaha(){
        return $this->belongsTo('App\Model\Superadmin_ukm\U_usaha', 'id_perusahaan');
    }
	public function linkToKaryawan(){
        return $this->belongsTo('App\Model\Hrd\H_Karyawan', 'id_karyawan');
    }
	
	
}
