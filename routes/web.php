<?php

use App\Model\Superadmin_ukm\U_menu_ukm as menu_ukm;
use Illuminate\Routing\Router;

Route::get('/', 'fronendController@index');

Route::get('pelatihan', 'fronendController@pelatihan');

Route::get('event', 'fronendController@event');

Route::get('registerApp', function () {
	return view('user.superadmin_ukm.master.section.registered.registered');
});

Route::get('login-page', function () {
	return view('user.superadmin_ukm.master.section.registered.login');
});

Route::get('sign-out', 'Superadmin_ukm\LoginAndRegisterController@signOut');

Route::get('dashboard', function () {
	/*     dd(Session::get('id_superadmin_ukm'));
    if(empty($model_superadmin = App\Model\Superadmin_ukm\U_usaha::where("id_user_ukm",Session::get('id_superadmin_ukm'))->first()))
    {
        return abort(404);
    } */

    $data_perusahaan = App\Model\Superadmin_ukm\U_usaha::all()->where('id_user_ukm',Session::get('id_superadmin_ukm'));
    $data=[
        'data_perusahaan'=>$data_perusahaan
    ];
    return view('user.superadmin_ukm.master.section.default.page_default', $data);

});
//=========================== Registrasi & Login ========================================================================
Route::post('registered', 'Superadmin_ukm\LoginAndRegisterController@registered');

Route::post('login-page', 'Superadmin_ukm\LoginAndRegisterController@login');

//=========================== Superadmin UKM ========================================================================
Route::get('pengaturan-perusahaan', 'Superadmin_ukm\Superadmin_UKM@index');

Route::get('verification/{id}', 'Superadmin_ukm\LoginAndRegisterController@verification_');

Route::get('editprofile', 'Superadmin_ukm\Superadmin_UKM@editProfileSuperadminUkm');

Route::get('getKabupaten/{id_provinsi}', 'Superadmin_ukm\Superadmin_UKM@ResponseKabupaten');

Route::put('updateProfile/{id_superadmin_ukm}', 'Superadmin_ukm\Superadmin_UKM@updateProfile');

Route::get('profil-perusahaan', 'Superadmin_ukm\Superadmin_UKM@profil_perusahaan');

Route::get('tambah-usaha', 'Superadmin_ukm\UsahaController@create');

Route::post('store-usaha', 'Superadmin_ukm\UsahaController@store');

Route::get('ubah-usaha/{id}', 'Superadmin_ukm\UsahaController@edit');

Route::put('update-usaha/{id}', 'Superadmin_ukm\UsahaController@update');

Route::put('delete-usaha/{id}', 'Superadmin_ukm\UsahaController@delete');

Route::get('visi', 'Superadmin_ukm\Superadmin_UKM@visi');

Route::get('membuat-visi', 'Superadmin_ukm\Visi@create');

Route::post('store-visi', 'Superadmin_ukm\Visi@store');

Route::get('misi', 'Superadmin_ukm\Superadmin_UKM@misi');

Route::get('membuat-misi', 'Superadmin_ukm\Misi@create');

Route::post('store-misi', 'Superadmin_ukm\Misi@store');

Route::get('akta', 'Superadmin_ukm\Superadmin_UKM@akta');

Route::get('unggah-akta', 'Superadmin_ukm\Akta@create');

Route::post('akta-visi', 'Superadmin_ukm\Akta@store');

Route::get('izin-usaha', 'Superadmin_ukm\Superadmin_UKM@izin_usaha');

Route::get('unggah-ijin', 'Superadmin_ukm\Ijin_usaha@create');

Route::post('ijin-usaha', 'Superadmin_ukm\Ijin_usaha@store');

Route::get('unggah-ijin/{id}', 'Superadmin_ukm\Ijin_usaha@edit');

Route::put('ijin-usaha-update/{id}', 'Superadmin_ukm\Ijin_usaha@update');

Route::put('unggah-ijin-delete/{id}', 'Superadmin_ukm\Ijin_usaha@delete');

Route::get('menu-perusahaan', 'Superadmin_ukm\Menu_perusahaan@daftar_perusahaan');

Route::get('pengaturan-menu/{id}', 'Superadmin_ukm\Menu_perusahaan@daftar_menu');

Route::post('store_request_menu', 'Superadmin_ukm\Menu_perusahaan@store_menu');

Route::post('delete_request_menu', 'Superadmin_ukm\Menu_perusahaan@delete_menu');

Route::get('rek-ukm', 'Superadmin_ukm\Superadmin_UKM@rek_ukm');

Route::get('tambah-rek-ukm', 'Superadmin_ukm\RekUkm@create');

Route::post('store-rek-ukm', 'Superadmin_ukm\RekUkm@store');

Route::get('edit-rek-ukm/{id}', 'Superadmin_ukm\RekUkm@edit');

Route::put('update-rek-ukm/{id}', 'Superadmin_ukm\RekUkm@update');

Route::put('delete-rek-ukm/{id}', 'Superadmin_ukm\RekUkm@destroy');

//=========================== Pengguna Karyawan ========================================================================

Route::get('pengguna-karyawan', 'Superadmin_ukm\PenggunaKaryawan@karyawan');

Route::get('daftar-karyawan/{id_usaha}', 'Superadmin_ukm\Karyawan@data_karyawan');

Route::get('daftarkan-karyawan/{id_usaha}', 'Superadmin_ukm\Karyawan@create');

Route::post('store-karyawan', 'Superadmin_ukm\Karyawan@store');

Route::get('ubah-karyawan/{id_usaha}/{id_karyawan}', 'Superadmin_ukm\Karyawan@edit');

Route::put('update-karyawan/{id_karyawan}', 'Superadmin_ukm\Karyawan@update');

Route::get('detail-karyawan/{id_karyawan}', 'Superadmin_ukm\Karyawan@detail');

Route::put('karyawan-delete/{id_karyawan}', 'Superadmin_ukm\Karyawan@delete');

//=============================== Investor =============================================================================

Route::get('daftar-investor/{id_perusahaa}', 'Superadmin_ukm\Investor@daftar_inverstor');

Route::get('daftarkan-investor/{id_perusahaan}', 'Superadmin_ukm\Investor@tambah_investor');

Route::post('store-investor', 'Superadmin_ukm\Investor@store');

Route::get('ubah-investor/{id_perusahaan}/{id_investor}', 'Superadmin_ukm\Investor@edit_investor');

Route::put('update-investor/{id_investor}', 'Superadmin_ukm\Investor@update');

Route::put('delete-investor/{id_investor}', 'Superadmin_ukm\Investor@delete');

Route::get('detail-investor/{id_perusahaan}/{id_investor}', 'Superadmin_ukm\Investor@detail_investor');

//============================= Menu Karyawan  ========================================================================

Route::get('hak-akses-karyawan/{id_karyawan}', 'Superadmin_ukm\Hak_akses@daftar_hak_akses');

Route::put('store_request_menu_karyawan/{id}', 'Superadmin_ukm\Hak_akses@store_menu');

Route::put('delete_request_menu_karyawan/{id}', 'Superadmin_ukm\Hak_akses@delete_menu');

//============================ Menu Investor ===========================================================================

Route::get('hak-akses-investor/{id_investor}', 'Superadmin_ukm\Hak_akses_investor@daftar_hak_akses');

Route::put('store_request_menu_investor/{id}', 'Superadmin_ukm\Hak_akses_investor@store_menu');

Route::put('delete_request_menu_investor/{id}', 'Superadmin_ukm\Hak_akses_investor@delete_menu');



//=========================== Login Karyawan ========================================================================

Route::get('login-karyawan', 'karyawan\LoginController@Login');

Route::post('cek-karyawan', 'karyawan\LoginController@cek_login');

Route::get('logout-karyawan', 'karyawan\LoginController@logOut');


//=========================== Menu Perusahaan ========================================================================
Route::get('welcome-page', 'karyawan\Dashboard@index');

Route::put('update-swot/{id}', 'karyawan\SWOT@update');

Route::put('delete-swot/{id}', 'karyawan\SWOT@delete');

Route::get('ubah-swot/{id}', 'karyawan\SWOT@edit');

//Route::get('Strategi-Jangka-Panjang', 'karyawan\SJP@index');

//--- struktur perusahaan ---

Route::get('Struktur-Perusahaan', 'karyawan\StruturPerusahaan@index');


Route::post('store-bagan', 'karyawan\StruturPerusahaan@store');

Route::get('getRequestStrukturPerusahaan', 'karyawan\StruturPerusahaan@getRequestStrukturPerusahaan');

Route::get('ubah-struktur/{id}', 'karyawan\StruturPerusahaan@getRequest');

Route::put('update-struktur/{id}', 'karyawan\StruturPerusahaan@update');

Route::put('delete-struktur/{id}', 'karyawan\StruturPerusahaan@delete');

//--- Departemen/Bagian ---

Route::get('Bagian', 'karyawan\Bagian@index');

Route::get('dataBagian', 'karyawan\Bagian@DataBagian');

Route::post('store-bagian', 'karyawan\Bagian@store');

Route::get('dataBagian/{id}', 'karyawan\Bagian@RequestDataBagian');

Route::post('update-bagian', 'karyawan\Bagian@update');

Route::post('hapus-bagian/{id}', 'karyawan\Bagian@delete');

//--- Divisi ---

Route::get('Divisi', 'karyawan\Devisi@index');

Route::post('store-divisi', 'karyawan\Devisi@store');

Route::get('Divisi/{id_divisi}', 'karyawan\Devisi@edit');

Route::post('update-divisi', 'karyawan\Devisi@update');

Route::put('hapusDivisi/{id_divisi}', 'karyawan\Devisi@delete');

Route::get('getDivisi/{id_bagian_p}', 'karyawan\Devisi@ResponseDivisi');

//--- jabatan ---

Route::get('Jabatan', 'karyawan\Jabatan@index');

Route::post('store-jabatan', 'karyawan\Jabatan@store');

Route::get('edit-jabatan/{id}', 'karyawan\Jabatan@edit');

Route::post('update-jabatan', 'karyawan\Jabatan@update');

Route::put('hapus-jabatan/{id}', 'karyawan\Jabatan@delete');

//--- JobDesc ---

Route::get('Job-Desc', 'karyawan\JobDecs@index');

Route::post('store-jobdesc', 'karyawan\JobDecs@store');

Route::get('ubah-jobdesc/{id_jobdesc}', 'karyawan\JobDecs@edit');

Route::post('update-jobdesc', 'karyawan\JobDecs@update');

Route::put('hapus-jobdesc/{id}', 'karyawan\JobDecs@delete');

//tugas
Route::post('store-tugas', 'karyawan\JobDecs@storeTugas');

Route::get('ubah-tugas/{id_jobdesc}', 'karyawan\JobDecs@editTugas');

Route::post('update-tugas', 'karyawan\JobDecs@updateTugas');

//tanggung jawab
Route::post('store-tanggungjawab', 'karyawan\JobDecs@storeTanggungJ');

Route::get('ubah-tanggungjawab/{id_jobdesc}', 'karyawan\JobDecs@editTanggungjawab');

Route::post('update-tanggungjawab', 'karyawan\JobDecs@updateTanggungjawab');

//wewenang
Route::post('store-wewenang', 'karyawan\JobDecs@storeWewenang');

Route::get('ubah-wewenang/{id_jobdesc}', 'karyawan\JobDecs@editWewenang');

Route::post('update-wewenang', 'karyawan\JobDecs@updateWewenang');

//--- SWOT ---

Route::get('Swot', 'karyawan\SWOT@index');

Route::get('buat-swot', 'karyawan\SWOT@create');

Route::post('store-swot', 'karyawan\SWOT@store');

Route::get('ubah-swot/{id}', 'karyawan\SWOT@edit');

Route::put('update-swot/{id}', 'karyawan\SWOT@update');

Route::put('delete-swot/{id}', 'karyawan\SWOT@delete');

//--- Kompetitor ---

Route::get('Kompetitor', 'superadmin_ukm\Kompetitor@index');

Route::get('tambah-kompetitor', 'superadmin_ukm\Kompetitor@create');

Route::post('store-kompetitor', 'superadmin_ukm\Kompetitor@store');

Route::get('ubah-kompetitor/{id}', 'superadmin_ukm\Kompetitor@edit');

Route::put('update-kompetitor/{id}', 'superadmin_ukm\Kompetitor@update');

Route::put('hapus-kompetitor/{id}', 'superadmin_ukm\Kompetitor@delete');

Route::get('detail-kompetitor/{id}', 'Superadmin_ukm\Kompetitor@detail');

