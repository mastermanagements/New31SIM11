<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\TaskProyek as taks_proyek;
use App\Model\Produksi\RincianTugas as rincian_Tugas;
use App\Model\Produksi\Proyek as proyek;
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
            'task_proyek'=> taks_proyek::all()->where('id_perusahaan', $this->id_perusahaan)
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
            return redirect('tambah-jadwal-proyek')->with('message_success',"Jadwal Proyek telah ditambahkan");
        }
        else{
            return redirect('tambah-jadwal-proyek')->with('message_fail',"Maaf, telah terjadi kesalahan silahkan coba lagi");
        }

    }

    public function ambilDaftarJadwalProyek($id_proyek)
    {
        $model = taks_proyek::all()->where('id_proyek', $id_proyek)->where('id_perusahaan', $this->id_perusahaan);
        $column = array();
        foreach ($model as $task_proyek)
        {
            $row = array();
            $subcolumn = array();
            $suSubbcolumn = array();
            $row[] = $task_proyek->nama_tugas;
            foreach ($task_proyek->rincian_tugas as $rincian_tugas)
            {
                $row_subRow =array();
                $row_subRow[] = $rincian_tugas->rincian_tugas;
                $subcolumn[] = $row_subRow;
            }
            $row[] = $subcolumn;

            foreach ($task_proyek->jadwal_proyek as $data_jadwal){
                $row_subRow1 =array();
                $row_subRow1[] = $data_jadwal->durasi;
                $row_subRow1[] = $data_jadwal->tgl_mulai;
                $row_subRow1[] = $data_jadwal->tgl_selesai;
                $row_subRow1[] =  '<button type="button" onclick="hapus_jadwal('.$data_jadwal->id.')">hapus</button>';
                $suSubbcolumn[] = $row_subRow1;
            }
            $row[] = $suSubbcolumn;
            $column[] = $row;
        }
        return response()->json($column);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
