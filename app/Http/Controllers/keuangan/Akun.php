<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_sim\K_master_akun as kmA;
use App\Model\Keuangan\Akun as akun_master; //k_akun_ukm
use App\Model\Keuangan\SubAkun as SB;//k_sub_akun_ukm
use App\Model\Superadmin_sim\K_master_sub_akun as KmsA;
use App\Model\Keuangan\SubSubAkun as ssA; //k_subsub_akun_ukm


class Akun extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;

    public $posisi = array(
        'D'=> 'Debit',
        'K'=> 'Kredit'
    );


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
        $data = [
          'master_akun'=>kmA::all(),
          'title'=> 'Menu pengaturan Akun',
          'posisi'=>$this->posisi,
          'menu'=>'peng_akun'
        ];
        return view('user.keuangan.section.akun.page_default', $data);
    }

    public function store_akun_ukm(Request $req){
//        $this->validate($req,[
//            "id_akun_master"=> 'required'
//        ]);
        $data_master_akun = kmA::all();
        foreach ($data_master_akun as $value){
            $model = akun_master::updateOrCreate(
                ['id_m_akun'=> $value->id, 'id_perusahaan'=>$this->id_perusahaan, 'id_karyawan'=> $this->id_karyawan],
                ['kode_akun'=>$value->kode_m_akun, 'nm_akun'=> $value->nm_m_akun]
            );
            $model->save();
            foreach ($value->manySubAkun as $values_sub){
                $modelSub = SB::updateOrCreate(
                    ['id_m_sub_akun'=> $values_sub->id,'id_perusahaan'=>$this->id_perusahaan],
                    ['id_akun_ukm'=>$model->id,'kode_sub_akun'=> $values_sub->kode_m_sub_akun,'nm_sub_akun'=>$values_sub->nm_m_sub_akun,
                        'off_on'=>'1','id_karyawan'=>$this->id_karyawan]
                );
                $modelSub->save();
                foreach ($values_sub->manySubsub as $value_sub_sub){
                    $model_sub_sub = ssA::updateOrCreate(
                      ['id_sub_sub_master_akun'=> $value_sub_sub->id,'id_perusahaan'=>$this->id_perusahaan],
                      ['id_sub_akun_ukm'=>$modelSub->id,'kode_subsub_akun'=> $value_sub_sub->kode_m_subsub_akun,
                       'nm_subsub_akun'=> $value_sub_sub->nm_m_subsub_akun,'off_on'=>'1','id_karyawan'=>$this->id_karyawan]
                    );
                    $model_sub_sub->save();
                }
            }
        }

        return redirect('Akun')->with('message_success','Akun Master telah aktif');

    }

    public function Daftar_akun()
    {
        $data = [
            'akun_ukm'=>akun_master::all()->where('id_perusahaan', $this->id_perusahaan),
            'title'=> 'Daftar Akun UKM',
            'menu'=>'Daf_akun',
            'posisi'=>$this->posisi
        ];
        return view('user.keuangan.section.akun.page_default', $data);
    }

    public function edit_akun_sub($id){
        if(empty($model = SB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function store_akun_sub(Request $req){
        $this->validate($req,[
            "kode_sub" => "required",
            "nm_sub" => "required",
            "id_akun_ukm" => "required",
        ]);

        $model = new SB();
        $model->id_akun_ukm= $req->id_akun_ukm;
        $model->kode_sub_akun= $req->kode_sub;
        $model->nm_sub_akun= $req->nm_sub;
        $model->off_on= '1';
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('daftar-akun')->with('message_success','Anda telah menambah sub akun :'.$model->nm_sub_akun);
        }else{
            return redirect('daftar-akun')->with('message_fail','Maaf, gagal menambahkan sub akun');
        }
    }

    public function update_akun_sub(Request $req){
        $this->validate($req,[
          "kode_sub" => "required",
          "nm_sub" => "required",
          "id_sub" => "required"
        ]);

        $model = SB::find($req->id_sub);
        $model->kode_sub_akun=$req->kode_sub;
        $model->nm_sub_akun=$req->nm_sub;
        if($model->save()){
            return redirect('daftar-akun')->with('message_success','Anda telah mengubah sub akun :'.$model->nm_sub_akun);
        }else{
            return redirect('daftar-akun')->with('message_fail','Maaf, gagal mengubah sub akun ');
        }
    }

    public function hidden_akun_sub(Request $req, $id){
        $this->validate($req,[
            "_token" => "required"
        ]);
        $model = SB::find($id);

        if($model->off_on=='1'){
            $model->off_on = '0';
        }else{
            $model->off_on = '1';
        }

        if($model->save()){
            return redirect('daftar-akun')->with('message_success','Anda telah menyebunyikan sub akun :'.$model->nm_sub_akun);
        }else{
            return redirect('daftar-akun')->with('message_fail','Maaf, gagal mengubah sub akun');
        }
    }

    // ================================================= Sub sub akun ==================================================
    public function store_sub_sub_akun(Request $req){
        $this->validate($req,[
            "kode_sub_sub" => "required",
            "nm_sub_sub" => "required",
            "id_sub_akun_ukm" => "required",
        ]);

        $model = new ssA();
        $model->id_sub_akun_ukm = $req->id_sub_akun_ukm;
        $model->kode_subsub_akun = $req->kode_sub_sub;
        $model->nm_subsub_akun = $req->nm_sub_sub;
        $model->off_on = '0';
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('daftar-akun')->with('message_success','Anda telah menambah sub sub akun :'.$model->nm_subsub_akun);
        }else{
            return redirect('daftar-akun')->with('message_fail','Maaf, gagal menambah sub sub akun');
        }

    }

    public function edit_sub_sub_akun($id){
        if(empty($model = ssA::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update_sub_sub_akun(Request $req){
       $this->validate($req,[
            "kode_sub_sub" => "required",
            "nm_sub_sub" => "required",
            "id_sub_sub" => "required"
        ]);

        $model = ssA::find($req->id_sub_sub);
        $model->kode_subsub_akun = $req->kode_sub_sub;
        $model->nm_subsub_akun = $req->nm_sub_sub;
        if($model->save()){
           return redirect('daftar-akun')->with('message_success','Anda telah mengubah sub sub akun :'.$model->nm_subsub_akun);
        }else{
           return redirect('daftar-akun')->with('message_fail','Maaf, gagal mengubah sub sub akun');
        }

    }

    public function hidden_sub_sub_akun(Request $req, $id){
       $this->validate($req,[
            "_token" => "required"
        ]);
        $model = ssA::find($id);

        if($model->off_on=='1'){
            $model->off_on = '0';
        }else{
            $model->off_on = '1';
        }

        if($model->save()){
           return redirect('daftar-akun')->with('message_success','Anda telah menyebunyikan sub sub akun :'.$model->nm_subsub_akun);
        }else{
           return redirect('daftar-akun')->with('message_fail','Maaf, gagal mengubah sub sub akun');
        }
    }

}
