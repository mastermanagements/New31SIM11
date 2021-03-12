<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Karyawan\JobDecs as JD;
use App\Model\Karyawan\TugasJobdesc as tugas;
use App\Model\Karyawan\TJBJobdesc as TJB;
use App\Model\Karyawan\WewenangJobdesc as wewenang;
use Session;

class JobDecs extends Controller
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
        $data_JD = [
           'data_jabatan'=>jabatan::where('id_perusahaan', $this->id_perusahaan)->paginate(6),
           'data_jobdesc'=>JD::where('id_perusahaan', $this->id_perusahaan)->get(),
           'tugas'=>tugas::where('id_perusahaan', $this->id_perusahaan)->get(),
           'tanggungj'=>TJB::where('id_perusahaan', $this->id_perusahaan)->get(),
           'wewenang'=>wewenang::where('id_perusahaan', $this->id_perusahaan)->get()
        ];
        return view('user.karyawan.section.JobDecs.page_default', $data_JD);
    }

    public function create()
    {
        $data_jab = [
            'jabatan' =>jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];

        return view('user.karyawan.section.JobDecs.page_create', $data_jab);
    }
	//direvisi
     public function store(Request $req)
    {
       $this->validate($req,[
          'id_jabatan_p' => 'required',
          'atasan' => 'required',
          'ruang_lingkup' => 'required',
          'hub_kedalam' => 'required',
          'hub_keluar' => 'required',
          'limpahan_wewenang' => 'required',

       ]);

       $id_jabatan_p = $req->id_jabatan_p;
       $atasan = $req->atasan;
       $ruang_lingkup = $req->ruang_lingkup;
       $hub_kedalam = $req->hub_kedalam;
       $hub_keluar = $req->hub_keluar;
       $limpahan_wewenang = $req->limpahan_wewenang;

       $model = new JD;

       $model->id_jabatan_p = $id_jabatan_p;
       $model->atasan = $atasan;
       $model->ruang_lingkup = $ruang_lingkup;
       $model->hub_kedalam = $hub_kedalam;
       $model->hub_keluar = $hub_keluar;
       $model->limpahan_wewenang = $limpahan_wewenang;
       $model->id_perusahaan = $this->id_perusahaan;
       $model->id_karyawan = $this->id_karyawan;


        if($model->save())
        {
            return redirect('Job-Desc')->with('message_success','Anda telah menambah Job Decs');
        }else
        {
            return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan silahkan masukan kembali Job Decs anda..!');
        }
    }

    public function edit($id)
      {
          if(empty($data_jobdesc = JD::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }
          $data = [
            'data_jobdesc'=> $data_jobdesc,
            'data_jabatan' => jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
          ];
          return response()->json($data);
      }

      public function editTugas($id)
        {
            if(empty($data_tugas = tugas::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
                return abort(404);
            }
            $data = [
              'data_tugas'=> $data_tugas
            ];
            return response()->json($data);
        }

        public function editTanggungjawab($id)
          {
              if(empty($data_tjb= TJB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
                  return abort(404);
              }
              $data = [
                'data_tjb'=> $data_tjb
              ];
              return response()->json($data);
          }

          public function editWewenang($id)
            {
                if(empty($data_wewenang= wewenang::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
                    return abort(404);
                }
                $data = [
                  'data_wewenang'=> $data_wewenang
                ];
                return response()->json($data);
            }

      public function update(Request $req)
        {
         //dd($req->all());
            $this->validate($req,[
            'id_jobdesc' => 'required',
    			  'id_jabatan_p'=>'required',
            'atasan_ubah'=> 'required',
    			  'ruanglingkup_ubah'=> 'required',
    			  'hub_kedalam_ubah'=> 'required',
    			  'hub_keluar_ubah'=> 'required',
            'limpahan_wewenang_ubah'=> 'required'
            ]);

    		$id_jobdesc = $req->id_jobdesc;
    		$id_jabatan_p = $req->id_jabatan_p;
    		$atasan = $req->atasan_ubah;
    		$ruang_lingkup = $req->ruanglingkup_ubah;
    		$hub_kedalam = $req->hub_kedalam_ubah;
        $hub_keluar = $req->hub_keluar_ubah;
    		$limpahan_wewenang = $req->limpahan_wewenang_ubah;

            if(empty($model = JD::where('id', $id_jobdesc)->where('id_perusahaan', $this->id_perusahaan)->first())){
              //dd($model);
                return abort(404);
            }
    		//insert ke @ field di tabel TT dg asiggment value dari hasil req di atas
    		$model->id_jabatan_p = $id_jabatan_p;
    		$model->atasan =$atasan;
        $model->ruang_lingkup =$ruang_lingkup;
    		$model->hub_kedalam =$hub_kedalam;
    		$model->hub_keluar =$hub_keluar;
    		$model->limpahan_wewenang =$limpahan_wewenang;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
    		//dd($req->all());
            if($model->save())
            {
                return redirect('Job-Desc')->with('message_sucess','Anda baru saja mengubah data Job-Desc perusahaan');
            }else
            {
                return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
            }
        }

          public function updateTugas(Request $req)
            {
            //  dd($req->all());
                $this->validate($req,[
                'id_tugas'=>'required',
                'id_jobdesc' => 'required',
                'item_tugas_ubah'=> 'required'
                ]);

        		$id_tugas = $req->id_tugas;
        		$id_jobdesc = $req->id_jobdesc;
        		$item_tugas = $req->item_tugas_ubah;

                if(empty($model = tugas::where('id', $id_tugas)->where('id_perusahaan', $this->id_perusahaan)->first())){
                  //dd($model);
                    return abort(404);
                }
        		//insert ke @ field di tabel TT dg asiggment value dari hasil req di atas
        		$model->id_jobdesc = $id_jobdesc;
        		$model->item_tugas =$item_tugas;
            $model->id_perusahaan = $this->id_perusahaan;
            $model->id_karyawan = $this->id_karyawan;
        		//dd($req->all());
                if($model->save())
                {
                    return redirect('Job-Desc')->with('message_sucess','Anda baru saja mengubah data Tugas pekerjaan');
                }else
                {
                    return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
                }
            }

            public function updateTanggungjawab(Request $req)
              {
              //  dd($req->all());
                  $this->validate($req,[
                  'id_tjb'=>'required',
                  'id_jobdesc' => 'required',
                  'item_tjb_ubah'=> 'required'
                  ]);

              $id_tjb = $req->id_tjb;
              $id_jobdesc = $req->id_jobdesc;
              $item_tjb = $req->item_tjb_ubah;

                  if(empty($model = TJB::where('id', $id_tjb)->where('id_perusahaan', $this->id_perusahaan)->first())){
                    //dd($model);
                      return abort(404);
                  }
              //insert ke @ field di tabel TT dg asiggment value dari hasil req di atas
              $model->id_jobdesc = $id_jobdesc;
              $model->item_tjb =$item_tjb;
              $model->id_perusahaan = $this->id_perusahaan;
              $model->id_karyawan = $this->id_karyawan;
              //dd($req->all());
                  if($model->save())
                  {
                      return redirect('Job-Desc')->with('message_sucess','Anda baru saja mengubah data Tanggung jawab pekerjaan');
                  }else
                  {
                      return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
                  }
              }

              public function updateWewenang(Request $req)
                {
                //  dd($req->all());
                    $this->validate($req,[
                    'id_wewenang'=>'required',
                    'id_jobdesc' => 'required',
                    'item_wewenang_ubah'=> 'required'
                    ]);

                $id_wewenang = $req->id_wewenang;
                $id_jobdesc = $req->id_jobdesc;
                $item_wewenang = $req->item_wewenang_ubah;

                    if(empty($model = wewenang::where('id', $id_wewenang)->where('id_perusahaan', $this->id_perusahaan)->first())){
                      //dd($model);
                        return abort(404);
                    }
                //insert ke @ field di tabel TT dg asiggment value dari hasil req di atas
                $model->id_jobdesc = $id_jobdesc;
                $model->item_wewenang =$item_wewenang;
                $model->id_perusahaan = $this->id_perusahaan;
                $model->id_karyawan = $this->id_karyawan;
                //dd($req->all());
                    if($model->save())
                    {
                        return redirect('Job-Desc')->with('message_sucess','Anda baru saja mengubah data wewenang pekerjaan');
                    }else
                    {
                        return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
                    }
                }

    //store tugas
    public function storeTugas (Request $req)
   {
      $this->validate($req,[
         'id_jobdesc' => 'required',
         'item_tugas' => 'required',
      ]);

      $id_jobdesc = $req->id_jobdesc;
      $item_tugas = $req->item_tugas;

      $model = new tugas;
      $model->id_jobdesc = $id_jobdesc;
      $model->item_tugas = $item_tugas;
      $model->id_perusahaan = $this->id_perusahaan;
      $model->id_karyawan = $this->id_karyawan;


       if($model->save())
       {
           return redirect('Job-Desc')->with('message_success','Anda telah menambah Tugas Job Decs');
       }else
       {
           return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan silahkan masukan kembali Job Decs anda..!');
       }
   }

   //store tanggungjawab
   public function storeTanggungJ (Request $req)
  {
     $this->validate($req,[
        'id_jobdesc' => 'required',
        'item_tjb' => 'required',
     ]);

     $id_jobdesc = $req->id_jobdesc;
     $item_tjb = $req->item_tjb;

     $model = new TJB;
     $model->id_jobdesc = $id_jobdesc;
     $model->item_tjb = $item_tjb;
     $model->id_perusahaan = $this->id_perusahaan;
     $model->id_karyawan = $this->id_karyawan;


      if($model->save())
      {
          return redirect('Job-Desc')->with('message_success','Anda telah menambah Tanggung Jawab Job Decs');
      }else
      {
          return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan silahkan masukan kembali Job Decs anda..!');
      }
  }
  //store tanggungjawab
  public function storeWewenang (Request $req)
 {
    $this->validate($req,[
       'id_jobdesc' => 'required',
       'item_wewenang' => 'required',
    ]);

    $id_jobdesc = $req->id_jobdesc;
    $item_wewenang = $req->item_wewenang;

    $model = new wewenang;
    $model->id_jobdesc = $id_jobdesc;
    $model->item_wewenang = $item_wewenang;
    $model->id_perusahaan = $this->id_perusahaan;
    $model->id_karyawan = $this->id_karyawan;

     if($model->save())
     {
         return redirect('Job-Desc')->with('message_success','Anda telah menambah wewenang Job Decs');
     }else
     {
         return redirect('Job-Desc')->with('message_fail','Terjadi kesalahan silahkan masukan kembali Job Decs anda..!');
     }
 }

 public function delete(Request $req, $id)
   {
       $model = JD::find($id);
       if($model->delete()){
           return redirect('Job-Desc')->with('message_success', 'Ada telah menghapus data Jobdesc');
       }else{
           return redirect('Job-Desc')->with('message_fail', 'Terjadi Kesalahan, Silahkan ulangi');
       }
   }
 }
