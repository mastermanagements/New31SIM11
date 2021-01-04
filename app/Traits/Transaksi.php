<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 05/09/2019
 * Time: 10:06
 */

namespace App\Traits;
use App\Model\Keuangan\Transaksi as transaksis;
use App\Model\Keuangan\AkunAktifUkm as Akun_aktif;
use App\Model\Keuangan\KetTransaksi as KetTransaksi;
use App\Model\Keuangan\Jurnal as jurnal;
use App\Model\Keuangan\Akun as akn;
use App\Model\Keuangan\LabaRugiDitahan as LRD;
use Illuminate\Http\Request;
use App\Traits\DateYears;
use App\Traits\AturanDK;
use Illuminate\Support\Facades\DB;
use App\Model\Keuangan\SubAkun as SA;
use App\Model\Keuangan\SubSubAkun as SSa;
use Session;

trait Transaksi
{
    use DateYears;
    use AturanDK;
    private $id_sub_sub_akun=0;

    public $jenis_jurnal=array(
        '0'=>'Saldo Awal',
        '1'=>'Jurnal',
        '2'=>'Jurnal Penyesuaian');

    public $jenisjurnal=array(
        '0','1');

    public $posisi = array(
      '0'=> 'Debit',
      '1'=> 'Kredit'
    );

    public function getData($array)
    {
        $model =KetTransaksi::all()->where('id_perusahaan', $array['id_perusahaan'])->where('jenis_transaksi', $array['jenis_transaksi']);
        $row = array();
        foreach ($model as $value){
            $colum = array();
            $colum[]= "<a href='#' onclick='detail_keterangan(".$value->id.")'>".$value->nm_transaksi."</a>";
            $colum[]= "<a href='#' onclick='hapus(".$value->id.")'>Hapus</a>";
            $colum[]= $value->id;
            $row[] = $colum;
        }

        return $row;
    }

    public function get_akun_akfif($array){
        $data = Akun_aktif::all()->where('id_perusahaan', $array['id_perusahaan']);
        return $data;
    }

    public function getKeterangan($array){
        $data = KetTransaksi::all()->where('id_perusahaan', $array['id_perusahaan']);
        return $data;
    }

    public function posisi(){
        $array = array(
          '0'=>"Debit",
          '1'=>"Kredit",
        );
        return $array;
    }

    public function InsertData($req, $jenis_transaksi, $array){
        $this->validate($req,[
            'id_akun_aktif'=> 'required',
            'posisi'=> 'required',
            'nm_transaksi'=> 'required',
        ]);
        if(!empty($req->id_ket_transaksi)){
            $model_ket_transaksi = KetTransaksi::find($req->id_ket_transaksi);
        }else{
            $model_ket_transaksi = new KetTransaksi();
        }
        $model_ket_transaksi->nm_transaksi = $req->nm_transaksi;
        $model_ket_transaksi->jenis_transaksi = $jenis_transaksi;
        $model_ket_transaksi->id_perusahaan = $array['id_perusahaan'];
        $model_ket_transaksi->id_karyawan = $array['id_karyawan'];
        if($model_ket_transaksi->save())
        {
            foreach ($req->id_akun_aktif as $key=> $value){
                $model = transaksis::updateOrCreate(
                    ['id_ket_transaksi'=>$model_ket_transaksi->id,'id_akun_aktif'=>$value,'posisi_akun'=>''.$req->posisi[$key],'id_perusahaan'=> $array['id_perusahaan'] ],
                    ['jenis_transaksi'=>$jenis_transaksi,'id_karyawan'=>$array['id_karyawan']]
                );
                $model->save();
            }
        }

        $data = [
            'message'=> 'Permintaan telah diproses',
        ];
        return $data;
    }

    public function getDetailKeterangan($data)
    {
        if(empty($model = KetTransaksi::where('id', $data['id'])->where('id_perusahaan', $data['id_perusahaan'])->first())){
            return abort(404);
        }

        $row = array();

        foreach ($model->dataAkun->where('jenis_transaksi', $data['jenis_transaksi']) as $value){
            $column = array();
            $column[]="<select class='form-control select2' style='width:100%' name='id_akun_aktif[]' id='id_akun_aktif_".$value->id."'>".$this->daftarAkun($value->id_akun_aktif, $data['id_perusahaan'])."</select>";
            $column[]="<select class='form-control select2' style='width:100%' name='posisi[]' id='posisi_".$value->id."'>".$this->daftarPoisi($value->posisi_akun, $data['id_perusahaan'])."</select>";
            $column[]="<button type='button' id='edit' class='btn btn-warning' onclick='update_akun(".$value->id.")'>Ubah</button> <button type='button' onclick='hapus_akun(".$value->id.")' class='btn btn-danger'>Hapus</button>";
            $row[] = $column;
        }
        return array('data'=> $row,'keterangan'=> $model->nm_transaksi);
    }

    public function hapus_data_keterangan($array){
        $model = KetTransaksi::where('id', $array['id'])->where('id_perusahaan', $array['id_perusahaan'])->first();
       // dd($model->hasOneAkun->count('id'));
        if($model->hasOneAkun->count('id') > 0){
            return [
                'message'=>'Maaf, Data Keterangan ini tidak dapat dihapus. katerana data telah terpakai',
                'status'=> 'true'
            ];
        }else{
            return [
                'message'=>'Data Telah terhapus',
                'status'=> 'true'
            ];
//            if($model->delete()){
//                return [
//                    'message'=>'Data Telah terhapus',
//                    'status'=> 'true'
//                ];
//            }
        }
    }


