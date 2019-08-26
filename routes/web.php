<?php

use App\Model\Superadmin_ukm\U_menu_ukm as menu_ukm;
use Illuminate\Routing\Router;

Route::get('registerApp', function () {
    return view('user.superadmin_ukm.master.section.registered.registered');
});

Route::get('login-page', function () {
    return view('user.superadmin_ukm.master.section.registered.login');
});

Route::get('sign-out', 'Superadmin_ukm\LoginAndRegisterController@signOut');


Route::get('dashboard', function (){
/*     dd(Session::get('id_superadmin_ukm'));
    if(empty($model_superadmin = App\Model\Superadmin_ukm\U_usaha::where("id_user_ukm",Session::get('id_superadmin_ukm'))->first()))
    {
        return abort(404);
    } */
    $data_perusahaan = App\Model\superadmin_ukm\U_usaha::all()->where('id_user_ukm',Session::get('id_superadmin_ukm'));
    $data=[
        'data_perusahaan'=>$data_perusahaan
    ];
    return view('user.superadmin_ukm.master.section.default.page_default', $data);
});
//=========================== Registrasi & Login ========================================================================
Route::post('registered','Superadmin_ukm\LoginAndRegisterController@registered');

Route::post('login-page','Superadmin_ukm\LoginAndRegisterController@login');

//=========================== Superadmin UKM ========================================================================
Route::get('pengaturan-perusahaan','Superadmin_ukm\Superadmin_UKM@index');

Route::get('verification/{id}','Superadmin_ukm\LoginAndRegisterController@verification_');

Route::get('editprofile','Superadmin_ukm\Superadmin_UKM@editProfileSuperadminUkm');

Route::get('getKabupaten/{id_provinsi}','Superadmin_ukm\Superadmin_UKM@ResponseKabupaten');

Route::put('updateProfile/{id_superadmin_ukm}','Superadmin_ukm\Superadmin_UKM@updateProfile');

Route::get('profil-perusahaan','Superadmin_ukm\Superadmin_UKM@profil_perusahaan');

Route::get('tambah-usaha','Superadmin_ukm\UsahaController@create');

Route::post('store-usaha','Superadmin_ukm\UsahaController@store');

Route::get('ubah-usaha/{id}','Superadmin_ukm\UsahaController@edit');

Route::put('update-usaha/{id}','Superadmin_ukm\UsahaController@update');

Route::put('delete-usaha/{id}','Superadmin_ukm\UsahaController@delete');

Route::get('visi','Superadmin_ukm\Superadmin_UKM@visi');

Route::get('membuat-visi','Superadmin_ukm\Visi@create');

Route::post('store-visi','Superadmin_ukm\Visi@store');

Route::get('misi','Superadmin_ukm\Superadmin_UKM@misi');

Route::get('membuat-misi','Superadmin_ukm\Misi@create');

Route::post('store-misi','Superadmin_ukm\Misi@store');

Route::get('akta','Superadmin_ukm\Superadmin_UKM@akta');

Route::get('unggah-akta','Superadmin_ukm\Akta@create');

Route::post('akta-visi','Superadmin_ukm\Akta@store');

Route::get('izin-usaha','Superadmin_ukm\Superadmin_UKM@izin_usaha');

Route::get('unggah-ijin','Superadmin_ukm\Ijin_usaha@create');

Route::post('ijin-usaha','Superadmin_ukm\Ijin_usaha@store');

Route::get('unggah-ijin/{id}','Superadmin_ukm\Ijin_usaha@edit');

Route::put('ijin-usaha-update/{id}','Superadmin_ukm\Ijin_usaha@update');

Route::put('unggah-ijin-delete/{id}','Superadmin_ukm\Ijin_usaha@delete');

Route::get('jabatan','Superadmin_ukm\Superadmin_UKM@jabatan_perusahaan');

Route::get('pilih-usaha/{id}','Superadmin_ukm\Superadmin_UKM@jabatan_di_perusahaan');

Route::get('pilih-usaha/{id}/daftar-jabatan','Superadmin_ukm\Superadmin_UKM@jabatan_di_perusahaan');

Route::get('tambah-jabatan/{id_perusahaan}','Superadmin_ukm\Jabatan@create');

Route::post('store-jabatan','Superadmin_ukm\Jabatan@store');

Route::get('ubah-jabatan/{id_perusahaan}/{id_jabatan}','Superadmin_ukm\Jabatan@edit');

Route::put('update-jabatan/{id_jabatan}','Superadmin_ukm\Jabatan@update');

Route::put('jabatan-delete/{id_jabatan}','Superadmin_ukm\Jabatan@delete');

Route::get('menu-perusahaan','Superadmin_ukm\Menu_perusahaan@daftar_perusahaan');

Route::get('pengaturan-menu/{id}','Superadmin_ukm\Menu_perusahaan@daftar_menu');

Route::post('store_request_menu','Superadmin_ukm\Menu_perusahaan@store_menu');

Route::post('delete_request_menu','Superadmin_ukm\Menu_perusahaan@delete_menu');

//=========================== Pengguna Karyawan ========================================================================

Route::get('pengguna-karyawan','Superadmin_ukm\PenggunaKaryawan@karyawan');

Route::get('daftar-karyawan/{id_usaha}','Superadmin_ukm\Karyawan@data_karyawan');

Route::get('daftarkan-karyawan/{id_usaha}','Superadmin_ukm\Karyawan@create');

Route::post('store-karyawan','Superadmin_ukm\Karyawan@store');

Route::get('ubah-karyawan/{id_usaha}/{id_karyawan}','Superadmin_ukm\Karyawan@edit');

Route::put('update-karyawan/{id_karyawan}','Superadmin_ukm\Karyawan@update');

Route::get('detail-karyawan/{id_karyawan}','Superadmin_ukm\Karyawan@detail');

Route::put('karyawan-delete/{id_karyawan}','Superadmin_ukm\Karyawan@delete');

//=============================== Investor =============================================================================

Route::get('daftar-investor/{id_perusahaa}','Superadmin_ukm\Investor@daftar_inverstor');

Route::get('daftarkan-investor/{id_perusahaan}','Superadmin_ukm\Investor@tambah_investor');

Route::post('store-investor', 'Superadmin_ukm\Investor@store');

Route::get('ubah-investor/{id_perusahaan}/{id_investor}','Superadmin_ukm\Investor@edit_investor');

Route::put('update-investor/{id_investor}','Superadmin_ukm\Investor@update');

Route::put('delete-investor/{id_investor}','Superadmin_ukm\Investor@delete');

Route::get('detail-investor/{id_perusahaan}/{id_investor}','Superadmin_ukm\Investor@detail_investor');

//============================= Menu Karyawan  ========================================================================

Route::get('hak-akses-karyawan/{id_karyawan}','Superadmin_ukm\Hak_akses@daftar_hak_akses');

Route::put('store_request_menu_karyawan/{id}','Superadmin_ukm\Hak_akses@store_menu');

Route::put('delete_request_menu_karyawan/{id}','Superadmin_ukm\Hak_akses@delete_menu');

//============================ Menu Investor ===========================================================================

Route::get('hak-akses-investor/{id_investor}','Superadmin_ukm\Hak_akses_investor@daftar_hak_akses');

Route::put('store_request_menu_investor/{id}','Superadmin_ukm\Hak_akses_investor@store_menu');

Route::put('delete_request_menu_investor/{id}','Superadmin_ukm\Hak_akses_investor@delete_menu');



//=========================== Login Karyawan ========================================================================

Route::get('login-karyawan','karyawan\LoginController@Login');

Route::post('cek-karyawan','karyawan\LoginController@cek_login');

Route::get('logout-karyawan','karyawan\LoginController@logOut');


