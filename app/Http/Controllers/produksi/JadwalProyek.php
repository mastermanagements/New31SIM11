<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\TaskProyek as taks_proyek;
use App\Model\Produksi\RincianTugas as rincian_Tugas;
use App\Model\Produksi\Proyek as proyek;
use App\Model\Produksi\JadwalProyek as jadwalProyeks;
use App\Model\Administrasi\SPKKontrak as spk;
use Session;

class JadwalProyek extends Controller
{

    private $id_karyawan;
    private $id_perusahaan;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[
          'proyek'=>proyek::where('id_perusahaan', $this->id_perusahaan)->paginate(15),
          'Listproyek'=>spk::all()->where('id_perusahaan', $this->id_perusahaan),
          'data_taks_proyek' => taks_proyek::all()->where('id_perusahaan', $this->id_perusahaan),
          'data_rincian_proyek' => rincian_Tugas::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.produksi.section.jadwalProyek.page_default', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[
            'task_proyek'=> taks_proyek::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.produksi.section.jadwalProyek.page_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'durasi'=> 'required',
            'tglMulai_tglAkhir' => 'required',
            'id_taksAndId_rincian' => 'required'
        ]);

        $durasi = $request->durasi;
        $split_tgl = explode(' - ', $request->tglMulai_tglAkhir);
        $split_id_task_dan_rincian = explode('-', $request->id_taksAndId_rincian);

        $tgl_mulai = date('Y-m-d', strtotime(str_replace('/','-',$split_tgl[0])));
        $tgl_akhir =  date('Y-m-d', strtotime(str_replace('/','-',$split_tgl[1])));
        $id_task = $split_id_task_dan_rincian[0];
        $id_rincian = $split_id_task_dan_rincian[1];

        $model = new jadwalProyeks;
        $model->id_task_p=$id_task;
        $model->id_rincian_p=$id_rincian;
        $model->durasi=$durasi;
        $model->tgl_mulai=$tgl_mulai;
        $model->tgl_selesai=$tgl_akhir;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save())
        {
            return redirect('Jadwal-Proyek')->with('message_success',"Jadwal Proyek telah ditambahkan");
        }
        else{
            return redirect('Jadwal-Proyek')->with('message_fail',"Maaf, telah terjadi kesalahan silahkan coba lagi");
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        $id_spk = $req->id_spk;
        $data=[
            'proyek'=>proyek::where('id_spk',$id_spk)->where('id_perusahaan', $this->id_perusahaan)->paginate(15),
            'Listproyek'=>spk::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_taks_proyek' => taks_proyek::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_rincian_proyek' => rincian_Tugas::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.produksi.section.jadwalProyek.page_default', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(empty($mode=jadwalProyeks::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
           return  abort(404);
        }

        $data=[
            'task_proyek'=> taks_proyek::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_jadwal'=> $mode
        ];
        return view('user.produksi.section.jadwalProyek.page_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'durasi'=> 'required',
            'tglMulai_tglAkhir' => 'required',
            'id_taksAndId_rincian' => 'required'
        ]);

        $durasi = $request->durasi;
        $split_tgl = explode(' - ', $request->tglMulai_tglAkhir);
        $split_id_task_dan_rincian = explode('-', $request->id_taksAndId_rincian);

        $tgl_mulai = date('Y-m-d', strtotime(str_replace('/','-',$split_tgl[0])));
        $tgl_akhir =  date('Y-m-d', strtotime(str_replace('/','-',$split_tgl[1])));
        $id_task = $split_id_task_dan_rincian[0];
        $id_rincian = $split_id_task_dan_rincian[1];

        $model = jadwalProyeks::find($id);
        $model->id_task_p=$id_task;
        $model->id_rincian_p=$id_rincian;
        $model->durasi=$durasi;
        $model->tgl_mulai=$tgl_mulai;
        $model->tgl_selesai=$tgl_akhir;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save())
        {
            return redirect('Jadwal-Proyek')->with('message_success',"Jadwal Proyek telah diubah");
        }
        else{
            return redirect('Jadwal-Proyek')->with('message_fail',"Maaf, telah terjadi kesalahan silahkan coba lagi");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id)
    {
        $model = jadwalProyeks::find($id);

        if($model->delete())
        {
            return redirect('Jadwal-Proyek')->with('message_success',"Jadwal Proyek telah dihapus");
        }
        else{
            return redirect('Jadwal-Proyek')->with('message_fail',"Maaf, telah terjadi kesalahan silahkan coba lagi");
        }
    }
}
