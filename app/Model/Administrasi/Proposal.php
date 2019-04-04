<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    //
    protected $table="a_proposal";

    protected $fillable = ['id_jenis_prop','judul_prop','tgl_prop','ditujukan','file_prop','cover_prop','status_prop','id_perusahaan','id_karyawan'];

    public function getJenisProposal()
    {
        return $this->belongsTo('App\Model\Administrasi\A_Jenis_Proposal','id_jenis_prop');
    }

}