Route::get('getKabupatenK/{id_provinsi}', 'Superadmin_ukm\Kompetitor@ResponseKabupaten');


//--- Target Perusahaan ---

Route::get('Target-Perusahaan', 'karyawan\TargetPerusahaan@index');

//Target puncak
Route::get('buat-tjp', 'karyawan\TargetPerusahaan@create');

Route::post('store-tjp', 'karyawan\TargetPerusahaan@store');

Route::get('ubah-tjp/{id}', 'karyawan\TargetPerusahaan@edit');

Route::post('update-tjp', 'karyawan\TargetPerusahaan@update');

Route::put('hapus-tjp/{id}', 'karyawan\TargetPerusahaan@delete');


//Target eksekutif
Route::get('buat-target-eks', 'karyawan\TargetPerusahaan@createTargetEks');

Route::post('store-target-eks', 'karyawan\TargetPerusahaan@storeTargetEks');

Route::get('ubah-target-eks/{id}', 'karyawan\TargetPerusahaan@editTargetEks');

Route::post('update-target-eks', 'karyawan\TargetPerusahaan@updateTargetEks');

Route::put('hapus-target-eks/{id}', 'karyawan\TargetPerusahaan@deleteTargetEks');

//Target manager
Route::get('buat-target-man', 'karyawan\TargetPerusahaan@createTargetMan');

Route::post('store-target-man', 'karyawan\TargetPerusahaan@storeTargetMan');

Route::get('ubah-target-man/{id}', 'karyawan\TargetPerusahaan@editTargetMan');

Route::post('update-target-man', 'karyawan\TargetPerusahaan@updateTargetMan');

Route::put('hapus-target-man/{id}', 'karyawan\TargetPerusahaan@deleteTargetMan');

//Target Supervisor
Route::get('buat-target-sup', 'karyawan\TargetPerusahaan@createTargetSup');

Route::post('store-target-sup', 'karyawan\TargetPerusahaan@storeTargetSup');

Route::get('ubah-target-sup/{id}', 'karyawan\TargetPerusahaan@editTargetSup');

Route::post('update-target-sup', 'karyawan\TargetPerusahaan@updateTargetSup');

Route::put('hapus-target-sup/{id}', 'karyawan\TargetPerusahaan@deleteTargetSup');

//Target Staf
Route::get('buat-target-staf', 'karyawan\TargetPerusahaan@createTargetStaf');

Route::post('store-target-staf', 'karyawan\TargetPerusahaan@storeTargetStaf');

Route::get('ubah-target-staf/{id}', 'karyawan\TargetPerusahaan@editTargetStaf');

Route::post('update-target-staf', 'karyawan\TargetPerusahaan@updateTargetStaf');

Route::put('hapus-target-staf/{id}', 'karyawan\TargetPerusahaan@deleteTargetStaf');

//--- Strategi Perusahaan ---
Route::get('Strategi-Perusahaan', 'karyawan\StrategiPerusahaan@index');

//Strategi jangka panjang perusahaan
Route::post('store-sjp', 'karyawan\StrategiPerusahaan@store');

Route::get('ubah-sjp/{id}', 'karyawan\StrategiPerusahaan@edit');

Route::post('update-sjp', 'karyawan\StrategiPerusahaan@update');

Route::put('hapus-sjp/{id_sjp}', 'karyawan\StrategiPerusahaan@delete');


//Strategi Eksekutif
Route::post('store-sekutif', 'karyawan\StrategiPerusahaan@storeSekutif');

Route::get('ubah-sekutif/{id}', 'karyawan\StrategiPerusahaan@editSekutif');

Route::post('update-sekutif', 'karyawan\StrategiPerusahaan@updateSekutif');

Route::put('hapus-sekutif/{id}', 'karyawan\StrategiPerusahaan@deleteSekutif');


//strategi manager
Route::post('store-sman', 'karyawan\StrategiPerusahaan@storeSman');

Route::get('ubah-sman/{id}', 'karyawan\StrategiPerusahaan@editSman');

Route::post('update-sman', 'karyawan\StrategiPerusahaan@updateSman');

Route::put('hapus-sman/{id}', 'karyawan\StrategiPerusahaan@deleteSman');

//strategi supervisor
Route::post('store-ssup', 'karyawan\StrategiPerusahaan@storeSsup');

Route::get('ubah-ssup/{id}', 'karyawan\StrategiPerusahaan@editSsup');

Route::post('update-ssup', 'karyawan\StrategiPerusahaan@updateSsup');

Route::put('hapus-ssup/{id}', 'karyawan\StrategiPerusahaan@deleteSsup');

//strategi staf
Route::post('store-sstaf', 'karyawan\StrategiPerusahaan@storeSstaf');

Route::get('ubah-sstaf/{id}', 'karyawan\StrategiPerusahaan@editSstaf');

Route::post('update-sstaf', 'karyawan\StrategiPerusahaan@updateSstaf');

Route::put('hapus-sstaf/{id}', 'karyawan\StrategiPerusahaan@deleteSstaf');

//--- Model Bisnis ---
Route::get('Model-Bisnis', 'karyawan\ModelBisnis@index');

Route::get('buat-model-bisnis', 'karyawan\ModelBisnis@create');

Route::post('store-mb', 'karyawan\ModelBisnis@store');

Route::get('ubah-mb/{id}', 'karyawan\ModelBisnis@edit');

Route::put('update-mb/{id}', 'karyawan\ModelBisnis@update');

Route::put('hapus-mb/{id}', 'karyawan\ModelBisnis@delete');

Route::get('getSubModelBisnis/{id_jenis_mb}', 'karyawan\ModelBisnis@ResponseSubModelBisnis');

//Route::get('getKabupatenK/{id_provinsi}', 'Superadmin_ukm\Kompetitor@ResponseKabupaten');

//======================================== Administrasi ================================================================
//--- Klien ---
Route::get('Klien', 'administrasi\Klien@index');

Route::get('tambah-leads', 'administrasi\Klien@create_leads');

Route::post('store-leads', 'administrasi\Klien@store_leads');

Route::get('ubah-klien/{id}', 'administrasi\Klien@edit');

Route::put('update-klien/{id}', 'administrasi\Klien@update');

Route::put('hapus-klien/{id}', 'administrasi\Klien@delete');

Route::resource('group-klien','administrasi\GroupKlien');
Route::get('group-klien/{id_group}/destroy','administrasi\GroupKlien@destroy');

Route::get('ambilDataKlien/{id}', 'administrasi\Klien@ambil_data_klien');

Route::get('getPenanda/{id_sdk}', 'administrasi\Klien@ResponsePenanda');

Route::post('ganti-jenis-klien-leads', 'administrasi\Klien@ganti_jenis_klien_leads');


//--- Surat ---
Route::get('Surat', 'administrasi\Surat@index');

Route::post('store-jenis-barang', 'administrasi\JenisSurat@store');

Route::get('tampilkan-jenis-barang', 'administrasi\JenisSurat@index');

Route::get('tampilkan-jenis-barang/{id}', 'administrasi\JenisSurat@edit');

Route::post('ubah-jenis-surat', 'administrasi\JenisSurat@update');

Route::post('hapus-jenis-barang/{id}', 'administrasi\JenisSurat@delete');

Route::get('tambah-surat-masuk', 'administrasi\Surat@create_surat_masuk');

Route::post('store-surat-masuk', 'administrasi\Surat@store_surat_masuk');

Route::get('ubah-surat-masuk/{id}', 'administrasi\Surat@ubah_surat_masuk');

Route::put('update-surat-masuk/{id}', 'administrasi\Surat@update_surat_masuk');

Route::put('hapus-surat-masuk/{id}', 'administrasi\Surat@delete_surat_masuk');

Route::get('tambah-surat-keluar', 'administrasi\Surat@create_surat_keluar');

Route::post('store-surat-keluar', 'administrasi\Surat@store_surat_keluar');

Route::get('ubah-surat-keluar/{id}', 'administrasi\Surat@edit_surat_keluar');

Route::put('update-surat-keluar/{id}', 'administrasi\Surat@update_surat_keluar');

Route::put('hapus-surat-keluar/{id}', 'administrasi\Surat@delete_surat_keluar');

Route::get('ambilDataSuratKeluar/{id}', 'administrasi\Surat@ambil_surat_keluar');

Route::post('upload-surat-keluar', 'administrasi\Surat@upload_surat_keluar');

Route::post('upload-status-surat-keluar', 'administrasi\Surat@upload_status_surat_keluar');

//--- Proposal ---

Route::get('Proposal', 'administrasi\Proposal@index');

Route::get('tambah-proposal', 'administrasi\Proposal@create');

Route::post('store-proposal', 'administrasi\Proposal@store');

Route::get('ubah-proposal/{id}', 'administrasi\Proposal@edit');

Route::put('update-proposal/{id}', 'administrasi\Proposal@update');

Route::put('delete-proposal/{id}', 'administrasi\Proposal@delete');

Route::post('upload-cover-proposal', 'administrasi\Proposal@uploadCoverProposal');

Route::post('upload-doc-proposal', 'administrasi\Proposal@uploadDocProposal');

Route::post('cari-proposal', 'administrasi\Proposal@cari');

Route::put('ubah-status-proposal/{id}', 'administrasi\Proposal@ubah_status_proposal');

Route::post('store-jenis-proposal', 'administrasi\JenisProposal@store');

Route::get('jenis-proposal', 'administrasi\JenisProposal@index');

Route::get('jenis-proposal/{id}', 'administrasi\JenisProposal@edit');

Route::post('ubah-jenis-proposal', 'administrasi\JenisProposal@update');

Route::post('delete-jenis-proposal', 'administrasi\JenisProposal@delete');

//--- Arsip ---

Route::get('Arsip', 'administrasi\Arsip@index');

Route::get('ambil-jenis-arsip', 'administrasi\JenisArsip@index');

Route::post('store-jenis-arsip', 'administrasi\JenisArsip@store');

Route::post('ubah-jenis-arsip', 'administrasi\JenisArsip@update');

Route::post('hapus-jenis-arsip', 'administrasi\JenisArsip@delete');

Route::get('ambil-jenis-arsip/{id}', 'administrasi\JenisArsip@edit');

Route::get('tambah-arsip', 'administrasi\Arsip@create');

Route::post('store-arsip', 'administrasi\Arsip@store');

Route::get('ubah-arsip/{id}', 'administrasi\Arsip@edit');

Route::put('update-arsip/{id}', 'administrasi\Arsip@update');

Route::put('hapus-arsip/{id}', 'administrasi\Arsip@delete');

Route::get('cari-arsip', 'administrasi\Arsip@cari');

//--- SPK/Kontrak ---

Route::get('SPK-Kontrak', 'administrasi\SPKKontrak@index');

Route::get('tambah-spk', 'administrasi\SPKKontrak@create');

Route::post('store-spk', 'administrasi\SPKKontrak@store');

Route::get('ubah-spk/{id}', 'administrasi\SPKKontrak@edit');

Route::put('update-spk/{id}', 'administrasi\SPKKontrak@update');

Route::put('hapus-spk/{id}', 'administrasi\SPKKontrak@delete');

Route::post('upload-file-spk', 'administrasi\SPKKontrak@uploadFileKontrak');

Route::post('upload-scan-spk', 'administrasi\SPKKontrak@uploadFileScanSPK');

Route::post('cari-spk', 'administrasi\SPKKontrak@cari');

//--- BApemeriksaan ---

Route::get('BA-Pemeriksaan', 'administrasi\BApemeriksaan@form');

Route::post('Proses-BApem', 'administrasi\BApemeriksaan@proses');

Route::put('Proses-BApem/{id}', 'administrasi\BApemeriksaan@proses_Update');

Route::put('Proses-BApem/{id}/hapus', 'administrasi\BApemeriksaan@proses_delete');

Route::post('cari-bapem', 'administrasi\BApemeriksaan@cari_bapem');

//--- BAkemajuan ---

Route::get('BA-Kemajuan', 'administrasi\BAkemajuan@form');

Route::post('BA-Kemajuan', 'administrasi\BAkemajuan@proses');

Route::put('Proses-BAkem/{id}', 'administrasi\BAkemajuan@proses_Update');

Route::put('Proses-BAkem/{id}/hapus', 'administrasi\BAkemajuan@proses_delete');

Route::post('cari-bakem', 'administrasi\BAkemajuan@cari_bakem');

//--- BApenyelesaian ---

Route::get('BA-Penyelesaian/{id}', 'administrasi\BApenyelesaian@index');

Route::post('BA-Penyelesaian', 'administrasi\BApenyelesaian@menu_modal');

