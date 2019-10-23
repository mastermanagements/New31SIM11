<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 18/09/2019
 * Time: 13:27
 */

namespace App\Traits;
use App\Model\Keuangan\SubAkun as SA;
use App\Model\Keuangan\SubSubAkun as SSA;

trait AturanDK
{

    //Variable ini saya sengaja buat untuk mencari akun yang tidak dapat diubah supaya
    //tidak perlu menambahkan tabel baru lagi. data ini nanti akan berasal hanya untuk master akun tidak berlaku untuk master_ukm
    public $static_id_sub_akun = array(
        'Prive' => 8,
        'Cadangan_Kerugian_Piutang_Tak_Tertagih'=>13,
        'Akumulasi_penyusutan_gedung'=>14,
        'Akumulasi_penyusutan_peralatan'=>15,
        'Akumulasi_penyusutan_kendaraan'=>16,
        'Dividen'=>26,
        'Return_Penjualan'=>27,
        'Potongan_Penjualan'=>28,
        'Potongan_pembelian'=>31,
        'Biaya_angkut_penjualan'=>30,
        'Pengurangan_harga/diskon'=>32,
    );





    public function rules($id_akun=0, $id_sub_akun=0, $id_sub_sub_akun=0,$statusDK,$jDebit, $jKredit, $saldo){
        $model_sub_akun = SA::where('id_akun_ukm',$id_akun)->first();
        $model_sub_akun2 = SA::where('id_m_sub_akun',$id_sub_akun)->first();

        $model_sub_sub_akun2 = SSA::where('id_sub_sub_master_akun',$id_sub_sub_akun)->first();

        if($statusDK==0){ //Debit
            if($model_sub_akun->id_akun_ukm==1){ //Aset
                if(!empty($model_sub_sub_akun2)){
                    if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Cadangan_Kerugian_Piutang_Tak_Tertagih']){
                        $saldo -= $jDebit;
                    }else if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Akumulasi_penyusutan_gedung']){
                        $saldo -= $jDebit;
                    }else if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Akumulasi_penyusutan_peralatan']){
                        $saldo -= $jDebit;
                    }else{
                        $saldo += $jDebit;
                    }
                }else{
                    $saldo += $jDebit;
                }
            }elseif ($model_sub_akun->id_akun_ukm==2){ //Hutang
                $saldo -= $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==3){ //Modal
                if(!empty($model_sub_akun2)){
                    if($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Prive']){
                        $saldo += $jDebit;
                    }else if($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Dividen']){
                        $saldo += $jDebit;
                    }else{
                        $saldo -= $jDebit;
                    }
                }else{
                    $saldo -= $jDebit;
                }
            }elseif ($model_sub_akun->id_akun_ukm==4){ //Pendapatan
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Return_Penjualan']) {
                        $saldo += $jDebit;
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Potongan_Penjualan']) {
                        $saldo += $jDebit;
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Biaya_angkut_penjualan']) {
                        $saldo += $jDebit;
                    } else {
                        $saldo -= $jDebit;
                    }
                }
                else {
                    $saldo -= $jDebit;
                }
            }elseif ($model_sub_akun->id_akun_ukm==5){ //Hpp
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Potongan_pembelian']) {
                        $saldo -= $jDebit;
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Pengurangan_harga/diskon']) {
                        $saldo -= $jDebit;
                    } else {
                        $saldo += $jDebit;
                    }
                }else {
                    $saldo += $jDebit;
                }

            }elseif ($model_sub_akun->id_akun_ukm==6){ //Biaya
                $saldo += $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==7){ //Pendapatan Lain
                $saldo -= $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==8){ //Pendapatan Lain
                $saldo += $jDebit;
            }
        }
        else{ //Kredit
            if($model_sub_akun->id_akun_ukm==1){ //Aset
                if(!empty($model_sub_sub_akun2)){
                    if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Cadangan_Kerugian_Piutang_Tak_Tertagih']){
                        $saldo += $jDebit;
                    }else if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Akumulasi_penyusutan_gedung']){
                        $saldo += $jDebit;
                    }else if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Akumulasi_penyusutan_peralatan']){
                        $saldo += $jDebit;
                    }else{
                        $saldo -= $jKredit;
                    }
                }else{
                    $saldo -= $jKredit;
                }

            }elseif ($model_sub_akun->id_akun_ukm==2){ //Hutang
                $saldo += $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==3){ //Modal
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Prive']) {
                        $saldo -= $jKredit;
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Dividen']) {
                        $saldo -= $jKredit;
                    } else {
                        $saldo += $jKredit;
                    }
                }else {
                    $saldo += $jKredit;
                }
            }elseif ($model_sub_akun->id_akun_ukm==4){ //Pendapatan
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Return_Penjualan']) {
                        $saldo -= $jKredit;
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Potongan_Penjualan']) {
                        $saldo -= $jKredit;
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Biaya_angkut_penjualan']) {
                        $saldo -= $jKredit;
                    } else {
                        $saldo += $jKredit;
                    }
                }else {
                    $saldo += $jKredit;
                }

            }elseif ($model_sub_akun->id_akun_ukm==5){ //Hpp
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Potongan_pembelian']) {
                        $saldo += $jKredit;
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Pengurangan_harga/diskon']) {
                        $saldo += $jKredit;
                    } else {
                        $saldo -= $jKredit;
                    }
                } else {
                    $saldo -= $jKredit;
                }

            }elseif ($model_sub_akun->id_akun_ukm==6){ //Biaya
                $saldo -= $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==7){ //Pendapatan Lain
                $saldo += $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==8){ //Biaya lain
                $saldo -= $jKredit;
            }
        }
        return $saldo;
    }


    public function rules_saldo($id_akun=0, $id_sub_akun=0,$id_sub_sub_akun=0,$statusDK){
        $model_sub_akun = SA::where('id_akun_ukm',$id_akun)->first();
        $model_sub_akun2 = SA::where('id_m_sub_akun',$id_sub_akun)->first();
        $model_sub_sub_akun2 = SSA::where('id_sub_sub_master_akun',$id_sub_sub_akun)->first();
        if($statusDK==0){
            if($model_sub_akun->id_akun_ukm==1){ //Aset
                if(!empty($model_sub_sub_akun2)){
                    if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Cadangan_Kerugian_Piutang_Tak_Tertagih']){
                        $DK = 'kredit';
                    }else if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Akumulasi_penyusutan_gedung']){

                    }else if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Akumulasi_penyusutan_peralatan']){
                        $DK = 'kredit';
                    }else{
                        $DK = 'debet';
                    }
                }else{
                    $DK = 'debet';
                }

            }elseif ($model_sub_akun->id_akun_ukm==2){ //Hutang
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==3){ //Modal
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Prive']) {
                        $DK = 'debet';
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Dividen']) {
                        $DK = 'debet';
                    } else {
                        $DK = 'kredit';
                    }
                }else {
                    $DK = 'kredit';
                }
            }elseif ($model_sub_akun->id_akun_ukm==4){ //Pendapatan
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Return_Penjualan']) {
                        $DK = 'debet';
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Potongan_Penjualan']) {
                        $DK = 'debet';
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Biaya_angkut_penjualan']) {
                        $DK = 'debet';
                    } else {
                        $DK = 'kredit';
                    }
                }else {
                    $DK = 'kredit';
                }

            }elseif ($model_sub_akun->id_akun_ukm==5){ //HPP
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Potongan_pembelian']) {
                        $DK = 'kredit';
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Pengurangan_harga/diskon']) {
                        $DK = 'kredit';
                    } else {
                        $DK = 'debet';
                    }
                }else {
                    $DK = 'debet';
                }

            }elseif ($model_sub_akun->id_akun_ukm==6){ //Biaya
                $DK = 'debet';
            }elseif ($model_sub_akun->id_akun_ukm==7){ //Pendapatan lain
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==8){ //Biaya Lain
                $DK = 'debet';
            }
        }else{
            if($model_sub_akun->id_akun_ukm==1){ //Aset
                if(!empty($model_sub_sub_akun2)){
                    if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Cadangan_Kerugian_Piutang_Tak_Tertagih']){
                        $DK = 'kredit';
                    }else if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Akumulasi_penyusutan_gedung']){

                    }else if($model_sub_sub_akun2->id_sub_sub_master_akun == $this->static_id_sub_akun['Akumulasi_penyusutan_peralatan']){
                        $DK = 'kredit';
                    }else{
                        $DK = 'debet';
                    }
                }else{
                    $DK = 'debet';
                }

            }elseif ($model_sub_akun->id_akun_ukm==2){ //Hutang
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==3){ //Modal
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Prive']) {
                        $DK = 'debet';
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Dividen']) {
                        $DK = 'debet';
                    } else {
                        $DK = 'kredit';
                    }
                }else {
                    $DK = 'kredit';
                }
            }elseif ($model_sub_akun->id_akun_ukm==4){ //Pendapatan
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Return_Penjualan']) {
                        $DK = 'debet';
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Potongan_Penjualan']) {
                        $DK = 'debet';
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Biaya_angkut_penjualan']) {
                        $DK = 'debet';
                    } else {
                        $DK = 'kredit';
                    }
                }else {
                    $DK = 'kredit';
                }

            }elseif ($model_sub_akun->id_akun_ukm==5){ //HPP
                if(!empty($model_sub_akun2)) {
                    if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Potongan_pembelian']) {
                        $DK = 'kredit';
                    } else if ($model_sub_akun2->id_m_sub_akun == $this->static_id_sub_akun['Pengurangan_harga/diskon']) {
                        $DK = 'kredit';
                    } else {
                        $DK = 'debet';
                    }
                }else {
                    $DK = 'debet';
                }

            }elseif ($model_sub_akun->id_akun_ukm==6){ //Biaya
                $DK = 'debet';
            }elseif ($model_sub_akun->id_akun_ukm==7){ //Pendapatan lain
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==8){ //Biaya Lain
                $DK = 'debet';
            }
        }
        return $DK;
    }

    public $static_rule_arus_kas =
        array(
            'ARUS KAS DARI OPERASIONAL'=>array(
            'penerimaan_kas_dan_pelanggan' => array(
                'Pendapatan' => [15 => 'kredit',16=>'kredit',17=>'kredit', 18=>'kredit', 19=>'kredit'],//(pendapatan jasa, pendapatan dagang, pendapatan jual, return penjualan, potongan penjualan)
                'Aktiva_Lancar'=>[
                    'sub-sub'=>[ 21=>'kredit', 33=>'kredit'],//(Piutang dagang/ Usaha, Pajak dibayar dimuka )
                ],
                'Hutang_lancar'=>
                    [
                        'sub-sub'=>[71=>'kredit',70=>'kredit'], //(PPN Keluaran, pendapatan di terima dimuka )
                    ]
            ),
            'Kas_yang_dibayarkan_ke_supplier(vendor)_brg_dan_jasa'=>array(
                'Hutang_lancar'=>
                    [
                        'sub-sub'=>[57=>'kredit'], //(Hutang dagang/usaha )
                    ],
                'Aktiva_Lancar'=>[
                    'sub-sub'=>[35=>'kredit'], //(PPN Masukan )
                ],
                'Akun_HPP'=>[
                    [21=>'kredit', 22=>'kredit'] ,//(Harga Pokok Penjualan (HPP), Pembelian)
                ]
            ),
            'Kas_yang_dibayarkan_untuk_pajak'=>array(
                'pajak'=>[
                    'sub-sub' =>[ 71 => 'kredit',35=>'kredit'], //(PPN Keluaran, PPN Masukan )
                ]
            ),
            'Kas_yang_dibayarkan_untuk_Biaya_Angkut_Penjualan'=> array(
                'pendapatan'=>[20=>'kredit']//20
            ),
            'Kas_yang_dibayarkan_untuk_biaya_operasional_perusahaan'=>array(
                'akun_Biaya'=>[
                    'akun'=>[6=>'kredit'], //
                ],
                'akun_aktiva_lancar'=>[
                    'sub-sub'=> [ 42=>'kredit', 43=>'kredit',44=>'kredit', 45=>'kredit'],// (Akumulasi Penyusutan Gedung, Akumulasi Penyusutan kendaraan, Akumulasi Penyusutan peralatan, mesin )
                ]
            ),
            'Kas_yang_diterima_di_bayarkan_lainnya'=>array(
                'semua_akun_Pendapatan_lainnya'=>[
                    'akun'=>[7=>'kredit'], //(akun pendaptan lainnya)
                ],
                'semua_akun_Biaya_lainnya'=>[
                    'akun'=>[8=>'kredit'], //(akun biaya lainnya)
                ]
            )
        ),
            'ARUS KAS DARI INVESTASI'=>array(
                 'Kas_dari_investasi'=>array(
                     'investasi'=>[
                         'sub-sub'=>[ 37=>'debet', 38=>'debet', 39=>'debet', 40=>'debet', 41=>'debet' ],
                     ]
                 )
            ),
            'ARUS KAS DARI PENDANAAN'=>array(
                'Kas_dari_Pendanaan'=>array(
                    'penambahan'=>[
                        6=>'kredit',7=>'kredit',8=>'kredit' //(modal usaha, modal saham, disagio saham)
                    ],
                    'pengurang'=>[
                        9=>'debet', 10=>'debet', //(prive, dividen)
                    ],
                ),
                'Hutang_Jangka_Panjang'=>[
                    'penambah'=>[
                        'sub-sub'=>[75=>'kredit',81=>'kredit', 82=>'kredit']
                    ],
                    'pengurang'=>[
                        'sub-sub'=>[75=>'debet',81=>'debet', 82=>'debet']
                    ]
                ]
            ),
        );
}