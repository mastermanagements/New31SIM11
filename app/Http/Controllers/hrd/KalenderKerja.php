<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_kalender_kerja as kalender;

class KalenderKerja extends Controller
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

    public function index()
    {
        return view('user.hrd.section.kalender_kerja.page_default');
    }

    public function getEventKalender(){
        $data = kalender::all()->where('id_perusahaan', $this->id_perusahaan);
        $column = array();
        foreach ($data as $value){
            $row = array();
            $row = [
                'title'=> $value->event,
                'start'=> $value->tgl_mulai,
                'end'=>  $value->tgl_akhir,
            ];
            $column[] = $row;
        }
        return response()->json($column);
    }

    public function daftarEvent()
    {
        $data=[
            'event'=> kalender::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.kalender_kerja.event.page_default', $data);
    }

    public function create()
    {
        return view('user.hrd.section.kalender_kerja.event.page_create');
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'tgl_mulai' =>'required',
           'tgl_akhir' => 'required',
           'event' => 'required'
        ]);

        $tgl_mulai = date('Y-m-d', strtotime($req->tgl_mulai));
        $tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
        $event = $req->event;

        $model =  new kalender();
        $model->event = $event;
        $model->tgl_mulai = $tgl_mulai;
        $model->tgl_akhir = $tgl_akhir;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('daftar-event-kalender')->with('message_success','Anda telah menambahkan event');
        }else{
            return redirect('daftar-event-kalender')->with('message_fail','Maaf, gagal menambahkan event');
        }

    }

    public function edit($id)
    {
        if(empty($model = kalender::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'data'=> $model
        ];

        return view('user.hrd.section.kalender_kerja.event.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'tgl_mulai' =>'required',
            'tgl_akhir' => 'required',
            'event' => 'required'
        ]);

        $tgl_mulai = date('Y-m-d', strtotime($req->tgl_mulai));
        $tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
        $event = $req->event;

        $model =  kalender::find($id);
        $model->event = $event;
        $model->tgl_mulai = $tgl_mulai;
        $model->tgl_akhir = $tgl_akhir;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('daftar-event-kalender')->with('message_success','Anda telah mengubah event');
        }else{
            return redirect('daftar-event-kalender')->with('message_fail','Maaf, gagal mengubah event');
        }

    }


    public function delete(Request $req, $id)
    {
        $model =  kalender::find($id);
        if($model->delete())
        {
            return redirect('daftar-event-kalender')->with('message_success','Anda telah menghapus event');
        }else{
            return redirect('daftar-event-kalender')->with('message_fail','Maaf, gagal menghapus event');
        }

    }

}
