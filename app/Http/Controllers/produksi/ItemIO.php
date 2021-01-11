<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Produksi\ItemIO as IIO;
use App\Http\Controllers\produksi\utils\StokBarangOperation;
class ItemIO extends Controller
{
    //

    private $jenis_item = [
      'Item Masuk',
      'Item Keluar',
    ];

    public function index(){
        $data = [
            'menu'=>'itemIO',
            'data_item_masuk'=>IIO::all()->where('jenis_item','0')->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_item_keluar'=>IIO::all()->where('jenis_item','1')->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.inventory.page_default', $data);
    }

    public function create(){
        $data = [
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'jenis_item'=>$this->jenis_item
        ];
        return view('user.produksi.section.inventory.itemIO.page_create', $data);
    }

    public function store(Request $req){
       $this->validate($req,[
           'jenis_item'=> 'required',
           'tgl'=> 'required',
           'id_barang'=> 'required',
           'jumlah_brg'=> 'required',
           'ket'=> 'required',
        ]);

        $model = new IIO();
        $model->jenis_item = $req->jenis_item;
        $model->tgl = $req->tgl;
        $model->id_barang = $req->id_barang;
        $model->ket = $req->ket;
        $model->jumlah_brg = $req->jumlah_brg;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            StokBarangOperation::operation($model,'itemIO');
            return redirect('itemIO')->with('message_success','Data Item telah disimpan');
        }else{
            return redirect('itemIO')->with('message_fail','Data item gagal disimpan');
        }
    }

    public function edit($id){
        $data = [
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'itemIO'=> IIO::findOrFail($id),
            'jenis_item'=>$this->jenis_item
        ];
        return view('user.produksi.section.inventory.itemIO.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'jenis_item'=> 'required',
            'tgl'=> 'required',
            'id_barang'=> 'required',
            'jumlah_brg'=> 'required',
            'ket'=> 'required',
        ]);

        $model = IIO::find($id);
        $model->jenis_item = $req->jenis_item;
        $model->tgl = $req->tgl;
        $model->id_barang = $req->id_barang;
        $model->ket = $req->ket;
        $model->jumlah_brg = $req->jumlah_brg;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            StokBarangOperation::operation($model,'itemIO');
            return redirect('itemIO')->with('message_success','Data Item telah disimpan');
        }else{
            return redirect('itemIO')->with('message_fail','Data item gagal disimpan');
        }
    }
}