//=========================== Menu Perusahaan ========================================================================
Route::get('welcome-page','karyawan\Dashboard@index');

	//--- struktur perusahaan ---
	
Route::get('Struktur-Perusahaan','karyawan\StruturPerusahaan@index');

Route::post('store-bagan','karyawan\StruturPerusahaan@store');

Route::get('getRequestStrukturPerusahaan','karyawan\StruturPerusahaan@getRequestStrukturPerusahaan');

Route::get('ubah-struktur/{id}','karyawan\StruturPerusahaan@getRequest');

Route::put('update-struktur/{id}','karyawan\StruturPerusahaan@update');

Route::put('delete-struktur/{id}','karyawan\StruturPerusahaan@delete');

	//--- Departemen/Bagian ---
	
Route::get('Bagian', 'karyawan\Bagian@index');

Route::get('dataBagian','karyawan\Bagian@DataBagian');

Route::post('store-bagian','karyawan\Bagian@store');

Route::get('dataBagian/{id}','karyawan\Bagian@RequestDataBagian');

Route::post('update-bagian','karyawan\Bagian@update');

Route::post('hapus-bagian/{id}','karyawan\Bagian@delete');

	//--- Divisi ---

Route::get('Divisi','karyawan\Devisi@index');

Route::post('store-divisi','karyawan\Devisi@store');

Route::get('Divisi/{id_divisi}','karyawan\Devisi@edit');

Route::post('update-divisi','karyawan\Devisi@update');

Route::put('hapusDivisi/{id_divisi}','karyawan\Devisi@delete');

Route::get('getDivisi/{id_bagian_p}','karyawan\Devisi@ResponseDivisi');

	//--- JobDesc ---
	
Route::get('Job-Desc','karyawan\JobDecs@index');

Route::post('store-jobdesc','karyawan\JobDecs@store');

Route::get('ubah-jobdesc/{id_jobdesc}','karyawan\JobDecs@edit');

Route::post('update-jobdesc','karyawan\JobDecs@update');

Route::put('hapusJobdesc/{id_jobdesc}','karyawan\JobDecs@delete');

Route::get('getJobdesc/{id_jabatan_p}','karyawan\JobDecs@ResponseJobdesc');

	//--- SWOT ---

Route::get('Swot','karyawan\SWOT@index');

Route::get('buat-swot','karyawan\SWOT@create');

Route::post('store-swot','karyawan\SWOT@store');

Route::get('ubah-swot/{id}','karyawan\SWOT@edit');

Route::put('update-swot/{id}','karyawan\SWOT@update');

Route::put('delete-swot/{id}','karyawan\SWOT@delete');

	//--- Kompetitor ---

Route::get('Kompetitor','superadmin_ukm\Kompetitor@index');

Route::get('tambah-kompetitor','superadmin_ukm\Kompetitor@create');

Route::post('store-kompetitor','superadmin_ukm\Kompetitor@store');

Route::get('ubah-kompetitor/{id}','superadmin_ukm\Kompetitor@edit');

Route::put('update-kompetitor/{id}','superadmin_ukm\Kompetitor@update');

Route::put('hapus-kompetitor/{id}','superadmin_ukm\Kompetitor@delete');

Route::get('detail-kompetitor/{id}','Superadmin_ukm\Kompetitor@detail');

Route::get('getKabupatenK/{id_provinsi}','Superadmin_ukm\Kompetitor@ResponseKabupaten');


	//--- Target Perusahaan ---
	
Route::get('Target-Perusahaan','karyawan\TargetPerusahaan@index');

		//TJP
Route::get('buat-tjp','karyawan\TargetPerusahaan@create');

Route::post('store-tjp','karyawan\TargetPerusahaan@store');

Route::get('ubah-tjp/{id_tjp}','karyawan\TargetPerusahaan@edit');

Route::post('update-tjp','karyawan\TargetPerusahaan@update');

Route::put('hapusTJP/{id_tjp}','karyawan\TargetPerusahaan@delete');

Route::get('getTJP/{id_tjps}','karyawan\TargetPerusahaan@ResponseTJP');

		//Target Tahunan
Route::post('store-target-tahunan','karyawan\TargetPerusahaan@storeTtahunan');

Route::get('ubah-Ttahunan/{id_tt}','karyawan\TargetPerusahaan@editTtahunan');

Route::post('update-Ttahunan','karyawan\TargetPerusahaan@updateTtahunan');

Route::put('hapusTtahunan/{id_tt}','karyawan\TargetPerusahaan@deleteTtahunan');

Route::get('getTtahunan/{id_tt}','karyawan\TargetPerusahaan@ResponseTtahunan');

		//Target Bulanan
Route::post('store-target-bulanan','karyawan\TargetPerusahaan@storeTbulanan');

Route::get('ubah-Tbulanan/{id_tb}','karyawan\TargetPerusahaan@editTbulanan');

Route::post('update-Tbulanan','karyawan\TargetPerusahaan@updateTbulanan');

Route::put('hapusTbulanan/{id_tb}','karyawan\TargetPerusahaan@deleteTbulanan');

Route::get('getTbulanan/{id_tb}','karyawan\TargetPerusahaan@ResponseTbulanan');

	//--- Strategi Perusahaan ---
Route::get('Strategi-Perusahaan','karyawan\StrategiPerusahaan@index');

		//SJP
Route::post('store-sjp','karyawan\StrategiPerusahaan@storeSJP');

Route::get('ubah-sjp/{id_sjp}','karyawan\StrategiPerusahaan@editSJP');

Route::post('update-sjp','karyawan\StrategiPerusahaan@updateSJP');

Route::put('hapusSJP/{id_sjp}','karyawan\StrategiPerusahaan@deleteSJP');

Route::get('getSJP/{id_sjp}','karyawan\StrategiPerusahaan@ResponseSJP');

		//Stahunan
Route::post('store-stahunan','karyawan\StrategiPerusahaan@storeStahunan');

Route::get('ubah-stahunan/{id_stahunan}','karyawan\StrategiPerusahaan@editStahunan');

Route::post('update-stahunan','karyawan\StrategiPerusahaan@updateStahunan');

Route::put('hapusStahunan/{id_stahunan}','karyawan\StrategiPerusahaan@deleteStahunan');

Route::get('getStahunan/{id_st}','karyawan\StrategiPerusahaan@ResponseStahunan');

		//Sbulanan
Route::post('store-sbulanan','karyawan\StrategiPerusahaan@storeSbulanan');

Route::get('ubah-sbulanan/{id_sbulanan}','karyawan\StrategiPerusahaan@editSbulanan');

Route::post('update-sbulanan','karyawan\StrategiPerusahaan@updateSbulanan');

Route::put('hapusSbulanan/{id_sbulanan}','karyawan\StrategiPerusahaan@deleteSbulanan');

Route::get('getSbulanan/{id_sb}','karyawan\StrategiPerusahaan@ResponseSbulanan');

	//--- Model Bisnis ---
Route::get('Model-Bisnis','karyawan\ModelBisnis@index');

Route::get('buat-model-bisnis','karyawan\ModelBisnis@create');

Route::post('store-mb','karyawan\ModelBisnis@store');

Route::get('ubah-model-bisnis/{id}','karyawan\ModelBisnis@edit');

Route::put('ubah-mb/{id}','karyawan\ModelBisnis@update');

Route::put('hapus-model-bisnis/{id}','karyawan\ModelBisnis@delete');

//======================================== Administrasi ================================================================
	//--- Klien ---
Route::get('Klien', 'administrasi\Klien@index');

Route::get('tambah-leads','administrasi\Klien@create_leads');

Route::post('store-leads','administrasi\Klien@store_leads');

Route::get('ubah-klien/{id}','administrasi\Klien@edit');

Route::put('update-klien/{id}','administrasi\Klien@update');

