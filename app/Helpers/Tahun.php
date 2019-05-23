<?php

Function Tahun(){
	/* $tahun =array("2019","2020");
	return $tahun; */
	//tampilkan tahun mulai dari tahun sekarang - 2 sampai dengan tahun sekarang +15
	$thn_now = date('Y');	
	$back_thn = $thn_now - 2;
	$thn_maks = $back_thn + 15;
	$tahuns = array();
		for ($tahun = $back_thn; $tahun <= $thn_maks; $tahun++) {
		$tahuns[] = $tahun;
		}

	return $tahuns; 
	}

//echo Tahun();
?>






