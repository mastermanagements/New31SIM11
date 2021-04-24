<?php

namespace App\Http\Controllers\produksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\JualBarang as jualBarangs;
use App\Model\Produksi\Barang as barang;
use App\Model\Administrasi\Klien as klien;
use App\Model\Produksi\TawarJual as TJ;
use App\Model\Produksi\PSO;
use App\Model\Produksi\PSales;
use App\Model\Produksi\PDiskon;
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
            'penjualan' => jualBarangs::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(),
            'tawar_jual'=> TJ::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'p_so'=> PSO::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'PSales'=> PSales::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'pDiskon'=> PDiskon::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        //tab1 tawar jual  di nonaktifkan dl
        if (empty(Session::get('tab3')) && empty(Session::get('tab4')) && empty(Session::get('tab5')) && empty(Session::get('tab6')) && empty(Session::get('tab6'))){
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
        if(!empty(Session::get('tab7'))){
            Session::flash('tab7',Session::get('tab7'));
        }

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

        $perusahaan = jualBarangs::where('id_perusahaan', $this->id_perusahaan)->first();

        foreach ($id_barang as $key => $value)
        {
            $tgl_beli = date('Y-m-d', strtotime($req->tgl_jual));
            $no_urut = jualBarangs::where('id_perusahaan', $this->id_perusahaan)->count()+1;
            $model = new jualBarangs;
            $model->no_invoice = date('dmY', strtotime($req->tgl_jual)).'/'.$perusahaan.'/'.$no_urut;
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
            return redirect('Penjualan')->with('message_success', 'Data berhasil diubah...!')->with('tab2','tab2');
        }else{
            return redirect('Penjualan')->with('message_success', 'Terjadi Kesalahan, Silahkan coba lagi')->with('tab2','tab2');
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
