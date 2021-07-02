<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\TargetPuncak as TargetPuncak;
use App\Model\Karyawan\TargetEksekutif as TargetEks;
use App\Model\Karyawan\TargetManager as TargetMan;
use App\Model\Karyawan\TargetSupervisor as TargetSup;
use App\Model\Karyawan\TargetStaf as TargetStaf;
use App\Model\Karyawan\Bagian as Bagian;
use App\Model\Karyawan\Devisi as Divisi;
use App\Model\Superadmin_ukm\H_karyawan as Karyawan;
use App\Model\Superadmin_ukm\U_jabatan_p as Jabatan;

use Carbon\Carbon;
use Session;

class TargetPerusahaan extends Controller
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
	/* -- menampilkan target jangka panjang, target tahunan & target bulanan--*/
	public function index()
    {
    $data_pass= [
        'tjp'=> TargetPuncak::all()->where('id_perusahaan', $this->id_perusahaan),
        'target_eks'=> TargetEks::all()->where('id_perusahaan', $this->id_perusahaan),
        'target_eks_group'=> TargetEks::where('id_perusahaan', $this->id_perusahaan)->groupBy('tahun','id_jabatan_p')->get(),
        'target_man'=> TargetMan::all()->where('id_perusahaan', $this->id_perusahaan),
        'target_man_group'=> TargetMan::where('id_perusahaan', $this->id_perusahaan)->groupBy('tahun','id_jabatan_p')->get(),
        'target_sup'=> TargetSup::all()->where('id_perusahaan', $this->id_perusahaan),
        'target_sup_group'=> TargetSup::where('id_perusahaan', $this->id_perusahaan)->groupBy('tahun','id_jabatan_p')->get(),
        'target_staf'=> TargetStaf::all()->where('id_perusahaan', $this->id_perusahaan),
        'target_staf_bln'=> TargetStaf::where('id_perusahaan', $this->id_perusahaan)->groupBy('id_target_superv','bulan')->get(),
        'target_staf_ky'=> TargetStaf::where('id_perusahaan', $this->id_perusahaan)->groupBy('bulan','nm_karyawan')->get(),
        'bagian_p'=>Bagian::all()->where('id_perusahaan', $this->id_perusahaan),
		    'divisi_p'=>Divisi::all()->where('id_perusahaan', $this->id_perusahaan),
		    'jabatan_p'=>Jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
        'karyawan'=>Karyawan::all()->where('id_perusahaan', $this->id_perusahaan)
        //'current_year'=>now()->year
    ];
		//dd($data_pass['target_staf_ky']);
        return view('user.karyawan.section.TargetPerusahaan.page_default', $data_pass);

    }

	/* -- target jangka panjang --*/
	public function create()
    {
        return view('user.karyawan.section.TargetPerusahaan.page_create');
    }
	public function store(Request $req)
    { //dd($req->all());
        $this->validate($req,[
       'periode'=> 'required|integer',
		   'thn_mulai'=> 'required',
		   'thn_selesai'=> 'required',
		   'target_puncak'=> 'required',
       'jumlah_target'=> 'required|integer',
       'satuan_target'=> 'required',
        ]);
        //assignment
		$periode = $req->periode;
    $thn_mulai = $req->thn_mulai;
		$thn_selesai = $req->thn_selesai;
		$target_puncak = $req->target_puncak;
    $jumlah_target = $req->jumlah_target;
    $satuan_target = $req->satuan_target;
		//instansiasi objek
    $model = new TargetPuncak;
    $model->periode = $periode;
		$model->thn_mulai = $thn_mulai;
		$model->thn_selesai = $thn_selesai;
		$model->target_puncak= $target_puncak;
    $model->jumlah_target = $req->jumlah_target;
    $model->satuan_target = $req->satuan_target;
    $model->id_perusahaan = $this->id_perusahaan;
    $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Target-Perusahaan')->with('message_success', 'Ada telah menambahkan Target Jangka Panjang Perusahaan');
        }else{
            return redirect('Target-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang Target Jangka Panjang perusahaan anda');
        }
    }

	public function edit($id)
    {
        if(empty($tjp = TargetPuncak::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'tjp'=> $tjp
        ];
        return response()->json($data);
    }

	public function update(Request $req)
    {
        $this->validate($req,[
      'periode_ubah' => 'required',
			'thn_mulai_ubah'=>'required',
      'thn_selesai_ubah'=> 'required',
			'target_puncak_ubah'=> 'required',
			'jumlah_target_ubah'=> 'required',
      'satuan_target_ubah'=> 'required',
      'id_tjp_ubah'=> 'required'
        ]);

		$periode = $req->periode_ubah;
		$thn_mulai = $req->thn_mulai_ubah;
		$thn_selesai = $req->thn_selesai_ubah;
		$target_puncak = $req->target_puncak_ubah;
		$jumlah_target = $req->jumlah_target_ubah;
    $satuan_target = $req->satuan_target_ubah;
    $id_tjp = $req->id_tjp_ubah;


        if(empty($model = TargetPuncak::where('id', $id_tjp)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

		$model->periode =$periode;
    $model->thn_mulai =$thn_mulai;
		$model->thn_selesai =$thn_selesai;
		$model->target_puncak =$target_puncak;
    $model->jumlah_target = $jumlah_target;
    $model->satuan_target = $satuan_target;
    $model->id_perusahaan = $this->id_perusahaan;
    $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
        if($model->save())
        {
            return redirect('Target-Perusahaan')->with('message_sucess','Anda baru saja mengubah data Target Jangka Panjang perusahaan');
        }else
        {
            return redirect('Target-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

	public function delete(Request $req, $id)
    {
      $model = TargetPuncak::find($id);
      if($model->delete())
      {
        return redirect ('Target-Perusahaan')->with('message_sucess','Berhasil menghapus data target jangka panjang perusahaan');
      }else
      {
          return redirect('Target-Perusahaan')->with('message_fail','Gagal menghapus data target jangka panjang perusahaan');
      }
    }


	/* -- target Eksekutif--*/
  public function createTargetEks()
    {
      $data_jab = [
          'jabatan_p' =>jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
          'bagian_p'=>Bagian::all()->where('id_perusahaan', $this->id_perusahaan)
      ];
        return view('user.karyawan.section.TargetPerusahaan.page_create_eks', $data_jab);
    }

	public function storeTargetEks(Request $req)
    { //dd($req->all());
        $this->validate($req,[
		   'tahun'=> 'required',
		   'id_bagian_p' => 'required',
		   'id_jabatan_p' => 'required',
       'target_eksekutif'=> 'required',
       'jumlah_target'=> 'required',
       'satuan_target'=> 'required'
        ]);

    $tahun = $req->tahun;
		$id_bagian_p = $req->id_bagian_p;
		$id_jabatan_p = $req->id_jabatan_p;
    $target_eksekutif = $req->target_eksekutif;
    $jumlah_target = $req->jumlah_target;
    $satuan_target = $req->satuan_target;

    $model = new TargetEks;
		$model->tahun = $tahun;
		$model->id_bagian_p = $id_bagian_p;
		$model->id_jabatan_p = $id_jabatan_p;
		$model->target_eksekutif = $target_eksekutif;
    $model->jumlah_target = $jumlah_target;
    $model->satuan_target = $satuan_target;
    $model->id_perusahaan = $this->id_perusahaan;
    $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Target-Perusahaan')->with('message_success', 'Ada telah menambahkan Target Tahunan baru');
        }else{
            return redirect('Target-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang Target Tahunan Anda');
        }
    }

    public function editTargetEks($id)
      {
          if(empty($target_eks = TargetEks::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }
          $data = [
            'target_eks'=> $target_eks,
          ];
          return response()->json($data);
      }

	public function updateTargetEks(Request $req)
    {
        $this->validate($req,[
          'tahun_ubah' => 'required',
    			'id_bagian_p_ubah'=>'required',
          'id_jabatan_p_ubah'=> 'required',
    			'target_eksekutif_ubah'=> 'required',
    			'jumlah_target_ubah'=> 'required',
          'satuan_target_ubah'=> 'required',
          'id_teks_ubah'=> 'required'
            ]);

    		$tahun = $req->tahun_ubah;
    		$id_bagian_p = $req->id_bagian_p_ubah;
    		$id_jabatan_p = $req->id_jabatan_p_ubah;
    		$target_eksekutif = $req->target_eksekutif_ubah;
    		$jumlah_target = $req->jumlah_target_ubah;
        $satuan_target = $req->satuan_target_ubah;
        $id_teks = $req->id_teks_ubah;


            if(empty($model = TargetEks::where('id', $id_teks)->where('id_perusahaan', $this->id_perusahaan)->first())){
                return abort(404);
            }

    		$model->tahun =$tahun;
        $model->id_bagian_p =$id_bagian_p;
    		$model->id_jabatan_p =$id_jabatan_p;
    		$model->target_eksekutif =$target_eksekutif;
        $model->jumlah_target = $jumlah_target;
        $model->satuan_target = $satuan_target;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
    		//dd($req->all());
            if($model->save())
            {
                return redirect('Target-Perusahaan')->with('message_sucess','Berhasil mengubah Target Eksekutif perusahaan');
            }else
            {
                return redirect('Target-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
            }
    }

    public function deleteTargetEks(Request $req, $id)
      {
        $model = TargetEks::find($id);
        if($model->delete())
        {
          return redirect ('Target-Perusahaan')->with('message_sucess','Berhasil menghapus data target Eksekutif perusahaan');
        }else
        {
            return redirect('Target-Perusahaan')->with('message_fail','Gagal menghapus data target Eksekutif perusahaan');
        }
      }

/* -- target Manajer--*/
public function createTargetMan()
  {
    $data_jab = [
        'target_eks' =>TargetEks::all()->where('id_perusahaan', $this->id_perusahaan),
        'jabatan_p' =>Jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
        'bagian_p'=>Bagian::all()->where('id_perusahaan', $this->id_perusahaan)
    ];
      return view('user.karyawan.section.TargetPerusahaan.page_create_man', $data_jab);
  }

public function storeTargetMan(Request $req)
  { //dd($req->all());
      $this->validate($req,[
     'id_target_eks' => 'required',
     'tahun'=> 'required',
     'id_bagian_p' => 'required',
     'id_jabatan_p' => 'required',
     'target_manager'=> 'required',
     'jumlah_target'=> 'required',
     'satuan_target'=> 'required'
      ]);

  $id_target_eks = $req->id_target_eks;
  $tahun = $req->tahun;
  $id_bagian_p = $req->id_bagian_p;
  $id_jabatan_p = $req->id_jabatan_p;
  $target_manager = $req->target_manager;
  $jumlah_target = $req->jumlah_target;
  $satuan_target = $req->satuan_target;

  $model = new TargetMan;
  $model->id_target_eks = $id_target_eks;
  $model->tahun = $tahun;
  $model->id_bagian_p = $id_bagian_p;
  $model->id_jabatan_p = $id_jabatan_p;
  $model->target_manager = $target_manager;
  $model->jumlah_target = $jumlah_target;
  $model->satuan_target = $satuan_target;
  $model->id_perusahaan = $this->id_perusahaan;
  $model->id_karyawan = $this->id_karyawan;

      if($model->save()){
          return redirect('Target-Perusahaan')->with('message_success', 'Berhasil menambah target Manager');
      }else{
          return redirect('Target-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan ulangi lagi');
      }
  }

  public function editTargetMan($id)
    {
        if(empty($target_man = TargetMan::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'target_man'=> $target_man,
        ];
        return response()->json($data);
    }

public function updateTargetMan(Request $req)
  {
      $this->validate($req,[
        'id_target_eks_ubah' => 'required',
        'tahun_ubah' => 'required',
        'id_bagian_p_ubah'=>'required',
        'id_jabatan_p_ubah'=> 'required',
        'target_manager_ubah'=> 'required',
        'jumlah_target_ubah'=> 'required',
        'satuan_target_ubah'=> 'required',
        'id_tman_ubah'=> 'required'
          ]);

      $id_target_eks = $req->id_target_eks_ubah;
      $tahun = $req->tahun_ubah;
      $id_bagian_p = $req->id_bagian_p_ubah;
      $id_jabatan_p = $req->id_jabatan_p_ubah;
      $target_manager = $req->target_manager_ubah;
      $jumlah_target = $req->jumlah_target_ubah;
      $satuan_target = $req->satuan_target_ubah;
      $id_tman = $req->id_tman_ubah;


          if(empty($model = TargetMan::where('id', $id_tman)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }

      $model->id_target_eks= $id_target_eks;
      $model->tahun =$tahun;
      $model->id_bagian_p =$id_bagian_p;
      $model->id_jabatan_p =$id_jabatan_p;
      $model->target_manager =$target_manager;
      $model->jumlah_target = $jumlah_target;
      $model->satuan_target = $satuan_target;
      $model->id_perusahaan = $this->id_perusahaan;
      $model->id_karyawan = $this->id_karyawan;
      //dd($req->all());
          if($model->save())
          {
              return redirect('Target-Perusahaan')->with('message_sucess','Berhasil mengubah Target Manager perusahaan');
          }else
          {
              return redirect('Target-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
          }
  }

  public function deleteTargetMan(Request $req, $id)
    {
      $model = TargetMan::find($id);
      if($model->delete())
      {
        return redirect ('Target-Perusahaan')->with('message_sucess','Berhasil menghapus data target Manager perusahaan');
      }else
      {
          return redirect('Target-Perusahaan')->with('message_fail','Gagal menghapus data target Manager perusahaan');
      }
    }


    /* -- target Supervisor --*/
    public function createTargetSup()
      {
        $data_jab = [
            'target_man' =>TargetMan::all()->where('id_perusahaan', $this->id_perusahaan),
            'jabatan_p' =>Jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
            'divisi_p'=>divisi::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
          return view('user.karyawan.section.TargetPerusahaan.page_create_sup', $data_jab);
      }

    public function storeTargetSup(Request $req)
      { //dd($req->all());
          $this->validate($req,[
         'id_target_man' => 'required',
         'tahun'=> 'required',
         'id_divisi_p' => 'required',
         'id_jabatan_p' => 'required',
         'target_supervisor'=> 'required',
         'jumlah_target'=> 'required',
         'satuan_target'=> 'required'
          ]);

      $id_target_man = $req->id_target_man;
      $tahun = $req->tahun;
      $id_divisi_p = $req->id_divisi_p;
      $id_jabatan_p = $req->id_jabatan_p;
      $target_supervisor = $req->target_supervisor;
      $jumlah_target = $req->jumlah_target;
      $satuan_target = $req->satuan_target;

      $model = new TargetSup;
      $model->id_target_man = $id_target_man;
      $model->tahun = $tahun;
      $model->id_divisi_p = $id_divisi_p;
      $model->id_jabatan_p = $id_jabatan_p;
      $model->target_supervisor = $target_supervisor;
      $model->jumlah_target = $jumlah_target;
      $model->satuan_target = $satuan_target;
      $model->id_perusahaan = $this->id_perusahaan;
      $model->id_karyawan = $this->id_karyawan;

          if($model->save()){
              return redirect('Target-Perusahaan')->with('message_success', 'Berhasil menambah target Supervisor');
          }else{
              return redirect('Target-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan ulangi lagi');
          }
      }

      public function editTargetSup($id)
        {
            if(empty($target_sup = TargetSup::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
                return abort(404);
            }
            $data = [
              'target_sup'=> $target_sup,
            ];
            return response()->json($data);
        }

    public function updateTargetSup(Request $req)
      {
          $this->validate($req,[
            'id_target_man_ubah' => 'required',
            'tahun_ubah' => 'required',
            'id_divisi_p_ubah'=>'required',
            'id_jabatan_p_ubah'=> 'required',
            'target_supervisor_ubah'=> 'required',
            'jumlah_target_ubah'=> 'required',
            'satuan_target_ubah'=> 'required',
            'id_tsup_ubah'=> 'required'
              ]);

          $id_target_man = $req->id_target_man_ubah;
          $tahun = $req->tahun_ubah;
          $id_divisi_p = $req->id_divisi_p_ubah;
          $id_jabatan_p = $req->id_jabatan_p_ubah;
          $target_supervisor = $req->target_supervisor_ubah;
          $jumlah_target = $req->jumlah_target_ubah;
          $satuan_target = $req->satuan_target_ubah;
          $id_tsup = $req->id_tsup_ubah;

              if(empty($model = TargetSup::where('id', $id_tsup)->where('id_perusahaan', $this->id_perusahaan)->first())){
                  return abort(404);
              }

          $model->id_target_man= $id_target_man;
          $model->tahun =$tahun;
          $model->id_divisi_p =$id_divisi_p;
          $model->id_jabatan_p =$id_jabatan_p;
          $model->target_supervisor =$target_supervisor;
          $model->jumlah_target = $jumlah_target;
          $model->satuan_target = $satuan_target;
          $model->id_perusahaan = $this->id_perusahaan;
          $model->id_karyawan = $this->id_karyawan;
          //dd($req->all());
              if($model->save())
              {
                  return redirect('Target-Perusahaan')->with('message_sucess','Berhasil mengubah Target Supervisor perusahaan');
              }else
              {
                  return redirect('Target-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
              }
      }

      public function deleteTargetSup(Request $req, $id)
        {
          $model = TargetSup::find($id);
          if($model->delete())
          {
            return redirect ('Target-Perusahaan')->with('message_sucess','Berhasil menghapus data target Supervisor perusahaan');
          }else
          {
              return redirect('Target-Perusahaan')->with('message_fail','Gagal menghapus data target Supervisor perusahaan');
          }
        }

        /* -- target Staf --*/
        public function createTargetStaf()
          {
            $data_jab = [
                'target_sup' =>TargetSup::all()->where('id_perusahaan', $this->id_perusahaan),
                'karyawan' =>Karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
                'jabatan_p' =>Jabatan::all()->where('id_perusahaan', $this->id_perusahaan),

            ];
              return view('user.karyawan.section.TargetPerusahaan.page_create_staf', $data_jab);
          }

        public function storeTargetStaf(Request $req)
          { //dd($req->all());
              $this->validate($req,[
             'id_target_superv' => 'required',
             'bulan'=> 'required',
             'nm_karyawan' => 'required',
             'target_staf'=> 'required',
             'jumlah_target'=> 'required',
             'satuan_target'=> 'required'
              ]);

          $id_target_superv = $req->id_target_superv;
          $bulan = $req->bulan;
          $nm_karyawan = $req->nm_karyawan;
          $target_staf = $req->target_staf;
          $jumlah_target = $req->jumlah_target;
          $satuan_target = $req->satuan_target;

          $model = new TargetStaf;
          $model->id_target_superv = $id_target_superv;
          $model->bulan = $bulan;
          $model->nm_karyawan = $nm_karyawan;
          $model->target_staf = $target_staf;
          $model->jumlah_target = $jumlah_target;
          $model->satuan_target = $satuan_target;
          $model->id_perusahaan = $this->id_perusahaan;
          $model->id_karyawan = $this->id_karyawan;

              if($model->save()){
                  return redirect('Target-Perusahaan')->with('message_success', 'Berhasil menambah target Staf');
              }else{
                  return redirect('Target-Perusahaan')->with('message_fail', 'Terjadi Kesalahan, Silahkan ulangi lagi');
              }
          }

          public function editTargetStaf($id)
            {
                if(empty($target_staf = TargetStaf::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
                    return abort(404);
                }
                $data = [
                  'target_staf'=> $target_staf,
                ];
                return response()->json($data);
            }

        public function updateTargetStaf (Request $req)
          {
            //dd($req->all());
              $this->validate($req,[
                'id_target_superv_ubah' => 'required',
                'bulan_ubah' => 'required',
                'nm_karyawan_ubah'=>'required',
                'target_staf_ubah'=> 'required',
                'jumlah_target_ubah'=> 'required',
                'satuan_target_ubah'=> 'required',
                'id_tstaf_ubah'=> 'required'
                  ]);

              $id_target_superv = $req->id_target_superv_ubah;
              $bulan = $req->bulan_ubah;
              $nm_karyawan = $req->nm_karyawan_ubah;
              $target_staf= $req->target_staf_ubah;
              $jumlah_target = $req->jumlah_target_ubah;
              $satuan_target = $req->satuan_target_ubah;
              $id_tstaf = $req->id_tstaf_ubah;

                  if(empty($model = TargetStaf::where('id', $id_tstaf)->where('id_perusahaan', $this->id_perusahaan)->first())){
                      return abort(404);
                  }

              $model->id_target_superv = $id_target_superv;
              $model->bulan = $bulan;
              $model->nm_karyawan = $nm_karyawan;
              $model->target_staf = $target_staf;
              $model->jumlah_target = $jumlah_target;
              $model->satuan_target = $satuan_target;
              $model->id_perusahaan = $this->id_perusahaan;
              $model->id_karyawan = $this->id_karyawan;
              //dd($model->all());
                  if($model->save())
                  {
                      return redirect('Target-Perusahaan')->with('message_sucess','Berhasil mengubah Target Staf perusahaan');
                  }else
                  {
                      return redirect('Target-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
                  }
          }

          public function deleteTargetStaf(Request $req, $id)
            {
              $model = TargetStaf::find($id);
              if($model->delete())
              {
                return redirect ('Target-Perusahaan')->with('message_sucess','Berhasil menghapus data target Staf perusahaan');
              }else
              {
                  return redirect('Target-Perusahaan')->with('message_fail','Gagal menghapus data target Staf perusahaan');
              }
            }


}
