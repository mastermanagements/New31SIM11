<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class H_karyawan extends Model
{
    //

    protected $table = "h_karyawan";

    protected $fillable = [
        'nik',
        'nama_ky',
        'password',
        'tmp_lahir',
        'tgl_lahir',
        'jenis_kel',
        'agama',
        'status_kerja',
        'no_ktp',
        'file_ktp',
        'pas_foto',
        'cu_vitae',
        'nm_bank',
        'no_rek',
        'gol_darah',
        'pend_akhir',
        'program_studi',
        'pt',
        'id_perusahaan',
        'id_user_ukm',
        'tgl_masuk',
    ];

    public function jabatan_ky(){
        return $this->hasOne('App\Model\Hrd\H_Jabatan_ky','id_ky');
    }

    public function getPerusahaan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_usaha', 'id_perusahaan');
    }

    public function getAlamatAsal()
    {
        return $this->hasOne('App\Model\Hrd\H_alamat_asal','id_ky');
    }

    public function getAlamatSek()
    {
        return $this->hasOne('App\Model\Hrd\H_alamat_sekarang','id_ky');
    }

    public function getDataKeluarga()
    {
        return $this->hasOne('App\Model\Hrd\H_keluarga_ky','id_ky');
    }

    public function getAlamatEmailKy()
    {
        return $this->hasMany('App\Model\Hrd\H_Email_ky','id_ky');
    }

    public function getHpKy()
    {
        return $this->hasMany('App\Model\Hrd\H_hp_ky','id_ky');
    }

    public function getSertifikasi()
    {
        return $this->hasMany('App\Model\Hrd\H_tenaga_kerja','id_ky');
    }

    public function get_pelatihan_karyawan(){
        return $this->hasOne('App\Model\Hrd\H_Karyawan_pelatihan','id_ky');
    }

    public function get_MannyTesKemanajerialan(){
        return $this->hasMany('App\Model\Hrd\H_tes_manajerial','id_ky');
    }
    public function get_MannyKpiKaryawan(){
        return $this->hasMany('App\Model\Hrd\H_kpi_karyawan','id_ky');
    }

    public function get_MannyTesTeknis(){
        return $this->hasMany('App\Model\Hrd\H_tes_kteknis','id_ky');
    }

    public function getMannyDaftarGaji(){
        return $this->hasMany('App\Model\Penggajian\DaftarGaji','id_ky');
    }

    public function getMannyTunjangan(){
        return $this->hasMany('App\Model\Penggajian\G_tunjangan_gaji','id_ky');
    }
}