Route::get('BA-penyelesian-tambah/{id}', 'administrasi\BApenyelesaian@create');

Route::post('BA-penyelesian-store', 'administrasi\BApenyelesaian@store');

Route::get('BA-Penyelesaian-ubah/{id}/{id_spk}', 'administrasi\BApenyelesaian@edit');

Route::put('BA-Penyelesaian-update/{id}', 'administrasi\BApenyelesaian@update');

Route::put('BA-Penyelesaian-delete/{id}', 'administrasi\BApenyelesaian@destroy');

Route::post('cari-Penyelesaian', 'administrasi\BApenyelesaian@cari_penye');

//--- BAsertim ---

Route::post('BA-Sertim', 'administrasi\BAsertim@IndexMenu');

Route::get('BA-Serah-Terima/{id}', 'administrasi\BAsertim@index');

Route::get('BA-Sertim-tambah/{id}', 'administrasi\BAsertim@create');

Route::post('BA-Sertim-store', 'administrasi\BAsertim@store');

Route::get('BA-Sertim-ubah/{id}/{id_spk}', 'administrasi\BAsertim@edit');

Route::put('BA-Sertim-update/{id}', 'administrasi\BAsertim@update');

Route::put('BA-Sertim-delete/{id}', 'administrasi\BAsertim@destroy');

Route::post('cari-Sertim', 'administrasi\BAsertim@cari_sertim');

//--- BAserop ---

Route::get('BA-Serah-Terima-Operasional/{id}', 'administrasi\BAserop@index');

Route::get('BA-Serops-tambah/{id}', 'administrasi\BAserop@create');

Route::post('BA-Serops-store', 'administrasi\BAserop@store');

Route::get('BA-Serops-ubah/{id}/{id_spk}', 'administrasi\BAserop@edit');

Route::put('BA-Serops-update/{id}', 'administrasi\BAserop@update');

Route::put('BA-Serops-delete/{id}', 'administrasi\BAserop@delete');

Route::post('cari-serops', 'administrasi\BAserop@cari');

Route::post('BA-Serah-Terima-Operasional', 'administrasi\BAserop@MenuIndex');

//--- Peralatan ---

Route::get('Peralatan', 'administrasi\Peralatan@index');

Route::get('tambah-peralatan', 'administrasi\Peralatan@create');

Route::post('store-peralatan', 'administrasi\Peralatan@store');

Route::get('ubah-peralatan/{id}', 'administrasi\Peralatan@edit');

Route::put('update-peralatan/{id}', 'administrasi\Peralatan@update');

Route::put('delete-peralatan/{id}', 'administrasi\Peralatan@delete');

Route::get('cari-peralatan', 'administrasi\Peralatan@cari');

//--- Jenis Rapat ---

Route::get('Pengaturan-rapat', 'administrasi\JenisRapat@index');

Route::post('store-jenis-rapat', 'administrasi\JenisRapat@store');

Route::get('edit-jenis-rapat/{id}', 'administrasi\JenisRapat@edit');

Route::put('update-jenis-rapat', 'administrasi\JenisRapat@update');

Route::put('delete-jenis-rapat/{id}', 'administrasi\JenisRapat@delete');

//--- Brifing ---

Route::get('Brifing', 'administrasi\Brifing@index');

Route::get('lihat-usulan-brifing', 'administrasi\Brifing@ambilEventBrifing');

Route::post('lihat-usulan-brifing-by-tgl', 'administrasi\Brifing@ambilEventBrifingByTanggal');

Route::post('store-brifing', 'administrasi\Brifing@store');

Route::put('delete-brifing/{id}', 'administrasi\Brifing@destroy');

Route::post('reply-brifing', 'administrasi\Brifing@store_brifing');

Route::put('delete-reply/{id}', 'administrasi\Brifing@delete_brifing');

//--- AgendaHarian ---

Route::get('Agenda-Harian', 'administrasi\AgendaHarian@index');

Route::get('lihat-usulan-brifing', 'administrasi\AgendaHarian@ambilEventBrifing');

Route::post('lihat-usulan-brifing-by-tgl', 'administrasi\AgendaHarian@ambilEventBrifingByTanggal');

Route::post('store-agenda', 'administrasi\AgendaHarian@store');

Route::put('delete-agenda/{id}', 'administrasi\AgendaHarian@destroy');

//--- Pengumuman ---

Route::get('Pengumuman', 'administrasi\Pengumuman@index');

Route::get('tambah-pengumuman', 'administrasi\Pengumuman@create');

Route::post('store-pengumuman', 'administrasi\Pengumuman@store');

Route::get('ubah-pengumuman/{id}', 'administrasi\Pengumuman@edit');

Route::put('update-pengumuman/{id}', 'administrasi\Pengumuman@update');

Route::put('delete-pengumuman/{id}', 'administrasi\Pengumuman@delete');


//============================================ Produksi ================================================================

//--- Barang ---

Route::get('Barang', 'produksi\Barang@index');
Route::post('getHargaBarang', 'produksi\Barang@respons_harga_barang');
Route::get('tambah-barang', 'produksi\Barang@create');

Route::post('store-barang', 'produksi\Barang@store');

Route::get('ubah-barang/{id}', 'produksi\Barang@edit');

Route::put('update-barang/{id}', 'produksi\Barang@update');

Route::put('delete-barang/{id}', 'produksi\Barang@destroy');

Route::post('import-barang', 'produksi\Barang@import_barang');

Route::post('cari-barang', 'produksi\Barang@show');

Route::resource('harga-jual-satuan', 'produksi\HargaJualSatuan');
Route::get('harga-jual-satuan/{id_barang}/create', 'produksi\HargaJualSatuan@create');
Route::put('harga-jual-satuan/{id_harga_jual}/delete', 'produksi\HargaJualSatuan@destroy');

Route::post('banyak-barang', 'produksi\HargaJualBaseOnJumlah@create');
Route::get('harga-jual-baseon-jumlah/{id}', 'produksi\HargaJualBaseOnJumlah@index');
Route::resource('harga-jual-baseon-jumlah', 'produksi\HargaJualBaseOnJumlah');
Route::get('harga_jual_base_on_jumlah/{id}', 'produksi\HargaJualBaseOnJumlah@show');
Route::put('harga-jual-baseon-jumlah/{id}/delete', 'produksi\HargaJualBaseOnJumlah@delete');

Route::resource('atur-konversi', 'produksi\AturKonversi');
Route::put('atur-konversi/{id}/delete', 'produksi\AturKonversi@delete');
Route::put('atur-konversi/{id}/konversi', 'produksi\AturKonversi@konversi');

Route::post('transfer_barang', 'produksi\Barang@transerBarang');

//--- Supplier ---

Route::get('Supplier', 'produksi\Supplier@index');

Route::get('tambah-supplier', 'produksi\Supplier@create');

Route::post('store-supplier', 'produksi\Supplier@store');

Route::get('ubah-supplier/{id}', 'produksi\Supplier@edit');

Route::put('update-supplier/{id}', 'produksi\Supplier@update');

Route::put('hapus-supplier/{id}', 'produksi\Supplier@delete');

Route::resource('RekSupplier', 'produksi\RekSupplier',['except'=>['index', 'show']]);


# Todo Penawaran Pembelian

Route::resource('tawar-beli', 'produksi\TawarBeli');
Route::get('tawar-beli/{id}/hapus', 'produksi\TawarBeli@destroy');
Route::post('tambah-pembelian-penawaran-barang/{id_tawar}', 'produksi\TawarBeli@storePenawaranBarang');
Route::put('ubah-pembelian-penawaran-barang/{id_tb}', 'produksi\TawarBeli@updatePenawaranBarang');
Route::get('hapus-pembelian-penawaran-barang/{id_tb}', 'produksi\TawarBeli@deletePenawaranBarang');



# Todo Pesanan Pembelian
Route::resource('pesanan-pembelian', 'produksi\PesananPembelian');
Route::post('pesanan-pembelian/{id}/hapus', 'produksi\PesananPembelian@delete');
Route::get('rincian-penawaran/{id}', 'produksi\PesananPembelian@RincianBarangPenawaran');

# Todo Pembelian ---

Route::get('Pembelian', 'produksi\BeliBarang@index');

Route::get('tambah-pembelian', 'produksi\BeliBarang@create');

Route::get('show-barang-pembelian/{id_pesanan_pembelian}', 'produksi\PesananPembelian@show');
Route::post('tambah-barang-pembelian/{id_pesanan_pembelian}', 'produksi\PesananPembelian@tambah_Pesanan_pembelian');
Route::post('ubah-barang-pembelian/{id_pesanan_pembelian}', 'produksi\PesananPembelian@ubah_Pesanan_pembelian');
Route::get('hapus-barang-pembelian/{id_pesanan_pembelian}', 'produksi\PesananPembelian@hapus_Pesanan_pembelian');
Route::post('ubah-pesanan-pembelian/{id_pesanan_pembelian}', 'produksi\PesananPembelian@ubah_Pesanan_pembelian_po');
Route::get('Order/pesanan_pembelian/{jenis_pembelian}','produksi\PesananPembelian@show_pesanan_pembelian');
Route::get('rincian-pembayaran/{id}','produksi\Bayar@show_rincian');


Route::resource('akun-pembelian','produksi\AkunPembelian');
Route::get('hapus-akun-pembelian/{id}','produksi\AkunPembelian@delete');

Route::get('bayar/{id_po}/bayar-po/{jenis_pembayaran}','produksi\Bayar@show_po');
Route::get('bayar/{id_po}/bayar-order/{jenis_pembayaran}','produksi\Bayar@show_order');
Route::post('bayar-po','produksi\Bayar@bayar_po');
Route::post('bayar-order','produksi\Bayar@bayar_order');

Route::get('return-barang/{id_order}','produksi\ReturnPembelian@show');
Route::post('simpan-return-barang','produksi\ReturnPembelian@store');
Route::get('preview-return-barang/{id_order}','produksi\ReturnPembelian@preview');

Route::get('status-return/{id_pembelian}','produksi\CekBarang@showCek');

Route::post('store-beli-barang', 'produksi\BeliBarang@store');

Route::get('ubah-pembelian/{id}', 'produksi\BeliBarang@edit');

Route::put('update-beli-barang/{id}', 'produksi\BeliBarang@update');

Route::put('hapus-pembelian/{id}', 'produksi\BeliBarang@delete');


# Todo P Order

Route::resource('Oder', 'produksi\POrder');

Route::post('Order/{id}/simpan', 'produksi\POrder@tambahDetailOrder');

Route::post('Order/{id}/simpan-rincian-pembelian', 'produksi\POrder@simpan_rincian_pembelian');

Route::post('Order/ubah-rincian-pembelian/{id_detail_pembelian}', 'produksi\POrder@ubah_detail_order');

Route::get('hapus-detail-order/{id_detail_order}', 'produksi\POrder@hapusDetailOrder');

Route::get('hapus-detail-order/{id_detail_order}', 'produksi\POrder@hapusDetailOrder');

Route::resource('cek-barang', 'produksi\CekBarang');

//---- Penawaran --------
Route::resource('penawaran-penjualan','produksi\TawarJual');

Route::resource('detail-barang-Tpenjualan','produksi\DetailBarangTawar');
Route::get('detail-barang-Tpenjualan/{id}/delete','produksi\DetailBarangTawar@delete');

Route::resource('pesanan-penjualan', 'produksi\PesananPenjualan');
Route::post('pesanan-penjualan/{id_so}','produksi\PesananPenjualan@updateSO_BaseOnDetailSO');
Route::resource('detail-pSo', 'produksi\DetailSo');
Route::get('detail-pSo/{id_detail_pso}/delete', 'produksi\DetailSo@delete');
//--- Penjualan ---

Route::get('Penjualan', 'produksi\JualBarang@index');
//
//Route::get('tambah-penjualan', 'produksi\JualBarang@create');
//
//Route::post('store-penjualan', 'produksi\JualBarang@store');
//
//Route::get('ubah-penjualan/{id}', 'produksi\JualBarang@edit');
//
//Route::put('update-penjualan/{id}', 'produksi\JualBarang@update');
//
//Route::put('hapus-penjualan/{id}', 'produksi\JualBarang@destory');
# History Penjulan
Route::resource('riwayat-harga-penjualan','produksi\HistoryPenjualan');

# Setting kasir
Route::resource('setting-kasir','produksi\SettingKasir');
Route::resource('setting-akun-kasir','produksi\SettingAkungKasir');
Route::get('setting-akun-kasir/{id}/delete','produksi\SettingAkungKasir@delete');

