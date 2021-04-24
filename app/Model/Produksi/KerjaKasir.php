<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class KerjaKasir extends Model
{
    //

    protected $table = "p_kerja_kasir";

    protected $fillable =['tgl_mulai','jam_mulai','id_shift_kasir','total_pemasukan','total_pengeluaran','kas_disetor',
        'penerima','status_kerja','jam_selesai','id_perusahaan','id_karyawan'];

    public function linkToKasir(){
        return $this->belongsTo('App\Model\Produksi\SettingKasir','id_shift_kasir');
    }

    public function linkToKaryawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','penerima');
    }
}
