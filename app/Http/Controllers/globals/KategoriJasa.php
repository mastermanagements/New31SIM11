<?php

namespace App\Http\Controllers\globals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_sim\P_subkategori_produk as subKategori;
use App\Model\Superadmin_sim\P_subsubkategori_produk as subsubKategori;

class KategoriJasa extends Controller
{
    //

    public function getSubKategori(Request $req){
        $id_kategori = $req->id_kategori;
        $data = [
            'data' => subKategori::all()->where('id_kategori_produk', $id_kategori)
        ];
        return response()->json($data);
    }

    public function getSubSubKategori(Request $req){
        $id_kategori = $req->id_subkategori;
        $data = [
            'data' => subsubKategori::all()->where('id_subkategori_produk', $id_kategori)
        ];
        return response()->json($data);
    }
}
