<?php

namespace App\Http\Controllers\produksi;

use App\Model\Keuangan\Akun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\BeliBarang as beliBarangs;
use App\Model\Produksi\Supplier as suppliers;
use App\Model\Produksi\Barang as barangs;
use App\Model\Produksi\TawarBeli;
use App\Model\Produksi\PesananPembelian;
use App\Model\Produksi\POrder;
use App\Model\Produksi\Detail_Cek_Barang as dcb;
use App\Http\utils\SettingNoSurat;
use App\Model\Produksi\AkunPembelian;
use App\Http\utils\JenisAkunPembelian;
use Session;

class BeliBarang extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;

    # Tanggapan Supplier
    private $tanggapan = [
        'Menerima',
        'Menolak'
    ];

    private $jenis_pembayran = [
        'PO',
        'Pembelian'
    ];

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

    public function index(){
        $no_surat = SettingNoSurat::no_kode_po();
        $data=[
            'data_pembelian'=> POrder::all()->where('id_perusahaan', $this->id_perusahaan)->sortByDesc('created_at'),
            'suppliers' => suppliers::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan')),
            'tawar_beli'=> TawarBeli::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan')),
            'pesanan_pembelian'=> PesananPembelian::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'tanggapan'=> $this->tanggapan,
            'jenis_pembayaran'=> $this->jenis_pembayran,
            'no_surat_penawaran'=> $no_surat,
            'akun_pembelian'=> AkunPembelian::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'detail_cek'=> PesananPembelian::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'jenis_jurnal'=> JenisAkunPembelian::$jenis_akun,
            'detail_cek_brg'=>dcb::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'detail_cek_brg_group'=>dcb::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->groupBy('id_order')->get()
        ];
        //dd($data['detail_cek_brg_group']);
        //tab1 tawar beli di nonaktifkan
        if (empty(Session::get('tab3')) && empty(Session::get('tab4')) && empty(Session::get('tab5')) && empty(Session::get('tab6'))){
            Session::flash('tab2','tab2');
        }

        if(!empty(Session::get('tab3'))){
            Session::flash('tab3',Session::get('tab3'));
        }

        if(!empty(Session::get('tab4'))){
            Session::flash('tab4',Session::get('tab4'));
        }

        if(!empty(Session::get('tab5'))){
            Session::flash('tab5',Session::get('tab5'));
        }
        if(!empty(Session::get('tab6'))){
            Session::flash('tab6',Session::get('tab6'));
        }

        return view('user.produksi.section.belibarang.page_default', $data);
    }

    public function create()
    {
        $data=[
            'supplier'=> suppliers::all()->where('id_perusahaan', $this->id_perusahaan),
            'barangs'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.produksi.section.belibarang.page_create', $data);
    }

    public function store(Request $req)
    {
       // dd($req->all());
        $this->validate($req,[
           'tgl_beli' => 'required',
            'id_barang' => 'required',
            'id_suplier'=> 'required',
            'jumlah_barang'=> 'required',
            'harga_beli' => 'required'
        ]);

        $tgl_beli = date('Y-m-d', strtotime($req->tgl_beli));
        $id_barang = $req->id_barang;
        $id_supplier= $req->id_suplier;
        $jumlah_barang= $req->jumlah_barang;
        $harga_beli= $req->harga_beli;
        $no_faktur= $req->no_faktur;

        $nama_supplier = suppliers::find($id_supplier)->nama_suplier;
        $no_urut = beliBarangs::where('id_perusahaan', $this->id_perusahaan)->count()+1;

        $model = new beliBarangs;
        $model->no_order = date('dmY', strtotime($tgl_beli))."/".$nama_supplier."/".$no_urut;
        $model->no_faktur = $no_faktur;
        $model->tgl_beli = $tgl_beli;
        $model->id_barang = $id_barang;
        $model->id_suplier = $id_supplier;
        $model->jumlah_barang = $jumlah_barang;
        $model->harga_beli =$harga_beli;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save())
        {
            return redirect('Pembelian')->with('message_success', 'Anda baru Saja menambahkan Pembelian baru');
        }
        else{
            return redirect('Pembelian')->with('message_fail', 'Maaf Terjadi kesalahan, Silahkan coba lagi untuk menambahkan data pembelian ');
        }
    }

    public function edit($id)
    {
        if(empty($data_pembeliaan= beliBarangs::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data=[
            'supplier'=> suppliers::all()->where('id_perusahaan', $this->id_perusahaan),
            'barangs'=> barangs::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=> $data_pembeliaan,
        ];
        return view('user.produksi.section.belibarang.page_edit', $data);
    }


    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'tgl_beli' => 'required',
            'id_barang' => 'required',
            'id_suplier'=> 'required',
            'jumlah_barang'=> 'required',
            'harga_beli' => 'required'
        ]);

        $tgl_beli = date('Y-m-d', strtotime($req->tgl_beli));

        $id_barang = $req->id_barang;
        $id_supplier= $req->id_suplier;
        $jumlah_barang= $req->jumlah_barang;
        $harga_beli= $req->harga_beli;
        $no_faktur= $req->no_faktur;

        $model = beliBarangs::find($id);
        $model->tgl_beli = $tgl_beli;
        $model->no_faktur = $no_faktur;
        $model->id_barang = $id_barang;
        $model->id_suplier = $id_supplier;
        $model->jumlah_barang = $jumlah_barang;
        $model->harga_beli =$harga_beli;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save())
        {
            return redirect('Pembelian')->with('message_success', 'Anda baru Saja mengubah Pembelian Anda');
        }
        else{
            return redirect('Pembelian')->with('message_fail', 'Maaf Terjadi kesalahan, Silahkan coba lagi untuk mengubah data pembelian ');
        }
    }

    public function delete(Request $req, $id)
    {

        if(empty($model = beliBarangs::where('id',$id)->where('id_perusahaan', $this->id_perusahaan))){
            return abort(404);
        }

        if($model->delete())
        {
            return redirect('Pembelian')->with('message_success', 'Anda baru Saja menghapus Pembelian Anda');
        }
        else{
            return redirect('Pembelian')->with('message_fail', 'Maaf Terjadi kesalahan, Silahkan coba lagi untuk menghapus data pembelian ');
        }
    }
}