Route::resource('kerja-kasir','produksi\KerjaKasir');
Route::post('kerja-kasir/masuk-kerja','produksi\KerjaKasir@show_shift_kerja');

# Komisi Sales

Route::resource('komisi-sales','produksi\KomisiSales');

# Diskon
Route::resource('p-diskon', 'produksi\PDiskon');

# Penjualan
Route::resource('penjualan-barang','produksi\PSales');
Route::post('penjualan-barang/{id_p_sales}/detail','produksi\PSales@updateDetail');
Route::get('penjualan-barang/{id_p_sales}/complain','produksi\PSales@complain');
#detail penjualan
#pake resource post detail-penjualan-barang return 404 terus
//Route::resource('detail-penjualan-barang','produksi\RincianSales');
Route::post('detail-penjualan-barang','produksi\DetailSales@store');
Route::get('detail-penjualan-barang/{id_detail_penjualan}/destroy','produksi\DetailSales@destroy');

Route::get('terima-bayar/{jenis_bayar}/{id}','produksi\TerimaBayar@form_terima_bayar');
Route::get('terima-bayar/{jenis_bayar}/{id}/rincian','produksi\TerimaBayar@rincian');
Route::get('terima-bayar/{jenis_bayar}/{id}/edit','produksi\TerimaBayar@edit');
Route::resource('terima-bayar','produksi\TerimaBayar');

#complain barang jual
Route::resource('complain-barang-jual','produksi\ComplainBarangJual');
//--- Jasa ---
Route::resource('return-barang-jual','produksi\ReturnBarangJual');
Route::get('cetak-return-barang-jual/{id}','produksi\ReturnBarangJual@cetak');

# Akun Penjualan
Route::resource('pengaturan-akun-penjualan','produksi\AkunPenjualan');
Route::get('pengaturan-akun-penjualan/{id}/delete','produksi\AkunPenjualan@destroy');


//--- Jasa ---

Route::resource('Jasa','produksi\Jasa');

Route::resource('Proses-Bisnis','produksi\ProsesBisnis',['except'=>['index', 'show']]);

Route::resource('SK-Jasa','produksi\SKJasa',['except'=>['index', 'show']]);

Route::resource('Order-Jasa', 'produksi\OrderJasa');

Route::get('rincian-orderjasa/{id}', 'produksi\OrderJasa@rincian_orderjasa');
Route::post('tambah-rincian-orderjasa/{id_order_jasa}', 'produksi\OrderJasa@rincian_orderjasa_store');
Route::put('ubah-detail-orderjasa/{id_detail_orderjasa}', 'produksi\OrderJasa@rincian_orderjasa_update');
Route::put('tambah-dp-orderjasa/{id_order_jasa}', 'produksi\OrderJasa@uangmuka_orderjasa_store');
Route::get('hapus-detail-orderjasa/{id_detail_orderjasa}', 'produksi\OrderJasa@rincian_orderjasa_delete');
Route::put('ubah-status-service/{id}', 'produksi\OrderJasa@ubah_status_service');

Route::post('store-doservice', 'produksi\OrderJasa@store_doservice');

Route::get('ubah-PLAwal/{id_pl}', 'produksi\OrderJasa@editPLAwal');
Route::post('update-PLAwal', 'produksi\OrderJasa@updatePLAwal');

Route::get('ubah-PLSelesai/{id_pl}', 'produksi\OrderJasa@editPLSelesai');
Route::post('update-PLSelesai', 'produksi\OrderJasa@updatePLSelesai');

Route::get('ubah-PLConfirm/{id_pl}', 'produksi\OrderJasa@editPLConfirm');
Route::post('update-PLConfirm', 'produksi\OrderJasa@updatePLConfirm');

Route::get('ubah-PLStatusAkhir/{id_pl}', 'produksi\OrderJasa@editPLStatusAkhir');
Route::post('update-PLStatusAkhir', 'produksi\OrderJasa@updatePLStatusAkhir');

//--- Proyek ---

Route::get('Proyek', 'produksi\Proyek@index');

Route::get('tambah-proyek', 'produksi\Proyek@create');

Route::post('store-proyek', 'produksi\Proyek@store');

Route::get('ubah-proyek/{id}', 'produksi\Proyek@edit');

Route::put('update-proyek/{id}', 'produksi\Proyek@update');

Route::put('delete-proyek/{id}', 'produksi\Proyek@delete');

Route::post('cari-proyek', 'produksi\Proyek@cari');

//Tim Proyek = Tim Produksi

Route::get('Tim-Produksi', 'produksi\TimProyek@index');

Route::post('store-tim-project', 'produksi\TimProyek@store');

Route::put('delete-tim-proyek/{id}', 'produksi\TimProyek@destroy');

Route::post('cari-tim-proyek', 'produksi\TimProyek@cari');

//--- Jadwal Proyek ---

Route::get('Jadwal-Proyek', 'produksi\JadwalProyek@index');

Route::get('tambah-jadwal-proyek', 'produksi\JadwalProyek@create');

Route::post('store-jadwal-proyek', 'produksi\JadwalProyek@store');

Route::get('get_liftOfProyek/{id_proyek}', 'produksi\JadwalProyek@ambilDaftarJadwalProyek');

Route::get('ubah-jadwal-proyek/{id_proyek}', 'produksi\JadwalProyek@edit');

Route::put('update-jadwal-proyek/{id}', 'produksi\JadwalProyek@update');

Route::put('delete-jadwal-proyek/{id}', 'produksi\JadwalProyek@destroy');

Route::post('cari-jadwal-proyek', 'produksi\JadwalProyek@show');

//--- Task Proyek ---

Route::get('tambah-taskproyek', 'produksi\TaskProyek@create');

Route::post('store-taksproyek', 'produksi\TaskProyek@store');

Route::get('ubah-taksproyek/{id}', 'produksi\TaskProyek@edit');

Route::put('update-taksproyek/{id}', 'produksi\TaskProyek@update');

Route::put('hapus-taksproyek/{id}', 'produksi\TaskProyek@destroy');

//--- Rincian Tugas ---

Route::get('tambah-rincian-tugas', 'produksi\RincianTugas@create');

Route::post('store-rincian-tugas', 'produksi\RincianTugas@store');

Route::get('ubah-rincian-tugas/{id}', 'produksi\RincianTugas@edit');

Route::put('update-rincian-tugas/{id}', 'produksi\RincianTugas@update');

Route::put('hapus-rincian-tugas/{id}', 'produksi\RincianTugas@destroy');

//--- Progress Proyek ---

Route::get('Progress-Proyek', 'produksi\ProgressProyek@index');

Route::get('Daftar-progress/{id_jadwal_proyek}', 'produksi\ProgressProyek@listOfProgress');

Route::post('store-progress-proyek', 'produksi\ProgressProyek@store');

Route::get('ubah-progress-jadwal/{id_progress_proyek}', 'produksi\ProgressProyek@edit');

Route::post('update-progress-proyek', 'produksi\ProgressProyek@update');

Route::put('hapus-progress-jadwal/{id}', 'produksi\ProgressProyek@destroy');

//--- Pemeliharaan ---

Route::get('Pemeliharaan', 'produksi\Pemeliharaan@index');

Route::get('tambah-pemeliharaan', 'produksi\Pemeliharaan@create');

Route::post('store-pemeliharaan', 'produksi\Pemeliharaan@store');

Route::get('ubah-pemeliharaan/{id}', 'produksi\Pemeliharaan@edit');

Route::put('update-pemeliharaan/{id}', 'produksi\Pemeliharaan@update');

Route::put('delete-pemeliharaan/{id}', 'produksi\Pemeliharaan@delete');

Route::post('cari-pemeliharaan', 'produksi\Pemeliharaan@show');

//--- Jenis Pemeliharaan ---

Route::get('tambah-jenis-proyek', 'produksi\JenisPemeliharaan@create');

Route::post('store-jenis-pemeliharaan', 'produksi\JenisPemeliharaan@store');

Route::get('ubah-jenis-pemeliharaan/{id}', 'produksi\JenisPemeliharaan@edit');

Route::put('update-jenis-pemeliharaan/{id}', 'produksi\JenisPemeliharaan@update');

Route::put('hapus-jenis-pemeliharaan/{id}', 'produksi\JenisPemeliharaan@delete');

//--- Progres Pemeliharaan ---

Route::get('Progres-Pemeliharaan', 'produksi\ProgressPemeliharaan@index');

Route::get('lihat-progress/{id_pemeliharaan}', 'produksi\ProgressPemeliharaan@daftar_progress_pemeliharaan');

Route::post('store-progress-pemeliharaan', 'produksi\ProgressPemeliharaan@store');

Route::get('ubah-progress-pemeliharaan/{id}', 'produksi\ProgressPemeliharaan@edit');

Route::post('update-progress-pemeliharaan', 'produksi\ProgressPemeliharaan@update');

Route::put('hapus-progress-pemeliharaan/{id}', 'produksi\ProgressPemeliharaan@delete');


//================================= Marketing ================================================================
//--Segmenting--

Route::get('Segmenting', 'marketing\Segmenting@index');

Route::post('store-segmenting', 'marketing\Segmenting@store');

Route::get('ubah-segmenting/{id}', 'marketing\Segmenting@edit');

Route::put('update-segmenting/{id}', 'marketing\Segmenting@update');

Route::put('hapus-segmenting/{id}', 'marketing\Segmenting@delete');

Route::post('store-segbarang', 'marketing\Segmenting@store_segbarang');

Route::post('store-segjasa', 'marketing\Segmenting@store_segjasa');

Route::post('store-segbarang-geo', 'marketing\Segmenting@store_segbarang_geo');

Route::post('store-segjasa-geo', 'marketing\Segmenting@store_segjasa_geo');

Route::post('store-segbarang-psi', 'marketing\Segmenting@store_segbarang_psi');

Route::post('store-segjasa-psi', 'marketing\Segmenting@store_segjasa_psi');

Route::get('ubah-hasil-segmenting-demog/{id_hasilsg}', 'marketing\Segmenting@edit_hasil_segmenting');

Route::get('ubah-hasil-segmenting-geog/{id_hasilsg}', 'marketing\Segmenting@edit_hasil_segmenting');

Route::get('ubah-hasil-segmenting-psi/{id_hasilsg}', 'marketing\Segmenting@edit_hasil_segmenting');

Route::post('update-hasilsg', 'marketing\Segmenting@update_hasilsg');

Route::get('getHasilSG/{id_hasilsg}', 'marketing\Segmenting@ResponseHasilSG');

Route::post('cari-hasilsg-brg', 'marketing\Segmenting@search_hasilsg_brg');

Route::post('cari-hasilsg-jasa', 'marketing\Segmenting@search_hasilsg_jasa');

//--Targeting---

Route::get('Targeting', 'marketing\Targeting@index');

Route::get('tambah-targeting', 'marketing\Targeting@create_targeting');

Route::post('store-targeting', 'marketing\Targeting@store');

Route::put('hapus-targeting/{id}', 'marketing\Targeting@delete');

//--Positioning---

Route::get('Positioning', 'marketing\PositioningPerusahaan@index');

Route::get('tambah-positioning', 'marketing\PositioningPerusahaan@create');

Route::post('store-positioning', 'marketing\PositioningPerusahaan@store');

Route::get('ubah-positioning/{id}', 'marketing\PositioningPerusahaan@edit');

Route::put('update-positioning/{id}', 'marketing\PositioningPerusahaan@update');

Route::put('hapus-positioning/{id}', 'marketing\PositioningPerusahaan@delete');

Route::get('detail-positioning/{id}', 'marketing\PositioningPerusahaan@detail');

//--Rencana Marketing & Kegiatan Marketing---

Route::get('Rencana-Marketing', 'marketing\RencanaMarketing@index');

Route::post('tambah-rmbj', 'marketing\RencanaMarketing@create');

Route::post('store-rmb-onOff', 'marketing\RencanaMarketing@store_rmb_onOff');

Route::post('store-rmb', 'marketing\RencanaMarketing@store_rmb');

Route::post('store-rmj', 'marketing\RencanaMarketing@store_rmj');

Route::put('hapus-rmbj/{id}', 'marketing\RencanaMarketing@delete');

Route::post('store-target-audience', 'marketing\RencanaMarketing@store_target_audience');

Route::get('getSubMedia/{id_media_marketing}', 'marketing\RencanaMarketing@ResponseSubMedia');

Route::get('getContentMarketing/{id_submedia_marketing}', 'marketing\RencanaMarketing@ResponseContentMarketing');

Route::post('cari-rmbj', 'marketing\RencanaMarketing@search_rmbj');

Route::post('store-keg-marketing', 'marketing\RencanaMarketing@store_keg_marketing');

