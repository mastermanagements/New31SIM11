<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Model\Superadmin_ukm\U_menu_ukm as menu_ukm;
use App\Http\Middleware;
use Session;

class UserComposer
{
    private $id_perusahaan;

    public function __construct(){
            if(empty(Session::get('id_superadmin_karyawan')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
    }

    public function compose(View $view)
    {
        $model_data = menu_ukm::all()->where('id_perusahaan',$this->id_perusahaan);
        $view->with('daftar_menu', $model_data);
    }
}