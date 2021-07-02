<?php

namespace App\Http\Controllers\penggajian;

use App\Model\Penggajian\G_kelas_proyek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\ItemTunjangan as IT;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Penggajian\SkalaTunjangan as ST;
use App\Model\Superadmin_ukm\H_karyawan as Hk;
use App\Model\Penggajian\G_kelas_proyek as GKP;
use App\Model\Produksi\Proyek as proyek;


class Tunjangan extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;

    public function __construct()
    {
        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index(){
        Session::put('menu_tun','itemTunjangan');
        Session::put('menu_sub_tun','');
        $data = [
            'data'=> IT::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.Tunjangan.page_default', $data);
    }

    public function item_tunjangan(){
        Session::put('menu_tun','itemTunjangan');
        Session::put('menu_sub_tun','');
        $data = [
            'data'=> IT::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.Tunjangan.page_default', $data);
    }

    public function skala_tunjangan(){
        Session::put('menu_tun','SkalaTunjangan');
        Session::put('menu_sub_tun','');
        $data =[
            'jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
            'itemJabatan'=> IT::all()->where('id_perusahaan', $this->id_perusahaan),
            'ST'=> ST::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.Tunjangan.page_default', $data);
    }

    public function TunjanganGaji(){
        Session::put('menu_tun','TunjanganGaji');
        Session::put('menu_sub_tun','');
        $data = [
            'ky'=> Hk::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.Tunjangan.page_default', $data);
    }

    public function KelasProyek(){
        Session::put('menu_tun','KelasProyek');
        Session::put('menu_sub_tun','');
        $data = [
            'data'=> GKP::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.Tunjangan.page_default', $data);
    }

    public function BonusProyek(){
        Session::put('menu_tun','BonusProyek');
        Session::put('menu_sub_tun','');
        $data = [
            'proyek'=>proyek::all()->where('id_perusahaan')
        ];
        return view('user.penggajian.section.Tunjangan.page_default', $data);
    }
}
