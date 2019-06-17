<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\TJP as TJP;
use App\Model\Karyawan\SJP as sjps;
use Session;

class SJP extends Controller
{
    //
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
        $data= [
            'target_jpg'=>TJP::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
		//dd($data['target_jpg_select']);
        return view('user.karyawan.section.SJP.page_default', $data);
    }

    public function store(Request $req)
    { //dd($req->all());
        $this->validate($req,[
           'id_tjpg'=> 'required',
		   'nm_sjpg' => 'required',
           'isi_sjpg'=> 'required'
        ]);

        $id_tjpg = $req->id_tjpg;
		$nm_sjpg = $req->nm_sjpg;
        $isi_sjpg = $req->isi_sjpg;

        $model = new sjps;
        $model->id_tjpg = $id_tjpg;
		$model->nm_sjpg = $nm_sjpg;
        $model->isi_sjpg = $isi_sjpg;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Strategi-Jangka-Panjang')->with('message_success', 'Ada telah menambahkan strategi baru');
        }else{
            return redirect('Strategi-Jangka-Panjang')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang strategi anda');
        }
    }


    public function edit($id)
    {
        if(empty($data_sjp = sjps::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_sjps'=> $data_sjp
        ];
        return response()->json($data);
    }

   public function update(Request $req)
    { //dd($req->all());

        $this->validate($req,[
            'id_tjpg_ubah' => 'required',
			'nm_sjpg_ubah'=>'required',
            'isi_sjpg_ubah'=> 'required',
            'id_sjps'=> 'required'
        ]);
		
		$nm_sjpg = $req->nm_sjpg_ubah;
        $isi_sjpg = $req->isi_sjpg_ubah;
        $id_tjpg = $req->id_tjpg_ubah;
		
        if(empty($model = sjps::where('id', $req->id_sjps)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		
        $model->id_tjpg = $id_tjpg;
		$model->nm_sjpg =$nm_sjpg;
        $model->isi_sjpg =$isi_sjpg;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Strategi-Jangka-Panjang')->with('message_sucess','Anda baru saja mengubah data strategi jangka panjang perusahaan');
        }else
        {
            return redirect('Strategi-Jangka-Panjang')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

     public function delete(Request $req, $id)
    {
        if(empty($model = sjps::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete())
        {
           $res = [
               'message'=> 'Anda baru saja menghapus data strategi jangka panjang perusahaan',
               'status'=> true
           ];
           return response()->json($res);
        }else
        {
            $res = [
                'message'=> 'Terjadi Kesalahan, Silahkan hapus ulang data  anda',
                'status'=> true
            ];
            return response()->json($res);
        }
    }
	
	public function getTJPG()
    {
        $model = TJP::all();
        return $model;
    }

    public function getSJP($id=1)
    {
        $model = sjps::all()->where('id_tjpg', $id);
        return $model;
    }

    public function ResponseSJP($id_tjpg){
        return response()->json($this->getSJP($id_tjpg));
    }
}
