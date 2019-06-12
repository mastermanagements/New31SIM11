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

Route::get('tambah-klien','administrasi\Klien@create');

Route::post('store-klien','administrasi\Klien@store');

Route::get('ubah-klien/{id}','administrasi\Klien@edit');

Route::put('update-klien/{id}','administrasi\Klien@update');

Route::get('hapus-klien/{id}','administrasi\Klien@delete');

Route::post('cari-klien','administrasi\Klien@cari_klien');

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


//================================= Global Route ======================================================================
Route::get('GlobalKabupaten/{id_provinsi}','globals\ProvinsiDanKabupaten@ResponseKabupaten');