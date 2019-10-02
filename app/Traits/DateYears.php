<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 13/08/2019
 * Time: 8:36
 */

namespace App\Traits;
use Carbon\Carbon;



trait DateYears
{
    public $containerDate;

    public function dateSettings($pilihMonth=""){
        $dataMonth = [
          '1' => 'Januari',
          '2' => 'Februari',
          '3' => 'Maret',
          '4' => 'April',
          '5' => 'Mai',
          '6' => 'Juni',
          '7' => 'Juli',
          '8' => 'Agustus',
          '9' => 'September',
          '10' => 'Oktober',
          '11' => 'November',
          '12' => 'Desember',
         ];

        $data= new \stdClass();
        $data->semua_bulan =  $dataMonth;
        $data->terpilih = $dataMonth[$pilihMonth];
        return $data;
    }

    public function costumDate()
    {
        $dateNow = Carbon::today();
        $start =  Carbon::today()->startOfMonth();
        $end = $start->copy()->endOfMonth();
        $con = new \stdClass();
        $con->year = $dateNow->year;
        $con->month = $this->dateSettings($dateNow->month);
        $con->day = $dateNow->day;
        $con->first_date = $start;
        $con->last_date = $end;
        return $con;
    }
}