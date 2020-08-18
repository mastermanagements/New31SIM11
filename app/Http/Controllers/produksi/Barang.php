<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\Barang as barangs;
use App\Model\Superadmin_sim\P_kategori_produk as kategori_produk;
use App\Model\Produksi\SatuanBarang as Sb;

class Barang extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[
            'data_barang'=> barangs::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at')->paginate(15)
        ];
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
            'stok_barang' => 'required',
            'hpp' => 'required',
        ]);

         $id_kategori = $request->id_kategori;
         $id_subkategori = $request->id_subkategori_produk;
         $id_subsubkategori = $request->id_subsubkategori_produk;
         $nm_barang = $request->nm_barang;
         $spec_barang= $request->spec_barang;
         $desc_barang= $request->desc_barang;
         $expired_date= date('Y-m-d', strtotime($request->expired_date));
         $stok_awal= $request->stok_awal;
         $stok_minimum= $request->stok_minimum;
         $harga_jual= $request->hpp;
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
         $model->expired_date= $expired_date;
         $model->no_rak= $no_rak;
         $model->stok_awal= $stok_awal;
         $model->stok_minimum= $stok_minimum;
         $model->hpp= $hpp;
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
            'stok_barang' => 'required',
            'harga_jual' => 'required',
        ]);

        $id_kategori = $request->id_kategori;
        $id_subkategori = $request->id_subkategori_produk;
        $id_subsubkategori = $request->id_subsubkategori_produk;
        $nm_barang = $request->nm_barang;
        $spec_barang= $request->spec_barang;
        $desc_barang= $request->desc_barang;
        $expired_date= date('Y-m-d', strtotime($request->expired_date));
        $stok_awal= $request->stok_awal;
        $stok_minimum= $request->stok_minimum;
        $harga_jual= $request->hpp;
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
        $model->expired_date= $expired_date;
        $model->no_rak= $no_rak;
        $model->stok_awal= $stok_awal;
        $model->stok_minimum= $stok_minimum;
        $model->hpp= $hpp;
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
}
