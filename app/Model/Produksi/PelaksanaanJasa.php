<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PelaksanaanJasa extends Model
{
  protected $table = "p_pelaksanaan_jasa";

  protected $fillable = ['id_detail_oj','tgl_jam_mulai','id_proses_bisnis','tgl_jam_do','what_do','tgl_jam_finish','
                          what_result','yg_mengerjakan','tgl_jam_konfirm','what_respon','yg_mengkonfirmasi','status_perproses','biaya_tambahan','id_perusahaan','id_karyawan'];

  public function getProBis(){
      return $this->belongsTo('App\Model\Produksi\ProsesBisnis','id_proses_bisnis');
  }
  public function getYgMengerjakan(){
      return $this->belongsTo('App\Model\Hrd\H_Karyawan','yg_mengerjakan');
  }
  public function getYgMengkonfirmasi(){
      return $this->belongsTo('App\Model\Hrd\H_Karyawan','yg_mengkonfirmasi');
  }
}
