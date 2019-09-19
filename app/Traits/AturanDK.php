<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 18/09/2019
 * Time: 13:27
 */

namespace App\Traits;
use App\Model\Keuangan\SubAkun as SA;

trait AturanDK
{
    public function rules($id_akun, $id_sub_akun,$statusDK,$jDebit, $jKredit, $saldo){
        $model_sub_akun = SA::where('id_akun_ukm',$id_akun)->first();
        $model_sub_akun2 = SA::where('id_m_sub_akun',$id_sub_akun)->first();
        if($statusDK==0){
            if($model_sub_akun->id_akun_ukm==1){
                $saldo += $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==2){
                $saldo -= $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==3){
                if($model_sub_akun2->id_m_sub_akun == 8){
                    $saldo += $jDebit;
                }else{
                    $saldo -= $jDebit;
                }
            }elseif ($model_sub_akun->id_akun_ukm==4){
                $saldo -= $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==5){
                $saldo += $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==6){
                $saldo += $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==7){
                $saldo -= $jDebit;
            }elseif ($model_sub_akun->id_akun_ukm==8){
                $saldo += $jDebit;
            }
        }else{
            if($model_sub_akun->id_akun_ukm==1){
                $saldo -= $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==2){
                $saldo += $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==3){
                if($model_sub_akun2->id_m_sub_akun == 8){
                    $saldo -= $jKredit;
                }else{
                    $saldo += $jKredit;
                }
            }elseif ($model_sub_akun->id_akun_ukm==4){
                $saldo += $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==5){
                $saldo -= $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==6){
                $saldo -= $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==7){
                $saldo += $jKredit;
            }elseif ($model_sub_akun->id_akun_ukm==8){
                $saldo -= $jKredit;
            }
        }
        return $saldo;
    }


    public function rules_saldo($id_akun, $id_sub_akun,$statusDK){
        $model_sub_akun = SA::where('id_akun_ukm',$id_akun)->first();
        $model_sub_akun2 = SA::where('id_m_sub_akun',$id_sub_akun)->first();
        if($statusDK==0){
            if($model_sub_akun->id_akun_ukm==1){
                $DK = 'debet';
            }elseif ($model_sub_akun->id_akun_ukm==2){
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==3){
                if($model_sub_akun2->id_m_sub_akun == 8){
                    $DK = 'debet';
                }else{
                    $DK = 'kredit';
                }
            }elseif ($model_sub_akun->id_akun_ukm==4){
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==5){
                $DK = 'debet';
            }elseif ($model_sub_akun->id_akun_ukm==6){
                $DK = 'debet';
            }elseif ($model_sub_akun->id_akun_ukm==7){
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==8){
                $DK = 'debet';
            }
        }else{
            if($model_sub_akun->id_akun_ukm==1){
                $DK = 'debet';
            }elseif ($model_sub_akun->id_akun_ukm==2){
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==3){
                if($model_sub_akun2->id_m_sub_akun == 8){
                    $DK = 'debet';
                }else{
                    $DK = 'kredit';
                }
            }elseif ($model_sub_akun->id_akun_ukm==4){
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==5){
                $DK = 'debet';
            }elseif ($model_sub_akun->id_akun_ukm==6){
                $DK = 'debet';
            }elseif ($model_sub_akun->id_akun_ukm==7){
                $DK = 'kredit';
            }elseif ($model_sub_akun->id_akun_ukm==8){
                $DK = 'debet';
            }
        }
        return $DK;
    }
}