Route::put('hapus-klien/{id}','administrasi\Klien@delete');

Route::get('ambilDataKlien/{id}','administrasi\Klien@ambil_data_klien');

Route::get('getPenanda/{id_sdk}','administrasi\Klien@ResponsePenanda');

Route::post('ganti-jenis-klien-leads','administrasi\Klien@ganti_jenis_klien_leads');


	//--- Surat ---
Route::get('Surat','administrasi\Surat@index');

Route::post('store-jenis-barang','administrasi\JenisSurat@store');

Route::get('tampilkan-jenis-barang','administrasi\JenisSurat@index');

Route::get('tampilkan-jenis-barang/{id}','administrasi\JenisSurat@edit');

Route::post('ubah-jenis-surat','administrasi\JenisSurat@update');

Route::post('hapus-jenis-barang/{id}','administrasi\JenisSurat@delete');

Route::get('tambah-surat-masuk','administrasi\Surat@create_surat_masuk');

Route::post('store-surat-masuk','administrasi\Surat@store_surat_masuk');

Route::get('ubah-surat-masuk/{id}','administrasi\Surat@ubah_surat_masuk');

Route::put('update-surat-masuk/{id}','administrasi\Surat@update_surat_masuk');

Route::put('hapus-surat-masuk/{id}','administrasi\Surat@delete_surat_masuk');

Route::get('tambah-surat-keluar','administrasi\Surat@create_surat_keluar');

Route::post('store-surat-keluar','administrasi\Surat@store_surat_keluar');

Route::get('ubah-surat-keluar/{id}','administrasi\Surat@edit_surat_keluar');

Route::put('update-surat-keluar/{id}','administrasi\Surat@update_surat_keluar');

Route::put('hapus-surat-keluar/{id}','administrasi\Surat@delete_surat_keluar');

Route::get('ambilDataSuratKeluar/{id}','administrasi\Surat@ambil_surat_keluar');

Route::post('upload-surat-keluar','administrasi\Surat@upload_surat_keluar');

Route::post('upload-status-surat-keluar','administrasi\Surat@upload_status_surat_keluar');

	//--- Proposal ---

Route::get('Proposal','administrasi\Proposal@index');

Route::get('tambah-proposal','administrasi\Proposal@create');

Route::post('store-proposal','administrasi\Proposal@store');

Route::get('ubah-proposal/{id}','administrasi\Proposal@edit');

Route::put('update-proposal/{id}','administrasi\Proposal@update');

Route::put('delete-proposal/{id}','administrasi\Proposal@delete');

Route::post('upload-cover-proposal','administrasi\Proposal@uploadCoverProposal');

Route::post('upload-doc-proposal','administrasi\Proposal@uploadDocProposal');

Route::post('cari-proposal','administrasi\Proposal@cari');

Route::put('ubah-status-proposal/{id}','administrasi\Proposal@ubah_status_proposal');

Route::post('store-jenis-proposal','administrasi\JenisProposal@store');

Route::get('jenis-proposal','administrasi\JenisProposal@index');

Route::get('jenis-proposal/{id}','administrasi\JenisProposal@edit');

Route::post('ubah-jenis-proposal','administrasi\JenisProposal@update');

Route::post('delete-jenis-proposal','administrasi\JenisProposal@delete');

	//--- Arsip ---

Route::get('Arsip','administrasi\Arsip@index');

Route::get('ambil-jenis-arsip', 'administrasi\JenisArsip@index');

Route::post('store-jenis-arsip','administrasi\JenisArsip@store');

Route::post('ubah-jenis-arsip','administrasi\JenisArsip@update');

Route::post('hapus-jenis-arsip','administrasi\JenisArsip@delete');

Route::get('ambil-jenis-arsip/{id}','administrasi\JenisArsip@edit');

Route::get('tambah-arsip','administrasi\Arsip@create');

Route::post('store-arsip','administrasi\Arsip@store');

Route::get('ubah-arsip/{id}','administrasi\Arsip@edit');

Route::put('update-arsip/{id}','administrasi\Arsip@update');

Route::put('hapus-arsip/{id}','administrasi\Arsip@delete');

Route::get('cari-arsip','administrasi\Arsip@cari');

	//--- SPK/Kontrak ---

Route::get('SPK-Kontrak','administrasi\SPKKontrak@index');

Route::get('tambah-spk','administrasi\SPKKontrak@create');

Route::post('store-spk','administrasi\SPKKontrak@store');

Route::get('ubah-spk/{id}','administrasi\SPKKontrak@edit');

Route::put('update-spk/{id}','administrasi\SPKKontrak@update');

Route::put('hapus-spk/{id}','administrasi\SPKKontrak@delete');

Route::post('upload-file-spk','administrasi\SPKKontrak@uploadFileKontrak');

Route::post('upload-scan-spk','administrasi\SPKKontrak@uploadFileScanSPK');

Route::post('cari-spk','administrasi\SPKKontrak@cari');

	//--- BApemeriksaan ---

Route::get('BA-Pemeriksaan','administrasi\BApemeriksaan@form');

Route::post('Proses-BApem','administrasi\BApemeriksaan@proses');

Route::put('Proses-BApem/{id}','administrasi\BApemeriksaan@proses_Update');

Route::put('Proses-BApem/{id}/hapus','administrasi\BApemeriksaan@proses_delete');

Route::post('cari-bapem','administrasi\BApemeriksaan@cari_bapem');

	//--- BAkemajuan ---

Route::get('BA-Kemajuan','administrasi\BAkemajuan@form');

Route::post('BA-Kemajuan','administrasi\BAkemajuan@proses');

Route::put('Proses-BAkem/{id}','administrasi\BAkemajuan@proses_Update');

Route::put('Proses-BAkem/{id}/hapus','administrasi\BAkemajuan@proses_delete');

Route::post('cari-bakem','administrasi\BAkemajuan@cari_bakem');

	//--- BApenyelesaian ---

Route::get('BA-Penyelesaian/{id}','administrasi\BApenyelesaian@index');

Route::post('BA-Penyelesaian','administrasi\BApenyelesaian@menu_modal');

Route::get('BA-penyelesian-tambah/{id}','administrasi\BApenyelesaian@create');

Route::post('BA-penyelesian-store','administrasi\BApenyelesaian@store');

Route::get('BA-Penyelesaian-ubah/{id}/{id_spk}','administrasi\BApenyelesaian@edit');

Route::put('BA-Penyelesaian-update/{id}','administrasi\BApenyelesaian@update');

Route::put('BA-Penyelesaian-delete/{id}','administrasi\BApenyelesaian@destroy');

Route::post('cari-Penyelesaian','administrasi\BApenyelesaian@cari_penye');

	//--- BAsertim ---

Route::post('BA-Sertim','administrasi\BAsertim@IndexMenu');

Route::get('BA-Serah-Terima/{id}','administrasi\BAsertim@index');

Route::get('BA-Sertim-tambah/{id}','administrasi\BAsertim@create');

Route::post('BA-Sertim-store','administrasi\BAsertim@store');

Route::get('BA-Sertim-ubah/{id}/{id_spk}','administrasi\BAsertim@edit');

Route::put('BA-Sertim-update/{id}','administrasi\BAsertim@update');

Route::put('BA-Sertim-delete/{id}','administrasi\BAsertim@destroy');

Route::post('cari-Sertim','administrasi\BAsertim@cari_sertim');

	//--- BAserop ---

Route::get('BA-Serah-Terima-Operasional/{id}','administrasi\BAserop@index');

Route::get('BA-Serops-tambah/{id}','administrasi\BAserop@create');

Route::post('BA-Serops-store','administrasi\BAserop@store');

Route::get('BA-Serops-ubah/{id}/{id_spk}','administrasi\BAserop@edit');

Route::put('BA-Serops-update/{id}','administrasi\BAserop@update');

