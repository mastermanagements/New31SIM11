<?php

namespace App\Imports;

use App\Model\Produksi\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Model\Produksi\SatuanBarang;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Session;

class ImportBarang implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $model_saatuan = SatuanBarang::where('satuan_brg','like','%'.$row[3].'%')->first();

        return Barang::updateOrCreate(
            [
                'id_kategori_produk'=> 1,
                'kd_barang'=> $row[1],
                'nm_barang'=> $row[2],
                'id_satuan'=> $model_saatuan->id,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
            ],
            [
                'spec_barang'=> $row[4],
                'desc_barang'=> $row[5],
                'stok_minimum'=> $row[6],
                'hpp'=> $row[7],
                'id_karyawan'=> Session::get('id_karyawan'),
            ]
        );
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
