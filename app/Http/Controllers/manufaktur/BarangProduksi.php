<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Hrd\H_Karyawan;
use App\Model\Manufaktur\P_tambah_produksi;
use App\Http\utils\Stok;

class BarangProduksi extends Controller
{
    //

    private function kode_produksi(){
        $current_date = date('Y-m-d');
        $exp_date = explode('-', $current_date);
        $kode_produksi = 'MFG'.$exp_date[2].''.$exp_date[1].''.$exp_date[1];
        return $kode_produksi;
    }

    public function create(){
        $data = [
            'barang_jadi'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang','0'),
            'barang_dalam_proses'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang','2'),
            'supervisor'=> H_Karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'current_date'=> date('Y-m-d'),
            'current_time'=> date('H:i:s'),
            'kode_produksi'=> $this->kode_produksi(),
        ];
        return view('user.manufaktur.pages.barang_produksi.page_create', $data);
    }

    public function store(Request $req){
         $this->validate($req,[
            'id_barang'=> 'required',
//            'brg_dalam_proses' =>'required',
            'id_supervisor_produksi' => 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $data['tgl_mulai'] = tanggalController($req->tgl_mulai);
        $model = new P_tambah_produksi($data);
        if($model->save()){
            return redirect('manufaktur')->with('message_success','Barang produksi telah disimpan')->with('tab2','tab2');
        }else{
            return redirect('manufaktur')->with('message_fail','Barang produksi gagal disimpan')->with('tab2','tab2');
        }
    }

    public function edit($id){
        $data = [
            'barang_jadi'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang','2'),
            'barang_dalam_proses'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang','1'),
            'supervisor'=> H_Karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'current_date'=> date('Y-m-d'),
            'current_time'=> date('H:i:s'),
            'kode_produksi'=> $this->kode_produksi(),
            'data_produksi'=>P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.manufaktur.pages.barang_produksi.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_barang'=> 'required',
//            'brg_dlm_proses' =>'required',
            'id_supervisor_produksi' => 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Barang produksi telah diubah');
        }else{
            return redirect('manufaktur')->with('message_fail','Barang produksi gagal diubah');
        }
    }


    public function destroy(Request $req, $id){
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('manufaktur')->with('message_success','Barang produksi telah dihapus');
        }else{
            return redirect('manufaktur')->with('message_fail','Barang produksi gagal dihapus');
        }
    }

    public function qualityControll(Request $req, $id)
    {
      //dd($req->all());
        $data = $req->except(['_token']);
        $data['tgl_mulai_qc'] = date('Y-m-d');
        $data['jam_mulai_qc'] = date('H:i:s');

        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');

        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Quality control telah disimpan')->with('tab3','tab3');
        }else{
            return redirect('manufaktur')->with('message_fail','Quality control gagal disimpan')->with('tab3','tab3');
        }
    }

