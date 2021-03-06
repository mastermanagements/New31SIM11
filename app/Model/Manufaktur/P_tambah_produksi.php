<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_tambah_produksi extends Model
{
    //
    protected $table = 'p_tambah_produksi';

    protected $fillable = ['id_barang','kode_produksi','batch_number','no_serial','tgl_mulai','jam_mulai',
        'id_supervisor_produksi','tgl_selesai','jam_selesai','tgl_mulai_qc','jam_mulai_qc','brg_dalam_proses',
        'jumlah_bdp_bagus','jumlah_bdp_rusak','status_bdp','expired_date_bdp','jumlah_brg_jadi_bagus',
        'jumlah_brg_jadi_rusan','expired_date_bj','status_produksi','lama_produksi','id_perusahaan','id_karyawan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang', 'id_barang');
    }

    public function linkToBarangDalamProses(){
        return $this->belongsTo('App\Model\Produksi\Barang', 'brg_dalam_proses');
    }

    public function linkToSupervisor(){
        return $this->belongsTo('App\Model\Hrd\H_Karyawan','id_supervisor_produksi');
    }

    public function linkToMannyProsesPengerjaan(){
        return $this->hasMany('App\Model\Manufaktur\P_proses_produksi','id_tambah_produksi','id');
    }

    public function linkToMannyTenagaProduksi(){
        return $this->hasMany('App\Model\Manufaktur\P_tenaga_produksi','id_tambah_produksi','id');
    }

    public function linkToBahanProduksi(){
        return $this->hasMany('App\Model\Manufaktur\P_Bahan_produksi','id_tambah_produksi','id');
    }

    public function linkToBiayaOverHead(){
        return $this->hasMany('App\Model\Manufaktur\P_biaya_overhead','id_tambah_produksi','id');
    }
}