Route::get('getdataRM/{id}', 'marketing\RencanaMarketing@get_data_RM');

Route::get('getdataKM/{id}', 'marketing\RencanaMarketing@get_data_KM');

//--Attract n Convert--

Route::get('Attract', 'marketing\PelaksanaanMarketing@index');

Route::get('Convert', 'marketing\PelaksanaanMarketing@index_convert');

Route::post('store-respon-attract', 'marketing\PelaksanaanMarketing@store_respon_attract');

Route::post('store-respon-convert', 'marketing\PelaksanaanMarketing@store_respon_convert');

//--Closing--

Route::get('Closing', 'marketing\Close@index');

Route::post('store-closing', 'marketing\Close@store');

Route::post('store-sclosing', 'marketing\Close@store_sclosing');

Route::get('ubah-closing/{id}', 'marketing\Close@edit');

Route::put('update-closing/{id}', 'marketing\Close@update');

Route::get('detail-closing/{id}', 'marketing\Close@detail');

Route::put('hapus-closing/{id}', 'marketing\Close@delete');


//--Delighting--

Route::get('Delight', 'marketing\Delight@index');

Route::post('store-delight', 'marketing\Delight@store');

Route::post('store-respon-delight', 'marketing\Delight@store_respon_delight');

Route::get('ubah-delight/{id}', 'marketing\Delight@edit');

Route::put('update-delight/{id}', 'marketing\Delight@update');

Route::get('detail-delight/{id}', 'marketing\Delight@detail');

Route::put('hapus-delight/{id}', 'marketing\Delight@delete');

//--Delighting--

Route::get('Evaluasi', 'marketing\Evaluasi@index');

Route::post('store-KEvaluasi', 'marketing\Evaluasi@store_KE');

Route::post('store-IEvaluasi', 'marketing\Evaluasi@store_IE');

Route::post('store-SEvaluasi', 'marketing\Evaluasi@store_SE');

Route::post('store-evaluasi-marketing', 'marketing\Evaluasi@store');

Route::post('store-evaluasi-marketing', 'marketing\Evaluasi@store');

Route::get('ubah-evaluasi/{id}', 'marketing\Evaluasi@edit');

Route::put('update-evaluasi/{id}', 'marketing\Evaluasi@update');

Route::put('hapus-evaluasi/{id}', 'marketing\Evaluasi@delete');

//================================= Keuangan ==============================================================
//--tab RPB--
Route::get('RAB', 'keuangan\RAB@index');

Route::post('store-rpb', 'keuangan\RAB@storeRPB');

Route::get('ubah-rpb/{id_rpb}', 'keuangan\RAB@editRPB');

Route::post('update-rpb', 'keuangan\RAB@updateRPB');

Route::put('hapus-rpb/{id}', 'keuangan\RAB@deleteRPB');

//--tab RPJ--

Route::post('store-rpj', 'keuangan\RAB@storeRPJ');

Route::get('ubah-rpj/{id_rpj}', 'keuangan\RAB@editRPJ');

Route::post('update-rpj', 'keuangan\RAB@updateRPJ');

Route::put('hapus-rpj/{id}', 'keuangan\RAB@deleteRPJ');

//--tab RPENGELURAN/ROUT--

Route::post('store-rout', 'keuangan\RAB@storeROUT');

Route::get('ubah-rout/{id_rout}', 'keuangan\RAB@editROUT');

Route::post('update-rout', 'keuangan\RAB@updateROUT');

Route::put('hapus-rout/{id}', 'keuangan\RAB@deleteROUT');

//================================= HRD ======================================================================

Route::get('profil', 'karyawan\Karyawan@index');

Route::post('proses-pendidikan', 'karyawan\Karyawan@proses_pendidikan');

Route::get('getDataPendidikan', 'karyawan\Karyawan@data_pendidikan');

Route::get('getDataAlamatAsal', 'karyawan\Karyawan@data_alamat');

Route::post('store-alamat-asal', 'karyawan\Karyawan@store_alamat');

Route::get('getDataAlamatSek', 'karyawan\Karyawan@data_alamat_sek');

Route::post('store-alamat-sek', 'karyawan\Karyawan@store_alamat_sek');

Route::get('getDataKeluarga', 'karyawan\Karyawan@data_keluarga');

Route::post('update-keluarga-ky', 'karyawan\Karyawan@update_keluarga');

Route::post('update-keluarga-ky-file', 'karyawan\Karyawan@update_upload_kk_keluarga');

Route::post('tambah-alamat-email-ky', 'karyawan\Karyawan@store_email');

Route::put('hapus-email-ky/{id}', 'karyawan\Karyawan@delete_email');

Route::post('tambah-alamat-handphone-ky', 'karyawan\Karyawan@store_hp');

Route::put('hapus-hp-ky/{id}', 'karyawan\Karyawan@delete_hp');

//----tambahan baru routes HRD--------------

//--- Karyawan ---

Route::get('Karyawan', 'hrd\Karyawan@index');

Route::get('tambah-karyawan', 'hrd\Karyawan@tambah_karyawan');

Route::post('store-karyawan/hrd', 'hrd\Karyawan@store');

Route::get('ubah-karyawan/{id}', 'hrd\Karyawan@edit_karyawan');

Route::put('update-hrd-karyawan/{id}', 'hrd\Karyawan@update');

Route::get('hapus-karyawan/{id}', 'hrd\Karyawan@delete');


Route::get('tambah-rencana-pelatihan', 'hrd\RencanaPelatihan@create');

Route::post('store-rencana-pelatihan', 'hrd\RencanaPelatihan@store');

Route::get('ubah-rencana-pelatihan/{id}', 'hrd\RencanaPelatihan@edit');

Route::post('update-rencana-pelatihan/{id}', 'hrd\RencanaPelatihan@update');

Route::put('hapus-rencana-pelatihan/{id}', 'hrd\RencanaPelatihan@delete');

Route::get('daftarkan-peserta-mengikuti-pelatihan/{id_pelatihan}', 'hrd\RencanaPelatihan@daftar_karyawan');

Route::post('daftarkan_peserta', 'hrd\RencanaPelatihan@store_pelatihan');

Route::post('batal_daftarkan_peserta', 'hrd\RencanaPelatihan@delete_pelatihan');

Route::get('Buku-Penilaian', function () {
	return view('user.hrd.section.penilaian_karyawan.PA.page_default');
});

Route::get('Performance-Appraisal', 'hrd\BukuPenilaian@PA');

Route::get('Aspek-Pa', 'hrd\AspekPenilaian@index');

Route::post('store-aspek-penilaian', 'hrd\AspekPenilaian@store');

Route::get('edit-Pa/{id}', 'hrd\AspekPenilaian@edit');

Route::post('update-aspek-penilaian', 'hrd\AspekPenilaian@update');

Route::put('hapus-PA/{id}', 'hrd\AspekPenilaian@deletes');

Route::get('Area-Kerja-Utama', 'hrd\AreaKerjaUtama@index');

Route::post('store-area-kerja-utama', 'hrd\AreaKerjaUtama@store');

Route::get('edit-Aku/{id}', 'hrd\AreaKerjaUtama@edit');

Route::post('update-area-kerja-utama', 'hrd\AreaKerjaUtama@update');

Route::put('hapus-area-kerja-utama/{id}', 'hrd\AreaKerjaUtama@delete');

Route::get('satuan-kpi', 'hrd\SatuanKpi@index');

Route::post('store-satuan-kpi', 'hrd\SatuanKpi@store');

Route::get('edit-satuan-kpi/{id}', 'hrd\SatuanKpi@edit');

Route::post('update-satuan-kpi', 'hrd\SatuanKpi@update');

Route::put('hapus-satuan-kpi/{id}', 'hrd\SatuanKpi@delete');

Route::get('jenis-kpi', 'hrd\JenisKPI@index');

Route::post('store-jenis-kpi', 'hrd\JenisKpi@store');

Route::get('edit-jenis-kpi/{id}', 'hrd\JenisKpi@edit');

Route::post('update-jenis-kpi', 'hrd\JenisKpi@update');

Route::put('hapus-jenis-kpi/{id}', 'hrd\JenisKpi@delete');

Route::get('Kpi', 'hrd\Kpi@index');

Route::post('store-kpi', 'hrd\Kpi@store');

Route::get('edit-kpi/{id}', 'hrd\Kpi@edit');

Route::post('update-kpi', 'hrd\Kpi@update');

Route::put('hapus-kpi/{id}', 'hrd\Kpi@delete');

Route::get('Kpi-karyawan', 'hrd\KpiKaryawan@index');

Route::post('store-kpi-karyawan', 'hrd\KpiKaryawan@store');

Route::get('edit-kpi-ky/{id}', 'hrd\KpiKaryawan@edit');

Route::post('update-kpi-ky', 'hrd\KpiKaryawan@update');

Route::put('hapus-kpi-ky/{id}', 'hrd\KpiKaryawan@delete');



Route::get('jenis-kompetensi', 'hrd\JenisKompetensi@index');

Route::post('store-jenis-kompetensi', 'hrd\JenisKompetensi@store');

Route::get('edit-jenis-kompetensi/{id}', 'hrd\JenisKompetensi@edit');

Route::post('update-jenis-kompetensi', 'hrd\JenisKompetensi@update');

Route::put('hapus-jenis-kompetensi/{id}', 'hrd\JenisKompetensi@delete');

Route::get('kompetensi-majerial', 'hrd\JenisKompetensiManaJerial@index');

Route::post('store-kompetensi-majerial', 'hrd\JenisKompetensiManaJerial@store');

Route::get('edit-kmanajerial/{id}', 'hrd\JenisKompetensiManaJerial@edit');

Route::post('update-kmanajerial', 'hrd\JenisKompetensiManaJerial@update');

Route::put('hapus-kmanajerial/{id}', 'hrd\JenisKompetensiManaJerial@delete');

Route::get('item-kompetensi-manajerial', 'hrd\ItemKmanajerial@index');

Route::post('store-item-kompetensi-majerial', 'hrd\ItemKmanajerial@store');

Route::get('edit-item-kmanajerial/{id}', 'hrd\ItemKmanajerial@edit');

Route::post('update-item-kmanajerial', 'hrd\ItemKmanajerial@update');

Route::put('hapus-item-kmanajerial/{id}', 'hrd\ItemKmanajerial@delete');

Route::get('kompetensi-teknis', 'hrd\KompetensiTeknis@index');

Route::post('store-kompetensi-teknis', 'hrd\KompetensiTeknis@store');

Route::get('edit-kompetensi-teknis/{id}', 'hrd\KompetensiTeknis@edit');

Route::post('update-kompetensi-teknis', 'hrd\KompetensiTeknis@update');

Route::put('hapus-kompetensi-teknis/{id}', 'hrd\KompetensiTeknis@delete');

Route::get('penilian-kemanajerial/{id}', 'hrd\KompetensiTeknis@create');

Route::get('Tes-kemanajerial', 'hrd\TesKemanajerial@index');

Route::post('store-tes-kmanajerial', 'hrd\TesKemanajerial@store');

Route::get('Kompensasi-Kinerja', 'hrd\KompensasiKinerja@index');

Route::post('store-kompensasi-kinerja', 'hrd\KompensasiKinerja@store');

Route::get('edit-kompensasi-kinerja/{id}', 'hrd\KompensasiKinerja@edit');

Route::post('update-kompensasi-kinerja', 'hrd\KompensasiKinerja@update');

Route::put('hapus-kompensasi-kinerja/{id}', 'hrd\KompensasiKinerja@delete');

Route::get('Log-Diary', 'hrd\LogDiary@index');

Route::post('store-LogDiary', 'hrd\LogDiary@store');

Route::get('edit-log-diary/{id}', 'hrd\LogDiary@edit');

Route::post('update-log-diary', 'hrd\LogDiary@update');

Route::get('hapus-log-diary/{id}', 'hrd\LogDiary@delete');

Route::get('formulir-tes-kemanajerialan/{id_ky}', 'hrd\TesKemanajerial@create');

Route::get('edit-tes-kemanajerial/{id}', 'hrd\TesKemanajerial@edit');

Route::post('update-tes-kemanajerial', 'hrd\TesKemanajerial@update');

Route::put('hapus-test-manajerial/{id}', 'hrd\TesKemanajerial@delete');

Route::post('cari-tes-km', 'hrd\TesKemanajerial@show');

Route::get('Tes-kompetensi-teknis', 'hrd\TesKompetensiTeknis@index');

Route::get('formulir-tes-kompetensi-teknis/{id_karyawan}', 'hrd\TesKompetensiTeknis@create');

