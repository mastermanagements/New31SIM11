<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Session;
use App\Model\Administrasi\Klien as kliens;

class Klien extends Controller
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
        $data_klien = [
            'data_klien' => kliens::where('id_perusahaan', $this->id_perusahaan)->paginate(25)
        ];
        return view('user.administrasi.section.klien.page_default', $data_klien);
    }

    public function cari_klien(Request $request)
    {
        $nama_klie = $request->nm_klien;
        $data_klien = [
            'data_klien' => kliens::where('nm_klien', 'LIKE', "%{$nama_klie}%") ->where('id_perusahaan', $this->id_perusahaan)->paginate(10)
        ];
        return view('user.administrasi.section.klien.page_default', $data_klien);
    }

    public function create()
    {
        return view('user.administrasi.section.klien.page_create');
    }

    public function store(Request $req)
    { //validasi
       $this->validate($req, [
            'nm_klien' =>'required',
            'alamat' =>'required',
            'pekerjaan' =>'required',
            'hp' =>'required'
        ]);

        $nm_klien = $req->nm_klien;
        $alamat = $req->alamat;
        $pekerjaan = $req->pekerjaan;
        $hp = $req->hp;
        $wa = $req->wa;
        $email = $req->email;
        $teleg = $req->teleg;
        $ig = $req->ig;
        $fb= $req->fb;
        $twiter= $req->twiter;
        $nm_perusahaan= $req->nm_perusahaan;
        $alamat_perusahaan= $req->alamat_perusahaan;
        $telp_perusahaan= $req->telp_perusahaan;
        $jabatan= $req->jabatan;

        $models = new kliens;
        $models->nm_klien = $nm_klien;
        $models->alamat = $alamat;
        $models->pekerjaan = $pekerjaan;
        $models->hp = $hp;
        $models->wa = $wa;
        $models->email = $email;
        $models->teleg = $teleg;
        $models->ig = $ig;
        $models->fb = $fb;
        $models->twiter = $twiter;
        $models->nm_perusahaan = $nm_perusahaan;
        $models->alamat_perusahaan = $alamat_perusahaan;
        $models->telp_perusahaan = $telp_perusahaan;
        $models->jabatan = $jabatan;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;

        if($models->save())
        {
            return redirect('Klien')->with('message_success','Anda telah menambah klien baru');
          }else
            {
                return redirect('Klien')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan klien anda');
            }
    }

    public function edit($id)
    {
        if(empty($data = kliens::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data_klien = [
            'data_klien' => $data
        ];
        return view('user.administrasi.section.klien.page_edit', $data_klien);
    }


    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'nm_klien' =>'required',
            'alamat' =>'required',
            'pekerjaan' =>'required',
            'hp' =>'required'
        ]);

        $nm_klien = $req->nm_klien;
        $alamat = $req->alamat;
        $pekerjaan = $req->pekerjaan;
        $hp = $req->hp;
        $wa = $req->wa;
        $email = $req->email;
        $teleg = $req->teleg;
        $ig = $req->ig;
        $fb= $req->fb;
        $twiter= $req->twiter;
        $nm_perusahaan= $req->nm_perusahaan;
        $alamat_perusahaan= $req->alamat_perusahaan;
        $telp_perusahaan= $req->telp_perusahaan;
        $jabatan= $req->jabatan;

        $models = kliens::find($id);
        $models->nm_klien = $nm_klien;
        $models->alamat = $alamat;
        $models->pekerjaan = $pekerjaan;
        $models->hp = $hp;
        $models->wa = $wa;
        $models->email = $email;
        $models->teleg = $teleg;
        $models->ig = $ig;
        $models->fb = $fb;
        $models->twiter = $twiter;
        $models->nm_perusahaan = $nm_perusahaan;
        $models->alamat_perusahaan = $alamat_perusahaan;
        $models->telp_perusahaan = $telp_perusahaan;
        $models->jabatan = $jabatan;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;

        if($models->save())
        {
            return redirect('Klien')->with('message_success','Anda telah mengubah klien baru');
        }else
        {
            return redirect('Klien')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba mengubaubah klien anda');
        }
    }

    public function delete(Request $req, $id)
    {
        if(empty($data = kliens::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        if($data->delete())
        {
            return redirect('Klien')->with('message_success','Anda telah menghapus klien baru');
        }
        else
        {
            return redirect('Klien')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba menghapus klien anda');
        }
    }
}
