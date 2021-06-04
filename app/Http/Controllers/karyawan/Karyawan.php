<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\H_karyawan as karyawans;
use App\Model\Hrd\H_alamat_asal as asal;
use App\Model\Hrd\H_alamat_sekarang as sekarang;
use App\Model\Hrd\H_keluarga_ky as keluarga;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use App\Model\Hrd\H_Email_ky as email_ky;
use App\Model\Hrd\H_hp_ky as hp_ky;
use Session;

class Karyawan extends Controller
{
    //

    private $id_karyawan;
    private $id_perusahaan;
    private $status = ['0'=>'Masih Hidup','1'=>'Meninggal Dunia'];

    public function __construct()
    {
        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }


    //public function index()
    public function index($id)
    {
        $data =[
            //'data_karyawan' => karyawans::where('id', $this->id_karyawan)->where('id_perusahaan', $this->id_perusahaan)->first(),
            'data_karyawan' => karyawans::where('id_perusahaan', $this->id_perusahaan)->findorFail($id),
            'provinsi'=> provinsi::all(),
            'status'=> $this->status
        ];
        return view('user.karyawan.section.Profil.page_default', $data);
    }

    public function data_pendidikan()
    {
        if(empty($data_karyawan = karyawans::findOrfail($this->id_karyawan))){
            return abort(404);
        }
        $data_pass = [
            'data' => $data_karyawan
        ];
        return response()->json($data_pass);
    }
	//direvisi
    public function proses_pendidikan(Request $req)
    {
        $pend_akhir = $req->pend_akhir;
        $program_studi = $req->program_studi;
        $pt = $req->pt;

        $model = karyawans::findOrfail($this->id_karyawan);
        $model->pend_akhir = $pend_akhir;
        $model->program_studi = $program_studi;
        $model->pt = $pt;

        if($model->save()){
            $data = [
                'message'=> 'Pendidikan baru saja diubah',
                'status'=> true
            ];
            return response()->json($data);
        }else{
            $data = [
                'message'=> 'Telah terjadi kesalahan',
                'status'=> false
            ];
            return response()->json($data);
        }
    }

    public function data_alamat()
    {
        if(empty($data_alamat = karyawans::where('id',$this->id_karyawan)->first()->getAlamatAsal)){
            return abort(404);
        }
        $data_pass = [
            'data' => $data_alamat
        ];
        return response()->json($data_pass);
    }

    public function store_alamat(Request $req)
    {
        $this->validate($req,[
            'alamat_asal' => 'required',
            'id_prov' =>' required',
            'id_kab' =>' required'
        ]);

        $alamat_asal = $req->alamat_asal;
        $id_prov = $req->id_prov;
        $id_kab = $req->id_kab;

        $model_asal = asal::updateOrCreate(['id_ky'=> $this->id_karyawan, 'id_perusahaan'=> $this->id_perusahaan],
            ['alamat_asal'=> $alamat_asal, 'id_prov'=> $id_prov,'id_kab'=> $id_kab,'id_karyawan'=> $this->id_karyawan]);
        if($model_asal->save())
        {
            $feedback = [
                'message'=>'Alamat telah diubah',
                'status'=> true
            ];
            return response()->json($feedback);
        }else{
            $feedback = [
                'message'=>'Terjadi kesalahan',
                'status'=> false
            ];
            return response()->json($feedback);
        }
    }

    public function data_alamat_sek()
    {
        if(empty($data_alamat = karyawans::where('id',$this->id_karyawan)->first()->getAlamatSek)){
            return abort(404);
        }
        $data_pass = [
            'data' => $data_alamat
        ];
        return response()->json($data_pass);
    }

    public function store_alamat_sek(Request $req)
    {
        $this->validate($req,[
            'alamat_asal' => 'required',
            'id_prov' =>' required',
            'id_kab' =>' required'
        ]);

        $alamat_asal = $req->alamat_asal;
        $id_prov = $req->id_prov;
        $id_kab = $req->id_kab;

        $model_asal = sekarang::updateOrCreate(['id_ky'=> $this->id_karyawan, 'id_perusahaan'=> $this->id_perusahaan],
            ['alamat_sek'=> $alamat_asal, 'id_prov'=> $id_prov,'id_kab'=> $id_kab,'id_karyawan'=> $this->id_karyawan]);
        if($model_asal->save())
        {
            $feedback = [
                'message'=>'Alamat telah diubah',
                'status'=> true
            ];
            return response()->json($feedback);
        }else{
            $feedback = [
                'message'=>'Terjadi kesalahan',
                'status'=> false
            ];
            return response()->json($feedback);
        }
    }

    public function data_keluarga()
    {
        if(empty($data_keluarga = karyawans::where('id',$this->id_karyawan)->first()->getDataKeluarga)){
            return abort(404);
        }
        $data_pass = [
            'data' => $data_keluarga
        ];
        return response()->json($data_pass);
    }

