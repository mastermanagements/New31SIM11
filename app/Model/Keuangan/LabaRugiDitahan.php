<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class LabaRugiDitahan extends Model
{
    //
    protected $table="k_laba_rugi_ditahan_tahun_berhalan";

    protected $fillable =[
      "jumlah_laba_tahun_berjalan",
      "id_sub_akun",
      "tahun",
      "id_perusahaan",
     ];
}