Route::post('store-tes-kteknis', 'hrd\TesKompetensiTeknis@store');

Route::get('edit-tes-teknis/{id}', 'hrd\TesKompetensiTeknis@edit');

Route::post('update-tes-teknis', 'hrd\TesKompetensiTeknis@update');

Route::put('hapus-test-teknis/{id}', 'hrd\TesKompetensiTeknis@delete');

Route::post('cari-tes-kt', 'hrd\TesKompetensiTeknis@show');

Route::get('item-teknis', 'hrd\ItemKTeknis@index');

Route::post('store-item-kompetensi-teknis', 'hrd\ItemKTeknis@store');

Route::get('edit-item-kteknis/{id}', 'hrd\ItemKTeknis@edit');

Route::post('update-item-kteknis', 'hrd\ItemKTeknis@update');

Route::put('hapus-item-kteknis/{id}', 'hrd\ItemKTeknis@delete');

Route::post('store-predikat-penilaian', 'hrd\PredikatPenilaian@store');

Route::get('edit-predikat-penilaian/{id}', 'hrd\PredikatPenilaian@edit');

Route::post('update-predikat-penilaian', 'hrd\PredikatPenilaian@update');

Route::put('delete-predikat-penilaian/{id}', 'hrd\PredikatPenilaian@delete');

Route::get('kompensasi_kinerja_data/{tahun}', 'hrd\PredikatPenilaian@data_kompensasisi');


Route::get('Absensi', 'hrd\Absensi@index');

Route::get('tambah-absensi', 'hrd\Absensi@create');

Route::post('store-absensi', 'hrd\Absensi@store');

Route::get('ubah-absensi/{id}', 'hrd\Absensi@edit');

Route::put('update-absensi/{id}', 'hrd\Absensi@update');

Route::put('delete-absensi/{id}', 'hrd\Absensi@delete');

Route::get('Potongan-tetap', 'hrd\PotonganTetap@index');

Route::post('store-potongan-tetap', 'hrd\PotonganTetap@store');

Route::get('edit-potongan-tetap/{id}', 'hrd\PotonganTetap@edit');

Route::post('update-potongan-tetap', 'hrd\PotonganTetap@update');

Route::put('hapus-potongan-tetap/{id}', 'hrd\PotonganTetap@delete');

Route::get('Potongan-absen', 'hrd\PotonganAbsen@index');

Route::post('store-potongan-absen', 'hrd\PotonganAbsen@store');

Route::get('edit-potongan-absen/{id}', 'hrd\PotonganAbsen@edit');

Route::post('update-potongan-absen', 'hrd\PotonganAbsen@update');

Route::put('hapus-potongan-absen/{id}', 'hrd\PotonganAbsen@delete');


Route::get('detail-daftar-tunjangan/{id}', 'penggajian\TunjanganGaji@create');

Route::post('tambah-daftar-tunganga-gaji', 'penggajian\TunjanganGaji@store');

Route::get('edit-daftar-tunjangan/{id}', 'penggajian\TunjanganGaji@edit');

Route::post('update-daftar-tunjangan', 'penggajian\TunjanganGaji@update');

Route::put('delete-daftar-tunjangan/{id}', 'penggajian\TunjanganGaji@delete');


Route::put('change-status-tunjanganOn/{id}', 'penggajian\TunjanganGaji@updateStatusOn');

Route::put('change-status-tunjanganOff/{id}', 'penggajian\TunjanganGaji@updateStatusOf');

Route::put('change-status-aktif-tunjanganOn/{id}', 'penggajian\TunjanganGaji@updateStatusAktifon');

Route::put('change-status-aktif-tunjanganOff/{id}', 'penggajian\TunjanganGaji@updateStatusAktifof');


Route::get('Tunjangan-gaji', 'penggajian\Tunjangan@index');

Route::get('item-tunjangan', 'penggajian\Tunjangan@item_tunjangan');

Route::post('store-item-tunjagan', 'penggajian\ItemTunjangan@store');

Route::get('edit-item-tunjangan/{id}', 'penggajian\ItemTunjangan@edit');

Route::post('update-item-tunjangan', 'penggajian\ItemTunjangan@update');

Route::put('delete-item-tunjangan/{id}', 'penggajian\ItemTunjangan@delete');

Route::get('Skala-tunjangan', 'penggajian\Tunjangan@skala_tunjangan');

Route::post('store_skala_tunjangan', 'penggajian\SkalaTunjangan@store');

Route::get('edit-skala-tunjangan/{id}', 'penggajian\SkalaTunjangan@edit');

Route::post('update-skala-tunjangan', 'penggajian\SkalaTunjangan@update');

Route::put('delete-skala-tunjangan/{id}', 'penggajian\SkalaTunjangan@delete');

Route::put('status-skala-on/{id}', 'penggajian\SkalaTunjangan@statusOn');

Route::put('status-skala-off/{id}', 'penggajian\SkalaTunjangan@statusOff');


Route::get('Daftar-gaji', 'penggajian\DaftarGaji@index');

Route::get('detail-daftar-gaji/{id}', 'penggajian\DaftarGaji@list');

Route::post('tambah-daftar-gaji', 'penggajian\DaftarGaji@store');

Route::get('edit-daftar-gaji/{id}', 'penggajian\DaftarGaji@edit');

Route::post('update-daftar-gaji', 'penggajian\DaftarGaji@update');

Route::put('hapus-daftar-gaji/{id}', 'penggajian\DaftarGaji@delete');

Route::put('update-status-gaji/{id}', 'penggajian\DaftarGaji@update_status');


Route::get('TunjanganGaji', 'penggajian\Tunjangan@TunjanganGaji');

Route::get('Kelas-proyek', 'penggajian\Tunjangan@KelasProyek');

Route::post('store-kelas-proyek', 'penggajian\KelasProyek@store');

Route::get('edit-kelas-proyek/{id}', 'penggajian\KelasProyek@edit');

Route::post('update-kelas-proyek', 'penggajian\KelasProyek@update');

Route::put('delete-kelas-proyek/{id}', 'penggajian\KelasProyek@delete');

Route::get('Bonus-proyek', 'penggajian\Tunjangan@BonusProyek');

Route::get('Skala-bonus-proyek/{id}', 'penggajian\SkalaBonusProyek@create');

Route::post('proses-skala-bonus-proyek/{id}', 'penggajian\SkalaBonusProyek@store');

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


Route::post('cari-karyawan', 'hrd\Karyawan@cari');

//--- Rekruitmen/loker ---

Route::get('Rekruitmen', 'hrd\Loker@index');

Route::get('tambah-rekrutment', 'hrd\Loker@create');

Route::post('store-rekruitmen', 'hrd\Loker@store');

Route::get('ubah-rekruitmen/{id}', 'hrd\Loker@edit');

Route::put('update-rekruitmen/{id}', 'hrd\Loker@update');

Route::get('hapus-rekruitmen/{id}', 'hrd\Loker@delete');

Route::post('upload-loker', 'hrd\Loker@upload_image');

Route::get('detail-rekruitmen/{id}', 'hrd\Loker@show');

Route::post('cari-rekruitmen', 'hrd\Loker@search');

//--- Lamaran Pekerjaan---

Route::get('Lamaran-Pekerjaan', 'hrd\LamaranPek@index');

Route::get('tambah-lamaran', 'hrd\LamaranPek@create');

Route::post('store-lamaran', 'hrd\LamaranPek@store');

Route::get('ubah-lamaran/{id}', 'hrd\LamaranPek@edit');

Route::put('update-lamaran/{id}', 'hrd\LamaranPek@update');

Route::put('hapus-lamaran/{id}', 'hrd\LamaranPek@delete');

//--- Seleksi---

Route::get('Seleksi', 'hrd\SeleksiBerkas@index');

Route::get('daftar-pelamar/{id}', 'hrd\SeleksiBerkas@show');

Route::get('Seleksi-pesarta/{id_peserta}', 'hrd\SeleksiBerkas@show_peserta');

Route::put('simpan-seleksi/{id_peserta}', 'hrd\SeleksiBerkas@save');

// Tab Psikotes
Route::get('Tes', 'hrd\Tes@psikotes');

Route::get('jenis-psikotes', 'hrd\JenisPsikotes@index');

Route::post('store-jenis-psikotes', 'hrd\JenisPsikotes@store');

Route::get('ubah-jenis-psikotes/{id}', 'hrd\JenisPsikotes@edit');

Route::post('update-jenis-psikotes', 'hrd\JenisPsikotes@update');

Route::put('hapus-jenis-psikotes/{id}', 'hrd\JenisPsikotes@delete');

Route::post('simpan-psikotes', 'hrd\Psikotes@store');

Route::post('cari-loker-psikotes', 'hrd\Tes@search_psikotes');

// Tab wawancara

Route::get('Wawancara', 'hrd\Tes@wawancara');

Route::get('item-wawancara', 'hrd\ItemWawancara@index');

Route::post('store-item-wawancara', 'hrd\ItemWawancara@store');

Route::get('ubah-item-wawancara/{id}', 'hrd\ItemWawancara@edit');

Route::post('update-item-wawancara', 'hrd\ItemWawancara@update');

Route::put('hapus-item-wawancara/{id}', 'hrd\ItemWawancara@delete');

Route::get('mulai-wawancara/{id}', 'hrd\Wawancara@index');

Route::get('tambah-penilaian-wawancara/{id}', 'hrd\Wawancara@create');

Route::put('store-penilaian-wawancara/{id}', 'hrd\Wawancara@store');

Route::get('ubah-hasil-wawancara/{id}', 'hrd\Wawancara@edit');

Route::put('update-penilaian-wawancara/{id}', 'hrd\Wawancara@update');

Route::put('hapus-hasil-wawancara/{id}', 'hrd\Wawancara@delete');

Route::post('cari-loker-wawancara', 'hrd\Tes@show_wawancara');

// Tab Keahlian

Route::get('Keahlian', 'hrd\Tes@keahlian');

Route::get('item-keahlian', 'hrd\ItemKeahlian@index');

Route::post('store-item-keahlian', 'hrd\ItemKeahlian@store');

Route::get('ubah-item-keahlian/{id_item_keahlian}', 'hrd\ItemKeahlian@edit');

Route::post('update-item-keahlian', 'hrd\ItemKeahlian@update');

Route::post('hapus-item-keahlian', 'hrd\ItemKeahlian@delete');

Route::get('mulai-tes-keahlian/{id}', 'hrd\TesKeahlian@index');

Route::get('tambah-penilaian-keahlian/{id}', 'hrd\TesKeahlian@create');

Route::put('store-penilaian-keahlian/{id}', 'hrd\TesKeahlian@store');

Route::get('ubah-hasil-keahlian/{id}', 'hrd\TesKeahlian@edit');

Route::put('update-penilaian-keahlian/{id}', 'hrd\TesKeahlian@update');

Route::put('hapus-hasil-keahlian/{id}', 'hrd\TesKeahlian@delete');

Route::post('cari-loker-keahlian', 'hrd\Tes@show');

Route::get('Hasil-tes', 'hrd\Tes@hasil_tes');

Route::get('keterangan-tambahan/{id_pelamar}', 'hrd\HasilTes@index');

Route::put('store-keterangan/{id_pelamaar}', 'hrd\HasilTes@save');

Route::get('lihat-keterangan/{id_pelamaar}', 'hrd\HasilTes@show');

Route::post('cari-hasil-loker', 'hrd\Tes@cari_hasil');

//--- Kontrak-Kerja---

Route::get('Kontrak-Kerja', 'hrd\KontrakKerja@index');

Route::get('tambah-kontrak', 'hrd\KontrakKerja@create');

Route::post('store-kontrak-kerja', 'hrd\KontrakKerja@store');

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

Route::get('daftar-sertifikasi/{id}', 'hrd\TenagaKerja@daftarSertifikasi');

Route::get('tambah-sertifikasi/{id_user}', 'hrd\TenagaKerja@create');

Route::post('store-sertifikasi', 'hrd\TenagaKerja@store');

Route::get('ubah-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@edit');

Route::put('update-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@update');

Route::put('hapus-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@delete');

//--- Periode-Kerja---

Route::get('Periode-Kerja', 'hrd\PeriodeKerja@index');

Route::get('tambah-periode-kerja', 'hrd\PeriodeKerja@create');

Route::post('store-periode-kerja', 'hrd\PeriodeKerja@store');

Route::get('ubah-periode-kerja/{id}', 'hrd\PeriodeKerja@edit');

Route::put('update-periode-kerja/{id}', 'hrd\PeriodeKerja@update');

