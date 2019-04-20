<?php

namespace App\Http\Controllers\administrasi;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Pengumuman as umumkan; 

class Pengumuman extends Controller
{
	//variabel private
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
	//menampilkan halaman index pengumuman
	public function index(){
		//dd('ucuch');
		$data_umumkan = ['data_umumkan' => umumkan::where('id_perusahaan', $this->id_perusahaan)->paginate(25)];
			return view('user.administrasi.section.pengumuman.page_default', $data_umumkan); 
	}
	//membuat halaman tambah peralatan
	 public function create(){
		return view('user.administrasi.section.pengumuman.page_create');
	}
	//simpan pengumuman
	public function store(Request $req)
	{
		//menseting validasi input form
		$this->validate($req, [
			'tgl_dibuat' => 'required',
			'isi_p' => 'required',
		]);
		
		//membuat variabel untuk menampung nilai field yg di input // asiggment
		$tgl_dibuat = $req->tgl_dibuat;
		$isi_p = $req->isi_p;
		
		//menginsert data yg diinput ke setiap field 
		$model = new umumkan;
		$model->tgl_dibuat = date('Y-m-d', strtotime($tgl_dibuat));
		$model->isi_p = $isi_p;
		$model->id_perusahaan =  $this->id_perusahaan;
		$model->id_karyawan=  $this->id_karyawan;
		
		//pesan jika berhasil insert
		if($model->save()){
                return redirect('Pengumuman')->with('message_success','Berhasil menambah data pengumuman');
            }else{
                return redirect('tambah-pengumuman/'. $id_usaha)->with('message_error','Gagal menyimpan data pengumuman');
            }
	}
	//edit pengumuman
	public function edit($id)
    {
        if(empty($data_umumkan =  umumkan::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        $data = [
            'data_umumkan'=> $data_umumkan
        ];
        return view('user.administrasi.section.pengumuman.page_edit', $data);
    }
	//update
	 public function update(Request $req, $id)
    {
        $this->validate($req, [
			'tgl_dibuat' => 'required',
			'isi_p' => 'required',
        ]);

        //membuat variabel untuk menampung nilai field yg di input
		$tgl_dibuat = $req->tgl_dibuat;
		$isi_p = $req->isi_p;
        
		$model = umumkan::find($id);
		$model->tgl_dibuat = date('Y-m-d', strtotime($tgl_dibuat));
		$model->isi_p = $isi_p;
		$model->id_perusahaan =  $this->id_perusahaan;
		$model->id_karyawan=  $this->id_karyawan;

        if($model->save())
        {
            return redirect('Pengumuman')->with('message_success','Berhasil mengubah data pengumuman');
            }else{
                return redirect('Pengumuman')->with('message_error','Gagal menyimpan data pengumuman');
            }
            return redirect('Pengumuman')->with('message_success','Berhasil mengubah data pengumuman');
    }
	//delete
	public function delete(Request $req, $id){
		
		$model = umumkan::find($id);
		if($model->delete()){
			return redirect('Pengumuman')->with('message_success','Berhasil Menghapus data pengumuman');
		} else{
			return redirect('Pengumuman')->with('message_fail','Gagal Menghapus data pengumuman');
		}	
	}
	//cari pengumuman
	public function cari(Request $req)
    {
        $this->validate($req,[
            'ket' => 'required'
        ]);
        $ket =$req->ket;
        $data = [
            'data_arsip'=> arsips::where('ket', 'LIKE',"{$ket}")->where('id_perusahaan', $this->id_perusahaan)->paginate(30),
            'jenis_arsip' => jenis_arsip::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.arsip.page_default', $data);
    }
	
}