Route::put('BA-Serops-delete/{id}','administrasi\BAserop@delete');

Route::post('cari-serops','administrasi\BAserop@cari');

Route::post('BA-Serah-Terima-Operasional','administrasi\BAserop@MenuIndex');

	//--- Peralatan ---
	
Route::get('Peralatan','administrasi\Peralatan@index');

Route::get('tambah-peralatan','administrasi\Peralatan@create');

Route::post('store-peralatan','administrasi\Peralatan@store');

Route::get('ubah-peralatan/{id}','administrasi\Peralatan@edit');

Route::put('update-peralatan/{id}','administrasi\Peralatan@update');

Route::put('delete-peralatan/{id}','administrasi\Peralatan@delete');

Route::get('cari-peralatan','administrasi\Peralatan@cari');	

	//--- Jenis Rapat ---

Route::get('Pengaturan-rapat','administrasi\JenisRapat@index');

Route::post('store-jenis-rapat','administrasi\JenisRapat@store');

Route::get('edit-jenis-rapat/{id}','administrasi\JenisRapat@edit');

Route::put('update-jenis-rapat','administrasi\JenisRapat@update');

Route::put('delete-jenis-rapat/{id}','administrasi\JenisRapat@delete');	
	
	//--- Brifing ---

Route::get('Brifing','administrasi\Brifing@index');

Route::get('lihat-usulan-brifing', 'administrasi\Brifing@ambilEventBrifing');

Route::post('lihat-usulan-brifing-by-tgl', 'administrasi\Brifing@ambilEventBrifingByTanggal');

Route::post('store-brifing','administrasi\Brifing@store');

Route::put('delete-brifing/{id}','administrasi\Brifing@destroy');

Route::post('reply-brifing', 'administrasi\Brifing@store_brifing');

Route::put('delete-reply/{id}','administrasi\Brifing@delete_brifing');

	//--- AgendaHarian ---

Route::get('Agenda-Harian','administrasi\AgendaHarian@index');

Route::get('lihat-usulan-brifing', 'administrasi\AgendaHarian@ambilEventBrifing');

Route::post('lihat-usulan-brifing-by-tgl', 'administrasi\AgendaHarian@ambilEventBrifingByTanggal');

Route::post('store-agenda','administrasi\AgendaHarian@store');

Route::put('delete-agenda/{id}','administrasi\AgendaHarian@destroy');
	
	//--- Pengumuman ---
	
Route::get('Pengumuman','administrasi\Pengumuman@index');

Route::get('tambah-pengumuman','administrasi\Pengumuman@create');

Route::post('store-pengumuman','administrasi\Pengumuman@store');

Route::get('ubah-pengumuman/{id}','administrasi\Pengumuman@edit');

Route::put('update-pengumuman/{id}','administrasi\Pengumuman@update');

Route::put('delete-pengumuman/{id}','administrasi\Pengumuman@delete');


//============================================ Produksi ================================================================

	//--- Barang ---
	
Route::get('Barang','produksi\Barang@index');

Route::get('tambah-barang','produksi\Barang@create');

Route::post('store-barang','produksi\Barang@store');

Route::get('ubah-barang/{id}','produksi\Barang@edit');

Route::put('update-barang/{id}','produksi\Barang@update');

Route::put('delete-barang/{id}','produksi\Barang@destroy');

Route::post('cari-barang','produksi\Barang@show');

	//--- Supplier ---

Route::get('Supplier','produksi\Supplier@index');

Route::get('tambah-supplier','produksi\Supplier@create');

Route::post('store-supplier','produksi\Supplier@store');

Route::get('ubah-supplier/{id}','produksi\Supplier@edit');

Route::put('update-supplier/{id}','produksi\Supplier@update');

Route::put('hapus-supplier/{id}','produksi\Supplier@delete');

	//--- Pembelian ---

Route::get('Pembelian', 'produksi\BeliBarang@index');

Route::get('tambah-pembelian', 'produksi\BeliBarang@create');

Route::post('store-beli-barang', 'produksi\BeliBarang@store');

Route::get('ubah-pembelian/{id}', 'produksi\BeliBarang@edit');

Route::put('update-beli-barang/{id}', 'produksi\BeliBarang@update');

Route::put('hapus-pembelian/{id}', 'produksi\BeliBarang@delete');


	//--- Penjualan ---
	
Route::get('Penjualan','produksi\JualBarang@index');

Route::get('tambah-penjualan','produksi\JualBarang@create');

Route::post('store-penjualan','produksi\JualBarang@store');

Route::get('ubah-penjualan/{id}','produksi\JualBarang@edit');

Route::put('update-penjualan/{id}','produksi\JualBarang@update');

Route::put('hapus-penjualan/{id}','produksi\JualBarang@destory');

	//--- Jasa ---
	
Route::get('Jasa', 'produksi\Jasa@index');

Route::get('tambah-jasa', 'produksi\Jasa@create');

Route::post('store-jasa', 'produksi\Jasa@store');

Route::get('ubah-jasa/{id}', 'produksi\Jasa@edit');

Route::put('update-jasa/{id}', 'produksi\Jasa@update');

Route::put('delete-jasa/{id}', 'produksi\Jasa@destroy');

Route::post('cari-jasa', 'produksi\Jasa@Cari_jasa');

	//--- Jual jasa ---

Route::get('Jual-Jasa','produksi\Jualjasa@index');

Route::get('tambah-jual-jasa','produksi\Jualjasa@create');

Route::post('store-jual-jasa','produksi\Jualjasa@store');

Route::get('ubah-jual-jasa/{id}','produksi\Jualjasa@edit');

Route::put('update-jual-jasa/{id}','produksi\Jualjasa@update');

Route::put('delete-jual-jasa/{id}','produksi\Jualjasa@delete');

Route::post('cari-jual-jasa','produksi\Jualjasa@cari_jual_jasa');

	//--- Proyek ---

Route::get('Proyek','produksi\Proyek@index');

Route::get('tambah-proyek', 'produksi\Proyek@create');

Route::post('store-proyek', 'produksi\Proyek@store');

Route::get('ubah-proyek/{id}', 'produksi\Proyek@edit');

Route::put('update-proyek/{id}', 'produksi\Proyek@update');

Route::put('delete-proyek/{id}', 'produksi\Proyek@delete');

Route::post('cari-proyek', 'produksi\Proyek@cari');

	//Tim Proyek = Tim Produksi
	
Route::get('Tim-Produksi','produksi\TimProyek@index');

Route::post('store-tim-project','produksi\TimProyek@store');

Route::put('delete-tim-proyek/{id}','produksi\TimProyek@destroy');

Route::post('cari-tim-proyek', 'produksi\TimProyek@cari');

	//--- Jadwal Proyek ---

Route::get('Jadwal-Proyek','produksi\JadwalProyek@index');

Route::get('tambah-jadwal-proyek','produksi\JadwalProyek@create');

Route::post('store-jadwal-proyek','produksi\JadwalProyek@store');

Route::get('get_liftOfProyek/{id_proyek}', 'produksi\JadwalProyek@ambilDaftarJadwalProyek');

Route::get('ubah-jadwal-proyek/{id_proyek}','produksi\JadwalProyek@edit');

Route::put('update-jadwal-proyek/{id}','produksi\JadwalProyek@update');

Route::put('delete-jadwal-proyek/{id}','produksi\JadwalProyek@destroy');

Route::post('cari-jadwal-proyek','produksi\JadwalProyek@show');

	//--- Task Proyek ---

Route::get('tambah-taskproyek','produksi\TaskProyek@create');

Route::post('store-taksproyek','produksi\TaskProyek@store');

Route::get('ubah-taksproyek/{id}','produksi\TaskProyek@edit');