Route::put('hapus-periode-kerja/{id}', 'hrd\PeriodeKerja@delete');

//--- Kelender-Kerja---

Route::get('Kelender-Kerja', 'hrd\KalenderKerja@index');

Route::get('daftar-event-kalender', 'hrd\KalenderKerja@daftarEvent');

Route::get('tambah-aktifitas', 'hrd\KalenderKerja@create');

Route::post('store-kalender-kerja', 'hrd\KalenderKerja@store');

Route::get('ubah-kalender-kerja/{id}', 'hrd\KalenderKerja@edit');

Route::put('update-kalender-kerja/{id}', 'hrd\KalenderKerja@update');

Route::put('hapus-kalender-kerja/{id}', 'hrd\KalenderKerja@delete');

Route::get('get-event-calender', 'hrd\KalenderKerja@getEventKalender');

//--- Cuti---

Route::get('Cuti', 'hrd\Cuti@index');

Route::get('tambah-pengaturan-cuti', 'hrd\PengaturanCuti@create');

Route::post('store-pengaturan-cuti', 'hrd\PengaturanCuti@store');

Route::get('ubah-pengaturan-cuti/{id}', 'hrd\PengaturanCuti@edit');

Route::put('update-pengaturan-cuti/{id}', 'hrd\PengaturanCuti@update');

Route::put('hapus-pengaturan-cuti/{id}', 'hrd\PengaturanCuti@delete');

Route::get('tambah-cuti', 'hrd\Cuti@create');

Route::post('store-cuti', 'hrd\Cuti@store');

Route::get('ubah-cuti/{id}', 'hrd\Cuti@edit');

Route::put('update-cuti/{id}', 'hrd\Cuti@update');

Route::put('hapus-cuti/{id}', 'hrd\Cuti@delete');

Route::get('tambah-permintaan-cuti', 'hrd\Permintaan_cuti@create');

Route::post('store-permintaan-cuti', 'hrd\Permintaan_cuti@store');

Route::get('ubah-permintaan-cuti/{id}', 'hrd\Permintaan_cuti@edit');

Route::put('update-permintaan-cuti/{id}', 'hrd\Permintaan_cuti@update');

Route::put('hapus-permintaan-cuti/{id}', 'hrd\Permintaan_cuti@delete');

Route::post('upload-file-permintaan-cuti', 'hrd\Permintaan_cuti@upload');

//--- SOP---

Route::get('SOP', 'hrd\Sop@index');

Route::get('tambah-sop', 'hrd\Sop@create');

Route::post('store-sop', 'hrd\Sop@store');

Route::get('ubah-sop/{id}', 'hrd\Sop@edit');

Route::put('update-sop/{id}', 'hrd\Sop@update');

Route::post('store-jabatan-ky', 'hrd\JabatanKy@storeUpdate');

//================================= Penggjian ==========================================================================

Route::get('Alokasi-Gaji', 'penggajian\AlokasiGaji@index');

Route::post('store-aloasi-gaji', 'penggajian\AlokasiGaji@store');

Route::get('edit-alokasi-gaji/{id}', 'penggajian\AlokasiGaji@edit');

Route::post('update-alokasi-gaji', 'penggajian\AlokasiGaji@update');

Route::put('hapus-alokasi-gaji/{id}', 'penggajian\AlokasiGaji@delete');

Route::get('Compansable-factors', 'penggajian\CompansableFactors@index');

Route::post('store-compansable-factors', 'penggajian\CompansableFactors@store');

Route::get('edit-cf/{id}', 'penggajian\CompansableFactors@edit');

Route::post('update-cf', 'penggajian\CompansableFactors@update');

Route::put('delete-cf/{id}', 'penggajian\CompansableFactors@delete');

Route::get('Sub-Compansable-factors', 'penggajian\SubCF@index');

Route::post('store-sub-cf', 'penggajian\SubCF@store');

Route::get('edit-sub-cf/{id}', 'penggajian\SubCF@edit');

Route::post('update-sub-cf', 'penggajian\SubCF@update');

Route::put('delete-sub-cf/{id}', 'penggajian\SubCF@delete');

Route::get('Content-CF', 'penggajian\ContentCF@index');

Route::get('Pokok-cf', 'penggajian\PokokCF@index');

Route::post('store-pokok-cf', 'penggajian\PokokCF@store');

Route::get('edit-pokok-cf/{id}', 'penggajian\PokokCF@edit');

Route::post('update-pokok-cf', 'penggajian\PokokCF@update');

Route::put('hapus-pokok-cf/{id}', 'penggajian\PokokCF@delete');

Route::get('item-cf', 'penggajian\ItemCf@index');

Route::post('store-item-cf', 'penggajian\ItemCf@store');

Route::get('edit-item-cf/{id}', 'penggajian\ItemCf@edit');

Route::post('update-item-cf', 'penggajian\ItemCf@update');

Route::put('hapus-item-cf/{id}', 'penggajian\ItemCf@delete');

Route::get('content-cf/{id}', 'penggajian\ContentCF@create');

Route::post('store-content-cf', 'penggajian\ContentCF@store');

Route::get('stok-total-compensable-factor', 'penggajian\SkorPosisiCF@index');

Route::post('store-skore-ccf', 'penggajian\SkorPosisiCF@store');

Route::get('Skala-Gaji', 'penggajian\SkalaGaji@index');

Route::post('store-skala-Gaji', 'penggajian\SkalaGaji@store');

Route::post('store-klasifikasi-gaji', 'penggajian\KlasifikasiGaji@store');

Route::get('edit-klasifikasi-gaji/{id}', 'penggajian\KlasifikasiGaji@edit');

Route::post('update-klasifikasi-gaji', 'penggajian\KlasifikasiGaji@update');

Route::put('delete-klasifikasi-gaji/{id}', 'penggajian\KlasifikasiGaji@delete');

Route::post('store-grade-gaji', 'penggajian\Grader@store');

Route::put('delete-grade-gaji/{id}', 'penggajian\Grader@delete');

Route::get('edit-grade-gaji/{id}', 'penggajian\Grader@edit');

Route::post('update-grader-gaji', 'penggajian\Grader@update');

Route::get('daftar-slip-gaji/{id}', 'penggajian\SlipGaji@index');

//Route::post('tambah-slip/{id}','penggajian\SlipGaji@create');

Route::post('store-slip-gaji', 'penggajian\SlipGaji@store');

Route::get('item-gaji/{id}', 'penggajian\SlipGaji@create');

Route::get('edit-slip-gaji/{id}', 'penggajian\SlipGaji@edit');

Route::post('update-slip-gaji', 'penggajian\SlipGaji@update');

Route::put('delete-slip-gaji/{id}', 'penggajian\SlipGaji@delete');


Route::post('store-lembur', 'penggajian\Lembur@store');

Route::put('delete-lembur/{id}', 'penggajian\Lembur@delete');

Route::post('store-tambahan-gaji', 'penggajian\TambahanGaji@store');

Route::put('delete-tambahan/{id}', 'penggajian\TambahanGaji@delete');

Route::post('store-potongan-tambahan', 'penggajian\PotonganTambahan@store');

Route::put('delete-potongan/{id}', 'penggajian\PotonganTambahan@delete');

Route::post('store-bonus-gaji', 'penggajian\G_Bonus_Gaji@store');

Route::put('delete-bonus-proyek/{id}', 'penggajian\G_Bonus_Gaji@delete');


//================================= Investor ==========================================================================
Route::get('Data-Investor', 'investor\DataInvestor@index');

Route::get('tambah-investor', 'investor\DataInvestor@create');

Route::post('store-investor', 'investor\DataInvestor@store');

Route::get('ubah-investor/{id}', 'investor\DataInvestor@edit');

Route::put('update-investors/{id}', 'investor\DataInvestor@update');

Route::put('hapus-investor/{id}', 'investor\DataInvestor@delete');

Route::post('upload-ktp-invest', 'investor\DataInvestor@uploadEktp');

Route::post('upload-photo-invest', 'investor\DataInvestor@uploadPasFotoInvest');


Route::get('Bentuk-Investor', 'investor\BentukInvestor@index');

Route::post('store-bentuk-investor', 'investor\BentukInvestor@store');

Route::get('edit-bentuk-investor/{id}', 'investor\BentukInvestor@edit');

Route::post('update-bentuk-investor', 'investor\BentukInvestor@update');

Route::put('hapus-bentuk-investor/{id}', 'investor\BentukInvestor@delete');


Route::get('Periode-Investasi', 'Investor\PeriodeInvestor@index');

Route::post('store-periode-investasi', 'Investor\PeriodeInvestor@store');

Route::get('edit-periode-investor/{id}', 'Investor\PeriodeInvestor@edit');

Route::post('update-periode-investor', 'Investor\PeriodeInvestor@update');

Route::put('hapus-periode-investor/{id}', 'Investor\PeriodeInvestor@delete');


Route::get('Saham', 'Investor\SahamPerdana@Index');

Route::post('store-saham-perdana', 'Investor\SahamPerdana@store');

Route::get('edit-saham-perdana/{id}', 'Investor\SahamPerdana@edit');

Route::post('update-saham-perdana', 'Investor\SahamPerdana@update');




Route::get('Data-Investasi', 'Investor\DataInvestasi@index');

Route::post('store-investasi', 'Investor\DataInvestasi@store');

Route::get('edit-daftar-investasi/{id}', 'Investor\DataInvestasi@edit');

Route::post('update-daftar-investasi', 'Investor\DataInvestasi@update');

Route::put('hapus-bentuk-investasi/{id}', 'Investor\DataInvestasi@delete');


Route::get('Saham-real', 'Investor\SahamReal@Index');

Route::post('store-saham-real', 'Investor\SahamReal@store');

Route::get('edit-saham-real/{id}', 'Investor\SahamReal@edit');

Route::post('update-saham-real', 'Investor\SahamReal@update');

Route::put('delete-saham-real/{id}', 'Investor\SahamReal@delete');

Route::put('ubah-status-saham-real/{id}', 'Investor\SahamReal@updateStatus');



Route::get('Jual-Saham', 'Investor\JualSahamPersahaan@index');

Route::post('store-jual-saham-perusahaan', 'Investor\JualSahamPersahaan@store');

Route::get('edit-jual-saham-perusahaan/{id}', 'Investor\JualSahamPersahaan@edit');

Route::post('update-jual-saham-perusahaan', 'Investor\JualSahamPersahaan@update');

Route::put('hapus-jual-saham-perusahaan/{id}', 'Investor\JualSahamPersahaan@delete');


Route::get('saham-investor', 'Investor\JualSahamInvestor@index');

Route::post('store-jual-saham-investor', 'Investor\JualSahamInvestor@store');

Route::put('delete-jual-saham-investor/{id}', 'Investor\JualSahamInvestor@deletes');

Route::get('edit-jual-saham-investor/{id}', 'Investor\JualSahamInvestor@edit');

Route::post('update-jual-saham-invest', 'Investor\JualSahamInvestor@update');

Route::get('Dividen', 'Investor\Deviden@index');

Route::post('store-dividen-per-bulan', 'Investor\Deviden@store');

Route::get('edit-divide-bulanan/{id}', 'Investor\Deviden@edit');

Route::post('update-divine-bulanan', 'Investor\Deviden@update');

Route::put('delete-divine-bulanan/{id}', 'Investor\Deviden@delete');

Route::get('getDataDividen/{year}', 'Investor\Deviden@getDataDP');

Route::get('Dividen-Investor', 'Investor\DividenInvestor@index');

Route::post('store-divinden-investor', 'Investor\DividenInvestor@store');

Route::get('edit-dividen-investor/{id}', 'Investor\DividenInvestor@edit');

Route::post('update-dividen-investor', 'Investor\DividenInvestor@update');

Route::put('delete-saham-real/{id}', 'Investor\DividenInvestor@delete');

Route::get('lihat-data-dividen-investor/{id_investor}', 'Investor\DividenInvestor@lihat_data_dividen');

Route::get('Persen-kas', 'Investor\PersenKas@index');

Route::post('store-persen-kas', 'Investor\PersenKas@store');

Route::get('edit-persen-kas/{id}', 'Investor\PersenKas@edit');

Route::post('update-persen-kas', 'Investor\PersenKas@update');

Route::put('hapus-persen-kas/{id}', 'Investor\PersenKas@delete');

Route::get('Pelaku-Investasi', 'Investor\PelakuInvestasi@index');

Route::post('store-pelaksana', 'Investor\PelakuInvestasi@store');

Route::get('edit-pelaksana/{id}', 'Investor\PelakuInvestasi@edit');

Route::post('update-pelaksana', 'Investor\PelakuInvestasi@update');

