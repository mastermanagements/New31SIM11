<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TargetPuncak extends Model
{
  protected $table="u_target_puncak";
  protected $fillable = ['periode','thn_mulai','thn_selesai','target_puncak','jumlah_target','satuan_target','id_perusahaan','id_karyawan'];
}