Route::put('update-taksproyek/{id}','produksi\TaskProyek@update');

Route::put('hapus-taksproyek/{id}','produksi\TaskProyek@destroy');

	//--- Rincian Tugas ---
	
Route::get('tambah-rincian-tugas','produksi\RincianTugas@create');

Route::post('store-rincian-tugas','produksi\RincianTugas@store');

Route::get('ubah-rincian-tugas/{id}','produksi\RincianTugas@edit');

Route::put('update-rincian-tugas/{id}','produksi\RincianTugas@update');

Route::put('hapus-rincian-tugas/{id}','produksi\RincianTugas@destroy');

	//--- Progress Proyek ---
	
Route::get('Progress-Proyek','produksi\ProgressProyek@index');

Route::get('Daftar-progress/{id_jadwal_proyek}','produksi\ProgressProyek@listOfProgress');

Route::post('store-progress-proyek','produksi\ProgressProyek@store');

Route::get('ubah-progress-jadwal/{id_progress_proyek}','produksi\ProgressProyek@edit');

Route::post('update-progress-proyek','produksi\ProgressProyek@update');

Route::put('hapus-progress-jadwal/{id}','produksi\ProgressProyek@destroy');

	//--- Pemeliharaan ---

Route::get('Pemeliharaan', 'produksi\Pemeliharaan@index');

Route::get('tambah-pemeliharaan','produksi\Pemeliharaan@create');

Route::post('store-pemeliharaan','produksi\Pemeliharaan@store');

Route::get('ubah-pemeliharaan/{id}','produksi\Pemeliharaan@edit');

Route::put('update-pemeliharaan/{id}','produksi\Pemeliharaan@update');

Route::put('delete-pemeliharaan/{id}','produksi\Pemeliharaan@delete');

Route::post('cari-pemeliharaan','produksi\Pemeliharaan@show');

	//--- Jenis Pemeliharaan ---

Route::get('tambah-jenis-proyek','produksi\JenisPemeliharaan@create');

Route::post('store-jenis-pemeliharaan', 'produksi\JenisPemeliharaan@store');

Route::get('ubah-jenis-pemeliharaan/{id}','produksi\JenisPemeliharaan@edit');

Route::put('update-jenis-pemeliharaan/{id}', 'produksi\JenisPemeliharaan@update');

Route::put('hapus-jenis-pemeliharaan/{id}', 'produksi\JenisPemeliharaan@delete');

	//--- Progres Pemeliharaan ---

Route::get('Progres-Pemeliharaan', 'produksi\ProgressPemeliharaan@index');

Route::get('lihat-progress/{id_pemeliharaan}','produksi\ProgressPemeliharaan@daftar_progress_pemeliharaan');

Route::post('store-progress-pemeliharaan','produksi\ProgressPemeliharaan@store');

Route::get('ubah-progress-pemeliharaan/{id}','produksi\ProgressPemeliharaan@edit');

Route::post('update-progress-pemeliharaan','produksi\ProgressPemeliharaan@update');

Route::put('hapus-progress-pemeliharaan/{id}','produksi\ProgressPemeliharaan@delete');


//================================= Marketing ================================================================
	//--Segmenting--
	
Route::get('Segmenting','marketing\Segmenting@index');

Route::post('store-segmenting','marketing\Segmenting@store');

Route::get('ubah-segmenting/{id}','marketing\Segmenting@edit');

Route::put('update-segmenting/{id}','marketing\Segmenting@update');

Route::put('hapus-segmenting/{id}','marketing\Segmenting@delete');

Route::post('store-segbarang','marketing\Segmenting@store_segbarang');

Route::post('store-segjasa','marketing\Segmenting@store_segjasa');

Route::post('store-segbarang-geo','marketing\Segmenting@store_segbarang_geo');

Route::post('store-segjasa-geo','marketing\Segmenting@store_segjasa_geo');

Route::post('store-segbarang-psi','marketing\Segmenting@store_segbarang_psi');

Route::post('store-segjasa-psi','marketing\Segmenting@store_segjasa_psi');

Route::get('ubah-hasil-segmenting-demog/{id_hasilsg}','marketing\Segmenting@edit_hasil_segmenting');

Route::get('ubah-hasil-segmenting-geog/{id_hasilsg}','marketing\Segmenting@edit_hasil_segmenting');

Route::get('ubah-hasil-segmenting-psi/{id_hasilsg}','marketing\Segmenting@edit_hasil_segmenting');

Route::post('update-hasilsg','marketing\Segmenting@update_hasilsg');

Route::get('getHasilSG/{id_hasilsg}','marketing\Segmenting@ResponseHasilSG');

Route::post('cari-hasilsg-brg','marketing\Segmenting@search_hasilsg_brg');

Route::post('cari-hasilsg-jasa','marketing\Segmenting@search_hasilsg_jasa');

	//--Targeting---
	
Route::get('Targeting','marketing\Targeting@index');

Route::get('tambah-targeting','marketing\Targeting@create_targeting');

Route::post('store-targeting','marketing\Targeting@store');

Route::put('hapus-targeting/{id}','marketing\Targeting@delete');

	//--Positioning---
	
Route::get('Positioning','marketing\PositioningPerusahaan@index');

Route::get('tambah-positioning','marketing\PositioningPerusahaan@create');

Route::post('store-positioning','marketing\PositioningPerusahaan@store');

Route::get('ubah-positioning/{id}','marketing\PositioningPerusahaan@edit');

Route::put('update-positioning/{id}','marketing\PositioningPerusahaan@update');

Route::put('hapus-positioning/{id}','marketing\PositioningPerusahaan@delete');

Route::get('detail-positioning/{id}','marketing\PositioningPerusahaan@detail');

	//--Rencana Marketing & Kegiatan Marketing---
	
Route::get('Rencana-Marketing','marketing\RencanaMarketing@index');

Route::post('tambah-rmbj','marketing\RencanaMarketing@create');

Route::post('store-rmb-onOff','marketing\RencanaMarketing@store_rmb_onOff');

Route::post('store-rmb','marketing\RencanaMarketing@store_rmb');

Route::post('store-rmj','marketing\RencanaMarketing@store_rmj');

Route::put('hapus-rmbj/{id}','marketing\RencanaMarketing@delete');

Route::post('store-target-audience','marketing\RencanaMarketing@store_target_audience');

Route::get('getSubMedia/{id_media_marketing}','marketing\RencanaMarketing@ResponseSubMedia');

Route::get('getContentMarketing/{id_submedia_marketing}','marketing\RencanaMarketing@ResponseContentMarketing');

Route::post('cari-rmbj','marketing\RencanaMarketing@search_rmbj');

Route::post('store-keg-marketing','marketing\RencanaMarketing@store_keg_marketing');

Route::get('getdataRM/{id}','marketing\RencanaMarketing@get_data_RM'); 

Route::get('getdataKM/{id}','marketing\RencanaMarketing@get_data_KM'); 

	//--Attract n Convert--
	
Route::get('Attract','marketing\PelaksanaanMarketing@index');

Route::get('Convert','marketing\PelaksanaanMarketing@index_convert');

Route::post('store-respon-attract','marketing\PelaksanaanMarketing@store_respon_attract');

Route::post('store-respon-convert','marketing\PelaksanaanMarketing@store_respon_convert');

	//--Closing--
	
Route::get('Closing','marketing\Close@index');

Route::post('store-closing','marketing\Close@store');

Route::post('store-sclosing','marketing\Close@store_sclosing');

Route::get('ubah-closing/{id}','marketing\Close@edit');

Route::put('update-closing/{id}','marketing\Close@update');

Route::get('detail-closing/{id}','marketing\Close@detail');

Route::put('hapus-closing/{id}','marketing\Close@delete');


	//--Delighting--
	
Route::get('Delight','marketing\Delight@index');

