<?php

namespace App\Http\Controllers\produksi;

use App\Imports\ImportBarang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\Barang as barangs;
use App\Model\Superadmin_sim\P_kategori_produk as kategori_produk;
use App\Model\Produksi\AturKonversi as p_konversi_barang;
use App\Model\Produksi\Satuan as Sb;
use App\Model\Produksi\HistroyKonversiBrg as p_history_konversi_brg;
use Illuminate\Support\Facades\DB;
use App\Model\Marketing\Promo;

class Barang extends Controller
{


    private $id_karyawan;
    private $id_perusahaan;
    private $metode_penjualan = [
        '0'=>'berdasarkan satu harga','1'=>'berdasarkan jumlah beli'
    ];

    private $metode_promo = [
      'Promo Barang',
      'Promo Jasa'
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function query_perusahaan(){
       $data =  DB::select('SELECT u_perusahaan.* FROM h_karyawan
                            join u_user_ukm on u_user_ukm.id=h_karyawan.id_user_ukm
                            join u_perusahaan on u_perusahaan.id_user_ukm = u_user_ukm.id
                            where h_karyawan.id_user_ukm ='.Session::get('id_superadmin_karyawan').' GROUP by u_perusahaan.id'
                           );
       return $data;
    }

    public function index()
    {
        $data=[
            'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan)->sortBy('created_at'),
            'konvesi_barang' => p_konversi_barang::all()->where('id_perusahaan', $this->id_perusahaan),
            'history_konversi_barang' => p_history_konversi_brg::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_perusahaan'=> $this->query_perusahaan(),
            'metode_promo'=>$this->metode_promo,
            'promo'=>Promo::where('id_perusahaan', $this->id_perusahaan)->where('jenis_promo','0')->get()
        ];

        if(empty(Session::get('tab')) && empty(Session::get('tab3')) && empty(Session::get('tab4')) && empty(Session::get('tab5')) && empty(Session::get('tab6'))){
            Session::flash('tab1','tab1');
        }

        if(!empty(Session::get('tab'))){
            Session::flash('tab2',Session::get('tab'));
        }

        if(!empty(Session::get('tab3'))){
            Session::flash('tab3',Session::get('tab3'));
        }

        if(!empty(Session::get('tab6'))){
            Session::flash('tab6',Session::get('tab6'));
        }

        return view('user.produksi.section.barang.page_default', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'kategori_jasa'=> kategori_produk::all(),
            'metode_jual'=>$this->metode_penjualan,
            'satuan' => Sb::all()
        ];
        return view('user.produksi.section.barang.page_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $this->validate($request,[
            'id_kategori' => 'required',
            'nm_barang' => 'required',
            'spec_barang' => 'required',
            'desc_barang' => 'required',
            'stok_minimum' => 'required',
//            'stok_barang' => 'required',
            'hpp' => 'required',
        ]);

         $id_kategori = $request->id_kategori;
         $id_subkategori = $request->id_subkategori_produk;
         $id_subsubkategori = $request->id_subsubkategori_produk;
         $nm_barang = $request->nm_barang;
         $spec_barang= $request->spec_barang;
         $desc_barang= $request->desc_barang;
         $stok_minimum= $request->stok_minimum;
         $kd_barang = $request->kd_barang;
         $barcode = $request->barcode;
         $id_satuan = $request->id_satuan;
         $no_rak = $request->no_rak;
         $hpp = $request->hpp;



         $model =new barangs;
         $model->id_kategori_produk = $id_kategori;
         $model->id_subkategori_produk = $id_subkategori;
         $model->id_subsubkategori_produk= $id_subsubkategori;
         $model->kd_barang= $kd_barang;
         $model->barcode= $barcode;
         $model->nm_barang= $nm_barang;
         $model->id_satuan= $id_satuan;
         $model->spec_barang= $spec_barang;
         $model->desc_barang= $desc_barang;

//         $model->expired_date= $expired_date;
         $model->no_rak= $no_rak;
//         $model->stok_awal= $stok_awal;
         $model->stok_minimum= $stok_minimum;
        $model->hpp= $hpp;
        $model->metode_jual= $request->metode_jual;
        $model->stok_akhir= $request->stok_akhir;
        $model->gambar= '';
         $model->id_perusahaan= $this->id_perusahaan;
         $model->id_karyawan= $this->id_karyawan;

         if($model->save()){
             return redirect('Barang')->with('message_success', 'Anda telah menambahkan data Barang Baru');
         }else{
             return redirect('Barang')->with('message_fail', 'Maaf terjadi kesalahan, coba lagi menambah data barang');
         }
    }


