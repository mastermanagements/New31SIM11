<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\TaskProyek as taskProyeks;
use App\Model\Produksi\Proyek as proyek;
use Session;

class TaskProyek extends Controller
{

    private $id_karyawan;
    private $id_perusahaan;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function create()
    {
        $data=[
            'proyek' => proyek::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.produksi.section.jadwalProyek.taksProyek.page_create', $data);
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'nama_tugas'=> 'required',
            'id_proyek'=> 'required'
        ]);

        $nama_tugas = $request->nama_tugas;
        $id_proyek = $request->id_proyek;

        $model = new taskProyeks;
        $model->nama_tugas= $nama_tugas;
        $model->id_proyek= $id_proyek;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect()->back()->with('message_success', 'Anda Baru saja menambahkan taks proyek baru');
        }else{
            return redirect()->back()->with('message_fail', 'Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(empty($model = taskProyeks::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data=[
          'data' => $model,
            'proyek' => proyek::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.produksi.section.jadwalProyek.taksProyek.page_edit', $data);
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
            'nama_tugas'=> 'required',
            'id_proyek'=> 'required'
        ]);

        $nama_tugas = $request->nama_tugas;
        $id_proyek = $request->id_proyek;
        $model = taskProyeks::find($id);
        $model->id_proyek= $id_proyek;
        $model->nama_tugas= $nama_tugas;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Proyek')->with('message_success', 'Anda Baru saja mengubah taks proyek ')->with('tab3','tab3');
        }else{
            return redirect('Proyek')->with('message_fail', 'Maaf, telah terjadi kesalahan silahkan coba lagi')->with('tab3','tab3');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(empty($model = taskProyeks::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($model->delete()){
            return redirect('Proyek')->with('message_success', 'Anda Baru saja menghapus taks proyek')->with('tab3','tab3');
        }else{
            return redirect('Proyek')->with('message_fail', 'Maaf, telah terjadi kesalahan silahkan coba lagi')->with('tab3','tab3');
        }
    }
}