Route::post('store-delight','marketing\Delight@store');

Route::post('store-respon-delight','marketing\Delight@store_respon_delight');

Route::get('ubah-delight/{id}','marketing\Delight@edit');

Route::put('update-delight/{id}','marketing\Delight@update');

Route::get('detail-delight/{id}','marketing\Delight@detail');

Route::put('hapus-delight/{id}','marketing\Delight@delete');

	//--Delighting--
	
Route::get('Evaluasi','marketing\Evaluasi@index');

Route::post('store-KEvaluasi','marketing\Evaluasi@store_KE');

Route::post('store-IEvaluasi','marketing\Evaluasi@store_IE');

Route::post('store-SEvaluasi','marketing\Evaluasi@store_SE');

Route::post('store-evaluasi-marketing','marketing\Evaluasi@store');

Route::post('store-evaluasi-marketing','marketing\Evaluasi@store');

Route::get('ubah-evaluasi/{id}','marketing\Evaluasi@edit');

Route::put('update-evaluasi/{id}','marketing\Evaluasi@update');

Route::put('hapus-evaluasi/{id}','marketing\Evaluasi@delete');

//================================= Keuangan ==============================================================
	//--tab RPB--
Route::get('RAB', 'keuangan\RAB@index');

Route::post('store-rpb','keuangan\RAB@storeRPB');

Route::get('ubah-rpb/{id_rpb}','keuangan\RAB@editRPB');

Route::post('update-rpb','keuangan\RAB@updateRPB');

Route::put('hapus-rpb/{id}','keuangan\RAB@deleteRPB');

	//--tab RPJ--
	
Route::post('store-rpj','keuangan\RAB@storeRPJ');

Route::get('ubah-rpj/{id_rpj}','keuangan\RAB@editRPJ');

Route::post('update-rpj','keuangan\RAB@updateRPJ');

Route::put('hapus-rpj/{id}','keuangan\RAB@deleteRPJ');

//--tab RPENGELURAN/ROUT--
	
Route::post('store-rout','keuangan\RAB@storeROUT');

Route::get('ubah-rout/{id_rout}','keuangan\RAB@editROUT');

Route::post('update-rout','keuangan\RAB@updateROUT');

Route::put('hapus-rout/{id}','keuangan\RAB@deleteROUT');

//================================= HRD ======================================================================

Route::get('profil','karyawan\Karyawan@index');

Route::post('proses-pendidikan','karyawan\Karyawan@proses_pendidikan');

Route::get('getDataPendidikan', 'karyawan\Karyawan@data_pendidikan');

Route::get('getDataAlamatAsal', 'karyawan\Karyawan@data_alamat');

Route::post('store-alamat-asal', 'karyawan\Karyawan@store_alamat');

Route::get('getDataAlamatSek', 'karyawan\Karyawan@data_alamat_sek');

Route::post('store-alamat-sek', 'karyawan\Karyawan@store_alamat_sek');

Route::get('getDataKeluarga', 'karyawan\Karyawan@data_keluarga');

Route::post('update-keluarga-ky', 'karyawan\Karyawan@update_keluarga');

Route::post('update-keluarga-ky-file', 'karyawan\Karyawan@update_upload_kk_keluarga');

Route::post('tambah-alamat-email-ky','karyawan\Karyawan@store_email');

Route::put('hapus-email-ky/{id}','karyawan\Karyawan@delete_email');

Route::post('tambah-alamat-handphone-ky','karyawan\Karyawan@store_hp');

Route::put('hapus-hp-ky/{id}','karyawan\Karyawan@delete_hp');

//----tambahan baru routes HRD--------------

	//--- Karyawan ---
	
Route::get('Karyawan','hrd\Karyawan@index');

Route::get('tambah-karyawan','hrd\Karyawan@tambah_karyawan');

Route::post('store-karyawan/hrd','hrd\Karyawan@store');

Route::get('ubah-karyawan/{id}','hrd\Karyawan@edit_karyawan');

Route::put('update-hrd-karyawan/{id}','hrd\Karyawan@update');

Route::get('hapus-karyawan/{id}','hrd\Karyawan@delete');


Route::get('tambah-rencana-pelatihan', 'hrd\RencanaPelatihan@create');

Route::post('store-rencana-pelatihan','hrd\RencanaPelatihan@store');

Route::get('ubah-rencana-pelatihan/{id}','hrd\RencanaPelatihan@edit');

Route::post('update-rencana-pelatihan/{id}','hrd\RencanaPelatihan@update');

Route::put('hapus-rencana-pelatihan/{id}','hrd\RencanaPelatihan@delete');

Route::get('daftarkan-peserta-mengikuti-pelatihan/{id_pelatihan}', 'hrd\RencanaPelatihan@daftar_karyawan');

Route::post('daftarkan_peserta','hrd\RencanaPelatihan@store_pelatihan');

Route::post('batal_daftarkan_peserta','hrd\RencanaPelatihan@delete_pelatihan');

Route::get('Buku-Penilaian', function(){
    return view('user.hrd.section.penilaian_karyawan.PA.page_default');
});

Route::get('Performance-Appraisal', 'hrd\BukuPenilaian@PA');

Route::get('Aspek-Pa', 'hrd\AspekPenilaian@index');

Route::post('store-aspek-penilaian','hrd\AspekPenilaian@store');

Route::get('edit-Pa/{id}', 'hrd\AspekPenilaian@edit');

Route::post('update-aspek-penilaian','hrd\AspekPenilaian@update');

Route::put('hapus-PA/{id}','hrd\AspekPenilaian@deletes');

Route::get('Area-Kerja-Utama','hrd\AreaKerjaUtama@index');

Route::post('store-area-kerja-utama', 'hrd\AreaKerjaUtama@store');

Route::get('edit-Aku/{id}', 'hrd\AreaKerjaUtama@edit');

Route::post('update-area-kerja-utama', 'hrd\AreaKerjaUtama@update');

Route::put('hapus-area-kerja-utama/{id}', 'hrd\AreaKerjaUtama@delete');

Route::get('satuan-kpi', 'hrd\SatuanKpi@index');

Route::post('store-satuan-kpi','hrd\SatuanKpi@store');

Route::get('edit-satuan-kpi/{id}', 'hrd\SatuanKpi@edit');

Route::post('update-satuan-kpi','hrd\SatuanKpi@update');

Route::put('hapus-satuan-kpi/{id}','hrd\SatuanKpi@delete');

Route::get('jenis-kpi','hrd\JenisKPI@index');

Route::post('store-jenis-kpi','hrd\JenisKpi@store');

Route::get('edit-jenis-kpi/{id}', 'hrd\JenisKpi@edit');

Route::post('update-jenis-kpi','hrd\JenisKpi@update');

Route::put('hapus-jenis-kpi/{id}','hrd\JenisKpi@delete');

Route::get('Kpi','hrd\Kpi@index');

Route::post('store-kpi','hrd\Kpi@store');

Route::get('edit-kpi/{id}','hrd\Kpi@edit');

Route::post('update-kpi','hrd\Kpi@update');

Route::put('hapus-kpi/{id}','hrd\Kpi@delete');

Route::get('Kpi-karyawan','hrd\KpiKaryawan@index');

Route::post('store-kpi-karyawan','hrd\KpiKaryawan@store');

Route::get('edit-kpi-ky/{id}','hrd\KpiKaryawan@edit');

Route::post('update-kpi-ky','hrd\KpiKaryawan@update');

Route::put('hapus-kpi-ky/{id}','hrd\KpiKaryawan@delete');



Route::get('jenis-kompetensi','hrd\JenisKompetensi@index');

Route::post('store-jenis-kompetensi','hrd\JenisKompetensi@store');

Route::get('edit-jenis-kompetensi/{id}','hrd\JenisKompetensi@edit');

