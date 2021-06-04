<?php

namespace App\Http\Controllers\superadmin_ukm;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Session;
use App\Model\Superadmin_ukm\U_user_ukm as superadmin_ukms;
use App\Model\Superadmin_ukm\U_profil_ukm as profil_user_ukm;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use App\Model\Superadmin_sim\U_kabupaten as kabupaten;
use App\Model\Superadmin_ukm\U_usaha as perusahaan;
use App\Model\Superadmin_ukm\A_visi_p as visi_p;
use App\Model\Superadmin_ukm\A_misi_p as misi_p;
use App\Model\Superadmin_ukm\U_Akta as akta_p;
use App\Model\Superadmin_ukm\U_ijin_usaha as ijin;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatans;

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
            Session::put('main_menu','pengaturan_awal-data_perusahaan');
            return $next($req);
        });
    }

    public function index()
    {
        $pass_data = [
            'data_user'=> $this->getFavoriteData()['data_user'],
            'profil_user_ukm'=> $this->getFavoriteData()['profil_user_ukm'],
            'content_menu'=> 'profil',
            'usaha'=> $this->getFavoriteData()['data_usaha']
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function editProfileSuperadminUkm()
    {
        $pass_data = [
            'menu'=>'edit',
            'data_user'=>$this->getFavoriteData()['data_user'],
			'profil_user_ukm'=>$this->getFavoriteData()['profil_user_ukm'],
            'provinsi'=>$this->getProvinsi(),
            'kabupaten' => $this->getKabupaten(),
            'usaha'=> $this->getFavoriteData()['data_usaha'],
            'content_menu' => 'profil'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function updateProfile(Request $req, $id)
    {
        $this->validate($req, [
            'foto'=>'image|mimes:jpeg,png,gif,jpg|max:2048',
            'nama'=>'required',
            'email'=>'required',
            'id_provinsi'=>'required',
            'id_kabupaten'=>'required',
            'hp'=>'required',
            'wa'=>'required',
        ]);
        //simpan value inputan yg diisi ke @ variabel untuk tabel superadmin_ukms
       // $id = $req->id;
        $nama = $req->nama;
        $email= $req->email;
		//simpan value inputan yg diisi ke @ variabel untuk tabel profil_user_ukm
		$id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $telp =  $req->telp;
        $hp = $req->hp;
        $wa = $req->wa;
        $telegram = $req->telegram;
		//temukan data di tabel superadmin_ukm yg id nya sama
        $model_user_ukm = superadmin_ukms::find($id);
		//dd($model_user_ukm);
        //insert value req ke field tabel superadmin_ukms
        $model_user_ukm->nama =$nama;
        $model_user_ukm->email =$email;
		
        $model_profil_user_ukm = profil_user_ukm::where('id', $model_user_ukm->id)->first();
		//dd($model_profil_user_ukm);
		$model_profil_user_ukm->telp =$telp;
		$model_profil_user_ukm->hp =$hp;
		$model_profil_user_ukm->wa =$wa;
		$model_profil_user_ukm->telegram =$telegram;
		$model_profil_user_ukm->provinsi_id =$id_provinsi;
		$model_profil_user_ukm->kab_id =$id_kabupaten;
		//khusus foto
		//cek jika tidak ada file foto yg mau di upload
		 if(isset($_FILES['foto'])){
				$foto 		= $req->file('foto');
				$image_name = time().'.'.$foto->getClientOriginalName();
				$foto->move(public_path('image_superadmin_ukm'), $image_name);
				
				//jika foto yg di upload sama dg yg sdh ada
				if(file_exists(public_path($image_name = time().'.'.$foto->getClientOriginalName()))){
					unlink(public_path($image_name));
				}
		//update foto di tabel
		$model_profil_user_ukm->foto = $image_name;
		} 
		
		if($req->file !=''){
			$path = public_path().'/image_superadmin_ukm';
			//remove old foto
			if($model_profil_user_ukm->foto !='' && $model_profil_user_ukm->foto != null){
				$file_old = $path.$model_profil_user_ukm->foto;
				unlink($file_old);
			}
			$foto = $req->foto;
			$image_name = $foto->getClientOriginalName();
			$foto->move($path, $image_name);
			
			$model_profil_user_ukm->foto = $image_name;	
		}
		
		if($model_user_ukm->save() AND $model_profil_user_ukm->save()){
                    return redirect('pengaturan-perusahaan')->with('message_success','Profil anda berhasil diperbarui');
                }else{
                    return redirect('pengaturan-perusahaan')->with('message_error','Profil anda gagal di update');
                }						
    } 
	
	//alternatif
	/*public function updateProfile(Request $req, $id)
    {
        $this->validate($req, [
            'foto'=>'image|mimes:jpeg,png,gif,jpg|max:2048',
            'nama'=>'required',
            'email'=>'required',
            'id_provinsi'=>'required',
            'id_kabupaten'=>'required',
            'hp'=>'required',
            'wa'=>'required',
        ]);
        $foto = $req->foto;
        $nama = $req->nama;
        $email= $req->email;
        $id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $telp =  $req->telp;
        $hp = $req->hp;
        $wa = $req->wa;
        $tegram = $req->telegram;
        
		$image_name = time().'.'.$foto->getClientOriginalExtension();
		
        $model_user_ukm = superadmin_ukms::find($id);
		
     
        $model_user_ukm->nama =$nama;
        $model_user_ukm->email =$email;
        $model_user_ukm->password =$password;
		//dd($model_user_ukm);
        if($model_user_ukm->save())
        {
            $profil_user_ukm = profil_user_ukm::updateOrCreate([
                'id_user_ukm'=>$model_user_ukm->id
            ],[
                'telp'=>$telp,
                'hp'=>$hp,
                'wa'=>$wa,
                'telegram'=>$tegram,
                'provinsi_id'=>$id_provinsi,
                'kab_id'=>$id_kabupaten,
                'foto'=>$image_name
            ]);
            if($profil_user_ukm->save()){
                if ($foto->move(public_path('image_superadmin_ukm'), $image_name)) {
                    return redirect('pengaturan-perusahaan')->with('message_success','Profil anda berhasil diperbarui');
                }else{
                    return redirect('pengaturan-perusahaan')->with('message_error','Profil anda berhasil diperbarui namun foto gagal diupload');
                }
            }
        }
        return redirect('editprofile')->with('message_error','Data tidak boleh kosong');
    }*/

    public function getFavoriteData(){
        $data = [
            'data_user'=> $this->getDataSuperadmin(),
            'profil_user_ukm' => $this->getDataPerusahaan(),
            'data_usaha'=> perusahaan::where('id_user_ukm', $this->id_superadmin)->paginate(6),
            'visi' => visi_p::where('id_user_ukm', $this->id_superadmin)->paginate(6),
            'misi' => misi_p::where('id_user_ukm', $this->id_superadmin)->paginate(6),
            'akta' => akta_p::where('id_user_ukm', $this->id_superadmin)->paginate(6),
            'ijin' => ijin::all()->where('id_user_ukm', $this->id_superadmin),
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

    public function getKabupaten($id=1)
    {
        $model = kabupaten::all()->where('id_provinsi', $id);
        return $model;
    }

    public function ResponseKabupaten($id_kabupaten){
        return response()->json($this->getKabupaten($id_kabupaten));
    }

    public function profil_perusahaan(){
        $pass_data=[
            'data_user'=> $this->getFavoriteData()['data_user'],
            'profil_user_ukm'=> $this->getFavoriteData()['profil_user_ukm'],
            'content_menu'=>'profil',
            'usaha'=> $this->getFavoriteData()['data_usaha']
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function visi(){
        $pass_data=[
            'data_user'=> $this->getFavoriteData()['data_user'],
            'profil_user_ukm'=> $this->getFavoriteData()['profil_user_ukm'],
            'visi' => $this->getFavoriteData()['visi'],
            'content_menu'=>'visi'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function misi()
    {
        $pass_data=[
            'data_user'=> $this->getFavoriteData()['data_user'],
            'profil_user_ukm'=> $this->getFavoriteData()['profil_user_ukm'],
            'misi' => $this->getFavoriteData()['misi'],
            'content_menu'=>'misi'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }
    public function akta()
    {
        $pass_data=[
            'data_user'=> $this->getFavoriteData()['data_user'],
            'profil_user_ukm'=> $this->getFavoriteData()['profil_user_ukm'],
            'akta'=> $this->getFavoriteData()['akta'],
            'content_menu'=>'akta'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function izin_usaha()
    {
        $pass_data=[
            'data_user'=> $this->getFavoriteData()['data_user'],
            'profil_user_ukm'=> $this->getFavoriteData()['profil_user_ukm'],
            'ijin'=> $this->getFavoriteData()['ijin'],
            'content_menu'=>'isi_usaha'
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function jabatan_perusahaan(){
        $pass_data=[
            'data_user'=> $this->getFavoriteData()['data_user'],
            'profil_user_ukm'=> $this->getFavoriteData()['profil_user_ukm'],
            'content_menu'=>'jabatan',
            'usaha'=> $this->getFavoriteData()['data_usaha']
        ];
        return view('user.superadmin_ukm.master.section.pengaturan_awal.page_default', $pass_data);
    }

    public function jabatan_di_perusahaan($id){
        if(empty($data_perusahaan= perusahaan::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first())){
            return abort(404);
        }
        $pass_data=[
            'data_user'=> $this->getFavoriteData()['data_user'],
            'profil_user_ukm'=> $this->getFavoriteData()['profil_user_ukm'],
            'content_menu'=>'jabatan',
            'usaha'=> $data_perusahaan,
            'jabatan'=> jabatans::all()->where('id_perusahaan', $id)
        ];
        return view('user.superadmin_ukm.master.section.jabatan_perusahaan.include.jabatan_content', $pass_data);
    }
}
