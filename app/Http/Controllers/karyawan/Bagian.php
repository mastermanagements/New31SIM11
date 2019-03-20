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
        if(empty($bagian = bagians::all()->where('id_perusahaan', $this->id_perusahaan)->where('id_karyawan', $this->id_karyawan))){
            return abort(404);
        }

        $column = array();
        $no=1;
        foreach ($bagian as $value)
        {
            $row = array();
            $row[] = $no++;
            $row[] = $value->nm_bagian;
            $row[] = "<a href='#' onclick='edit(".$value->id.")' class='btn btn-warning'>ubah</a>
                      <button type='button' onclick='delete(".$value->id.")' class='btn btn-danger'>hapus</button>";
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
                'message_success'=> 'Bagian telah berhasil ditabahkan',
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
}