Route::post('update-jenis-kompetensi','hrd\JenisKompetensi@update');

Route::put('hapus-jenis-kompetensi/{id}','hrd\JenisKompetensi@delete');

Route::get('kompetensi-majerial','hrd\JenisKompetensiManaJerial@index');

Route::post('store-kompetensi-majerial','hrd\JenisKompetensiManaJerial@store');

Route::get('edit-kmanajerial/{id}','hrd\JenisKompetensiManaJerial@edit');

Route::post('update-kmanajerial','hrd\JenisKompetensiManaJerial@update');

Route::put('hapus-kmanajerial/{id}','hrd\JenisKompetensiManaJerial@delete');

Route::get('item-kompetensi-manajerial','hrd\ItemKmanajerial@index');

Route::post('store-item-kompetensi-majerial','hrd\ItemKmanajerial@store');

Route::get('edit-item-kmanajerial/{id}','hrd\ItemKmanajerial@edit');

Route::post('update-item-kmanajerial','hrd\ItemKmanajerial@update');

Route::put('hapus-item-kmanajerial/{id}','hrd\ItemKmanajerial@delete');

Route::get('kompetensi-teknis','hrd\KompetensiTeknis@index');

Route::post('store-kompetensi-teknis','hrd\KompetensiTeknis@store');

Route::get('edit-kompetensi-teknis/{id}','hrd\KompetensiTeknis@edit');

Route::post('update-kompetensi-teknis','hrd\KompetensiTeknis@update');

Route::put('hapus-kompetensi-teknis/{id}','hrd\KompetensiTeknis@delete');

Route::get('penilian-kemanajerial/{id}','hrd\KompetensiTeknis@create');

Route::get('Tes-kemanajerial','hrd\TesKemanajerial@index');

Route::post('store-tes-kmanajerial','hrd\TesKemanajerial@store');

Route::get('Kompensasi-Kinerja','hrd\KompensasiKinerja@index');

Route::post('store-kompensasi-kinerja','hrd\KompensasiKinerja@store');

Route::get('edit-kompensasi-kinerja/{id}','hrd\KompensasiKinerja@edit');

Route::post('update-kompensasi-kinerja','hrd\KompensasiKinerja@update');

Route::put('hapus-kompensasi-kinerja/{id}','hrd\KompensasiKinerja@delete');

Route::get('Log-Diary','hrd\LogDiary@index');

Route::post('store-LogDiary','hrd\LogDiary@store');

Route::get('edit-log-diary/{id}','hrd\LogDiary@edit');

Route::post('update-log-diary','hrd\LogDiary@update');

Route::get('hapus-log-diary/{id}','hrd\LogDiary@delete');

Route::get('formulir-tes-kemanajerialan/{id_ky}', 'hrd\TesKemanajerial@create');

Route::get('edit-tes-kemanajerial/{id}', 'hrd\TesKemanajerial@edit');

Route::post('update-tes-kemanajerial', 'hrd\TesKemanajerial@update');

Route::put('hapus-test-manajerial/{id}', 'hrd\TesKemanajerial@delete');

Route::post('cari-tes-km', 'hrd\TesKemanajerial@show');

Route::get('Tes-kompetensi-teknis', 'hrd\TesKompetensiTeknis@index');

Route::get('formulir-tes-kompetensi-teknis/{id_karyawan}', 'hrd\TesKompetensiTeknis@create');

Route::post('store-tes-kteknis','hrd\TesKompetensiTeknis@store' );

Route::get('edit-tes-teknis/{id}','hrd\TesKompetensiTeknis@edit');

Route::post('update-tes-teknis','hrd\TesKompetensiTeknis@update' );

Route::put('hapus-test-teknis/{id}','hrd\TesKompetensiTeknis@delete' );

Route::post('cari-tes-kt','hrd\TesKompetensiTeknis@show' );

Route::get('item-teknis','hrd\ItemKTeknis@index');

Route::post('store-item-kompetensi-teknis','hrd\ItemKTeknis@store');

Route::get('edit-item-kteknis/{id}','hrd\ItemKTeknis@edit');

Route::post('update-item-kteknis','hrd\ItemKTeknis@update');

Route::put('hapus-item-kteknis/{id}','hrd\ItemKTeknis@delete');
//if(!empty(Session::get('id_perusahaan_karyawan')))
//{
//    $daftar_menu = menu_ukm::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
//    foreach ($daftar_menu as $menus)
//    {
//        if(!empty($subMenu = $menus->getSubMenu))
//        {
//            foreach ($subMenu as $sum_menu)
//            {
//                if(!empty($menuKaryawan= $sum_menu->getMenuKaryawan->where('id_karyawan', Session::get('id_karyawan') ))){
//                    foreach ($menuKaryawan as $menu_karyawan)
//                    {
//                        Route::get('{ $sum_menu->getMasterSubMenuUKM->url }','');
//                    }
//                }
//            }
//        }
//    }
//}
//============================================ Produksi ================================================================


Route::post('cari-karyawan','hrd\Karyawan@cari');

	//--- Rekruitmen/loker ---

Route::get('Rekruitmen','hrd\Loker@index');

Route::get('tambah-rekrutment','hrd\Loker@create');

Route::post('store-rekruitmen','hrd\Loker@store');

Route::get('ubah-rekruitmen/{id}','hrd\Loker@edit');

Route::put('update-rekruitmen/{id}','hrd\Loker@update');

Route::get('hapus-rekruitmen/{id}','hrd\Loker@delete');

Route::post('upload-loker','hrd\Loker@upload_image');

Route::get('detail-rekruitmen/{id}','hrd\Loker@show');

Route::post('cari-rekruitmen','hrd\Loker@search');

	//--- Lamaran Pekerjaan---

Route::get('Lamaran-Pekerjaan','hrd\LamaranPek@index');

Route::get('tambah-lamaran','hrd\LamaranPek@create');

Route::post('store-lamaran','hrd\LamaranPek@store');

Route::get('ubah-lamaran/{id}','hrd\LamaranPek@edit');

Route::put('update-lamaran/{id}','hrd\LamaranPek@update');

Route::put('hapus-lamaran/{id}','hrd\LamaranPek@delete');

	//--- Seleksi---

Route::get('Seleksi','hrd\SeleksiBerkas@index');

Route::get('daftar-pelamar/{id}', 'hrd\SeleksiBerkas@show');

Route::get('Seleksi-pesarta/{id_peserta}','hrd\SeleksiBerkas@show_peserta');

Route::put('simpan-seleksi/{id_peserta}','hrd\SeleksiBerkas@save');

		// Tab Psikotes
Route::get('Tes', 'hrd\Tes@psikotes'); 

Route::get('jenis-psikotes', 'hrd\JenisPsikotes@index');

Route::post('store-jenis-psikotes', 'hrd\JenisPsikotes@store');

Route::get('ubah-jenis-psikotes/{id}', 'hrd\JenisPsikotes@edit');

Route::post('update-jenis-psikotes', 'hrd\JenisPsikotes@update');

Route::put('hapus-jenis-psikotes/{id}', 'hrd\JenisPsikotes@delete');

Route::post('simpan-psikotes','hrd\Psikotes@store');

Route::post('cari-loker-psikotes','hrd\Tes@search_psikotes');

		// Tab wawancara

Route::get('Wawancara', 'hrd\Tes@wawancara'); 

Route::get('item-wawancara', 'hrd\ItemWawancara@index');

Route::post('store-item-wawancara', 'hrd\ItemWawancara@store');

Route::get('ubah-item-wawancara/{id}', 'hrd\ItemWawancara@edit');

Route::post('update-item-wawancara', 'hrd\ItemWawancara@update');

Route::put('hapus-item-wawancara/{id}', 'hrd\ItemWawancara@delete');

