<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_request_cuti extends Model
{
    //
    protected $table ="h_request_cuti";

    protected $fillable=["tgl_req","jenis_izin","id_cuti","lama_request","upprove","atasan","surat_keterangan","id_perusahaan","id_karyawan"];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_karyawan');
    }

    public function cuti(){
        return $this->belongsTo('App\Model\Hrd\H_setting_cuti','id_cuti');
    }

    public function atasans(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','atasan');
    }
}
