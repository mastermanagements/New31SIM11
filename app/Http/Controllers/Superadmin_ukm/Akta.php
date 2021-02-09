<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use App\Model\Superadmin_ukm\U_Akta as aktas;

class Akta extends Controller
{
    //
    private $id_superadmin;

    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            return $next($req);
        });
    }

    public function create()
    {
        $data = [
            'usaha'=> usaha::all()->where('id_user_ukm', $this->id_superadmin)
        ];
        return view('user/superadmin_ukm/master/section/akta_perusahaan/akta_create_page', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'id_perusahaan'=>'required',
            'no_akta'=>'required',
            'tgl_akta' => 'required',
            'notaris' => 'required',
            'bentuk_usaha' => 'required',
            'file_akta' => 'required|file|mimes:rar,zip'
        ]);

        $id_perusahaan = $req->id_perusahaan;
        $no_akta = $req->no_akta;
        $tgl_akta =  date('Y-m-d', strtotime($req->tgl_akta));
        $notaris = $req->notaris;
        $bentuk_usaha = $req->bentuk_usaha;
        $file_akta = $req->file_akta;
        $no_rak = $req->no_rak;

        $name_file =  time().'.'.$file_akta->getClientOriginalExtension();
        $model = aktas::updateOrCreate(['id_perusahaan'=>$id_perusahaan,'id_user_ukm'=>$this->id_superadmin],
            [
                'no_akta'=>$no_akta,
                'tgl_akta'=>$tgl_akta,
                'notaris'=>$notaris,
                'bentuk_usaha'=>$bentuk_usaha,
                'no_rak'=>$no_rak,
                'file_akta'=>$name_file,
            ]
        );

        if(!empty($model->file_akta))
        {
            $file_path =public_path('fileAkta').'/' . $model->file_akta;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if ($model->save())
        {
            if ($file_akta->move(public_path('fileAkta'), $name_file)) {
                return redirect('akta')->with('message_success','Berhasil menyimpan akta');
            }else{
                return redirect('akta')->with('message_error','Gagal menyimpan akta file akta');
            }
            return redirect('akta')->with('message_success','Berhasil mengubah akta');
        }

    }
}
