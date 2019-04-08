<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;


class SPKKontrak extends Model
{
    //
    protected $table="a_spk";

    protected $fillable = ['no_spk','tgl_spk','id_klien','nm_spk','tgl_mulai','tgl_selesai','alamat','id_prov','id_kab','file_kotrak','file_scan','id_perusahaan','id_karyawan'];

    public function getKlien()
    {
        return $this->belongsTo('App\Model\Administrasi\Klien','id_klien');
    }

    public function getProvinsi()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_provinsi','id_prov');
    }

    public function getKabupaten()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_kabupaten','id_kab');
    }
}
