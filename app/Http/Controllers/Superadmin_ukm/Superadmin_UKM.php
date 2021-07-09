<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

use Session;
use Auth;
use App\Model\Superadmin_ukm\U_user_ukm as superadmin_ukms;
use App\Model\Superadmin_ukm\U_profil_ukm as profil_user_ukm;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use App\Model\Superadmin_sim\U_kabupaten as kabupaten;
use App\Model\Superadmin_ukm\U_usaha as perusahaan;
use App\Model\Superadmin_ukm\A_visi_p as visi_p;
use App\Model\Superadmin_ukm\A_misi_p as misi_p;
use App\Model\Superadmin_ukm\U_Akta as akta_p;
use App\Model\Superadmin_ukm\U_ijin_usaha as ijin;
use App\Model\Produksi\RekUkm as rek_ukm;

class Superadmin_UKM extends Controller
{
    //
    private $id_superadmin;

    public function __construct()
    {
        $this->middleware(function ($req, $next) {
            if (empty(Session::get('id_superadmin_ukm'))) {
                return redirect('/')->with('message_fail', 'Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            Session::put('main_menu', 'pengaturan_awal-data_perusahaan');
            return $next($req);
        });
    }

    public function index()
    {
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'content_menu' => 'profil',
            'usaha' => $this->getFavoriteData()['data_usaha']
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function editPwo()
    {
        $pass_data = [
            'data_user' => superadmin_ukms::findOrFail(Session::get('id_superadmin_ukm'))
        ];
        return view('user/superadmin_ukm/master/section/pengaturan_awal/include/section_editpwo', $pass_data);
    }

    public function updatePwo(Request $request)
    {

        if (!(Hash::check($request->get('pass_old'), Auth::superadmin_ukms()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('pass_old'), $request->get('pass_new')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        if (strcmp($request->get('pass_new'), $request->get('repass_new')) !== 0) {
            //mewpassword and re new password are not same
            return redirect()->back()->with("error", "re New Password must be same as your new password. Please choose a different password.");
        }


        $validatedData = $request->validate([
            'pass_old' => 'required',
            'pass_new' => 'required|string|min:6|confirmed',
            'repass_new' => 'required'
        ]);

        //Change Password
        $user_ukm = superadmin_ukms::findOrFail(Session::get('id_superadmin_ukm'));
        $user_ukm->password = bcrypt($request->get('pass_new'));
        $user_ukm->save();

        return redirect()->back()->with("success", "Password changed successfully !");

    }

    public function editProfileSuperadminUkm()
    {
        $pass_data = [
            'menu' => 'edit',
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'provinsi' => $this->getProvinsi(),
            'kabupaten' => $this->getKabupaten(),
            'usaha' => $this->getFavoriteData()['data_usaha'],
            'content_menu' => 'profil'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function updateProfile(Request $req, $id)
    {
        $this->validate($req, [
            'foto' => 'nullable|image|mimes:jpeg,png,gif,jpg|max:2048',
            'nama' => 'required',
            'email' => 'required',
            'id_provinsi' => 'required',
            'id_kabupaten' => 'required',
            'hp' => 'required',
            'wa' => 'required',
        ]);


        $nama = $req->nama;
        $email = $req->email;
        $alamat = $req->alamat;
        $id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $telp = $req->telp;
        $hp = $req->hp;
        $wa = $req->wa;
        $tegram = $req->telegram;
        $fb = $req->fb;
        $ig = $req->ig;
        $twitter = $req->twitter;
        $tiktok = $req->tiktok;
        $foto = $req->foto;

        if (!empty($foto)) {
            $image_name = time() . '.' . $foto->getClientOriginalExtension();
        } else {
            //ambil foto lama
            $foto_lama = profil_user_ukm::find($id);
            $image_name = $foto_lama['foto'];
        }

        $model_user_ukm = superadmin_ukms::find($id);
        $model_user_ukm->nama = $nama;
        $model_user_ukm->email = $email;

        if ($model_user_ukm->save()) {
            $profil_user_ukm = profil_user_ukm::updateOrCreate([
                'id_user_ukm' => $model_user_ukm->id],
                ['hp' => $hp,
                    'wa' => $wa,
                    'telegram' => $tegram,
                    'fb' => $fb,
                    'twitter' => $twitter,
                    'ig' => $ig,
                    'tiktok' => $tiktok,
                    'alamat' => $alamat,
                    'provinsi_id' => $id_provinsi,
                    'kab_id' => $id_kabupaten,
                    'foto' => $image_name
                ]);

            if ($profil_user_ukm->save()) {
                if (!empty($foto)) {
                    if ($foto->move(public_path('image_superadmin_ukm'), $image_name)) {

                    } else {
                        return redirect('pengaturan-perusahaan')->with('message_error', 'Profil anda berhasil diperbarui namun foto gagal diupload');
                    }
                }
            }
            return redirect('pengaturan-perusahaan')->with('message_success', 'Profil anda berhasil diperbarui');
        }

        return redirect('editprofile')->with('message_error', 'Data tidak boleh kosong');

    }

    public function getFavoriteData()
    {
        $data = [
            'data_user' => $this->getDataSuperadmin(),
            'profil_user_ukm' => $this->getDataPerusahaan(),
            'data_usaha' => perusahaan::where('id_user_ukm', $this->id_superadmin)->paginate(6),
            'visi' => visi_p::where('id_user_ukm', $this->id_superadmin)->paginate(6),
            'misi' => misi_p::where('id_user_ukm', $this->id_superadmin)->paginate(6),
            'akta' => akta_p::where('id_user_ukm', $this->id_superadmin)->paginate(6),
            'ijin' => ijin::all()->where('id_user_ukm', $this->id_superadmin),
            'rek_ukm' => rek_ukm::all()->where('id_user_ukm', $this->id_superadmin)
        ];
        return $data;
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

    public function getKabupaten($id = 1)
    {
        $model = kabupaten::all()->where('id_provinsi', $id);
        return $model;
    }

    public function ResponseKabupaten($id_kabupaten)
    {
        return response()->json($this->getKabupaten($id_kabupaten));
    }

    public function profil_perusahaan()
    {
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'content_menu' => 'profil',
            'usaha' => $this->getFavoriteData()['data_usaha']
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function visi()
    {
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'visi' => $this->getFavoriteData()['visi'],
            'content_menu' => 'visi'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function misi()
    {
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'misi' => $this->getFavoriteData()['misi'],
            'content_menu' => 'misi'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function akta()
    {
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'akta' => $this->getFavoriteData()['akta'],
            'content_menu' => 'akta'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function izin_usaha()
    {
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'ijin' => $this->getFavoriteData()['ijin'],
            'content_menu' => 'isi_usaha'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function jabatan_perusahaan()
    {
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'content_menu' => 'jabatan',
            'usaha' => $this->getFavoriteData()['data_usaha']
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function jabatan_di_perusahaan($id)
    {
        if (empty($data_perusahaan = perusahaan::where('id', $id)->where('id_user_ukm', $this->id_superadmin)->first())) {
            return abort(404);
        }
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'content_menu' => 'jabatan',
            'usaha' => $data_perusahaan,
            'jabatan' => jabatans::all()->where('id_perusahaan', $id)
        ];
        return view('user.superadmin_ukm.master.section.jabatan_perusahaan.include.jabatan_content', $pass_data);
    }

    public function rek_ukm()
    {
        $pass_data = [
            'data_user' => $this->getFavoriteData()['data_user'],
            'profil_user_ukm' => $this->getFavoriteData()['profil_user_ukm'],
            'rek_ukm' => $this->getFavoriteData()['rek_ukm'],
            'content_menu' => 'rek_ukm'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function ganti_password(){
        $data = [
            'data_profil'=>superadmin_ukms::find(Session::get('id_superadmin_ukm'))
        ];
        return view('user.superadmin_ukm.master.section.ganti_password.page_default', $data);
    }

    public function ganti_password_proses(Request $req){
        $model = superadmin_ukms::find(Session::get('id_superadmin_ukm'));
        $model->email = $req->email;
        $model->password = bcrypt($req->password);
        if($model->save()){
            return redirect()->back()->with('message_success', 'Permintaan ubah email atau password telah diproses');
        }else{
            return redirect()->back()->with('message_fail', 'Gagal, mengubah email atau password');
        }
        $data = [
            'data'=>$model
        ];
        return view('user.superadmin_ukm.master.section.ganti_password.page_default', $data);
    }
}
