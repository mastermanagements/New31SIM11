<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Session;
use App\Model\Superadmin_ukm\U_user_ukm as superadmin_ukms;
use App\Model\Superadmin_ukm\U_profil_ukm as profil_user_ukm;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use App\Model\Superadmin_sim\U_kabupaten as kabupaten;

class Superadmin_UKM extends Controller
{
    //
    private $id_superadmin;

    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            return $next($req);
        });
    }

    public function index()
    {
        $pass_data = [
            'data_user'=> $this->getDataSuperadmin(),
            'profil_user_ukm' => $this->getDataPerusahaan()
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function editProfileSuperadminUkm()
    {
        $pass_data = [
            'menu'=>'edit',
            'data_user'=> $this->getDataSuperadmin(),
            'profil_user_ukm' => $this->getDataPerusahaan(),
            'provinsi'=>$this->getProvinsi(),
            'kabupaten' => $this->getKabupaten()
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function updateProfile(Request $req, $id)
    {
        dd($req->all());
    }

    private function getDataSuperadmin()
    {
        $model = superadmin_ukms::findOrFail($this->id_superadmin);
        return $model;
    }

    public function getDataPerusahaan()
    {
        $model = profil_user_ukm::where('id_user_ukm', $this->getDataSuperadmin()->id)->first();
        return $model;
    }

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
