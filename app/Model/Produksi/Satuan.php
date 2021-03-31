<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
  protected $table="p_satuan";

  protected $fillable = ['jenis_satuan','satuan'];
}