    public function show(Request $req)
    {
        $barang_yang_dicari = $req->nm_barang;
        $data=[
            'data_barang'=> barangs::where('id_perusahaan', $this->id_perusahaan)->where('nm_barang','Like',"%{$barang_yang_dicari}%")->paginate(15)
        ];
        return view('user.produksi.section.barang.page_default', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(empty($data_barang = barangs::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'kategori_jasa'=> kategori_produk::all(),
            'data_barang' => $data_barang,
            'metode_jual'=>$this->metode_penjualan,
            'satuan' => Sb::all()
        ];
        return view('user.produksi.section.barang.page_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'id_kategori' => 'required',
            'nm_barang' => 'required',
            'spec_barang' => 'required',
            'desc_barang' => 'required',
//            'stok_barang' => 'required',
//            'harga_jual' => 'required',
        ]);



        $id_kategori = $request->id_kategori;
        $id_subkategori = $request->id_subkategori_produk;
        $id_subsubkategori = $request->id_subsubkategori_produk;
        $nm_barang = $request->nm_barang;
        $spec_barang= $request->spec_barang;
        $desc_barang= $request->desc_barang;
        $expired_date= date('Y-m-d', strtotime($request->expired_date));
        $stok_minimum= $request->stok_minimum;
        $kd_barang = $request->kd_barang;
        $barcode = $request->barcode;
        $id_satuan = $request->id_satuan;
        $no_rak = $request->no_rak;
        $hpp = $request->hpp;

        $model =barangs::find($id);
        $model->id_kategori_produk = $id_kategori;
        $model->id_subkategori_produk = $id_subkategori;
        $model->id_subsubkategori_produk= $id_subsubkategori;
        $model->kd_barang= $kd_barang;
        $model->barcode= $barcode;
        $model->nm_barang= $nm_barang;
        $model->id_satuan= $id_satuan;
        $model->spec_barang= $spec_barang;
        $model->desc_barang= $desc_barang;
        $model->no_rak= $no_rak;
        $model->stok_minimum= $stok_minimum;
        $model->hpp= $hpp;
        $model->metode_jual= $request->metode_jual;
        $model->stok_akhir= $request->stok_akhir;
        $model->gambar= '';
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Barang')->with('message_success', 'Anda telah mengubah data darang ');
        }else{
            return redirect('Barang')->with('message_fail', 'Maaf terjadi kesalahan, coba lagi mengubah data barang');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(empty($model =barangs::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($model->delete()){
            return redirect('Barang')->with('message_success', 'Anda telah menghapus data barang');
        }else{
            return redirect('Barang')->with('message_fail', 'Maaf terjadi kesalahan, coba lagi mengubah data barang');
        }
    }

    public function transerBarang(Request $req){

        $this->validate($req,[
            'p_awal'=> 'required',
            'p_tujuan'=> 'required',
        ]);

        $model_perusahaan_awal = barangs::all()->where('id_perusahaan', $req->p_awal);
        foreach ($model_perusahaan_awal as $data_barang){
            $model_perusahaan_tujuan = barangs::updateOrCreate(
                [
                    'id_perusahaan'=> $req->p_tujuan,
                    'kd_barang'=>$data_barang->kd_barang
                ],
                [
                   'id_kategori_produk'=>$data_barang->id_kategori_produk,
                   'id_subkategori_produk'=>$data_barang->id_subkategori_produk,
                   'id_subsubkategori_produk'=>$data_barang->id_subsubkategori_produk,
                   'barcode'=>$data_barang->barcode,
                   'nm_barang'=>$data_barang->nm_barang,
                   'id_satuan'=>$data_barang->id_satuan,
                   'spec_barang'=>$data_barang->spec_barang,
                   'desc_barang'=>$data_barang->desc_barang,
                   'no_rak'=>'-',
                   'stok_minimum'=>$data_barang->stok_minimum,
                   'hpp'=>$data_barang->hpp,
                   'id_karyawan'=>$data_barang->id_karyawan,
                   'stok_akhir'=>0,
                   'metode_jual'=>'0',
                   'gambar'=>$data_barang->gambar,
                ]
            );
        }
           return redirect('Barang')->with('message_success', 'Data barang telah berhasil ditransfer')->with('tab5','tab5');
    }

    # Todo: Stok Akhir
    public function akhir_stok(){
        $data = [
            'menu'=> 'stok_akhir',
            'data_barang'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan)->sortBy('created_at'),
        ];
        return view('user.produksi.section.inventory.page_default', $data);
    }

    # Todo Import Barang
    public function import_barang(Request $request){
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('filebarang',$nama_file);

        // import data
        Excel::import(new ImportBarang, public_path('/filebarang/'.$nama_file));

        // notifikasi dengan session
        Session::flash('message_success','Data Barang Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('/Barang');
    }
}
