<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Marketing\Segmenting as sg;
use App\Model\Marketing\SubSegmenting as subsg;
use App\Model\Marketing\SubSubSegmenting as subsubsg;
use App\Model\Marketing\ContentSegmenting as contentsg;
use App\Model\Marketing\HasilSegmenting as hasilsg;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\Jasa as jasas;
use Session;

class Segmenting extends Controller
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
        $data_segmenting = [
            'data_sg' => sg::all()->where('id',1),
			'data_sg_geo' => sg::all()->where('id',2),
			'data_sg_psi' => sg::all()->where('id',3),
            'data_subsg' => subsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_subsubsg' => subsubsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_contentsg' => contentsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_hasilsg_brg' => hasilsg::whereNotNull('id_barang')->where('tahun',now()->year)->where('id_perusahaan', $this->id_perusahaan)->get(),
			'select_tahun_brg'=> hasilsg::whereNotNull('id_barang')->groupBy
			('tahun')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'select_tahun_jasa'=> hasilsg::whereNotNull('id_jasa')->groupBy
			('tahun')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_hasilsg_jasa' => hasilsg::whereNotNull('id_jasa')->where('tahun',now()->year)->where('id_perusahaan', $this->id_perusahaan)->get()

        ];
		//dd($data_segmenting['select_tahun']);
        return view('user.marketing.section.segmenting.page_default', $data_segmenting);
    }
	
	public function search_hasilsg_brg(Request $req){
        $data = [
            'data_hasilsg_brg' => hasilsg::whereNotNull('id_barang')->where('tahun', $req->tahun_cari)->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_sg' => sg::all()->where('id',1),
			'data_sg_geo' => sg::all()->where('id',2),
			'data_sg_psi' => sg::all()->where('id',3),
            'data_subsg' => subsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_subsubsg' => subsubsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_contentsg' => contentsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan),
			'select_tahun_brg'=> hasilsg::whereNotNull('id_barang')->groupBy
			('tahun')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_hasilsg_jasa' => hasilsg::whereNotNull('id_jasa')->where('id_perusahaan', $this->id_perusahaan)->get()
        ];

        return view('user.marketing.section.segmenting.page_default', $data);
    }
	
	public function search_hasilsg_jasa(Request $req){
        $data = [
            'data_hasilsg_jasa' => hasilsg::whereNotNull('id_jasa')->where('tahun', $req->tahun_cari)->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_sg' => sg::all()->where('id',1),
			'data_sg_geo' => sg::all()->where('id',2),
			'data_sg_psi' => sg::all()->where('id',3),
            'data_subsg' => subsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_subsubsg' => subsubsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_contentsg' => contentsg::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_jasa'=> jasas::all()->where('id_perusahaan', $this->id_perusahaan),
			'select_tahun_jasa'=> hasilsg::whereNotNull('id_jasa')->groupBy
			('tahun')->where('id_perusahaan', $this->id_perusahaan)->get(),
			'data_hasilsg_brg' => hasilsg::whereNotNull('id_barang')->where('id_perusahaan', $this->id_perusahaan)->get(),
        ];

        return view('user.marketing.section.segmenting.page_default', $data);
    }
	
	public function store(Request $req)
    { //validasi
       $this->validate($req, [
            'id_segmenting' =>'required',
            'item_sub_segmenting' =>'required',
        ]);
        $id_segmenting = $req->id_segmenting;
        $item_sub_segmenting = $req->item_sub_segmenting;
        $item_subsub_segmenting = $req->item_subsub_segmenting;
        $content_segmenting = $req->content_segmenting;
		
        $models = new subsg;
        $models->id_segmenting = $id_segmenting;
        $models->item_sub_segmenting = $item_sub_segmenting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		
		 //ambil get id subsg
		$last_subsg_id = $models->id;
		
		
		$modelss = new subsubsg;
        $modelss->id_sub_segmenting = $last_subsg_id;
        $modelss->item_subsub_segmenting = $item_subsub_segmenting;
        $modelss->id_perusahaan = $this->id_perusahaan;
        $modelss->id_karyawan = $this->id_karyawan;
		$modelss->save(); 
		
		//ambil get id subsubsg
		$last_subsub_sg_id = $models->id;
		
		$modelsss = new contentsg;
        $modelsss->id_subsub_segmenting = $last_subsub_sg_id;
        $modelsss->content_segmenting = $content_segmenting;
        $modelsss->id_perusahaan = $this->id_perusahaan;
        $modelsss->id_karyawan = $this->id_karyawan;
		$modelsss->save(); 
		//dd($req->all());
        if($models->save()  AND $modelss->save() AND $modelsss->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah menambah data segmenting');
          }else
            {
                return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data segementing perusahaan anda');
            }
    }
	
	public function edit($id)
    {
        if(empty($data_ssg = subsg::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data_subsg = [
            'data_subsg' => $data_ssg
        ];
        return view('user.marketing.section.segmenting.page_edit', $data_subsg);
    }
	
	public function update(Request $req, $id)
    {
        $this->validate($req, [
            'item_sub_segmenting' =>'required',
        ]);

        $item_sub_segmenting = $req->item_sub_segmenting;
        $item_subsub_segmenting = $req->item_subsub_segmenting;
		$content_segmenting = $req->content_segmenting;
		
        $models = subsg::find($id);
        $models->item_sub_segmenting = $item_sub_segmenting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
			
		$modelss = subsubsg::find($id);
        $modelss->item_subsub_segmenting = $item_subsub_segmenting;
        $modelss->id_perusahaan = $this->id_perusahaan;
        $modelss->id_karyawan = $this->id_karyawan;
		$modelss->save();
		
		$modelsss = contentsg::find($id);
        $modelsss->content_segmenting = $content_segmenting;
        $modelsss->id_perusahaan = $this->id_perusahaan;
        $modelsss->id_karyawan = $this->id_karyawan;
		$modelsss->save();
			
         if($models->save()  AND $modelss->save() AND $modelsss->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah mengubah data Segmenting');
        }else
        {
            return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba mengubaubah Segmenting anda');
        }
    }
	
	//=========== store Demografis ============//
	
	public function store_segbarang(Request $req)
    { 
	//validasi
       $this->validate($req, [
			'tahun' =>'required',
            'id_barang' =>'required',
            'hasil_segmenting' =>'required',
            'id_content_segmenting' =>'required'
        ]);
		
        $tahun = $req->tahun;
        $id_barang = $req->id_barang;
		$id_content_segmenting = $req->id_content_segmenting;
        $hasil_segmenting = $req->hasil_segmenting;
		
        $models = new hasilsg;
        $models->tahun = $tahun;
        $models->id_barang = $id_barang;
        $models->id_content_segmenting = $id_content_segmenting;
        $models->hasil_segmenting = $hasil_segmenting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		//dd($req->all());
	
        if($models->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah menambah data segmenting Demografis per barang');
          }else
            {
                return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data segmenting per barang perusahaan anda');
            }
    }
	
	public function store_segjasa(Request $req)
    { 
	//validasi
       $this->validate($req, [
			'tahun' =>'required',
            'id_jasa' =>'required',
            'hasil_segmenting' =>'required',
            'id_content_segmenting' =>'required'
        ]);
		
        $tahun = $req->tahun;
		$id_jasa = $req->id_jasa;
		$id_content_segmenting = $req->id_content_segmenting;
        $hasil_segmenting = $req->hasil_segmenting;
		
        $models = new hasilsg;
		$models->tahun = $tahun;
        $models->id_jasa = $id_jasa;
        $models->id_content_segmenting = $id_content_segmenting;
        $models->hasil_segmenting = $hasil_segmenting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		//dd($req->all());
	
        if($models->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah menambah data segmenting Demografis per jasa perusahaan Anda');
          }else
            {
                return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data segmenting per jasa perusahaan anda');
            }
    }
	
	//=========== store Geografis ============//
	
	public function store_segbarang_geo(Request $req)
    { 
	//validasi
       $this->validate($req, [
			'tahun' =>'required',
            'id_barang' =>'required',
            'hasil_segmenting' =>'required',
            'id_content_segmenting' =>'required'
        ]);
		
        $tahun = $req->tahun;
		$id_barang = $req->id_barang;
		$id_content_segmenting = $req->id_content_segmenting;
        $hasil_segmenting = $req->hasil_segmenting;
		
        $models = new hasilsg;
		$models->tahun = $tahun;
        $models->id_barang = $id_barang;
        $models->id_content_segmenting = $id_content_segmenting;
        $models->hasil_segmenting = $hasil_segmenting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		//dd($req->all());
	
        if($models->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah menambah data segmenting per barang Segmentasi Geografis');
          }else
            {
                return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data segmenting Geografis per barang perusahaan anda');
            }
    }
	
	public function store_segjasa_geo(Request $req)
    { 
	//validasi
       $this->validate($req, [
			'tahun' =>'required',
            'id_jasa' =>'required',
            'hasil_segmenting' =>'required',
            'id_content_segmenting' =>'required'
        ]);
		
        $tahun = $req->tahun;
		$id_jasa = $req->id_jasa;
		$id_content_segmenting = $req->id_content_segmenting;
        $hasil_segmenting = $req->hasil_segmenting;
		
        $models = new hasilsg;
		$models->tahun = $tahun;
        $models->id_jasa = $id_jasa;
        $models->id_content_segmenting = $id_content_segmenting;
        $models->hasil_segmenting = $hasil_segmenting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		//dd($req->all());
	
        if($models->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah menambah data segmenting Geografis per jasa perusahaan Anda');
          }else
            {
                return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data segmenting per jasa perusahaan anda');
            }
    }
	
	//=========== store Psikografis ============//
	
	public function store_segbarang_psi(Request $req)
    { 
	//validasi
       $this->validate($req, [
            'tahun' =>'required',
			'id_barang' =>'required',
            'hasil_segmenting' =>'required',
            'id_content_segmenting' =>'required'
        ]);
		 
		$tahun = $req->tahun;
        $id_barang = $req->id_barang;
		$id_content_segmenting = $req->id_content_segmenting;
        $hasil_segmenting = $req->hasil_segmenting;
		
        $models = new hasilsg;
		$models->tahun = $tahun;
        $models->id_barang = $id_barang;
        $models->id_content_segmenting = $id_content_segmenting;
        $models->hasil_segmenting = $hasil_segmenting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		//dd($req->all());
	
        if($models->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah menambah data segmenting per barang Segmentasi Psikografis');
          }else
            {
                return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data segmenting Psikografis per barang perusahaan anda');
            }
    }
	
	public function store_segjasa_psi(Request $req)
    { 
	//validasi
       $this->validate($req, [
            'tahun' =>'required',
			'id_jasa' =>'required',
            'hasil_segmenting' =>'required',
            'id_content_segmenting' =>'required'
        ]);
		
		$tahun = $req->tahun;
		$tahun = $req->tahun;
        $id_jasa = $req->id_jasa;
		$id_content_segmenting = $req->id_content_segmenting;
        $hasil_segmenting = $req->hasil_segmenting;
		
        $models = new hasilsg;
		$models->tahun = $tahun;
        $models->id_jasa = $id_jasa;
        $models->id_content_segmenting = $id_content_segmenting;
        $models->hasil_segmenting = $hasil_segmenting;
        $models->id_perusahaan = $this->id_perusahaan;
        $models->id_karyawan = $this->id_karyawan;
		$models->save();
		//dd($req->all());
	
        if($models->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah menambah data segmenting Psikografis per jasa perusahaan Anda');
          }else
            {
                return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data segmenting per jasa perusahaan anda');
            }
    }
	
	public function edit_hasil_segmenting($id)
    {
        if(empty($data_hasilsg = hasilsg::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_hasilsg'=> $data_hasilsg
        ];
        return response()->json($data);
    }
	
	public function update_hasilsg(Request $req)
    { //
		//validasi harus di isi
        $this->validate($req,[
            'id_hasil_segmenting'=> 'required',
			'hasil_segmenting_ubah'=> 'required'
        ]);
		//tampung di variabel
        $hasil_segmenting = $req->hasil_segmenting_ubah;
        
        if(empty($model = hasilsg::where('id', $req->id_hasil_segmenting)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
		//insert ke field nilai dari variabel yg berisi data request
        $model->hasil_segmenting =$hasil_segmenting;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
		//dd($req->all());
         if($model->save())
        {
            return redirect('Segmenting')->with('message_success','Anda telah merubah hasil segmenting di perusahaan Anda');
          }else
            {
                return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba Masukan lagi data segmenting per jasa perusahaan anda');
            }
    }
	
	public function getHasilSG($id=1)
    {
        $model = hasilsg::all()->where('id_hasilsg', $id);
        return $model;
    }

    public function ResponseHasilSG($id_hasilsg){
        return response()->json($this->getHasilSG($id_hasilsg));
    }
	
	public function delete(Request $req, $id)
    {
        if(empty($data = subsg::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
		
        if($data->delete())
        {
            return redirect('Segmenting')->with('message_success','Anda telah menghapus data segmenting');
        }
        else
        {
            return redirect('Segmenting')->with('message_fail','Maaf,Telah terjadi kesalahan, Coba lagi menghapus data anda');
        }
    }


}
