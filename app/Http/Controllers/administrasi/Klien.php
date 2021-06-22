<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as kliens;
use App\Model\Administrasi\Leads as lead;
use App\Model\Administrasi\RekKlien as rek_klien;
use App\Model\Marketing\SumberDataKlien as SDK;
use App\Model\Marketing\PenandaSDK as penandaSDK;
use App\Model\Marketing\HistoryKlien as historykliens;
use Session;
//use Carbon\Carbon;
use App\Model\Administrasi\GroupKlien;
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
			'data_klien' => kliens::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_leads' => lead::where('id_perusahaan', $this->id_perusahaan)->paginate(25),
			//'data_prospect' => kliens::where('jenis_klien', '2')->where('id_perusahaan', $this->id_perusahaan)->paginate(25),
			//'data_potential' => kliens::where('jenis_klien', '3')->where('id_perusahaan', $this->id_perusahaan)->paginate(25),
			//'data_closeable' => kliens::where('jenis_klien', '4')->where('id_perusahaan', $this->id_perusahaan)->paginate(25),
			'SDK'=>SDK::all(),
			'penandaSDK'=>penandaSDK::all(),
      'group_klien'=> GroupKlien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
      'rek_klien'=> rek_klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
		//dd($data_klien['penandaSDK']);
    if(empty(Session::get('tab2')) && empty(Session::get('tab3')) && empty(Session::get('tab6'))){
        Session::flash('tab1','tab1');
    }

    if(!empty(Session::get('tab2'))){
        Session::flash('tab2',Session::get('tab2'));
    }

    if(!empty(Session::get('tab3'))){
        Session::flash('tab3',Session::get('tab3'));
    }

    if(!empty(Session::get('tab4'))){
        Session::flash('tab4',Session::get('tab4'));
    }

        return view('user.administrasi.section.klien.page_default', $data_klien);
    }

    /* public function cari_klien(Request $request)
    {
        $nama_klie = $request->nm_klien;
        $data_klien = [
            'data_klien' => kliens::where('nm_klien', 'LIKE', "%{$nama_klie}%") ->where('id_perusahaan', $this->id_perusahaan)->paginate(10)
        ];
        return view('user.administrasi.section.klien.page_default', $data_klien);
    } */

	//tambah klien
	public function create_klien()
    {
		$data = ['group_klien' => GroupKlien::all()->where('id_perusahaan', $this->id_perusahaan)];
		
        return view('user.administrasi.section.klien.page_create_klien', $data);
    }
	
	public function store_klien(Request $req)
    { //validasi
       $this->validate($req, [
            'nm_klien' =>'required',
            //'alamat' =>'required',
            //'pekerjaan' =>'required',
            //'hp' =>'required',
            //'id_sdk' =>'required',
            //'id_penanda_sdk' =>'required'
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
    		/*$jenis_klien= $req->jenis_klien;
    		$id_sdk = $req->id_sdk;
    		$id_penanda_sdk = $req->id_penanda_sdk;
    		$tambahan_sdk = $req->tambahan_sdk; */

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
        /* $models->jenis_klien = $jenis_klien;
		$models->id_sdk = $id_sdk;
        $models->id_penanda_sdk = $id_penanda_sdk;
        $models->tambahan_sdk = $tambahan_sdk; */
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;

        if($models->save())
        {
            return redirect('Klien')->with('message_success','Anda telah menambah data customer');
          }else
            {
                return redirect('Klien')->with('message_fail',' Gagal tambah data customer');
            }
    }

	//tambah leads
	public function create_leads()
    {
		   $tambah_leads = [
			'SDK'=>SDK::all(),
			//'penandaSDK'=>penandaSDK::all(),
        ];
        return view('user.administrasi.section.klien.page_create_leads', $tambah_leads);
    }

	//store leads
	public function store_leads(Request $req)
    { //validasi
       $this->validate($req, [
            'nm_klien' =>'required',
            //'alamat' =>'required',
            //'pekerjaan' =>'required',
            //'hp' =>'required',
            //'id_sdk' =>'required',
            //'id_penanda_sdk' =>'required'
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
    	$id_sdk = $req->id_sdk;
    	$id_penanda_sdk = $req->id_penanda_sdk;
    	$tambahan_sdk = $req->tambahan_sdk;

        $models = new lead;
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
		$models->id_sdk = $id_sdk;
        $models->id_penanda_sdk = $id_penanda_sdk;
        $models->tambahan_sdk = $tambahan_sdk;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;

        if($models->save())
        {
            return redirect('Klien')->with('message_success','Anda telah menambah data lead')->with('tab2','tab2');
          }else
            {
                return redirect('Klien')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan calon lead anda')->with('tab2','tab2');
            }
    }
	
	public function editLeads($id)
    {
        if(empty($data = lead::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data_leads = [
            'data_leads' => $data,
        ];
        return view('user.administrasi.section.klien.page_edit_leads', $data_leads);
    }
	
	 public function updateLeads(Request $req, $id)
    {
        $this->validate($req, [
            'nm_klien' =>'required',
            //'alamat' =>'required',
            //'pekerjaan' =>'required',
            //'hp' =>'required'
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
       
        $models = lead::find($id);

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
		//$models->updated_at = Carbon::now();

        if($models->save())
        {
            return redirect('Klien')->with('message_success','Anda telah mengubah data leads')->with('tab2','tab2');
        }else
        {
            return redirect('Klien')->with('message_fail','Gagal ubah data leads, Coba ulangi lagi')->with('tab2','tab2');
        }
    }


    public function edit($id)
    {
        if(empty($data = kliens::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data_klien = [
            'data_klien' => $data,
            'group_klien' => GroupKlien::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
		//dd($data_klien['group_klien']);
        return view('user.administrasi.section.klien.page_edit', $data_klien);
    }


    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'nm_klien' =>'required',
            //'alamat' =>'required',
            //'pekerjaan' =>'required',
            //'hp' =>'required'
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
        $id_group= $req->id_group;
        $status_diskon= $req->status_diskon;

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
        $models->id_group = $id_group;
        $models->status_diskon = $status_diskon;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		//$models->updated_at = Carbon::now();

        if($models->save())
        {
            return redirect('Klien')->with('message_success','Anda telah mengubah data customer');
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
            return redirect('Klien')->with('message_success','Anda telah menghapus data klien');
        }
        else
        {
            return redirect('Klien')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba menghapus klien anda');
        }
    }

	public function ambil_data_klien($id)
    {
        if(empty($data_klien = kliens::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data_pass = [
            'data'=> $data_klien
        ];
        return response()->json($data_pass);
    }

	/*public function getSDK()
    {
        $model = SDK::all();
        return $model;
    }*/

    public function getPenanda($id=1)
    {
        $model = penandaSDK::all()->where('id_sdk', $id);
        return $model;
    }

    public function ResponsePenanda($id_sdk){
        return response()->json($this->getPenanda($id_sdk));
    }

	//Ganti jenis klien dari leads ke prospect

  public function convertLeads(Request $req, $id)
  {
      $models = kliens::find($id);
      $models->jenis_klien = '0';
      if($models->save())
      {
          return redirect('Klien')->with('message_success','sukses mengubah jenis klien');
      }
      else
      {
          return redirect('Klien')->with('message_fail','Maaf,Telah terjadi kesalahan, gagal mengubah jenis klien');
      }
  }

}
