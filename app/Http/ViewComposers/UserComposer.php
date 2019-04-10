<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Model\Superadmin_ukm\U_menu_ukm as menu_ukm;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Administrasi\SPKKontrak as spk;
use App\Http\Middleware;
use Session;

class UserComposer
{
    private $id_perusahaan;
    private $id_karyawan;

    public function __construct(){
            if(empty(Session::get('id_superadmin_karyawan')) && empty(Session::get('id_karyawan')))
            {
                Session::flush();
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            $this->id_karyawan = Session::get('id_karyawan');
    }

    public function compose(View $view)
    {
        $model_data = menu_ukm::all()->where('id_perusahaan',$this->id_perusahaan);
        $karyawan = karyawan::where('id', $this->id_karyawan)->where('id_perusahaan',$this->id_perusahaan)->first();
        $spk = spk::all()->where('id_perusahaan', $this->id_perusahaan);
        $data_pass = [
          'karyawan' => $karyawan,
          'daftar_menu' => $model_data,
          'spk'=> $spk
        ];
        $view->with('daftar_menu', $data_pass);
    }
}