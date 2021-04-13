<?php

namespace App\Imports;

use App\Model\Produksi\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Model\Produksi\Satuan;
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
        $model_saatuan = Satuan::where('satuan','like','%'.$row[3].'%')->first();
        //dd($model_saatuan);
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
                'merk_barang'=> $row[5],
                'desc_barang'=> $row[6],
                'no_rak'=> $row[7],
                'stok_minimum'=> $row[8],
                'hpp'=> $row[9],
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
