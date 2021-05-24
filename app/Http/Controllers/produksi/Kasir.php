<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Illuminate\Support\Str;
use App\Model\Kasir\Kasir as KasirModel;
use App\Model\Kasir\DetailKasir;
use Session;
class Kasir extends Controller
{
    //
    private $kode_nota = 'Trans';


    public function index()
    {
        $current_date = date('Y/m/d');
        $data = [
            'kode'=> $this->kodeKasir(),
            'nota'=> KasirModel::whereDate('created_at',$current_date)->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get(),
            'barang'=>Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('kasir.page.kasir.page', $data);
    }

    public function store(Request $req){
         $this->validate($req,[
            'kode'=>'required',
            'id_barang'=> 'required',
            'jumlah_jual'=> 'required',
            'harga_satuan' => 'required',
            'sub_total'=> 'required',
            'bayar'=> 'required'
        ]);
        $data = [
            'kode'=> $req->kode,
            'bayar'=> $req->bayar,
            'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
            'id_karyawan'=>Session::get('id_karyawan')
        ];
        if($kasir_model = $this->insert_kasir($data)){
            $this->insert_detail_kasir($kasir_model, $req);
        }
        return redirect()->back()->with('message_success', 'Nota penjualan telah dibuat');
    }

    private function insert_kasir($array){
        $model =KasirModel::updateOrCreate(
            [
                'kode'=>$array['kode'],
                'id_perusahaan'=> $array['id_perusahaan']
            ],
            [
                'bayar'=> $array['bayar'],
                'id_karyawan'=> $array['id_karyawan'],
            ]
        );
        return $model;
    }

    private function insert_detail_kasir($model,$req){
        $this->delete_before_updateOrCreate($model->id);
        foreach ($req->id_barang as $key=> $id_barang){
            $model_detail_nota = DetailKasir::create(
                [
                    'id_nota_kasir'=> $model->id,
                    'id_barang'=>$id_barang,
                    'jumlah_jual'=>$req->jumlah_jual[$key],
                    'harga_satuan'=> $req->harga_satuan[$key],
                    'sub_total'=> $req->sub_total[$key],
                    ]
            );
            $model_detail_nota->save();
        }
    }

    private function delete_before_updateOrCreate($id){
        $model = DetailKasir::where('id_nota_kasir',$id);
        if(!empty($model)){
            $model->delete();
        }
    }

    private function kodeKasir(){
        $year = date('Y');
        $mont = date('m');
        $date = date('d');
        $kode = $this->kode_nota;
        $count_kasir = KasirModel::whereYear('created_at', $year)->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->count('id')+1;
        $format = $kode.'/'.$count_kasir.'/'.$date.$mont.$year;
        return $format;
    }
}
