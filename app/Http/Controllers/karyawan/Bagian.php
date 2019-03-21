<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\Bagian as bagians;
use Session;
class Bagian extends Controller
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
        return view('user.karyawan.section.Bagian.page_default');
    }

    public function DataBagian()
    {
        if(empty($bagian = bagians::all()->where('id_perusahaan', $this->id_perusahaan))){
            return abort(404);
        }

        $column = array();
        $no=1;
        foreach ($bagian as $value)
        {
            $row = array();
            $row[] = $no++;
            $row[] = $value->nm_bagian;
            $row[] = "<a href='#' onclick='edits(".$value->id.")' class='btn btn-warning'>ubah</a>
                      <button type='button' onclick='deletes(".$value->id.")' class='btn btn-danger'>hapus</button>";
            $column [] = $row;
        }
        $output = array('data'=> $column);
        return response()->json($output);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'nm_bagian'=> 'required',
        ]);

        $nm_bagian=$req->nm_bagian;
        $model = new bagians;
        $model->nm_bagian = $nm_bagian;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            $data=[
                'message_success'=> 'Bagian telah berhasil ditambahkan',
                'status'=> true
            ];
            return response()->json($data);
        }else{
            $data=[
                'message_fail'=> 'terkadi kesalahan, Silahkan tambahkan ulang',
                'status'=> false
            ];
            return response()->json($data);
        }
    }

    public function RequestDataBagian($id)
    {
        if(empty($bagian = bagians::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data=[
            'bagian'=> $bagian
        ];

        return response()->json($data);
    }


    public function update(Request $req)
    {
        $this->validate($req,[
            'nm_bagian'=> 'required',
            'id' => 'required'
        ]);

        $nm_bagian=$req->nm_bagian;
        if(empty($model = bagians::where('id',$req->id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $model->nm_bagian = $nm_bagian;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            $data=[
                'message'=> 'Bagian telah berhasil ditambahkan',
                'status'=> true
            ];
            return response()->json($data);
        }else{
            $data=[
                'message'=> 'terkadi kesalahan, Silahkan tambahkan ulang',
                'status'=> false
            ];
            return response()->json($data);
        }
    }


    public function delete($id)
    {
        if(empty($model = bagians::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($model->delete())
        {
            $data=[
                'message'=> 'Bagian telah berhasil dihapus',
                'status'=> true
            ];
            return response()->json($data);
        }else{
            $data=[
                'message'=> 'terkadi kesalahan, Silahkan hapus ulang',
                'status'=> false
            ];
            return response()->json($data);
        }
    }
}
