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
use Illuminate\Http\Request;
use Session;

trait Transaksi
{

    public function getData($array)
    {
        $model =KetTransaksi::all()->where('id_perusahaan', $array['id_perusahaan']);
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
        $model->jenis_transaksi = '0';
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

}