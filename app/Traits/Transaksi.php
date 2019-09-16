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
use Illuminate\Http\Request;
use App\Traits\DateYears;
use Session;

trait Transaksi
{
    use DateYears;

    public $jenis_jurnal=array(
        '0'=>'Saldo Awal',
        '1'=>'Jurnal',
        '2'=>'Jurnal Penyesuaian');

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
            $model = jurnal::all()->where('id_perusahaan', $array['id_perusahaan']);
        }else{
            $model = jurnal::where('id_perusahaan', $array['id_perusahaan'])->whereyear('tgl_jurnal', $array['tahun_berjalan'])->orderBy('jenis_jurnal','asc')->get();
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
            $column[] = '<input type="hidden" name="id_jurnal[]" value="'.$data->id.'"> <input type="hidden" name="debet_kredit[]" value="'.$posisi_akun.'"> <input  type="text" class="form-control class_debit" name="jumlah_transaksi[]" id="debit" value='.$debet.' style="width: 100%" '.$posisi_debit.'>';
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

}