    public function UpdateQualityControll(Request $req, $id)
    {
        $data = $req->except(['_token']);
        $data['tgl_mulai_qc'] = date('Y-m-d');
        $data['jumlah_bdp_bagus'] = $req->jumlah_bdp_bagus;
        $data['jumlah_bdp_rusak'] = $req->jumlah_bdp_rusak;
        $data['status_bdp'] = $req->status_bdp;
        $data['jumlah_brg_jadi_bagus'] = $req->jumlah_brg_jadi_bagus;
        $data['jumlah_brg_jadi_rusan'] = $req->jumlah_brg_jadi_rusan;
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            $this->setBarangDalamProses($model);
            $this->setBarangJadi($model);
            return redirect('manufaktur')->with('message_success','Quality control telah disimpan');
        }else{
            return redirect('manufaktur')->with('message_fail','Quality control gagal disimpan');
        }
    }

    public function EndqualityControll(Request $req)
    {
        $data = $req->except(['_token']);
        $data['tgl_selesai'] = date('Y-m-d');
        $data['jam_selesai'] = date('H:i:s');
        $data['status_produksi'] = '2';
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($req->id_quality_control);
        if($model->update($data)){
            $stok = Stok::updateStokAkhirManufaktur($model);
            return redirect('manufaktur')->with('message_success','Quality control telah disimpan');
        }else{
            return redirect('manufaktur')->with('message_fail','Quality control gagal disimpan');
        }
    }

    public function cek_stok( $id){
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $array = [
            'data'=> $model
        ];
        return response()->json($array);
    }

    private function setBarangDalamProses($model){
        if(!empty($model->brg_dalam_proses)){
            $model_barang = Barang::findOrFail($model->brg_dalam_proses);
            $tambah_brang = $model_barang->stok_akhir + $model->jumlah_bdp_bagus;
            if($model->status_bdp=='1'){
                $model_barang->stok_akhir =$tambah_brang;
                $model_barang->save();
            }
        }
    }

    private function setBarangJadi($model){
        $model_barang = Barang::findOrFail($model->id_barang);
        $tambah_brang = $model_barang->stok_akhir + $model->jumlah_brg_jadi_bagus;
        $model_barang->stok_akhir = $tambah_brang;
        $model_barang->save();
    }

    public function detail($id)
    {
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $array = [
            'data'=> $model,
            'hpp'=>$this->set_hpp($model),
            'id'=> $id
        ];
//        dd($this->set_hpp($model));
        return view('user.manufaktur.pages.detail.page_show', $array);
    }

    public function cetak($id)
    {
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $array = [
            'data'=> $model,
            'hpp'=>$this->set_hpp($model)
        ];
//        dd($this->set_hpp($model));
        return view('user.manufaktur.pages.detail.cetak', $array);
    }

    private function check_jumlah_bahan_baku($link_To_bahan_baku){
        $total = 0;
        if(!empty($link_To_bahan_baku)){
            foreach ($link_To_bahan_baku as $item_bahan_baku){
                $total+= $item_bahan_baku->jumlah_bahan * $item_bahan_baku->linkToBarang->hpp;
            }
        }
        return $total;
    }

    private function set_hpp($model_p_tambah_barang)
    {
        $container=[];
        //1. total biaya mentah

        $a = $this->check_jumlah_bahan_baku($model_p_tambah_barang->linkToBahanProduksi);

		//1. ambil biaya = p_bahan_produksi * p_barang.hpp
		
        $a = $model_p_tambah_barang->linkToBahanProduksi->sum('jumlah_bahan');
		

        //push total biaya bahan mentah ke container
        $container[]= [
            [
                'judul'=> 'Total Biaya Bahan Mentah',
                'total'=> $a,
                'data'=>null
            ]
        ];

        //2. Total biaya produksi
        $t = $model_p_tambah_barang->linkToMannyTenagaProduksi->sum('jumlah_upah');
        $o = $model_p_tambah_barang->linkToBiayaOverHead->sum('jumlah_biaya');
        $tb = $a+$t+$o;
        //push total produksi ke kontainer
        $container[] = [
            [
                'judul'=>'Total Biaya Produksi',
                'total'=> $tb,
                'data'=>
                    [
                        [
                            'judul'=>'Total Biaya Tenaga Kerja',
                            'total'=> $t,
                            'data'=>null
                        ],
                        [
                            'judul'=>'Total Biaya Overhead',
                            'total'=> $o,
                            'data'=>null
                        ],
                    ]
            ],
        ];

        //3. Harga Pokok Biaya Produksi (HPPProd)
        $SABSJ = !empty($barang=$model_p_tambah_barang->linkToBarang->where('jenis_barang','1')->first()) ? $barang->stok_akhir : 0;
        $SAKBSJ =$SABSJ+($model_p_tambah_barang->jumlah_brg_jadi_bagus -$model_p_tambah_barang->jumlah_brg_jadi_rusan);
        $HPProd = $tb+$SABSJ-$SAKBSJ;
        //push HPP ke kontainer
        $container[] = [
            [
                'judul'=>'Harga Pokok Produksi',
                'total'=>0,
                'data'=>[
                    [
                        'judul'=>'Saldo Awal Produksi',
                        'total'=> $SABSJ,
                        'data'=>null
                    ],
                    [
                        'judul'=>'Saldo Akhir Barang Dalam Proses',
                        'total'=> $SAKBSJ,
                        'data'=>null
                    ],
                    [
                        'judul'=>'Harga Pokok Penjualan (HPP)',
                        'total'=> $HPProd,
                        'data'=>null
                    ],
                ]
            ],

        ];

        //4. Hpp (Harga pokok Penjualan)
        $saj = !empty($barang=$model_p_tambah_barang->linkToBarang->where('jenis_barang','2')->first()) ? $barang->stok_akhir : 0;
        $sak = $saj + ($model_p_tambah_barang->jumlah_brg_jadi_bagus-$model_p_tambah_barang->jumlah_brg_jadi_rusan);
        $hpp = $HPProd+($saj-$sak);
//        $hpp_per_barang = $hpp/$model_p_tambah_barang->jumlah_brg_jadi_bagus;
        $hpp_per_barang = $hpp / ($model_p_tambah_barang->jumlah_brg_jadi_bagus);
        //push Hpp ke kontainer
        $container[] = [
            [
                'judul'=>'Saldo awal barang Jadi',
                'total'=> $saj,
                'data'=>[
                    [
                        'judul'=>'Saldo awal barang Jadi',
                        'total'=> $saj,
                        'data'=>null
                    ],
                    [
                        'judul'=>'Saldo Akhir barang Jadi',
                        'total'=> $sak,
                        'data'=>null
                    ],
                ],
            ],
            [
                'judul'=>'Harga Pokok Penjualan (HPP)',
                'total'=> $hpp,
                'data'=>null
            ],
            [
                'judul'=>'Harga Pokok Penjualan (HPP) Per barang',
                'total'=> $hpp_per_barang,
                'data'=>null
            ],
        ];
        return $container;
    }

}