    public function daftarAkun($id_selected, $id_perusahaan)
    {
        $model = Akun_aktif::all()->where('id_perusahaan', $id_perusahaan);
        $option="";

        foreach ($model as $value){
            $select = "";
            if ($value->id == $id_selected){
                $select= "selected";
            }
            $option.="<option value='".$value->id."' ".$select.">".$value->kode_akun_aktif.':'.$value->nm_akun_aktif."</option>";
        }

        return $option;
    }

    public function daftarPoisi($id_posisi)
    {
        $model = array('0'=>'Debit', '1'=>'Kredit');
        $option="";
        foreach ($model as $key=>$value){

            $select = "";

            if ($key == $id_posisi){
                $select= "selected";
            }

            $option.="<option value='".$key."' ".$select.">".$value."</option>";
        }

        return $option;
    }

    public function update_keterangans($req, $id, $id_perusahaan){
        $model = transaksis::where('id', $id)->where('id_perusahaan', $id_perusahaan)->first();
        //$model->jenis_transaksi = '0';
        $model->id_akun_aktif = $req['id_akun_aktif'];
        $model->posisi_akun = $req['posisi'];
        if($model->save()){
            $model_transaksi = KetTransaksi::find($model->id_ket_transaksi);
            $model_transaksi->nm_transaksi = $req['nm_transaksi'];
            $model_transaksi->save();
        }
        $data = [
            'message'=>'Anda telah mengubah keterangan'
        ];
        return $data;
    }

    public function delete_keterangan($id, $id_perusahaan){
        $model = transaksis::where('id', $id)->where('id_perusahaan', $id_perusahaan)->first();
        return $model;
    }

    public function detail_keterangan_aktif($array){

        $model = KetTransaksi::where('id', $array['id'])->where('id_perusahaan', $array['id_perusahaan'])->first();
        $row = array();
        foreach ($model->dataAkun->sortBy('posisi_akun') as $data){

            $posisi_kredit = "";
            $posisi_debit = "";

            if ($data->posisi_akun == 0){
                $posisi_debit ='';
                $posisi_kredit = 'disabled';
            }else{
                $posisi_debit = 'disabled';
                $posisi_kredit ='';
            }

            $column = array();
            $column[] = $data->transaksi->kode_akun_aktif;
            $column[] = $data->transaksi->nm_akun_aktif;
            $column[] = $this->posisi[$data->posisi_akun] ;
            $column[] = '<input type="hidden" name="id_akun_aktif[]" value="'.$data->transaksi->id.'"> <input type="hidden" name="debet_kredit[]" value="'.$data->posisi_akun.'"> <input  type="text" class="form-control class_debit" name="jumlah_transaksi[]" id="debit" style="width: 100%" '.$posisi_debit.'>';
            $column[] = '<input type="text" class="form-control class_kredit" name="jumlah_transaksi[]" id="kredit" style="width: 100%" '.$posisi_kredit.'>';
            $row[] = $column;
        }
        return $row;
    }

    public function store_jurnal($req, $id_perusahaan, $id_karyawan){
        $this->validate($req,[
            'id_ket_transaksi'=> 'required',
            'tgl_jurnal'=> 'required',
            'no_transaksi'=> 'required',
            'jenis_jurnal'=> 'required',
            'id_akun_aktif'=> 'required',
            'debet_kredit'=> 'required',
            'jumlah_transaksi'=> 'required',
        ]);

        $cek_jenis_jurnal = jurnal::whereYear('tgl_jurnal',$this->costumDate()->year)->where('jenis_jurnal','0')->where('id_perusahaan',$id_perusahaan)->first();
        $cek_no_transaksi = jurnal::whereYear('tgl_jurnal',$this->costumDate()->year)->where('no_transaksi',$req->no_transaksi)->where('id_perusahaan',$id_perusahaan)->first();

        if(!empty($cek_jenis_jurnal)){
            if($cek_jenis_jurnal->jenis_jurnal == $req->jenis_jurnal){
                return array('message'=>'Saldo awal cuma bisa dimasukan sekali', 'id_transaksi'=> $cek_jenis_jurnal->id_ket_transaksi);
            }
        }

        if(!empty($cek_no_transaksi)){
            return array('message'=>'Nomor Transaksi Telah digunakan', 'id_transaksi'=> $cek_jenis_jurnal->id_ket_transaksi);
        }

        $id_ket_transaksi = "";
        foreach ($req->id_akun_aktif as $key=>$value){
            $model = new jurnal();
            $model->jenis_jurnal = $req->jenis_jurnal;
            $model->tgl_jurnal = date('Y-m-d', strtotime($req->tgl_jurnal));
            $model->id_ket_transaksi = $req->id_ket_transaksi;
            $model->id_akun_aktif = $value;
            $model->no_transaksi = $req->no_transaksi;
            $model->ket ='';
            $model->debet_kredit =$req->debet_kredit[$key];
            $model->jumlah_transaksi =$req->jumlah_transaksi[$key];
            $model->id_perusahaan =$id_perusahaan;
            $model->id_karyawan =$id_karyawan;
            $model->save();
            $id_ket_transaksi = $model->id_ket_transaksi;
        }

        return array('message'=>'transaksi sudah diproses', 'id_transaksi'=> $id_ket_transaksi);
    }

