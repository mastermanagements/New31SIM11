<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Administrasi\Peralatan as alat; 

class Peralatan extends Controller
{
    //
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
		$data_alat = ['data_alat' => alat::where('id_perusahaan', $this->id_perusahaan)->paginate(25)];
			return view('user.administrasi.section.peralatan.page_default', $data_alat); 
	}
	//membuat halaman tambah peralatan
	 public function create(){
		return view('user.administrasi.section.peralatan.page_create');
	}
	//memproses simpan tambah peralatan
	public function store(Request $req)
	{
		//menseting validasi input form
		$this->validate($req, [
			'nm_alat' => 'required',
			'satuan' => 'required',
			'jumlah_alat' => 'required',
			'thn_buat' => 'numeric',
			'tgl_beli' => 'required',
			'kondisi_alat' => 'required',
			'file_bukti' => 'required|image|mimes:jpeg,jpg,png,gif',
			
		]);
		//membuat variabel untuk menampung nilai field yg di input
		$nm_alat = $req->nm_alat;
		$satuan = $req->satuan;
		$jumlah_alat = $req->jumlah_alat;
		$merk = $req->merk;
		$tipe = $req->tipe;
		$thn_buat = $req->thn_buat;
		$tgl_beli = $req->tgl_beli;
		$kondisi_alat = $req->kondisi_alat;
		$bukti_kepemilikan = $req->bukti_kepemilikan;
		$file_bukti = $req->file_bukti;
		
		
		//mengatur nama file bukti yg akan di ambil
		 $name_file_bukti = time()."-bukti.".$file_bukti->getClientOriginalExtension();
		 
		
		//menginsert data yg diinput ke setiap field 
		$model = new alat;
		$model->nm_alat = $nm_alat;
		$model->satuan = $satuan;
		$model->jumlah_alat = $jumlah_alat;
		$model->merk = $merk;
		$model->tipe = $tipe;
		$model->thn_buat = $thn_buat;
		$model->tgl_beli = date('Y-m-d', strtotime($tgl_beli));
		$model->kondisi_alat = $kondisi_alat;
		$model->bukti_kepemilikan = $bukti_kepemilikan;
		$model->file_bukti = $name_file_bukti;
		$model->id_perusahaan =  $this->id_perusahaan;
		$model->id_karyawan=  $this->id_karyawan;
		
		//pesan jika berhasil insert
		if($model->save()){
			 if ($file_bukti->move(public_path('fileBukti'), $name_file_bukti)) {
                return redirect('Peralatan')->with('message_success','Berhasil menambah data inventaris peralatan');
            }else{
                return redirect('tambah-peralatan/'. $id_usaha)->with('message_error','Gagal menyimpan data inventaris peralatan');
            }
		}
	}
	//edit peralatan
	public function edit($id)
    {
        if(empty($data_alat =  alat::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'data_alat'=> $data_alat
        ];
        return view('user.administrasi.section.peralatan.page_edit', $data);
    }
	//update
	 public function update(Request $req, $id)
    {
        $this->validate($req, [
            'nm_alat' => 'required',
			'satuan' => 'required',
			'jumlah_alat' => 'required',
			'thn_buat' => 'numeric',
			'tgl_beli' => 'required',
			'kondisi_alat' => 'required',
			'file_bukti' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        //membuat variabel untuk menampung nilai field yg di input
		$nm_alat = $req->nm_alat;
		$satuan = $req->satuan;
		$jumlah_alat = $req->jumlah_alat;
		$merk = $req->merk;
		$tipe = $req->tipe;
		$thn_buat = $req->thn_buat;
		$tgl_beli = $req->tgl_beli;
		$kondisi_alat = $req->kondisi_alat;
		$bukti_kepemilikan = $req->bukti_kepemilikan;
		$file_bukti = $req->file_bukti;

        //mengatur nama file bukti yg akan di ambil
		 $name_file_bukti = time()."-bukti.".$file_bukti->getClientOriginalExtension();
        
		$model = alat::find($id);

        if(!empty($model->file_bukti))
        {
            $file_path =public_path('fileBukti').'/' . $model->file_bukti;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        $model->nm_alat = $nm_alat;
		$model->satuan = $satuan;
		$model->jumlah_alat = $jumlah_alat;
		$model->merk = $merk;
		$model->tipe = $tipe;
		$model->thn_buat = $thn_buat;
		$model->tgl_beli = date('Y-m-d', strtotime($tgl_beli));
		$model->kondisi_alat = $kondisi_alat;
		$model->bukti_kepemilikan = $bukti_kepemilikan;
		$model->file_bukti = $name_file_bukti;
		$model->id_perusahaan =  $this->id_perusahaan;
		$model->id_karyawan=  $this->id_karyawan;

        if($model->save())
        {
            if ($file_bukti->move(public_path('fileBukti'), $name_file_bukti)) {
                return redirect('Peralatan')->with('message_success','Berhasil mengubah data peralatan');
            }else{
                return redirect('Peralatan')->with('message_error','Gagal menyimpan data peralatan');
            }
            return redirect('Peralatan')->with('message_success','Berhasil mengubah data peralatan');

        }
    }
	//delete
	public function delete(Request $req, $id){
		
		$model = alat::find($id);
			if (!empty($model->fileBukti)){
				($file_path = public_path('fileBukti').'/' . $model->fileBukti);
					if (file_exists(file_path)){
					@unlink($file_path);
				}
			}
		if($model->delete()){
			return redirect('Peralatan')->with('message_success','Berhasil Menghapus data peralatan');
		} else{
			return redirect('Peralatan')->with('message_fail','Gagal Menghapus data peralatan');
		}
			
	}
	  
}
