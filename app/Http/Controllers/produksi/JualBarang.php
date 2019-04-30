<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\JualBarang as jualBarangs;
use App\Model\Produksi\Barang as barang;
use App\Model\Administrasi\Klien as klien;
class JualBarang extends Controller
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
        $data=[
            'penjualan' => jualBarangs::where('id_perusahaan', $this->id_perusahaan)->paginate()
        ];
        return view('user.produksi.section.jualbarang.page_default', $data);
    }

    public function create()
    {
        $data=[
            'barangs'=> barang::all()->where('id_perusahaan', $this->id_perusahaan),
            'klien'=> klien::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.produksi.section.jualbarang.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'tgl_jual' => 'required',
            'id_klien' => 'required',
            'id_barang' => 'required',
            'jumlah_barang' => 'required',
        ]);


        $id_klien = $req->id_klien;
        $id_barang = $req->id_barang;
        $jumlah_barang = $req->jumlah_barang;


        foreach ($id_barang as $key => $value)
        {
            $tgl_beli = date('Y-m-d', strtotime($req->tgl_jual));
            $model = new jualBarangs;
            $model->tgl_jual = $tgl_beli;
            $model->id_klien = $id_klien;
            $model->id_perusahaan = $this->id_perusahaan;
            $model->id_karyawan = $this->id_karyawan;
            $model->id_barang = $value;
            $model->jumlah_barang = $jumlah_barang[$key];
            $model->save();
        }

        return redirect('Penjualan')->with('message_success', 'Data Sedang diproses...!');

    }

    public function edit($id)
    {
        if(empty($dataPenjualan= jualBarangs::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data=[
            'barangs'=> barang::all()->where('id_perusahaan', $this->id_perusahaan),
            'klien'=> klien::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_penjualan'=> $dataPenjualan
        ];
        return view('user.produksi.section.jualbarang.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'tgl_jual' => 'required',
            'id_klien' => 'required',
            'id_barang' => 'required',
            'jumlah_barang' => 'required',
        ]);


        $id_klien = $req->id_klien;
        $id_barang = $req->id_barang;
        $jumlah_barang = $req->jumlah_barang;

            $tgl_beli = date('Y-m-d', strtotime($req->tgl_jual));
            $model = jualBarangs::find($id);
            $model->tgl_jual = $tgl_beli;
            $model->id_klien = $id_klien;
            $model->id_perusahaan = $this->id_perusahaan;
            $model->id_karyawan = $this->id_karyawan;
            $model->id_barang =$id_barang;
            $model->jumlah_barang = $jumlah_barang;

        if( $model->save()){
            return redirect('Penjualan')->with('message_success', 'Data berhasil diubah...!');
        }else{
            return redirect('Penjualan')->with('message_success', 'Terjadi Kesalahan, Silahkan coba lagi');
        }
    }

    public function destory(Request $req, $id)
    {
        if(empty($model = jualBarangs::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if( $model->delete()){
            return redirect('Penjualan')->with('message_success', 'Data berhasil dihapus...!');
        }else{
            return redirect('Penjualan')->with('message_success', 'Terjadi Kesalahan, Silahkan coba lagi');
        }
    }
}
