<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Karyawan\StrukturPerusahaan as bagan;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;

class StruturPerusahaan extends Controller
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
        if(empty($data_bagan= bagan::all()->where('id_perusahaan', $this->id_perusahaan))){
            return abort(404);
        }

        if(empty($data_karyawan= karyawan::all()->where('id_perusahaan', $this->id_perusahaan))){
            return abort(404);
        }

        if(empty($data_jabatan= jabatan::all()->where('id_perusahaan', $this->id_perusahaan))){
            return abort(404);
        }

        $data = [
            'parentID' => $data_bagan,
            'data_karyawan' => $data_karyawan,
            'jabatan'=> $data_jabatan
        ];

        return view('user.karyawan.section.StrukturPerusahaan.page_default', $data);
    }

    public function getRequestStrukturPerusahaan()
    {
        if(empty($bagan = bagan::all()->where('id_perusahaan', $this->id_perusahaan))){
            return abort(404);
        }
        $data_bagan_perusahaan = $bagan;
        $dataColumn = array();
        foreach ($data_bagan_perusahaan as $value)
        {
            $row = array();
            $row['Id'] = $value->id;
            $row['ParentId'] = $value->parentId;
            $row['Nama_karyawan'] = $value->getKaryawan->nama_ky;
            $row['Jabatan'] = $value->getJabatan->nm_jabatan;
            $row['Nik'] = "Nik :".$value->getKaryawan->nik;
            $row['Image'] = url('filePfoto/'.$value->getKaryawan->pas_foto);
            $dataColumn[] = $row;
        }

        return response()->json($dataColumn);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'parentId'=> 'required',
            'id_karyawan'=> 'required',
            'id_jabatan'=> 'required'
        ]);

        $parentID = $req->parentId;
        $id_karyawan =  $req->id_karyawan;
        $id_jabatan =  $req->id_jabatan;

        $model = new bagan;
        $model->parentId = $parentID;
        $model->id_karyawan = $id_karyawan;
        $model->id_jabatan = $id_jabatan;
        $model->id_perusahaan = $this->id_perusahaan;

        if($model->save())
        {
            $data = [
                'message' => 'Berhasil menambahkan bagan',
                'status'=> 'true'
            ];
            return response()->json($data);
        }else
        {
                $data = [
                    'message' => 'Gagal menambahkan bagan',
                    'status'=> 'false'
                ];
                return response()->json($data);
        }
    }

    public function getRequest($id)
    {
        if(empty($bagan = bagan::all()->where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data=[
            'bagan'=> $bagan
        ];

        return response()->json($data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'parentId'=> 'required',
            'id_karyawan'=> 'required',
            'id_jabatan'=> 'required'
        ]);

        if(empty($bagan = bagan::all()->where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $parentID = $req->parentId;
        $id_karyawan =  $req->id_karyawan;
        $id_jabatan =  $req->id_jabatan;

        $bagan->parentId = $parentID;
        $bagan->id_karyawan = $id_karyawan;
        $bagan->id_jabatan = $id_jabatan;
        $bagan->id_perusahaan = $this->id_perusahaan;

        if($bagan->save())
        {
            $data = [
                'message' => 'Berhasil mengubah bagan',
                'status'=> 'true'
            ];
            return response()->json($data);
        }else
        {
            $data = [
                'message' => 'Gagal mengubah bagan',
                'status'=> 'false'
            ];
            return response()->json($data);
        }
    }

    public function delete(Request $req, $id)
    {
        if(empty($bagan = bagan::all()->where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($bagan->delete())
        {
            $data = [
                'message' => 'Berhasil mengubah bagan',
                'status'=> 'true'
            ];
            return response()->json($data);
        }else
        {
            $data = [
                'message' => 'Gagal mengubah bagan',
                'status'=> 'false'
            ];
            return response()->json($data);
        }
    }


}
