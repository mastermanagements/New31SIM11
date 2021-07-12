<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\karyawan\TargetPerusahaan;

use App\Model\Karyawan\TargetPuncak as TargetPuncak;
use App\Model\Karyawan\TargetEksekutif as TargetEks;
use App\Model\Karyawan\TargetManager as TargetMan;
use App\Model\Karyawan\TargetSupervisor as TargetSup;
use App\Model\Karyawan\TargetStaf as TargetStaf;
use App\Model\Karyawan\StrategiJP as StrategiPuncak;
use App\Model\Karyawan\StrategiEks as SEks;
use App\Model\Karyawan\StrategiManager as SMan;
use App\Model\Karyawan\StrategiSupervisor as SSup;
use App\Model\Karyawan\StrategiStaf as SStaf;
use App\Model\Superadmin_ukm\H_karyawan as Karyawan;
use App\Model\Superadmin_ukm\U_jabatan_p as Jabatan;

use Session;

class StrategiPerusahaan extends Controller
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

	/*--- halaman strategi perusahaan ----*/
	public function index()
    {
        $data_pass= [
          'sjp'=> StrategiPuncak::all()->where('id_perusahaan', $this->id_perusahaan),
          'tjp'=> TargetPuncak::all()->where('id_perusahaan', $this->id_perusahaan),
          'sekutif'=>SEks::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_eks'=>TargetEks::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_eks_group'=> TargetEks::where('id_perusahaan', $this->id_perusahaan)->groupBy('tahun','id_jabatan_p')->get(),
          'sman'=> SMan::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_man'=> TargetMan::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_man_group'=> TargetMan::where('id_perusahaan', $this->id_perusahaan)->groupBy('tahun','id_jabatan_p')->get(),
          'ssup'=> SSup::all()->where('id_perusahaan', $this->id_perusahaan),
          'sstaf'=> SStaf::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_sup'=> TargetSup::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_sup_group'=> TargetSup::where('id_perusahaan', $this->id_perusahaan)->groupBy('tahun','id_jabatan_p')->get(),
          'target_staf'=> TargetStaf::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_staf_group'=> TargetStaf::where('id_perusahaan', $this->id_perusahaan)->groupBy('id_target_superv','bulan','nm_karyawan')->get(),
          'jabatan_p'=>Jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
          'karyawan'=>Karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
          'sstaf'=> SStaf::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_staf'=> TargetStaf::all()->where('id_perusahaan', $this->id_perusahaan),
          'target_staf_bln'=> TargetStaf::where('id_perusahaan', $this->id_perusahaan)->groupBy('id_target_superv','bulan')->get(),
          'target_staf_ky'=> TargetStaf::where('id_perusahaan', $this->id_perusahaan)->groupBy('bulan','nm_karyawan')->get(),


        ];
		//dd($data_pass['data_bulanan']);
        return view('user.karyawan.section.StrategiPerusahaan.page_default', $data_pass);
    }

	/*--- Strategi Jangka Panjang ----*/

	public function store(Request $req)
    {
      //dd($req->all());
        $this->validate($req,[
       'id_tjp'=> 'required',
		   'isi'=> 'required'
        ]);
        $id_tjp = $req->id_tjp;
        $isi= $req->isi;
        $id_perusahaan = $this->id_perusahaan;
        $id_karyawan = $this->id_karyawan;

        /*
          jika datanya hnya satu bedasrakan id_perusahaan dan id_karyawn yg sama, pake ini
         $model =StrategiPuncak::updateOrCreate(['id_perusahaan'=>$id_perusahaan,'id_karyawan'=>$id_karyawan],['isi'=>$isi]);
        if($model->save())*/
        $model = new StrategiPuncak;
        $model->id_tjp = $id_tjp;
        $model->isi = $isi;
        $model->id_perusahaan = $id_perusahaan;
        $model->id_karyawan = $id_karyawan;
          if($model->save())
            {
              return redirect('Strategi-Perusahaan')->with('message_sucess', 'strategi Jangka Panjang berhasil dibuat');
            }
    }


    public function edit($id)
      {
          if(empty($sjp = StrategiPuncak::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }
          $data = [
            'sjp'=> $sjp
          ];
          return response()->json($data);
      }

	public function update(Request $req)
    { //dd($req->all());
		//validasi harus di isi
      $this->validate($req,[
      'id_sjp_ubah'=> 'required',
      'id_tjpg_ubah'=>'required',
			'isi_ubah'=> 'required'
        ]);
		//tampung di variabel
        $isi = $req->isi_ubah;
        $id_sjp = $req->id_sjp_ubah;
        $id_tjpg = $req->id_tjpg_ubah;

        if(empty($model = StrategiPuncak::where('id', $id_sjp)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke field nilai dari variabel yg berisi data request
        $model->id_tjpg = $id_tjpg;
        $model->isi =$isi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Strategi-Perusahaan')->with('message_sucess','Anda baru saja mengubah data strategi Jangka Panjang perusahaan');
        }else
        {
            return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

	public function delete(Request $req, $id)
  {
    $model = StrategiPuncak::find($id);
    if($model->delete())
    {
      return redirect ('Strategi-Perusahaan')->with('message_sucess','Berhasil menghapus data Strategi Jangka Panjang  perusahaan');
    }else
    {
        return redirect('Strategi-Perusahaan')->with('message_fail','Gagal menghapus data ini, silahkan ulangi');
    }
  }


	/*--- Strategi Eksekutif ----*/
  public function storeSekutif(Request $req)
    {
      //dd($req->all());
        $this->validate($req,[
       'id_teks'=> 'required',
       'nama'=> 'required',
		   'isi'=> 'required'
        ]);

        $id_teks = $req->id_teks;
        $nama = $req->nama;
        $isi= $req->isi;
        $id_perusahaan = $this->id_perusahaan;
        $id_karyawan = $this->id_karyawan;

        /*
        jika data per row hnya satu berdasarkan id_perusahaan, id_karyawan session yg sama serta id_teks yg sama pake ini
        $model =StrategiEks::updateOrCreate(['id_perusahaan'=>$id_perusahaan,'id_karyawan'=>$id_karyawan,'id_teks'=>$id_teks],['isi'=>$isi, 'nama'=>$nama, 'id_teks'=>$id_teks]);
        if($model->save())*/

        $model= new SEks;
        $model->id_teks = $id_teks;
        $model->nama = $nama;
        $model->isi = $isi;
        $model->id_perusahaan = $id_perusahaan;
        $model->id_karyawan = $id_karyawan;
          if($model->save())
            {
              return redirect('Strategi-Perusahaan')->with('message_sucess', 'strategi Eksekutf berhasil dibuat');
            }
    }

    public function editSekutif($id)
      {
          if(empty($sekutif = SEks::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }
          $data = [
            'sekutif'=> $sekutif
          ];
          return response()->json($data);
      }

	public function updateSekutif(Request $req)
    { //dd($req->all());
		//validasi harus di isi
      $this->validate($req,[
      'id_seks_ubah'=> 'required',
      'id_teks_ubah'=>'required',
      'nama_ubah'=>'required',
			'isi_eks_ubah'=> 'required'
        ]);
		//tampung di variabel
        $id_seks = $req->id_seks_ubah;
        $id_teks = $req->id_teks_ubah;
        $nama = $req->nama_ubah;
        $isi = $req->isi_eks_ubah;

        if(empty($model = SEks::where('id', $id_seks)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke field nilai dari variabel yg berisi data request
        $model->id_teks = $id_teks;
        $model->nama = $nama;
        $model->isi =$isi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Strategi-Perusahaan')->with('message_sucess','Anda baru saja mengubah data strategi eksekutif perusahaan');
        }else
        {
            return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }


	public function deleteSekutif(Request $req, $id)
  {
    $model = SEks::find($id);
    if($model->delete())
    {
      return redirect ('Strategi-Perusahaan')->with('message_sucess','Berhasil menghapus data Strategi Eksekutif perusahaan');
    }else
    {
        return redirect('Strategi-Perusahaan')->with('message_fail','Gagal menghapus data ini, silahkan ulangi');
    }
  }

	/*--- Strategi manager ----*/
  public function storeSman(Request $req)
    {
      //dd($req->all());
        $this->validate($req,[
       'id_tman'=> 'required',
       'nama'=> 'required',
		   'isi'=> 'required'
        ]);

        $id_tman = $req->id_tman;
        $nama = $req->nama;
        $isi= $req->isi;
        $id_perusahaan = $this->id_perusahaan;
        $id_karyawan = $this->id_karyawan;


        $model= new SMan;
        $model->id_tman = $id_tman;
        $model->nama = $nama;
        $model->isi = $isi;
        $model->id_perusahaan = $id_perusahaan;
        $model->id_karyawan = $id_karyawan;
          if($model->save())
            {
              return redirect('Strategi-Perusahaan')->with('message_sucess', 'strategi manager berhasil dibuat');
            }
    }

    public function editSman($id)
      {
          if(empty($sman = SMan::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }
          $data = [
            'sman'=> $sman
          ];
          return response()->json($data);
      }

	public function updateSman(Request $req)
    { //dd($req->all());
		//validasi harus di isi
      $this->validate($req,[
      'id_sman_ubah'=> 'required',
      'id_tman_ubah'=>'required',
      'nama_ubah'=>'required',
			'isi_man_ubah'=> 'required'
        ]);
		//tampung di variabel
        $id_sman = $req->id_sman_ubah;
        $id_tman = $req->id_tman_ubah;
        $nama = $req->nama_ubah;
        $isi = $req->isi_man_ubah;

        if(empty($model = SMan::where('id', $id_sman)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke field nilai dari variabel yg berisi data request
        $model->id_tman = $id_tman;
        $model->nama = $nama;
        $model->isi =$isi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Strategi-Perusahaan')->with('message_sucess','Anda baru saja mengubah data manager eksekutif perusahaan');
        }else
        {
            return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

    public function deleteSman(Request $req, $id)
    {
      $model = SMan::find($id);
      if($model->delete())
      {
        return redirect ('Strategi-Perusahaan')->with('message_sucess','Berhasil menghapus data Strategi Manager perusahaan');
      }else
      {
          return redirect('Strategi-Perusahaan')->with('message_fail','Gagal menghapus data ini, silahkan ulangi');
      }
    }

  /*--- Strategi supervisor ----*/
  public function storeSsup(Request $req)
    {
      //dd($req->all());
        $this->validate($req,[
       'id_tsup'=> 'required',
       'nama'=> 'required',
		   'isi'=> 'required'
        ]);

        $id_tsup = $req->id_tsup;
        $nama = $req->nama;
        $isi= $req->isi;
        $id_perusahaan = $this->id_perusahaan;
        $id_karyawan = $this->id_karyawan;


        $model= new SSup;
        $model->id_tsup = $id_tsup;
        $model->nama = $nama;
        $model->isi = $isi;
        $model->id_perusahaan = $id_perusahaan;
        $model->id_karyawan = $id_karyawan;
          if($model->save())
            {
              return redirect('Strategi-Perusahaan')->with('message_sucess', 'strategi Supervisor berhasil dibuat');
            }else{
                return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
            }

    }

    public function editSsup($id)
      {
          if(empty($ssup = SSup::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }
          $data = [
            'ssup'=> $ssup
          ];
          return response()->json($data);
      }

	public function updateSsup(Request $req)
    { //dd($req->all());
		//validasi harus di isi
      $this->validate($req,[
      'id_ssup_ubah'=> 'required',
      'id_tsup_ubah'=>'required',
      'nama_ubah'=>'required',
			'isi_sup_ubah'=> 'required'
        ]);
		//tampung di variabel
        $id_ssup = $req->id_ssup_ubah;
        $id_tsup = $req->id_tsup_ubah;
        $nama = $req->nama_ubah;
        $isi = $req->isi_sup_ubah;

        if(empty($model = SSup::where('id', $id_ssup)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke field nilai dari variabel yg berisi data request
        $model->id_tsup = $id_tsup;
        $model->nama = $nama;
        $model->isi =$isi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('Strategi-Perusahaan')->with('message_sucess','Anda baru saja mengubah data supervisor eksekutif perusahaan');
        }else
        {
            return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
        }
    }

    public function deleteSsup(Request $req, $id)
    {
      $model = SSup::find($id);
      if($model->delete())
      {
        return redirect ('Strategi-Perusahaan')->with('message_sucess','Berhasil menghapus data Strategi supervisor perusahaan');
      }else
      {
          return redirect('Strategi-Perusahaan')->with('message_fail','Gagal menghapus data ini, silahkan ulangi');
      }
    }


  /*--- Strategi staf ----*/
  public function storeSstaf(Request $req)
    {
      //dd($req->all());
        $this->validate($req,[
       'id_tstaf'=> 'required',
       'nama'=> 'required',
		   'isi'=> 'required'
        ]);

        $id_tstaf = $req->id_tstaf;
        $nama = $req->nama;
        $isi= $req->isi;
        $id_perusahaan = $this->id_perusahaan;
        $id_karyawan = $this->id_karyawan;


        $model= new SStaf;
        $model->id_tstaf = $id_tstaf;
        $model->nama = $nama;
        $model->isi = $isi;
        $model->id_perusahaan = $id_perusahaan;
        $model->id_karyawan = $id_karyawan;
          if($model->save())
            {
              return redirect('Strategi-Perusahaan')->with('message_sucess', 'strategi Staf berhasil dibuat');
            }else{
                return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
            }
    }

    public function editSstaf($id)
      {
          if(empty($sstaf = SStaf::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }
          $data = [
            'sstaf'=> $sstaf
          ];
          return response()->json($data);
      }

    public function updateSstaf(Request $req)
      { //dd($req->all());
  		//validasi harus di isi
        $this->validate($req,[
        'id_sstaf_ubah'=> 'required',
        'id_tstaf_ubah'=>'required',
        'nama_ubah'=>'required',
  			'isi_staf_ubah'=> 'required'
          ]);
  		//tampung di variabel
          $id_sstaf = $req->id_sstaf_ubah;
          $id_tstaf = $req->id_tstaf_ubah;
          $nama = $req->nama_ubah;
          $isi = $req->isi_staf_ubah;

          if(empty($model = SStaf::where('id', $id_sstaf)->where('id_perusahaan', $this->id_perusahaan)->first())){
              return abort(404);
          }
  		//insert ke field nilai dari variabel yg berisi data request
          $model->id_tstaf = $id_tstaf;
          $model->nama = $nama;
          $model->isi =$isi;
          $model->id_perusahaan = $this->id_perusahaan;
          $model->id_karyawan = $this->id_karyawan;

          if($model->save())
          {
              return redirect('Strategi-Perusahaan')->with('message_sucess','Anda baru saja mengubah data staf eksekutif perusahaan');
          }else
          {
              return redirect('Strategi-Perusahaan')->with('message_fail','Terjadi kesalahan, Silahkan ubah ulang..!');
          }
      }

      public function deleteSstaf(Request $req, $id)
      {
        $model = SStaf::find($id);
        if($model->delete())
        {
          return redirect ('Strategi-Perusahaan')->with('message_sucess','Berhasil menghapus data Strategi staf perusahaan');
        }else
        {
            return redirect('Strategi-Perusahaan')->with('message_fail','Gagal menghapus data ini, silahkan ulangi');
        }
      }

}