Route::put('delete-pelaksana/{id}', 'Investor\PelakuInvestasi@delete');


Route::get('Pemodal', 'Investor\Pemodal@index');

Route::post('store-pemodal', 'Investor\Pemodal@store');

Route::get('edit-pemodal/{id}', 'Investor\Pemodal@edit');

Route::post('update-pemodal', 'Investor\Pemodal@update');

Route::put('delete-pemodal', 'Investor\Pemodal@delete');

Route::get('Akad', 'Investor\Akad@index');

Route::post('store-akad', 'Investor\Akad@store');

Route::put('hapus-akad/{id}', 'Investor\Akad@delete');

Route::get('Nisbah', 'Investor\Nisbah@index');

Route::post('store-nisbah', 'Investor\Nisbah@store');

Route::post('store-besar-nisbah', 'Investor\BesarNisbah@store');

Route::get('besar-nisbah/{year}', 'Investor\BesarNisbah@getDataByDate');

Route::put('besar-nisbah-periode/{id}', 'Investor\BesarNisbah@getDataByDatePeriode');

Route::get('edit-besar-nisbah/{id}', 'Investor\BesarNisbah@edit');

Route::post('update-besar-nisbah', 'Investor\BesarNisbah@update');

Route::put('delete-divine-bulananM/{id}', 'Investor\BesarNisbah@delete');

Route::get('group-by/{year}', 'Investor\BesarNisbah@getPeriodeByear');

Route::get('Nisbah-pelaksana', 'Investor\NisbahPelaksana@index');

Route::post('store-nisbah-pelaksana', 'Investor\NisbahPelaksana@store');

Route::get('edit-nisbah-pelaksana/{id}', 'Investor\NisbahPelaksana@edit');

Route::post('update-nisbah-pelaksana', 'Investor\NisbahPelaksana@update');

Route::put('delete-nisbah-pelaksana/{id}', 'Investor\NisbahPelaksana@delete');

Route::get('data-pelaksana/{id}', 'Investor\NisbahPelaksana@data_pelaksana');

Route::get('Nisbah-pemodal', 'Investor\NisbahPemodal@index');

Route::post('store-nisbah-pemodal', 'Investor\NisbahPemodal@store');


Route::get('edit_dividen_pemodal/{id}', 'Investor\NisbahPemodal@edit');

Route::post('update-nisbah-pemodal', 'Investor\NisbahPemodal@update');

Route::put('delete-nisbah-pemodal/{id}', 'Investor\NisbahPemodal@delete');

Route::get('data-pemodal/{id}', 'Investor\NisbahPemodal@data_pemodal');

Route::put('hapus-sop/{id}', 'hrd\Sop@delete');

//--- Rencana-Pelatihan---

Route::get('Rencana-Pelatihan', 'hrd\RencanaPelatihan@index');


//===================================== Keuangan =====================================================================

Route::get('Akun', 'keuangan\Akun@index');

Route::post('store_master_akun_to_ukm', 'keuangan\Akun@store_akun_ukm');

Route::post('nonaktif_master_akun_to_ukm', 'keuangan\Akun@delete_akun_ukm');

Route::post('store_master_sub_akun_to_sub_akun', 'keuangan\Akun@store_akun_sub_ukm');

Route::get('daftar-akun', 'keuangan\Akun@Daftar_akun');

Route::get('edit-sub-sub-akun/{id}', 'keuangan\Akun@edit_sub_sub_akun');

Route::post('update-sub-sub-akun', 'keuangan\Akun@update_sub_sub_akun');

Route::post('hidden-sub-sub-akun/{id}', 'keuangan\Akun@hidden_sub_sub_akun');

Route::post('store-sub-sub-akun', 'keuangan\Akun@store_sub_sub_akun');

Route::get('edit-sub-akun/{id}', 'keuangan\Akun@edit_akun_sub');

Route::post('update-sub-akun', 'keuangan\Akun@update_akun_sub');

Route::post('hidden-sub-akun/{id}', 'keuangan\Akun@hidden_akun_sub');

Route::post('store-sub-akun', 'keuangan\Akun@store_akun_sub');

Route::post('tambah-ke-akun-aktif', 'keuangan\AkunAktifUkm@store');

//====================================== Penerimaan ===================================================================

Route::get('Transaksi', 'keuangan\Penerimaan@index');

Route::get('data-penerimaan', 'keuangan\Penerimaan@get_penerimaan');

Route::post('store-transaksi-penerimaan', 'keuangan\Penerimaan@store');

Route::post('detail-keterangan-transaksi', 'keuangan\Penerimaan@detail_keterangan');

Route::put('update-transaksi-penerimaan/{id}', 'keuangan\Penerimaan@update_keterangan');

Route::put('delete-transaksi-penerimaan/{id}', 'keuangan\Penerimaan@delete_keterangans');

Route::get('data-keterangan-transaksi/{id}', 'keuangan\Penerimaan@data_keterangan_transaksi');

Route::post('store-jurnal', 'keuangan\Penerimaan@store_jurnal_penerimaan');

Route::post('delete-keterangan-transaksi', 'keuangan\Penerimaan@delete_keterangan_transaksi');

//===================================================== Pengeluaran ===================================================

Route::get('Pengeluaran', 'keuangan\Pengeluaran@index');

Route::get('data-pengeluaran', 'keuangan\pengeluaran@get_pengeluaran');

Route::post('store-transaksi-pengeluaran', 'keuangan\pengeluaran@store');

Route::post('detail-keterangan-transaksi-pengeluaran', 'keuangan\Pengeluaran@detail_keterangan');

Route::put('update-transaksi-pengeluaran/{id}', 'keuangan\Pengeluaran@update_keterangan');

Route::put('delete-transaksi-pengeluaran/{id}', 'keuangan\Pengeluaran@delete_keterangans');

Route::get('data-keterangan-transaksi-pengeluaran/{id}', 'keuangan\Pengeluaran@data_keterangan_transaksi');

Route::post('store-jurnal-pengeluaran', 'keuangan\Pengeluaran@store_jurnal_pengeluaran');



Route::get('Daftar-Jurnal', 'keuangan\DaftarJurnal@index');

Route::get('edit-jurnal/{no_transaksi}', 'keuangan\DaftarJurnal@edit');

Route::post('update-jurnal', 'keuangan\DaftarJurnal@update');

Route::put('hapus-jurnal', 'keuangan\DaftarJurnal@delete');

Route::get('Saldo-awal', 'keuangan\SaldoAwal@index');

Route::post('store-saldo-awal', 'keuangan\SaldoAwal@store_jurnal_awal');

Route::get('Jurnal-Umum', 'keuangan\JurnalUmum@index');

Route::post('store-saldo-awal', 'keuangan\JurnalUmum@store_jurnal_awal');

Route::get('Jurnal-Penyesuaian', 'keuangan\JurnalPernyesuaian@index');

Route::post('tutup-buku', 'keuangan\TutupBuku@store');

// =================================================== Laporan Keuangan ==============================================

Route::get('Laporan-jurnal', 'keuangan\LaporanKeuangan@dataJurnal');

Route::get('Laporan-keuangan', 'keuangan\report\JurnalUmum@index');

Route::get('tampilan-cetak-jurnal-umum/{tgl_awal}/{tgl_akhir}', 'keuangan\report\JurnalUmum@print');
//Route::get('tampilan-cetak-jurnal-umum/{tgl_awal}/{tgl_akhir}','keuangan\LaporanKeuangan@cetak_jurnal_umum');

Route::post('tampilkan-jurnal-berdasarkan-tanggal', 'keuangan\report\JurnalUmum@preview');

Route::post('cetak-jurnal-umum', 'keuangan\LaporanKeuangan@dataBaseOnDate');

Route::get('buku-besar', 'keuangan\report\BukuBesar@index');
//Route::get('buku-besar','keuangan\LaporanKeuangan@buku_besar');

Route::get('data-buku-besar', 'keuangan\LaporanKeuangan@dataBukuBesars');

Route::get('tampilan-cetak-buku-besar/{tgl_awal}/{tgl_akhir}', 'keuangan\report\BukuBesar@preview');

Route::get('print-buku-besar/{tgl_awal}/{tgl_akhir}', 'keuangan\report\BukuBesar@print');

//Route::get('neraca-saldo','keuangan\LaporanKeuangan@neraca_saldo');
Route::get('neraca-saldo', 'keuangan\report\NeracaSaldo@index');

Route::get('data-neraca-saldo', 'keuangan\LaporanKeuangan@dataNeracaSaldo');

Route::get('tampilan-cetak-neraca-saldo/{tgl_awal}/{tgl_akhir}', 'keuangan\report\NeracaSaldo@print');

//Route::get('Laba-rugi','keuangan\LaporanKeuangan@laba_rugi');
Route::get('Laba-rugi', 'keuangan\report\LabaRugi@index');

Route::get('data-Laba-rugi', 'keuangan\LaporanKeuangan@data_labaRugi');

Route::get('tampilan-cetak-laba-rugi/{tgl_awal}/{tgl_akhir}', 'keuangan\report\LabaRugi@print');

//Route::get('perubahan-modal','keuangan\LaporanKeuangan@perubahan_modal');

Route::get('perubahan-modal', 'keuangan\report\PerubahanModal@index');

Route::get('data-perubahan-modal', 'keuangan\LaporanKeuangan@data_perubahan_modals');

Route::get('tampilan-cetak-perubahan-modal/{tgl_awal}/{tgl_akhir}', 'keuangan\report\PerubahanModal@print');

//Route::get('neraca','keuangan\LaporanKeuangan@neraca');
Route::get('neraca', 'keuangan\report\Neraca@index');

Route::get('data-neraca', 'keuangan\LaporanKeuangan@data_neraca');

Route::get('tampilan-cetak-neraca/{tgl_awal}/{tgl_akhir}', 'keuangan\report\Neraca@print');

// Route::get('arus-kas','keuangan\LaporanKeuangan@tampilan_arus_kas');
Route::get('arus-kas', 'keuangan\report\ArusKas@index');

Route::get('tampilan-arus-kas-api', 'keuangan\LaporanKeuangan@arus_kas');

Route::get('tampilan-arus-kas-api/{tgl_awal}/{tgl_akhir}', 'keuangan\report\ArusKas@print');

Route::resource('tahun-buku', 'keuangan\TahunBuku');
Route::post('tahun-buku/{id}/delete', 'keuangan\TahunBuku@delete');
Route::post('ubah-status-tahun-buku/{id}', 'keuangan\TahunBuku@ubah_status');


// TODO: Inventory
Route::resource('inventory', 'produksi\StokAwal');
Route::post('inventory/{id}/destroy', 'produksi\StokAwal@delete');

Route::resource('itemIO', 'produksi\ItemIO');

Route::get('stok-akhir', 'produksi\Barang@akhir_stok');

Route::resource('stok-opname', 'produksi\StokOpname');
Route::get('stok-opname-print', 'produksi\StokOpname@cetak');
Route::get('perbaikan-stok/{id_barang}', 'produksi\StokOpname@perbaikanstok');
Route::post('tambah-perbaikan-stok', 'produksi\StokOpname@tambah_perbaikan_stok');
Route::get('history-barang', 'produksi\StokOpname@HistoryStokOpname');
Route::get('ubah-stok-opname/{id}', 'produksi\StokOpname@UbahHistoryStokUpname');
Route::post('ubah-perbaikan-stok/{id}', 'produksi\StokOpname@update_perbaikan_stok');

#Todo Promo
//promo barang
Route::resource('promo-crud', 'marketing\Promo');
//detail barang promo barang & jasa digabung
Route::post('delete-promo/{id}', 'marketing\Promo@delete_promo');
Route::get('rincian-promo/{id}', 'marketing\Promo@rincian_promo');
Route::post('tambah-rincian-promo/{id_promo}', 'marketing\Promo@rincian_promo_store');
Route::put('ubah-detail-promo/{id_detail_promo}', 'marketing\Promo@barang_promo_update');
Route::get('hapus-detail-promo/{id_detail_promo}', 'marketing\Promo@barang_promo_delete');

//Manufaktur
Route::resource('manufaktur','manufaktur\manufaktur');
Route::resource('sop-produksi','manufaktur\ProsesProduksi');


//================================= Global Route ======================================================================
Route::get('GlobalKabupaten/{id_provinsi}', 'globals\ProvinsiDanKabupaten@ResponseKabupaten');

Route::post('GlobalSubKategori', 'globals\KategoriJasa@getSubKategori');

Route::post('GlobalSubSubKategori', 'globals\KategoriJasa@getSubSubKategori');