    public function daftar_jurnal($array){
        if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
            $tanggal_awal = date('Y-m-d', strtotime($array['tanggal_awal']));
            $tanggal_akhir= date('Y-m-d', strtotime($array['tanggal_akhir']));
            $model = jurnal::whereIn('jenis_jurnal',$array['jenis_jurnal'])->whereBetween('tgl_jurnal',[$tanggal_awal,$tanggal_akhir ])->where('id_perusahaan', $array['id_perusahaan'])->get();
        }else{
            $model = jurnal::whereIn('jenis_jurnal',$array['jenis_jurnal'])->where('id_perusahaan', $array['id_perusahaan'])->whereyear('tgl_jurnal', $array['tahun_berjalan'])->orderBy('jenis_jurnal','asc')->get();
        }

        $row = array();
        foreach ($model as $value){
            $column = array();
            $column['tanggal'] = date('d-m-Y', strtotime($value->tgl_jurnal));
                        $column['tanggal'] = date('d-m-Y', strtotime($value->tgl_jurnal));
                        $column['no_transaksi'] = $value->no_transaksi;
                        $column['kode_akun'] = $value->akun->kode_akun_aktif;
                        $column['nm_akun'] = $value->akun->nm_akun_aktif;
                        $column['jenis_jurnal'] = $this->jenis_jurnal[$value->jenis_jurnal];

                        $debet = 0;
                        $kredit = 0;
                        if($value->debet_kredit =='0'){
                            $debet= $value->jumlah_transaksi;
                            $kredit= 0;
                        }else{
                            $kredit= $value->jumlah_transaksi;
                            $debet= 0;
                        }
                        $column['nama_keterangan'] = $value->keterangan->nm_transaksi;
                        $column['debet'] = $debet;
                        $column['kredit'] = $kredit;
                        $column['no_transaksi'] = $value->no_transaksi;
                        $column['cmb_kode_akun'] = $value->akun->kode_akun_aktif.'-'.$value->akun->nm_akun_aktif;
            $row[]=$column;
        }
        return $row;
    }

    public function getDataByNoTransaksiWithTahunBerjalan($no_transaksi, $id_perusahaan)
    {
        $tahun = $this->costumDate()->year;
        $model = jurnal::where('no_transaksi', $no_transaksi)->whereyear('tgl_jurnal', $tahun)->where('id_perusahaan', $id_perusahaan)->first();
        $model_data = jurnal::where('no_transaksi', $no_transaksi)->whereyear('tgl_jurnal', $tahun)->where('id_perusahaan', $id_perusahaan)->get();
        $row = array();
        $total_debet=0;
        $total_kredit=0;
        foreach ($model_data as $key=> $data){
            $column = array();
            $column[] = $data->akun->kode_akun_aktif;
            $column[] = $data->akun->nm_akun_aktif;
            $column[] = $this->posisi[$data->keterangan->dataAkun[$key]->posisi_akun];

            $posisi_kredit = "";
            $posisi_debit = "";
            $posisi_akun = $data->keterangan->dataAkun[$key]->posisi_akun;
            $debet = 0;
            $kredit = 0;
            if ($data->keterangan->dataAkun[$key]->posisi_akun == 0){
                $posisi_debit ='';
                $posisi_kredit = 'disabled';
                $debet= $data->jumlah_transaksi;
                $kredit= 0;
            }else{
                $posisi_debit = 'disabled';
                $posisi_kredit ='';
                $kredit= $data->jumlah_transaksi;
                $debet= 0;
            }
            $total_debet+=$debet;
            $total_kredit+=$kredit;
            $column[] = '<input type="hidden"  name="id_jurnal[]" value="'.$data->id.'"> <input type="hidden" name="debet_kredit[]" value="'.$posisi_akun.'"> <input  type="text" class="form-control class_debit" name="jumlah_transaksi[]" id="debit" value='.$debet.' style="width: 100%" '.$posisi_debit.'>';
            $column[] = '<input type="text" class="form-control class_kredit" name="jumlah_transaksi[]" id="kredit" style="width: 100%" value='.$kredit.' '.$posisi_kredit.'>';

            $row[] = $column;
        }
        $conainer = array(
            'tanggal'=> date('d-m-Y', strtotime($model->tgl_jurnal)),
            'nomor_transaksi'=>$model->no_transaksi,
            'jenis_jurnal'=>$model->jenis_jurnal,
            'total_debet'=>$total_debet,
            'total_kredit'=>$total_kredit,
            'data'=> $row);
        return $conainer;
    }


    public function update_keterangan($req, $jumlah_transaksi, $id_jurnal)
    {
        $model = jurnal::find($id_jurnal);
        $model-> jenis_jurnal= $req->jenis_jurnal;
        $model-> tgl_jurnal= date('Y-m-d', strtotime($req->tgl_jurnal));
        $model-> jumlah_transaksi= $jumlah_transaksi;
        return $model->save();
    }

    public function delete_jurnal($no_transaksi, $id_perusahaan){
        $model = jurnal::where('no_transaksi',$no_transaksi)->whereyear('tgl_jurnal', $this->costumDate()->year)->where('id_perusahaan', $id_perusahaan)->get();
        foreach ($model as $data){
            $model_delete = jurnal::find($data->id);
            $model_delete->delete();
        }
        $data = [
            'message'=> 'berhasil menghapus jurnal',
            'status'=> 'true'
        ];
        return $data;
    }

    public function data_buku_besar($array){
        if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
            $tanggal_awal = date('Y-m-d', strtotime($array['tanggal_awal']));
            $tanggal_akhir= date('Y-m-d', strtotime($array['tanggal_akhir']));
            $model = jurnal::whereIn('jenis_jurnal',$array['jenis_jurnal'])->whereBetween('tgl_jurnal',[$tanggal_awal,$tanggal_akhir ])->where('id_perusahaan', $array['id_perusahaan'])->orderBy('no_transaksi','asc');
        }else{
            $model = jurnal::whereIn('jenis_jurnal',$array['jenis_jurnal'])->where('id_perusahaan', $array['id_perusahaan'])->whereyear('tgl_jurnal', $array['tahun_berjalan'])->orderBy('id_akun_aktif','asc');
        }

        $row = array();

        foreach ($model->groupBy('id_akun_aktif')->get() as $key=> $value){
              $column = array();
              $column[] = $value->akun->nm_akun_aktif;
              $saldo=0;
              $newColumn= array();
              foreach ($value->akun->getMannyJurnal->sortBy('no_transaksi')->sortBy('jenis_jurnal') as $data_jurnals){
                  $data_jurnal = array();
                  $data_jurnal['tanggal'] = $data_jurnals->tgl_jurnal;
                  $data_jurnal['no_transaksi'] = $data_jurnals->no_transaksi;
                  $data_jurnal['nama_keterangan'] = $data_jurnals->keterangan->nm_transaksi;

                  $debet = 0;
                  $kredit = 0;
                  if($data_jurnals->debet_kredit == 0){
                      $kredit = 0;
                      $statusDK = 0;
                      $debet  = $data_jurnals->jumlah_transaksi;
                  }else{
                      $debet=0;
                      $statusDK=1;
                      $kredit = $data_jurnals->jumlah_transaksi;
                  }

                  $id_akun = $data_jurnals->akun->sub_akun->id_akun_ukm;
                  $id_sub_akun = $data_jurnals->akun->sub_akun->id_m_sub_akun;
                  //baru ditambahkan

                  if(!empty($data_sub_sub = $data_jurnals->akun->sub_sub_akun)){
                      $this->id_sub_sub_akun =  $data_jurnals->akun->sub_sub_akun->id;
                  }
                  $saldo = $this->rules($id_akun,$id_sub_akun, $this->id_sub_sub_akun, $statusDK,$debet,$kredit, $saldo);
                  $data_jurnal['debet'] =$debet;
                  $data_jurnal['kredit'] =$kredit;
                  $data_jurnal['saldo'] =$saldo;
                  $newColumn[] = $data_jurnal;
              }
            $column[] = $newColumn;
            $row[]=$column;
        }
        return $row;
    }

    public function data_neraca_saldo($array){
        if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
            $tanggal_awal = date('Y-m-d', strtotime($array['tanggal_awal']));
            $tanggal_akhir= date('Y-m-d', strtotime($array['tanggal_akhir']));
            $model = jurnal::whereIn('jenis_jurnal',$array['jenis_jurnal'])->whereBetween('tgl_jurnal',[$tanggal_awal,$tanggal_akhir ])->where('id_perusahaan', $array['id_perusahaan'])->orderBy('no_transaksi','asc');
        }else{
            $model = jurnal::whereIn('jenis_jurnal',$array['jenis_jurnal'])->where('id_perusahaan', $array['id_perusahaan'])->whereyear('tgl_jurnal', $array['tahun_berjalan'])->orderBy('id_akun_aktif','asc');
        }

        $row = array();

        foreach ($model->groupBy('id_akun_aktif')->get() as $key=> $value){
              $column = array();
              $column['kode_akun'] = $value->akun->kode_akun_aktif;
              $column['nm_akun'] = $value->akun->nm_akun_aktif;
              $saldo=0;
              $saldo_debits = 0;
              $saldo_kredits = 0;
              foreach ($value->akun->getMannyJurnal->sortBy('no_transaksi')->sortBy('jenis_jurnal') as $data_jurnals){
                      $debet = 0;
                      $kredit = 0;
                      $id_akun = $data_jurnals->akun->sub_akun->id_akun_ukm;
                      $id_sub_akun = $data_jurnals->akun->sub_akun->id_m_sub_akun;


                  $saldo_debit=0;
                      $saldo_kredit = 0;

                     if($data_jurnals->debet_kredit == 0){
                          $statusDK = 0;
                          $debet  = $data_jurnals->jumlah_transaksi;
                     }else{
                          $statusDK= 1;
                          $kredit = $data_jurnals->jumlah_transaksi;
                     }
                      if(!empty($data_sub_sub = $data_jurnals->akun->sub_sub_akun)){
                          $this->id_sub_sub_akun =  $data_jurnals->akun->sub_sub_akun->id;
                      }

                      $saldo = $this->rules($id_akun,$id_sub_akun,$this->id_sub_sub_akun, $statusDK,$debet,$kredit, $saldo);
                      $rules_saldo = $this->rules_saldo($id_akun,$id_sub_akun, $this->id_sub_sub_akun, $statusDK);
                      if($rules_saldo=='debet'){
                         $saldo_debit = $saldo;
                      }elseif($rules_saldo =='kredit'){
                         $saldo_kredit = $saldo;
                      }

                }
                if($saldo_debit <=0 ){
                    $saldo_debits = $saldo_debit*-1;
                }else{
                    $saldo_debits = $saldo_debit;
                }
                if($saldo_kredit <=0 ){
                    $saldo_kredits = $saldo_kredit*-1;
                }else{
                    $saldo_kredits = $saldo_kredit;
                }


                 $column['debet']=$saldo_debits;
                 $column['kredit']=$saldo_kredits;

            // $column[] = $newColumn;
            $row[]=$column;
        }
        return $row;
    }


    //laba rugi ditahun berjalan
    public function data_laba_rugi($array){
        $model = akn::all()->whereIn('id_m_akun',[4,5,6,7,8]);
        $row = array();
        $status_operasi = 0;
        $total_keseluruhan = 0;

        foreach ($model as $akun){
            $column = array();
            $row_sub =array();
            $column['akun']= $akun->nm_akun;

            if($akun->id ==4){
                $status_operasi = 1; //bertambah
            }
            else if($akun->id ==5){
                $status_operasi = 1; //Bertambah
            }
            else if($akun->id ==6){
                $status_operasi = 2; //Berkurang
            }
            else if($akun->id ==7){
                $status_operasi = 1; //Berkurang
            }
            else if($akun->id ==7){
                $status_operasi = 2; //Berkurang
            }

            $column['operasi']= $status_operasi;
            $sub_total = 0;
            foreach ($akun->sub_akun_ukm as $sub_akun){
                $sub_column = array();
                $sub_column['nm_sub_akun'] = $sub_akun->nm_sub_akun;
                $sub_sub_row = array();
                $saldo_subs=0;

                    foreach ($sub_akun->id_sub_akun_aktif as $akun_akf){
                        $status_sub = 0;
                        $sub_sub_column = array();
                        $saldo_sub=0;
                        if(empty($akun_akf->sub_sub_akun->nm_subsub_akun)){
                            $sub_sub_column['nm_sub_sub_akun'] = "";
                        }else{
                            $sub_sub_column['nm_sub_sub_akun'] = $akun_akf->sub_sub_akun->nm_subsub_akun;
                         }
                        if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
                            $tanggal_awal = date('Y-m-d', strtotime($array['tanggal_awal']));
                            $tanggal_akhir= date('Y-m-d', strtotime($array['tanggal_akhir']));
                            $model = $akun_akf->getMannyJurnal->whereIn('jenis_jurnal',$array['jenis_jurnal'])->whereBetween('tgl_jurnal',[$tanggal_awal,$tanggal_akhir ])->where('id_perusahaan', $array['id_perusahaan'])->sortBy('no_transaksi');
                        }else{
//                          $akun_akf->getMannyJurnal->sortBy('no_transaksi')->sortBy('jenis_jurnal');
                            $model =  $akun_akf->getMannyJurnal->whereIn('jenis_jurnal',$array['jenis_jurnal'])->where(DB::raw('tgl_jurnal','=',$array['tahun_berjalan']))->where('id_perusahaan', $array['id_perusahaan'])->sortBy('no_transaksi')->sortBy('jenis_jurnal');
                        }

                       //  dd($model );
                        foreach ($model as $data_jurnals){
                            $saldo=0;
                            $status_sub = 1;
                            $debet = 0;
                            $kredit = 0;
                            $id_akun = $data_jurnals->akun->sub_akun->id_akun_ukm;
                            $id_sub_akun = $data_jurnals->akun->sub_akun->id_m_sub_akun;




                            if($data_jurnals->debet_kredit == 0){
                                $statusDK = 0;
                                $debet  = $data_jurnals->jumlah_transaksi;
                            }else{
                                $statusDK= 1;
                                $kredit = $data_jurnals->jumlah_transaksi;
                            }
                            if(!empty($data_sub_sub = $data_jurnals->akun->sub_sub_akun)){
                                $this->id_sub_sub_akun =  $data_jurnals->akun->sub_sub_akun->id;
                            }
                            $saldo = $this->rules($id_akun,$id_sub_akun, $this->id_sub_sub_akun, $statusDK,$debet,$kredit, $saldo);
                            //$rules_saldo = $this->rules_saldo($id_akun,$id_sub_akun, $this->id_sub_sub_akun, $statusDK);
                            $saldo_sub =$saldo;
                        }

                        $sub_sub_column['total_sub_sub'] = $saldo_sub;
                        $sub_sub_column['status'] = $status_sub;
                        if(!empty($akun_akf->sub_sub_akun)) {
                            $sub_sub_row[]= $sub_sub_column;
                            $sub_column['data_sub_akun_aktif'] = $sub_sub_row;
                        }
                        $saldo_subs += $saldo_sub;
                    }

                   $sub_column['total'] = $saldo_subs;
                   $sub_column['sub_operasi'] = $status_operasi;
                   $row_sub[] = $sub_column;
                   $sub_total += $saldo_subs;

                   if($status_operasi==1){
                       $total_keseluruhan +=$saldo_subs;
                   }else{
                       $total_keseluruhan -=$saldo_subs;
                   }
            }
            $column['sub_akun'] = $row_sub;
            $column['sub_total'] = $sub_total;
            $row[] = $column;
        }

        return array('data'=>$row, 'total_laba_rugi'=>$total_keseluruhan );
    }

    public function data_neracas($array){
        $model = akn::all()->whereIn('id',[1,2,3]);
        $section = array();
        $status_operasi = 0;
        $row_aktiva = [];
        $row_pasiva = [];
        $laba_ditahan_ditahun_berjalan = $this->data_laba_rugi_lalu(25,$array['tahun_berjalan']-1,$array['id_perusahaan']);
        $row = array();
        foreach ($model as $akun){
            $column = array();
            $row_sub =array();
            $column['akun']= $akun->nm_akun;
            if($akun->id ==1){
                $status_operasi = 'aktiva'; //bertambah kalau aktiva
            }
            else {
                $status_operasi = 'pasiva'; //bertambah kalau pasiva
            }
            $column['operasi']= $status_operasi;
            $sub_total = 0;
            foreach ($akun->sub_akun_ukm as $sub_akun){
                $sub_column = array();
                $sub_column['nm_sub_akun'] = $sub_akun->nm_sub_akun;
                $sub_sub_row = array();
                $saldo_subs=0;
                    foreach ($sub_akun->id_sub_akun_aktif as $akun_akf){
                        $status_sub = 0;
                        $sub_sub_column = array();
                        $saldo_sub=0;
                        if(empty($akun_akf->sub_sub_akun->nm_subsub_akun)){
                            $sub_sub_column['nm_sub_sub_akun'] = "";
                        }else{
                            $sub_sub_column['nm_sub_sub_akun'] = $akun_akf->sub_sub_akun->nm_subsub_akun;
                        }

                        if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
                            $tanggal_awal = date('Y-m-d', strtotime($array['tanggal_awal']));
                            $tanggal_akhir= date('Y-m-d', strtotime($array['tanggal_akhir']));
                            $model = $akun_akf->getMannyJurnal->whereIn('jenis_jurnal',$array['jenis_jurnal'])->whereBetween('tgl_jurnal',[$tanggal_awal,$tanggal_akhir ])->where('id_perusahaan', $array['id_perusahaan'])->sortBy('no_transaksi');
                        }else{
    //                          $akun_akf->getMannyJurnal->sortBy('no_transaksi')->sortBy('jenis_jurnal');
                            $model =  $akun_akf->getMannyJurnal->whereIn('jenis_jurnal',$array['jenis_jurnal'])->where(DB::raw('tgl_jurnal','=',$array['tahun_berjalan']))->where('id_perusahaan', $array['id_perusahaan'])->sortBy('no_transaksi')->sortBy('jenis_jurnal');
                        }

                        //  dd($model );
                        foreach ($model as $data_jurnals){
                            $saldo=0;
                            $status_sub = 1;
                            $debet = 0;
                            $kredit = 0;
                            $id_akun = $data_jurnals->akun->sub_akun->id_akun_ukm;
                            $id_sub_akun = $data_jurnals->akun->sub_akun->id_m_sub_akun;

                            if($data_jurnals->debet_kredit == 0){
                                $statusDK = 0;
                                $debet  = $data_jurnals->jumlah_transaksi;
                            }else{
                                $statusDK= 1;
                                $kredit = $data_jurnals->jumlah_transaksi;
                            }

                            if(!empty($data_sub_sub = $data_jurnals->akun->sub_sub_akun)){
                                $this->id_sub_sub_akun =  $data_jurnals->akun->sub_sub_akun->id;
                            }
//                            if($id_sub_akun==3){
//                                dd($id_akun."  ===".$id_sub_akun."====".$statusDK);
//                            }
                            $saldo = $this->rules($id_akun,$id_sub_akun, $this->id_sub_sub_akun, $statusDK,$debet,$kredit, $saldo);

                            //$rules_saldo = $this->rules_saldo($id_akun,$id_sub_akun, $this->id_sub_sub_akun, $statusDK);
                            $saldo_sub = $saldo;
                        }

                        $sub_sub_column['total_sub_sub'] = $saldo_sub;
                        $sub_sub_column['status'] = $status_sub;
                        if(!empty($akun_akf->sub_sub_akun)) {
                            $sub_sub_row[]= $sub_sub_column;
                            $sub_column['data_sub_akun_aktif'] = $sub_sub_row;
                        }
                        $saldo_subs += $saldo_sub;
                    }

                    if($sub_akun->id_m_sub_akun==10){
                        $saldo_subs = $this->data_laba_rugi($array)['total_laba_rugi'];
                    }else if($sub_akun->id_m_sub_akun==25){
                        $saldo_subs = $laba_ditahan_ditahun_berjalan;
                    }


                $sub_column['sub_operasi'] = $status_operasi;
                $sub_column['total'] = $saldo_subs;
                $row_sub[] = $sub_column;
                $sub_total += $saldo_subs;
            }
            $column['sub_akun'] = $row_sub;
            $column['sub_total'] = $sub_total;
            $row[] = $column;
            if($akun->id ==1){
                $row_aktiva[] = $column; //bertambah kalau aktiva
            }
            else {
                $row_pasiva[] = $column; //bertambah kalau pasiva
            }
         }
        return array_merge(array('aktiva'=> $row_aktiva),array('pasiva'=> $row_pasiva));
    }

    //cek data laba rugi ditahun sebelumnya
    public function data_laba_rugi_lalu($id_sub_akun, $tahun, $id_perusahaan)
    {
        $model = LRD::whereYear('tahun', $tahun)->where('id_perusahaan', $id_perusahaan)->where('id_sub_akun',$id_sub_akun)->first();
        if(empty($model)){
            return 0;
        }else{
            return $model->jumlah_laba_tahun_berjalan;
        }
    }

    public function data_perubahan_modal($array){
        $model = akn::all()->whereIn('id',[3]);
        $section = array();
        $status_operasi = 0;
        $row_debit = [];
        $row_kredit = [];
        $row = array();

        foreach ($model as $akun){

            foreach ($array['debet_kredit'] as $debet_kredit){
                $column = array();
                $row_sub =array();
                $column['akun']= $akun->nm_akun;

                $sub_total = 0;
                foreach ($akun->sub_akun_ukm as $sub_akun){

                    $sub_column = array();
                    $sub_column['nm_sub_akun'] = $sub_akun->nm_sub_akun;
                    $sub_sub_row = array();
                    $saldo_subs=0;
                    foreach ($sub_akun->id_sub_akun_aktif as $akun_akf){
                        $status_sub = 0;
                        $sub_sub_column = array();
                        $saldo_sub=0;
                        if(empty($akun_akf->sub_sub_akun->nm_subsub_akun)){
                            $sub_sub_column['nm_sub_sub_akun'] = "";
                        }else{
                            $sub_sub_column['nm_sub_sub_akun'] = $akun_akf->sub_sub_akun->nm_subsub_akun;
                        }

                        if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
                            $tanggal_awal = date('Y-m-d', strtotime($array['tanggal_awal']));
                            $tanggal_akhir= date('Y-m-d', strtotime($array['tanggal_akhir']));
                            $model = $akun_akf->getMannyJurnal->whereIn('jenis_jurnal',$array['jenis_jurnal'])->where('debet_kredit',$debet_kredit)->whereBetween('tgl_jurnal',[$tanggal_awal,$tanggal_akhir ])->where('id_perusahaan', $array['id_perusahaan'])->sortBy('no_transaksi');
                        }else{
                            //                          $akun_akf->getMannyJurnal->sortBy('no_transaksi')->sortBy('jenis_jurnal');
                            $model =  $akun_akf->getMannyJurnal->whereIn('jenis_jurnal',$array['jenis_jurnal'])->where('debet_kredit',$debet_kredit)->where(DB::raw('tgl_jurnal','=',$array['tahun_berjalan']))->where('id_perusahaan', $array['id_perusahaan'])->sortBy('no_transaksi')->sortBy('jenis_jurnal');
                        }

                        //  dd($model );
                        foreach ($model as $data_jurnals){
                            $saldo=0;
                            $status_sub = 1;
                            $debet = 0;
                            $kredit = 0;
                            $id_akun = $data_jurnals->akun->sub_akun->id_akun_ukm;
                            $id_sub_akun = $data_jurnals->akun->sub_akun->id;



                            if($data_jurnals->debet_kredit == 0){
                                $statusDK = 0;
                                $debet  = $data_jurnals->jumlah_transaksi;
                            }else{
                                $statusDK= 1;
                                $kredit = $data_jurnals->jumlah_transaksi;
                            }

                            if(!empty($data_sub_sub = $data_jurnals->akun->sub_sub_akun)){
                                $this->id_sub_sub_akun =  $data_jurnals->akun->sub_sub_akun->id;
                            }
                            $saldo = $this->rules($id_akun,$id_sub_akun, $this->id_sub_sub_akun, $statusDK,$debet,$kredit, $saldo);
                            $rules_saldo = $this->rules_saldo($id_akun,$id_sub_akun, $this->id_sub_sub_akun, $statusDK);
                            if($rules_saldo == 'kredit'){
                                $saldo_sub = $saldo;
                            }else{
                                $saldo_sub = 0;
                            }
                        }

                        $sub_sub_column['total_sub_sub'] = $saldo_sub;
                        $sub_sub_column['status'] = $status_sub;
                        if(!empty($akun_akf->sub_sub_akun)) {
                            $sub_sub_row[]= $sub_sub_column;
                            $sub_column['data_sub_akun_aktif'] = $sub_sub_row;
                        }
                        $saldo_subs += $saldo_sub;
                    }

                    $sub_column['total'] = $saldo_subs;
                    if($model->count()>0){
                        $row_sub[] = $sub_column;
                    }
                    $sub_total += $saldo_subs;
                }
                $column['sub_akun'] = $row_sub;
                $column['sub_total'] = $sub_total;
                //$row[] = $column;
                if($debet_kredit ==0){
                    $row_debit[] = $column; //bertambah kalau aktiva
                }
                else if($debet_kredit ==1) {
                    $row_kredit[] = $column; //bertambah kalau pasiva
                }
            }
            $data_laba_bersih =array();
            $data_laba_bersih['nm_sub_akun']= "Laba Bersih";
            $data_laba_bersih['total'] = $this->data_laba_rugi($array)['total_laba_rugi'];

        }
        return array_merge(array('debit'=> $row_debit),array('kredit'=> $row_kredit),array('laba_tahun_berjalan'=>$data_laba_bersih));
    }

    public function aruskas($array){
        $rule_aruskas = $this->static_rule_arus_kas;
        $ouputs_array =array();
        $totalSemua = 0;
        foreach ($rule_aruskas as $keys=>$datas){
            $ouput_array =array();
            foreach ($datas as $second_floor => $data){
                $data_container = array();
                $sub_total = 0;
                foreach ($data as $list_id){
                    foreach ($list_id as $data_id=> $status) {
                        if ($data_id == 'sub-sub') {

                            foreach ($status as $key=> $data_sub_sub){ //sub-sub
                                if (!empty($this->formula_arus_kas_sub_sub($key, $data_sub_sub, $array)))
                                {
                                    $data_container[] =$this->formula_arus_kas_sub_sub($key, $data_sub_sub,$array) ;
                                    $sub_total +=$this->formula_arus_kas_sub_sub($key, $data_sub_sub,$array)[2];
                                }
                            }
                        }else if ($data_id == 'akun') { //akun
                            foreach ($status as $key=> $data_sub_sub){
                                if (!empty($this->formula_arus_akun_kas($key, $data_sub_sub,$array)))
                                {
                                    $data_container[] =$this->formula_arus_akun_kas($key, $data_sub_sub,$array) ;
                                    $sub_total +=$this->formula_arus_akun_kas($key, $data_sub_sub,$array)[2];
                                }
                            }
                        }else{ //sub akun
                            if (!empty($this->formula_arus_sub_akun_kas($data_id, $status,$array)))
                            {
                                $data_container[] =$this->formula_arus_sub_akun_kas($data_id, $status,$array);
                                $sub_total +=$this->formula_arus_sub_akun_kas($data_id, $status,$array)[2];
                            }
                        }
                    }
                }
                $ouput_array[$second_floor]=array('data'=>$data_container, 'total'=> $sub_total);
            }
            $ouputs_array[$keys]=$ouput_array;
        }
        $output =array($ouputs_array);
        return $output;
    }

    public function formula_arus_akun_kas($data_id, $status, $array){
        $data_akun_dari_sub = SA::all()->where('id_akun_ukm',$data_id)->where('id_perusahaan', $array['id_perusahaan']);
        $data_return = array();
        foreach ($data_akun_dari_sub as $data_akun)
        {
            $id_sub_akun = $data_akun->id_akun_ukm; //sub_akun
            $akses_akun_aktif = $data_akun->id_sub_akun_aktif;
            foreach($akses_akun_aktif as $data_akun_aktif){

                $id_sub_sub_akun = $data_akun_aktif->id_subsub_akun;//sub_sub_akun
                if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
                    $data_jurnal = $data_akun_aktif->getMannyJurnal->whereBetween('tgl_jurnal',[$array['tanggal_awal'],$array['tanggal_akhir'] ])->where('id_perusahaan', $array['id_perusahaan']);
                }else{
                    $data_jurnal = $data_akun_aktif->getMannyJurnal;
                }
                foreach ($data_jurnal as $data_jurnal){
                    $total=0;
                    if($data_jurnal->debet_kredit == 0){
                        $statusDK = 0;
                    }else{
                        $statusDK = 1;
                    }

                    $status_saldo = $this->rules_saldo($data_akun->id_akun_ukm,$id_sub_akun,$id_sub_sub_akun,$statusDK);

                    if($status_saldo==$status){
                        $total += $data_jurnal->jumlah_transaksi;
                    }else{
                        $total -= $data_jurnal->jumlah_transaksi;
                    }
                    $data_return[] = $data_jurnal->akun->nm_akun_aktif;
                    $data_return[] = $status_saldo;
                    $data_return[] = $total;
                }
            }
        }

       return $data_return;
    }

    public function formula_arus_sub_akun_kas($data_id, $status,$array){
        $data_sub = SA::where('id_m_sub_akun',$data_id)->where('id_perusahaan', $array['id_perusahaan'])->first();
        $id_sub_akun = $data_sub->id_akun_ukm; //sub_akun
        $akses_akun_aktif = $data_sub->id_sub_akun_aktif;

        $data_return = array();
        foreach($akses_akun_aktif as $data_akun_aktif){

            $id_sub_sub_akun = $data_akun_aktif->id_subsub_akun;//sub_sub_akun


            if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
                $data_jurnal = $data_akun_aktif->getMannyJurnal->whereBetween('tgl_jurnal',[$array['tanggal_awal'],$array['tanggal_akhir'] ])->where('id_perusahaan', $array['id_perusahaan']);
            }else{
                $data_jurnal = $data_akun_aktif->getMannyJurnal;
            }
            foreach ($data_jurnal as $data_jurnal){
                $total=0;
                if($data_jurnal->debet_kredit == 0){
                    $statusDK = 0;
                }else{
                    $statusDK = 1;
                }

                $status_saldo = $this->rules_saldo($data_sub->id_akun_ukm,$id_sub_akun,$id_sub_sub_akun,$statusDK);

                if($status_saldo==$status){
                    $total += $data_jurnal->jumlah_transaksi;
                }else{
                    $total -= $data_jurnal->jumlah_transaksi;
                }
                $data_return[] = $data_jurnal->akun->nm_akun_aktif;
                $data_return[] = $status_saldo;
                $data_return[] = $total;
            }
        }
        return $data_return;
    }

    public function formula_arus_kas_sub_sub($data_id, $status,$array){
        $sub_sub = SSa::where('id_sub_sub_master_akun', $data_id)->where('id_perusahaan', $array['id_perusahaan'])->first();
        $akun= $sub_sub->getSubAkun->id_akun_ukm;
        $sub_akun = $sub_sub->getSubAkun->id_m_sub_akun;
        $akses_akun_aktif = $sub_sub->getSubAkun->id_sub_akun_aktif->where('id_subsub_akun',$sub_sub->id);
        $data_return = array();
        foreach($akses_akun_aktif as $data_akun_aktif){

            $id_sub_sub_akun = $data_akun_aktif->id_subsub_akun;//sub_sub_akun

          ;
            if(!empty($array['tanggal_awal']) && !empty($array['tanggal_akhir'])){
                $data_jurnal = $data_akun_aktif->getMannyJurnal->whereBetween('tgl_jurnal',[$array['tanggal_awal'],$array['tanggal_akhir'] ])->where('id_perusahaan', $array['id_perusahaan']);
            }else{
                $data_jurnal = $data_akun_aktif->getMannyJurnal;
            }
            foreach ($data_jurnal as $data_jurnal){
                $total=0;
                if($data_jurnal->debet_kredit == 0){
                    $statusDK = 0;
                }else{
                    $statusDK = 1;
                }

                $status_saldo = $this->rules_saldo($sub_akun,$akun,$id_sub_sub_akun,$statusDK);

                if($status_saldo==$status){
                    $total += $data_jurnal->jumlah_transaksi;
                }else{
                    $total -= $data_jurnal->jumlah_transaksi;
                }
                $data_return[] = $sub_sub->nm_subsub_akun;
                $data_return[] = $status_saldo;
                $data_return[] = $total;
            }
        }
        return $data_return;
    }
}