<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Proyek as proyeks;
use App\Model\Administrasi\SPKKontrak as spk;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Produksi\JadwalProyek as jadwalProyeks;
use App\Model\Produksi\TaskProyek as taks_proyek;
use App\Model\Produksi\RincianTugas as rincian_Tugas;
use App\Model\Produksi\TaskProyek as taskProyeks;
use App\Model\Produksi\ProgressProyek as progress_proyek;
use App\Model\Produksi\JenisPemeliharaan;
use App\Model\Produksi\Jasa as jasa;
use App\Model\Produksi\Pemeliharaan as pemeliharaans;
use Session;

class Proyek extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;

    private $jenis_proyek = [
        '0'=> 'Proyek Internal',
        '1'=> 'Proyek Pesanan Klien',
    ];

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
        $data = [
          'proyeks'=> proyeks::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(),
          'spk'=> spk::all()->where('id_perusahaan', $this->id_perusahaan),
		  'karyawan'=> karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
		  'Listproyek'=>spk::all()->where('id_perusahaan', $this->id_perusahaan),
          'data_taks_proyek' => taks_proyek::all()->where('id_perusahaan', $this->id_perusahaan),
          'data_rincian_proyek' => rincian_Tugas::all()->where('id_perusahaan', $this->id_perusahaan),
		   'jenis_pemeliharaan' => JenisPemeliharaan::all()->where('id_perusahaan', $this->id_perusahaan),
          'data_pemeliaraan'=> pemeliharaans::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(15)
		  
        ];
		 if(empty(Session::get('tab2')) && empty(Session::get('tab3')) && empty(Session::get('tab4')) && empty(Session::get('tab5')) && empty(Session::get('tab6'))){
                  Session::flash('tab1','tab1');
              }

              if(!empty(Session::get('tab2'))){
                  Session::flash('tab2',Session::get('tab2'));
              }

              if(!empty(Session::get('tab3'))){
                  Session::flash('tab3',Session::get('tab3'));
              }

              if(!empty(Session::get('tab4'))){
                  Session::flash('tab4',Session::get('tab4'));
              }
			  if(!empty(Session::get('tab5'))){
                  Session::flash('tab5',Session::get('tab5'));
              }
			  if(!empty(Session::get('tab6'))){
                  Session::flash('tab6',Session::get('tab6'));
              }
        return view('user.produksi.section.proyek.page_default', $data);
    }

    public function cari(Request $request){
        $spk = $request->id_spk;
        $data = [
            'proyeks'=> proyeks::where('id_perusahaan', $this->id_perusahaan)->where('id_spk', $spk)->paginate(),
            'spk'=> spk::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.produksi.section.proyek.page_default', $data);
    }

    public function create()
    {
        $data = [
            'spk'=> spk::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_proyek' => $this->jenis_proyek
        ];
        return view('user.produksi.section.proyek.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'jenis_proyek'=> 'required',
            'id_spk'=> 'required',
            'jangka_waktu'=> 'required',
            'detail_proyek' => 'required',
        ]);

        $jenis_proyek = $req->jenis_proyek;
        $id_spk = $req->id_spk;
        $jangka_waktu = $req->jangka_waktu;
        $detail_proyek = $req->detail_proyek;

        $model = new proyeks;
        $model->jenis_proyek = $jenis_proyek;
        $model->id_spk = $id_spk;
        $model->jangka_waktu = $jangka_waktu;
        $model->rincian_proyek = $detail_proyek;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save())
        {
            return redirect('Proyek')->with('message_success', 'Anda telah menambahkan proyek baru');
        }else{
            return redirect('Proyek')->with('message_fail', 'Maaf, telah terjadi kesalahan. silahkan coba lagi untuk menambahkan proyek anda');
        }
    }

    public function edit($id)
    {
        if(empty($data = proyeks::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data = [
            'spk'=> spk::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_proyek' => $this->jenis_proyek,
            'data'=>$data
        ];
        return view('user.produksi.section.proyek.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'jenis_proyek'=> 'required',
            'id_spk'=> 'required',
            'jangka_waktu'=> 'required',
            'detail_proyek' => 'required',
        ]);

        $jenis_proyek = $req->jenis_proyek;
        $id_spk = $req->id_spk;
        $jangka_waktu = $req->jangka_waktu;
        $detail_proyek = $req->detail_proyek;

        $model = proyeks::find($id);
        $model->jenis_proyek = $jenis_proyek;
        $model->id_spk = $id_spk;
        $model->jangka_waktu = $jangka_waktu;
        $model->rincian_proyek = $detail_proyek;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save())
        {
            return redirect('Proyek')->with('message_success', 'Anda telah mengubah proyek ');
        }else{
            return redirect('Proyek')->with('message_fail', 'Maaf, telah terjadi kesalahan. silahkan coba lagi untuk mengubah proyek anda');
        }
    }

    public function delete(Request $req, $id)
    {

        if(empty($model = proyeks::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($model->delete())
        {
            return redirect('Proyek')->with('message_success', 'Anda telah menghapus proyek ');
        }else{
            return redirect('Proyek')->with('message_fail', 'Maaf, telah terjadi kesalahan. silahkan coba lagi untuk mengahpus proyek anda');
        }
    }

}
