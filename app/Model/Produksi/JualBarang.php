<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class JualBarang extends Model
{

    protected $table = "p_jual_barang";

    protected $fillable = ['no_invoice','tgl_jual','id_barang','id_klien','jumlah_barang','id_perusahaan','id_karyawan'];

    public function barang(){
        return $this->belongsTo('App\Model\Produksi\Barang', 'id_barang');
    }

    public function klien(){
        return $this->belongsTo('App\Model\Administrasi\Klien','id_klien');
    }

    public function perusahaan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\U_usaha','id_perusahaan');
    }
}