Route::get('mulai-wawancara/{id}','hrd\Wawancara@index');

Route::get('tambah-penilaian-wawancara/{id}', 'hrd\Wawancara@create');

Route::put('store-penilaian-wawancara/{id}', 'hrd\Wawancara@store');

Route::get('ubah-hasil-wawancara/{id}', 'hrd\Wawancara@edit');

Route::put('update-penilaian-wawancara/{id}', 'hrd\Wawancara@update');

Route::put('hapus-hasil-wawancara/{id}', 'hrd\Wawancara@delete');

Route::post('cari-loker-wawancara', 'hrd\Tes@show_wawancara');

		// Tab Keahlian

Route::get('Keahlian', 'hrd\Tes@keahlian'); 

Route::get('item-keahlian','hrd\ItemKeahlian@index');

Route::post('store-item-keahlian','hrd\ItemKeahlian@store');

Route::get('ubah-item-keahlian/{id_item_keahlian}','hrd\ItemKeahlian@edit');

Route::post('update-item-keahlian','hrd\ItemKeahlian@update');

Route::post('hapus-item-keahlian','hrd\ItemKeahlian@delete');

Route::get('mulai-tes-keahlian/{id}','hrd\TesKeahlian@index');

Route::get('tambah-penilaian-keahlian/{id}','hrd\TesKeahlian@create');

Route::put('store-penilaian-keahlian/{id}','hrd\TesKeahlian@store');

Route::get('ubah-hasil-keahlian/{id}','hrd\TesKeahlian@edit');

Route::put('update-penilaian-keahlian/{id}','hrd\TesKeahlian@update');

Route::put('hapus-hasil-keahlian/{id}','hrd\TesKeahlian@delete');

Route::post('cari-loker-keahlian','hrd\Tes@show');

Route::get('Hasil-tes','hrd\Tes@hasil_tes');

Route::get('keterangan-tambahan/{id_pelamar}', 'hrd\HasilTes@index');

Route::put('store-keterangan/{id_pelamaar}', 'hrd\HasilTes@save');

Route::get('lihat-keterangan/{id_pelamaar}', 'hrd\HasilTes@show');

Route::post('cari-hasil-loker', 'hrd\Tes@cari_hasil');

	//--- Kontrak-Kerja---
		
Route::get('Kontrak-Kerja','hrd\KontrakKerja@index');

Route::get('tambah-kontrak','hrd\KontrakKerja@create');

Route::post('store-kontrak-kerja','hrd\KontrakKerja@store');

Route::get('ubah-kontrak/{id}', 'hrd\KontrakKerja@edit');

Route::put('update-kontrak-kerja/{id}', 'hrd\KontrakKerja@update');

Route::get('hapus-kontrak/{id}', 'hrd\KontrakKerja@delete');

Route::post('store-updok-kontrak-kerja', 'hrd\KontrakKerja@upload_file');

Route::post('store-updok-kontrak-kerja-ttd', 'hrd\KontrakKerja@upload_fileTTD');

Route::post('cari-kontrak-kerja-ky', 'hrd\KontrakKerja@cari');

Route::get('jenis-kontrak-kerja', 'hrd\JenisKontrakKerja@index');

Route::post('store-jenis-kontrak-kerja', 'hrd\JenisKontrakKerja@store');

Route::get('ubah-jenis-kontrak-kerja/{id}', 'hrd\JenisKontrakKerja@edit');

Route::post('update-jenis-kontrak-kerja', 'hrd\JenisKontrakKerja@update');

Route::put('hapus-jenis-kontrak-kerja/{id}', 'hrd\JenisKontrakKerja@delete');

	//--- Tenaga-ahli---
	
Route::get('Tenaga-ahli', 'hrd\TenagaKerja@index');

Route::post('cari-sertifikasi-karyawan', 'hrd\TenagaKerja@show');

Route::get('daftar-sertifikasi/{id}','hrd\TenagaKerja@daftarSertifikasi');

Route::get('tambah-sertifikasi/{id_user}','hrd\TenagaKerja@create');

Route::post('store-sertifikasi','hrd\TenagaKerja@store');

Route::get('ubah-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@edit');

Route::put('update-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@update');

Route::put('hapus-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@delete');

	//--- Periode-Kerja---
	
Route::get('Periode-Kerja','hrd\PeriodeKerja@index');

Route::get('tambah-periode-kerja','hrd\PeriodeKerja@create');

Route::post('store-periode-kerja','hrd\PeriodeKerja@store');

Route::get('ubah-periode-kerja/{id}','hrd\PeriodeKerja@edit');

Route::put('update-periode-kerja/{id}','hrd\PeriodeKerja@update');

Route::put('hapus-periode-kerja/{id}','hrd\PeriodeKerja@delete');

	//--- Kelender-Kerja---

Route::get('Kelender-Kerja','hrd\KalenderKerja@index');

Route::get('daftar-event-kalender', 'hrd\KalenderKerja@daftarEvent');

Route::get('tambah-aktifitas', 'hrd\KalenderKerja@create');

Route::post('store-kalender-kerja','hrd\KalenderKerja@store');

Route::get('ubah-kalender-kerja/{id}', 'hrd\KalenderKerja@edit');

Route::put('update-kalender-kerja/{id}','hrd\KalenderKerja@update');

Route::put('hapus-kalender-kerja/{id}','hrd\KalenderKerja@delete');

Route::get('get-event-calender','hrd\KalenderKerja@getEventKalender');

	//--- Cuti---
	
Route::get('Cuti', 'hrd\Cuti@index');

Route::get('tambah-pengaturan-cuti','hrd\PengaturanCuti@create');

Route::post('store-pengaturan-cuti','hrd\PengaturanCuti@store');

Route::get('ubah-pengaturan-cuti/{id}','hrd\PengaturanCuti@edit');

Route::put('update-pengaturan-cuti/{id}','hrd\PengaturanCuti@update');

Route::put('hapus-pengaturan-cuti/{id}','hrd\PengaturanCuti@delete');

Route::get('tambah-cuti','hrd\Cuti@create');

Route::post('store-cuti','hrd\Cuti@store');

Route::get('ubah-cuti/{id}','hrd\Cuti@edit');

Route::put('update-cuti/{id}','hrd\Cuti@update');

Route::put('hapus-cuti/{id}','hrd\Cuti@delete');

Route::get('tambah-permintaan-cuti','hrd\Permintaan_cuti@create');

Route::post('store-permintaan-cuti','hrd\Permintaan_cuti@store');

Route::get('ubah-permintaan-cuti/{id}','hrd\Permintaan_cuti@edit');

Route::put('update-permintaan-cuti/{id}','hrd\Permintaan_cuti@update');

Route::put('hapus-permintaan-cuti/{id}','hrd\Permintaan_cuti@delete');

Route::post('upload-file-permintaan-cuti','hrd\Permintaan_cuti@upload');

	//--- SOP---
	
Route::get('SOP', 'hrd\Sop@index');

Route::get('tambah-sop', 'hrd\Sop@create');

Route::post('store-sop','hrd\Sop@store');

Route::get('ubah-sop/{id}', 'hrd\Sop@edit');

Route::put('update-sop/{id}','hrd\Sop@update');

Route::put('hapus-sop/{id}','hrd\Sop@delete');

	//--- Rencana-Pelatihan---
	
Route::get('Rencana-Pelatihan', 'hrd\RencanaPelatihan@index');

//================================= Global Route ======================================================================
Route::get('GlobalKabupaten/{id_provinsi}','globals\ProvinsiDanKabupaten@ResponseKabupaten');

Route::post('GlobalSubKategori', 'globals\KategoriJasa@getSubKategori');

Route::post('GlobalSubSubKategori', 'globals\KategoriJasa@getSubSubKategori');