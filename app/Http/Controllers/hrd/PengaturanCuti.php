<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_setting_cuti as HSC;

class PengaturanCuti extends Controller
{
    //

    private $id_karyawan;
    private $id_perusahaan;
    private $pengurangan_cuti =[
        '0'=> 'Cuti bersama tidak mengurangi cuti tahunan',
        '1'=> 'Cuti bersama mengurangi cuti tahunan',
    ];
    private $akumulasi_cuti =[
        '0'=> 'Sisa cuti tahunan tidak di akumulasikan ke thn berikutnya',
        '1'=> 'Sisa cuti tahunan di akumulasikan ke thn berikutnya',
    ];
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

    public function create()
    {
        $data = [
            'pengurangan_cuti'=>$this->pengurangan_cuti,
            'akumulasi_cuti' =>$this->akumulasi_cuti
        ];
        return view('user.hrd.section.cuti.setting_cuti.page_create', $data);
    }

    public function store(Request $req){
       $this->validate($req,[
           'nm_cuti'=>'required',
           'pengurang_cuti' => 'required',
           'akumulasi_cuti' => 'required'
        ]);

        $nm_cuti = $req->nm_cuti;
        $pengurang_cuti = $req->pengurang_cuti;
        $akumulasi_cuti = $req->akumulasi_cuti;

        $model = new HSC();
        $model->nm_cuti = $nm_cuti;
        $model->pengurang_cuti = $pengurang_cuti;
        $model->akumulasi_cuti = $akumulasi_cuti;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            Session::get('menu_cuti','pengaturan_cuti');
            return redirect('Cuti')->with('message_success','Anda telah menambahkah nama cuti baru');
        }else{
            Session::get('menu_cuti','pengaturan_cuti');
            return redirect('Cuti')->with('message_fail','Maaf, gagal menambahkan nama cuti baru');
        }
    }

    public function edit($id)
    {
        if(empty($model = HSC::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'pengaturan_cuti'=> $model,
            'pengurangan_cuti'=>$this->pengurangan_cuti,
            'akumulasi_cuti' =>$this->akumulasi_cuti
        ];
        return view('user.hrd.section.cuti.setting_cuti.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'nm_cuti'=>'required',
            'pengurang_cuti' => 'required',
            'akumulasi_cuti' => 'required'
        ]);

        $nm_cuti = $req->nm_cuti;
        $pengurang_cuti = $req->pengurang_cuti;
        $akumulasi_cuti = $req->akumulasi_cuti;

        $model = HSC::find($id);
        $model->nm_cuti = $nm_cuti;
        $model->pengurang_cuti = $pengurang_cuti;
        $model->akumulasi_cuti = $akumulasi_cuti;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            Session::get('menu_cuti','pengaturan_cuti');
            return redirect('Cuti')->with('message_success','Anda telah mengubah nama cuti baru');
        }else{
            Session::get('menu_cuti','pengaturan_cuti');
            return redirect('Cuti')->with('message_fail','Maaf, gagal mengubah nama cuti baru');
        }
    }

    public function delete(Request $req, $id){
        $model = HSC::find($id);
        if($model->delete()){
            Session::get('menu_cuti','pengaturan_cuti');
            return redirect('Cuti')->with('message_success','Anda telah menghapus nama cuti baru');
        }else{
            Session::get('menu_cuti','pengaturan_cuti');
            return redirect('Cuti')->with('message_fail','Maaf, gagal menghapus nama cuti baru');
        }
    }


}
