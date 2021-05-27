<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Illuminate\Support\Str;
use App\Model\Kasir\Kasir as KasirModel;
use App\Model\Kasir\DetailKasir;
use Session;
use App\Model\Produksi\PSales;
use App\Model\Produksi\DetailSales;
class Kasir extends Controller
{
    //
    private $kode_nota = 'Trans';


    public function index()
    {
        $current_date = date('Y/m/d');
        $data = [
            'kode'=> $this->kodeKasir(),
            'nota'=> KasirModel::whereDate('created_at',$current_date)->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->orderBy('created_at','desc')->get(),
            'barang'=>Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('kasir.page.kasir.page', $data);
    }

    public function show($id){
        $model = KasirModel::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        return response()->json(array('detail_barang'=> $this->ListBarang($model),'nota'=> $model));
    }

    private function ListBarang($model){
        $array_container = [];
        $no = 1;
        foreach ($model->linkToMannyDetailNota as $data){
            $column = [];
            $column[]= $no++;
            $column[]= $data->linkToBarang->nm_barang;
            $column[]= $data->jumlah_jual;
            $column[]= $data->harga_satuan;
            $column[]= $data->sub_total;
            $array_container[] = $column;
        }
        return $array_container;
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
            'total_penjualan'=> $req->total_penjualan,
            'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
            'id_karyawan'=>Session::get('id_karyawan')
        ];
        // Tambah data kasir
        if($kasir_model = $this->insert_kasir($data)){
            // Tambah detail kasir
            $this->insert_detail_kasir($kasir_model, $req);

            // Tambah data p_sales
            $model_sales=$this->insert_P_sales($kasir_model);
            $this->insert_detail_p_sales($model_sales, $req);

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
                'total_penjualan'=> $array['total_penjualan'],
                'id_karyawan'=> $array['id_karyawan'],
            ]
        );
        return $model;
    }

    private function insert_P_sales($kasir_model){
        $data = PSales::updateOrCreate(
            [
                'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
                'no_sales'=> $kasir_model->kode
            ],
            [
                'id_so'=>0,
                'tgl_sales'=>$kasir_model->created_at,
                'bayar'=>$kasir_model->bayar,
                'total'=>$kasir_model->total_penjualan,
                'status_bayar'=>'0',
                'id_karyawan'=>$kasir_model->id_karyawan,
            ]
        );
        return $data;
    }

    private function insert_detail_kasir($model,$req){
        $this->delete_before_updateOrCreate($model->id);
        foreach ($req->id_barang as $key=> $id_barang){
            $model_detail_nota =new DetailKasir(
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

    private function insert_detail_p_sales($model_p_sales,$req){
        $this->delete_before_updateOrCreate_P_detail_sales($model_p_sales->id);
        foreach ($req->id_barang as $key=> $id_barang){
            $model_detail_p_sales=new DetailSales(
                [
                    'id_sales'=> $model_p_sales->id,
                    'id_barang'=>$id_barang,
                    'jumlah_jual'=>$req->jumlah_jual[$key],
                    'hpp'=> $req->harga_satuan[$key],
                    'jumlah_harga'=> $req->sub_total[$key],
                    'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                    'id_karyawan'=> Session::get('id_karyawan'),
                ]
            );
            $model_detail_p_sales->save();
         }
    }

    private function delete_before_updateOrCreate($id){
        $model = DetailKasir::where('id_nota_kasir',$id);
        if(!empty($model)){
            $model->delete();
        }
    }

    private function delete_before_updateOrCreate_P_detail_sales($id){
        $model = DetailSales::where('id_sales',$id);
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

    public function cetak($id_nota_kasir){
        $data =[
            'nota'=> KasirModel::where('id_perusahaan',Session::get('id_perusahaan_karyawan'))->find($id_nota_kasir)
        ];
        return view('kasir.page.kasir.cetak', $data);
    }
}
