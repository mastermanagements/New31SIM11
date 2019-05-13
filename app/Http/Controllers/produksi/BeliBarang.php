<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\BeliBarang as beliBarangs;
use App\Model\Produksi\Supplier as suppliers;
use App\Model\Produksi\Barang as barangs;
use Session;

class BeliBarang extends Controller
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

    public function index(){
        $data=[
            'data_pembelian'=> beliBarangs::all()->where('id_perusahaan', $this->id_perusahaan)->sortByDesc('created_at')
        ];
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
