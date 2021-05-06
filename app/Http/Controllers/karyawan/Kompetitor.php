<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_Kompetitor as kompetitors;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use App\Model\Superadmin_sim\U_kabupaten as kabupaten;

use Session;

class Kompetitor extends Controller
{
    private $id_perusahaan;
	private $id_karyawan;

	//mengecek session yang aktif
	public function __construct()
	{
		$this->middleware(function($req, $next){
			if (empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
			{
				Session::flush();
				return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan Login Ulang...!!');
			}
			$this->id_karyawan = Session::get('id_karyawan');
			$this->id_perusahaan = Session::get('id_perusahaan_karyawan');
			return $next($req);
		});
	}
	//menampilkan halaman index peralatan
	public function index(){
		//dd('ucuch');
		$data = [
		 'data_kompetitor' => kompetitors::all()->where('id_perusahaan', $this->id_perusahaan)
		 ];

			return view('user.karyawan.section.kompetitor.page_default', $data);
	}

	 public function create()
    {
		$data_pass =[
            'provinsi'=> provinsi::all()
        ];
        return view('user.karyawan.section.kompetitor.page_create', $data_pass);
    }

	public function store(Request $req)
    {
       // dd($req->all());
        $this->validate($req,[
           'nm_kompetitor' => 'required',
           'badan_hukum' => 'required',
           'bidang_usaha' => 'required',
           'alamat' => 'required',
           'id_provinsi' => 'required',
           'id_kabupaten' => 'required',

        ]);

        $nm_kompetitor = $req->nm_kompetitor;
        $badan_hukum = $req->badan_hukum;
        $bidang_usaha = $req->bidang_usaha;
        $alamat = $req->alamat;
        $id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $cp = $req->cp;
        $telp = $req->telp;
        $hp = $req->hp;
        $wa = $req->wa;
        $teleg = $req->teleg;
        $email = $req->email;
        $web = $req->web;
        $akun_fb = $req->akun_fb;
        $fanspages = $req->fanspages;
        $twitter = $req->twitter;
        $ig = $req->ig;

        $model = new kompetitors;
        $model->nm_kompetitor = $nm_kompetitor;
        $model->badan_hukum = $badan_hukum;
        $model->bidang_usaha = $bidang_usaha;
        $model->alamat = $alamat;
        $model->id_prov = $id_provinsi;
        $model->id_kab = $id_kabupaten;
        $model->cp = $cp;
        $model->telp = $telp;
        $model->hp = $hp;
        $model->wa = $wa;
        $model->teleg = $teleg;
        $model->email = $email;
        $model->web = $web;
        $model->akun_fb = $akun_fb;
        $model->fanspages = $fanspages;
        $model->twitter = $twitter;
        $model->ig = $ig;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
                return redirect('Kompetitor')->with('message_success','Anda baru saja menambahkan data kompetitor baru');
            }else{
                return redirect('Kompetitor')->with('message_fail','Terjadi kesalahan, silahkan ulangi lagi');
            }
    }

	public function edit($id)
    {
        if(empty($data_kompetitor =  kompetitors::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'data_kompetitor'=> $data_kompetitor,
			'provinsi'=> provinsi::all(),
			'kabupaten'=> kabupaten::all()
        ];
		return view('user.karyawan.section.kompetitor.page_edit', $data);
    }

	//update
	 public function update(Request $req, $id)
    {
        $this->validate($req, [
            'nm_kompetitor' => 'required',
           'badan_hukum' => 'required',
           'bidang_usaha' => 'required',
           'alamat' => 'required',
           'id_provinsi' => 'required',
           'id_kabupaten' => 'required',
        ]);

        //membuat variabel untuk menampung nilai field yg di input
		$nm_kompetitor = $req->nm_kompetitor;
        $badan_hukum = $req->badan_hukum;
        $bidang_usaha = $req->bidang_usaha;
        $alamat = $req->alamat;
        $id_provinsi = $req->id_provinsi;
        $id_kabupaten = $req->id_kabupaten;
        $cp = $req->cp;
        $telp = $req->telp;
        $hp = $req->hp;
        $wa = $req->wa;
        $teleg = $req->teleg;
        $email = $req->email;
        $web = $req->web;
        $akun_fb = $req->akun_fb;
        $fanspages = $req->fanspages;
        $twitter = $req->twitter;
        $ig = $req->ig;

        //insert value ke tabel

		$model = kompetitors::find($id);
		$model->nm_kompetitor = $nm_kompetitor;
        $model->badan_hukum = $badan_hukum;
        $model->bidang_usaha = $bidang_usaha;
        $model->alamat = $alamat;
        $model->id_prov = $id_provinsi;
        $model->id_kab = $id_kabupaten;
        $model->cp = $cp;
        $model->telp = $telp;
        $model->hp = $hp;
        $model->wa = $wa;
        $model->teleg = $teleg;
        $model->email = $email;
        $model->web = $web;
        $model->akun_fb = $akun_fb;
        $model->fanspages = $fanspages;
        $model->twitter = $twitter;
        $model->ig = $ig;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Kompetitor')->with('message_success','Anda baru saja mengubah data kompetitor');
            }else{
                return redirect('Kompetitor')->with('message_fail','Terjadi kesalahan, silahkan ulangi lagi');
            }
    }

	//delete
	public function delete(Request $req, $id){

		$model = kompetitors::find($id);
		if($model->delete()){
			return redirect('Kompetitor')->with('message_success','Berhasil Menghapus data kompetitor');
		} else{
			return redirect('Kompetitor')->with('message_fail','Gagal Menghapus data kompetitor');
		}
	}

	public function detail($id){

		 if(empty($data_kompetitor =  kompetitors::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'data_kompetitor'=> $data_kompetitor,
			'provinsi'=> provinsi::all()
        ];

			return view('user.karyawan.section.kompetitor.detail_page', $data);
	}

	 public function getProvinsi()
    {
        $model = provinsi::all();
        return $model;
    }

    public function getKabupatenK($id=1)
    {
        $model = kabupaten::all()->where('id_provinsi', $id);
        return $model;
    }
    public function ResponseKabupaten($id_kabupaten){
        return response()->json($this->getKabupatenK($id_kabupaten));
    }
}
