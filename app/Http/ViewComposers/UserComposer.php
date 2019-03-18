<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Model\Superadmin_ukm\U_menu_ukm as menu_ukm;
use App\Http\Middleware;
use Session;

class UserComposer
{
    private $id_superadmin;

    public function __construct(){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
    }

    public function compose(View $view)
    {
        $model_data = menu_ukm::where('id_user_ukm',$this->id_superadmin);
        $view->with('daftar_menu', $model_data);
    }
}