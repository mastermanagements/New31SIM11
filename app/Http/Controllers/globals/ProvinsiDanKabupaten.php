<?php

namespace App\Http\Controllers\globals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use App\Model\Superadmin_sim\U_kabupaten as kabupaten;

class ProvinsiDanKabupaten extends Controller
{
    //
    public function getProvinsi()
    {
        $model = provinsi::all();
        return $model;
    }

    public function getKabupaten($id=1)
    {
        $model = kabupaten::all()->where('id_provinsi', $id);
        return $model;
    }
    public function ResponseKabupaten($id_kabupaten){
        return response()->json($this->getKabupaten($id_kabupaten));
    }
}