    public function update_keluarga(Request $req)
    {
        $this->validate($req,[
            'nm_ayah' => 'required',
            'status_a' => 'required',
            'nm_ibu' => 'required',
            'status_i' =>'required',
            'jum_saudara' => 'required',
            'anak_ke' => 'required',
            'cp_darurat' => 'required',
            'telp_darurat' => 'required',
        ]);

        $nm_ayah = $req->nm_ayah;
        $status_a = $req->status_a;
        $nm_ibu = $req->nm_ibu;
        $status_i = $req->status_i;
        $jum_saudara = $req->jum_saudara;
        $anak_ke = $req->anak_ke;
        $cp_darurat = $req->cp_darurat;
        $telp_darurat = $req->telp_darurat;

        $model = keluarga::updateOrCreate(['id_perusahaan'=>$this->id_perusahaan,'id_ky'=>$this->id_karyawan],
            [
                'nm_ayah'=> $nm_ayah,
                'status_a'=> $status_a,
                'nm_ibu'=> $nm_ibu,
                'status_i'=> $status_i,
                'jum_saudara'=> $jum_saudara,
                'anak_ke'=> $anak_ke,
                'cp_darurat'=> $cp_darurat,
                'telp_darurat'=> $telp_darurat,
                'id_perusahaan'=> $this->id_perusahaan,
                'id_karyawan'=> $this->id_karyawan,
            ]);
        if($model->save())
        {
            return redirect('profil')->with('message_success', 'Anda telah mengubah data keluarga anda');
        }else{
            return redirect('profil')->with('message_fail', 'Maaf, Telah terjadi kesalahan. silahkan coba lagi');
        }
    }

    public function update_upload_kk_keluarga(Request $req)
    {


        $this->validate($req,[
            'file_kk'=> 'required|image|mimes:jpg,png,gif,jpeg'
        ]);

        $file_kk= $req->file_kk;
        $name_file = time().'_SKK.'.$file_kk->getClientOriginalExtension();
        $model = keluarga::where('id_perusahaan',$this->id_perusahaan)->where('id_ky',$this->id_karyawan)->first();
        $model->file_kk = $name_file;

        if(!empty($model->file_kk))
        {
            $file_path =public_path('FileScanKK').'/' . $model->file_kk;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($model->save())
        {
            if($file_kk->move(public_path('FileScanKK'), $name_file))
            {
                return redirect('profil')->with('message_success', 'Anda telah mengubah data keluarga anda');
            }
            else
            {
                return redirect('profil')->with('message_fail', 'Gagal, Mengunggah File KK');
            }
            return redirect('profil')->with('message_success', 'Anda telah mengubah data keluarga anda');
        }
    }

    public function store_email(Request $request)
    {
        $this->validate($request, [
           'nm_email'=> 'required'
        ]);

        $nm_email = $request->nm_email;
        $model = new email_ky;
        $model->id_ky = $this->id_karyawan;
        $model->nm_email = $nm_email;
        $model->id_karyawan = $this->id_karyawan;
        $model->id_perusahaan = $this->id_perusahaan;

        if ($model->save())
        {
            return redirect('profil')->with('message_success', 'Anda telah menambahkan email baru');
        }else
        {
            return redirect('profil')->with('message_fail', 'Gagal, memasukan email. silahkan tambahkan ulan email anda');
        }

    }

    public function delete_email(Request $request,$id)
    {
        if(empty($data_model = email_ky::where('id', $id)->where('id_ky', $this->id_karyawan)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        if ($data_model->delete())
        {
            return redirect('profil')->with('message_success', 'Anda telah menghapus email ');
        }else
        {
            return redirect('profil')->with('message_fail', 'Gagal, menghapus email. silahkan menghapus ulang email anda');
        }
    }


    public function store_hp(Request $request)
    {
        $this->validate($request,[
            'hp' => 'required',
            'status_hp' => 'required'
        ]);

        $hp = $request->hp;
        $status_hp = $request->status_hp;

        $model = new hp_ky;
        $model->id_ky = $this->id_karyawan;
        $model->hp = $hp;
        $model->status_hp = $status_hp;
        $model->id_karyawan = $this->id_karyawan;
        $model->id_perusahaan = $this->id_perusahaan;
        if($model->save())
        {
            return redirect('profil')->with('message_success', 'Anda telah menambah no. handphone baru');
        }
        else
        {
            return redirect('profil')->with('message_fail',  'Gagal, memasukan email. silahkan memasukan ulang no.handphone anda');
        }

    }

    public function delete_hp(Request $request,$id)
    {
        if(empty($data_model = hp_ky::where('id', $id)->where('id_ky', $this->id_karyawan)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        if ($data_model->delete())
        {
            return redirect('profil')->with('message_success', 'Anda telah menghapus no.handphone ');
        }else
        {
            return redirect('profil')->with('message_fail', 'Gagal, menghapus no.handphone. silahkan menghapus ulang no.handphone anda');
        }
    }


    public function ganti_password_karyawan(){
        $data = [
            'data'=> karyawans::findOrFail(Session::get('id_karyawan'))
        ];
        return view('user.karyawan.section.ganti_password.page_default', $data);
    }

    public function ganti_password_karyawan_proses(Request $req){
        $model = karyawans::findOrFail(Session::get('id_karyawan'));
        $model->username = $req->username;
        $model->nama_ky = $req->nama_ky;
        $model->password = bcrypt($req->password);
        if($model->save()){
            return redirect()->back()->with('message_success','Anda telah mengubah akun anda');
        }else{
            return redirect()->back()->with('message_fail','gagal, mengubah akun anda');
        }
    }
}
