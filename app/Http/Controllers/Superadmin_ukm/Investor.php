<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use App\Model\Superadmin_ukm\K_Investor as investors;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use App\Model\Superadmin_sim\U_kabupaten as kabupaten;
use Session;

class Investor extends Controller
{
    //
    private $id_superadmin;
    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('/')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            Session::put('main_menu','pengaturan_awal-pengguna_karyawan');
            return $next($req);
        });
    }

    public function daftar_inverstor($id)
    {
        if(empty($data_usaha = usaha::where('id_user_ukm', $this->id_superadmin)->where('id', $id)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'data_investor' => investors::all()->where('id_perusahaan', $id)->where('id_user_ukm', $this->id_superadmin),
            'id_usaha'=> $id
        ];
        return view('user.superadmin_ukm.master.section.investor_perusahaan.investor_view_page',$data_pass);
    }

    public function tambah_investor($id)
    {
        if(empty($data_usaha = usaha::where('id_user_ukm', $this->id_superadmin)->where('id', $id)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'provinsi' => provinsi::all(),
            'id_usaha'=> $id
        ];
        return view('user.superadmin_ukm.master.section.investor_perusahaan.investor_create_page',$data_pass);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'nm_investor' => 'required',
            'no_ktp' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'id_provinsi' =>'required',
            'id_kabupaten' => 'required',
            'hp' => 'required',
            'wa' => 'required',
            'jum_saham' => 'required|numeric',
            'nm_ahli_waris' => 'required',
            'alamat_aw' => 'required',
            'no_hp_aw' => 'required',
            'file_ktp'=> 'required|image|mimes: jpg,png,gif',
            'id_usaha'=> 'required|numeric'
        ]);

        $nm_investor = $req->nm_investor;
        $no_ktp = $req->no_ktp;
        $password =bcrypt($req->password);
        $alamat = $req->alamat;
        $id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $hp = $req->hp;
        $wa = $req->wa;
        $jum_saham = $req->jum_saham;
        $nm_ahli_waris = $req->nm_ahli_waris;
        $no_hp_aw = $req->no_hp_aw;
        $alamat_aw = $req->alamat_aw;
        $id_usaha = $req->id_usaha;
        $file_ktp = $req->file_ktp;

        $nm_ktp_investor = time().'-IKtp.'.$file_ktp->getClientOriginalExtension();

        $model = new investors;
        $model->nm_investor = $nm_investor;
        $model->no_ktp = $no_ktp;
        $model->password = $password;
        $model->alamat = $alamat;
        $model->id_prov = $id_provinsi;
        $model->id_kab = $id_kabupaten;
        $model->hp = $hp;
        $model->wa = $wa;
        $model->jum_saham = $jum_saham;
        $model->file_ktp = $nm_ktp_investor;
        $model->nm_ahli_waris = $nm_ahli_waris;
        $model->no_hp_aw = $no_hp_aw;
        $model->alamat_aw = $alamat_aw;
        $model->id_perusahaan = $id_usaha;
        $model->id_user_ukm = $this->id_superadmin;

        if($model->save())
        {
            if($file_ktp->move(public_path('ktpInvestor'), $nm_ktp_investor))
            {
                return redirect('daftar-investor/'.$id_usaha)->with('message_success','Berhasil menambah data investor');
            }else{
                return redirect('daftar-investor/'.$id_usaha)->with('message_error','Gagal menyimpan data file ktp investor');
            }
            return redirect('daftar-investor/'.$id_usaha)->with('message_success','Berhasil menambah data investor');
        }
        else {
            return redirect('daftar-investor/'.$id_usaha)->with('message_error','Terjadi Kesahalan, Coba Lagi');
        }
    }

    public function edit_investor($id, $id_investor)
    {
        if(empty($data_investor = investors::where('id', $id_investor)->where('id_user_ukm', $this->id_superadmin)->where('id_perusahaan', $id)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'provinsi' => provinsi::all(),
            'id_usaha'=> $id,
            'data_investor' => $data_investor
        ];
        return view('user.superadmin_ukm.master.section.investor_perusahaan.investor_edit_page',$data_pass);
    }

    public function update(Request $req,$id)
    {
        $this->validate($req,[
            'nm_investor' => 'required',
            'no_ktp' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'id_provinsi' =>'required',
            'id_kabupaten' => 'required',
            'hp' => 'required',
            'wa' => 'required',
            'jum_saham' => 'required|numeric',
            'nm_ahli_waris' => 'required',
            'alamat_aw' => 'required',
            'no_hp_aw' => 'required',
            'file_ktp'=> 'required|image|mimes: jpg,png,gif',
            'id_usaha'=> 'required|numeric'
        ]);

        $nm_investor = $req->nm_investor;
        $no_ktp = $req->no_ktp;
        $password =bcrypt($req->password);
        $alamat = $req->alamat;
        $id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $hp = $req->hp;
        $wa = $req->wa;
        $jum_saham = $req->jum_saham;
        $nm_ahli_waris = $req->nm_ahli_waris;
        $no_hp_aw = $req->no_hp_aw;
        $alamat_aw = $req->alamat_aw;
        $id_usaha = $req->id_usaha;
        $file_ktp = $req->file_ktp;

        $nm_ktp_investor = time().'-IKtp.'.$file_ktp->getClientOriginalExtension();

        $model = investors::find($id);
        if(!empty($model->file_ktp))
        {
            $file_path =public_path('ktpInvestor').'/' . $model->file_ktp;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        $model->nm_investor = $nm_investor;
        $model->no_ktp = $no_ktp;
        $model->password = $password;
        $model->alamat = $alamat;
        $model->id_prov = $id_provinsi;
        $model->id_kab = $id_kabupaten;
        $model->hp = $hp;
        $model->wa = $wa;
        $model->jum_saham = $jum_saham;
        $model->file_ktp = $nm_ktp_investor;
        $model->nm_ahli_waris = $nm_ahli_waris;
        $model->no_hp_aw = $no_hp_aw;
        $model->alamat_aw = $alamat_aw;
        $model->id_perusahaan = $id_usaha;
        $model->id_user_ukm = $this->id_superadmin;

        if($model->save())
        {
            if($file_ktp->move(public_path('ktpInvestor'), $nm_ktp_investor))
            {
                return redirect('daftar-investor/'.$id_usaha)->with('message_success','Berhasil mengubah data investor');
            }else{
                return redirect('daftar-investor/'.$id_usaha)->with('message_error','Gagal mengubah data file ktp investor');
            }
            return redirect('daftar-investor/'.$id_usaha)->with('message_success','Berhasil mengubah data investor');
        }
        else {
            return redirect('daftar-investor/'.$id_usaha)->with('message_error','Terjadi Kesahalan, Coba Lagi');
        }
    }

  public function delete(Request $req,$id)
  {
        $model = investors::find($id);
        if(!empty($model->file_ktp))
        {
            $file_path =public_path('ktpInvestor').'/' . $model->file_ktp;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($model->delete())
        {
            return redirect('daftar-investor/'.$model->id_perusahaan)->with('message_success','Berhasil menghapus data investor');
        }
        else {
            return redirect('daftar-investor/'.$model->id_perusahaan)->with('message_error','Terjadi Kesahalan, Coba Lagi');
        }
  }

    public function detail_investor($id, $id_investor)
    {
        if(empty($data_investor = investors::where('id', $id_investor)->where('id_user_ukm', $this->id_superadmin)->where('id_perusahaan', $id)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'provinsi' => provinsi::all(),
            'id_usaha'=> $id,
            'data_investor' => $data_investor
        ];
        return view('user.superadmin_ukm.master.section.investor_perusahaan.investor_detail_page',$data_pass);
    }

}
