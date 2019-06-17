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
//    dd(Session::get('id_superadmin_ukm'));
//    if(empty($model_superadmin = App\Model\Superadmin_ukm\U_usaha::where("id_user_ukm",Session::get('id_superadmin_ukm'))->first()))
//    {
//        return abort(404);
//    }
    $data_perusahaan = App\Model\superadmin_ukm\U_usaha::all()->where('id_user_ukm',Session::get('id_superadmin_ukm'));
    $data=[
        'data_perusahaan'=>$data_perusahaan
    ];
    return view('user.superadmin_ukm.master.section.default.page_default', $data);
});

Route::post('registered','Superadmin_ukm\LoginAndRegisterController@registered');

Route::post('login-page','Superadmin_ukm\LoginAndRegisterController@login');

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

//=========================== Pengguna Karyawan ========================================================================

Route::get('pengguna-karyawan','Superadmin_ukm\PenggunaKaryawan@karyawan');

Route::get('daftar-karyawan/{id_usaha}','Superadmin_ukm\Karyawan@data_karyawan');

Route::get('daftarkan-karyawan/{id_usaha}','Superadmin_ukm\Karyawan@create');

Route::post('store-karyawan','Superadmin_ukm\Karyawan@store');

Route::get('ubah-karyawan/{id_usaha}/{id_karyawan}','Superadmin_ukm\Karyawan@edit');

Route::put('update-karyawan/{id_karyawan}','Superadmin_ukm\Karyawan@update');

Route::get('detail-karyawan/{id_karyawan}','Superadmin_ukm\Karyawan@detail');

Route::put('karyawan-delete/{id_karyawan}','Superadmin_ukm\Karyawan@delete');

Router::get('daftar-karyawan','Superadmin_ukm\Karyawan@data_karyawan');

//=============================== Investor =============================================================================

Route::get('daftar-investor/{id_perusahaa}','Superadmin_ukm\Investor@daftar_inverstor');

Route::get('daftarkan-investor/{id_perusahaan}','Superadmin_ukm\Investor@tambah_investor');

Route::post('store-investor', 'Superadmin_ukm\Investor@store');

Route::get('ubah-investor/{id_perusahaan}/{id_investor}','Superadmin_ukm\Investor@edit_investor');

Route::put('update-investor/{id_investor}','Superadmin_ukm\Investor@update');

Route::put('delete-investor/{id_investor}','Superadmin_ukm\Investor@delete');

Route::get('detail-investor/{id_perusahaan}/{id_investor}','Superadmin_ukm\Investor@detail_investor');

//=============================== Menu Perusahaan ======================================================================

Route::get('menu-perusahaan','Superadmin_ukm\Menu_perusahaan@daftar_perusahaan');

Route::get('pengaturan-menu/{id}','Superadmin_ukm\Menu_perusahaan@daftar_menu');

Route::post('store_request_menu','Superadmin_ukm\Menu_perusahaan@store_menu');

Route::post('delete_request_menu','Superadmin_ukm\Menu_perusahaan@delete_menu');

//============================= Menu Karyawan  ========================================================================

Route::get('hak-akses-karyawan/{id_karyawan}','Superadmin_ukm\Hak_akses@daftar_hak_akses');

Route::put('store_request_menu_karyawan/{id}','Superadmin_ukm\Hak_akses@store_menu');

Route::put('delete_request_menu_karyawan/{id}','Superadmin_ukm\Hak_akses@delete_menu');

//============================ Menu Investor ===========================================================================

Route::get('hak-akses-investor/{id_investor}','Superadmin_ukm\Hak_akses_investor@daftar_hak_akses');

Route::put('store_request_menu_investor/{id}','Superadmin_ukm\Hak_akses_investor@store_menu');

Route::put('delete_request_menu_investor/{id}','Superadmin_ukm\Hak_akses_investor@delete_menu');



//////////////////////////////////////// Karyawan //////////////////////////////////////////////////////////////////////

Route::get('login-karyawan','karyawan\LoginController@Login');

Route::post('cek-karyawan','karyawan\LoginController@cek_login');

Route::get('logout-karyawan','karyawan\LoginController@logOut');

Route::get('welcome-page','karyawan\Dashboard@index');

Route::get('Swot','karyawan\SWOT@index');

Route::get('buat-swot','karyawan\SWOT@create');

Route::post('store-swot','karyawan\SWOT@store');

Route::get('Strategi-Jangka-Panjang','karyawan\SJP@index');

Route::get('buat-strategi-jangka-panjang','karyawan\SJP@create');

Route::post('store-sjp','karyawan\SJP@store');

Route::get('ubah-strategi-jangka-panjang-ini/{id_sjp}','karyawan\SJP@edit');

Route::put('ubah-sjp/{id_sjp}','karyawan\SJP@update');

Route::put('hapus-sjp/{id_sjp}','karyawan\SJP@delete');

Route::get('Bagian', 'karyawan\Bagian@index');

Route::get('dataBagian','karyawan\Bagian@DataBagian');

Route::post('store-bagian','karyawan\Bagian@store');

Route::get('dataBagian/{id}','karyawan\Bagian@RequestDataBagian');

Route::post('update-bagian','karyawan\Bagian@update');

Route::post('hapus-bagian/{id}','karyawan\Bagian@delete');

Route::get('Divisi','karyawan\Devisi@index');

Route::post('store-divisi','karyawan\Devisi@store');

Route::get('Divisi/{id_divisi}','karyawan\Devisi@edit');

Route::post('update-divisi','karyawan\Devisi@update');

Route::put('hapusDivisi/{id_divisi}','karyawan\Devisi@delete');

Route::get('Strategi-Jangka-Pendek','karyawan\SJPK@index');

Route::get('buat-strategi-jangka-pendek','karyawan\SJPK@create');

Route::post('store-sjpk','karyawan\SJPK@store');

Route::get('ubah-strategi-jangka-pendek','karyawan\SJPK@edit');

Route::put('update-sjpk/{id}','karyawan\SJPK@update');

Route::get('delete-sjpk/{id}','karyawan\SJPK@delete');

Route::get('Model-Bisnis','karyawan\ModelBisnis@index');

Route::get('buat-model-bisnis','karyawan\ModelBisnis@create');

Route::post('store-mb','karyawan\ModelBisnis@store');

Route::get('ubah-model-bisnis/{id}','karyawan\ModelBisnis@edit');

Route::put('ubah-mb/{id}','karyawan\ModelBisnis@update');

Route::put('hapus-model-bisnis/{id}','karyawan\ModelBisnis@delete');

Route::get('Struktur-Perusahaan','karyawan\StruturPerusahaan@index');

Route::post('store-bagan','karyawan\StruturPerusahaan@store');

Route::get('getRequestStrukturPerusahaan','karyawan\StruturPerusahaan@getRequestStrukturPerusahaan');

Route::get('ubah-struktur/{id}','karyawan\StruturPerusahaan@getRequest');

Route::put('update-struktur/{id}','karyawan\StruturPerusahaan@update');

Route::put('delete-struktur/{id}','karyawan\StruturPerusahaan@delete');

Route::get('Job-Desc','karyawan\JobDecs@index');

Route::get('tambah-job-decs','karyawan\JobDecs@create');

Route::post('store-JD','karyawan\JobDecs@store');

Route::get('ubah-job-decs/{id}','karyawan\JobDecs@edit');

Route::put('update-JD/{id}','karyawan\JobDecs@update');

Route::put('hapus-JD/{id}','karyawan\JobDecs@delete');


//=================================================== HRD ==========================================================

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

//======================================== Administrasi ================================================================

Route::get('Klien', 'administrasi\Klien@index');

Route::get('tambah-klien','administrasi\Klien@create');

Route::post('store-klien','administrasi\Klien@store');

Route::get('ubah-klien/{id}','administrasi\Klien@edit');

Route::put('update-klien/{id}','administrasi\Klien@update');

Route::get('hapus-klien/{id}','administrasi\Klien@delete');

Route::post('cari-klien','administrasi\Klien@cari_klien');

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

Route::get('SPK-Kontrak','administrasi\SPKKontrak@index');

Route::get('tambah-spk','administrasi\SPKKontrak@create');

Route::post('store-spk','administrasi\SPKKontrak@store');

Route::get('ubah-spk/{id}','administrasi\SPKKontrak@edit');

Route::put('update-spk/{id}','administrasi\SPKKontrak@update');

Route::put('hapus-spk/{id}','administrasi\SPKKontrak@delete');

Route::post('upload-file-spk','administrasi\SPKKontrak@uploadFileKontrak');

Route::post('upload-scan-spk','administrasi\SPKKontrak@uploadFileScanSPK');

Route::post('cari-spk','administrasi\SPKKontrak@cari');

Route::get('Ba-Pemeriksaan','administrasi\BApemeriksaan@form');

Route::post('Proses-BApem','administrasi\BApemeriksaan@proses');

Route::put('Proses-BApem/{id}','administrasi\BApemeriksaan@proses_Update');

Route::put('Proses-BApem/{id}/hapus','administrasi\BApemeriksaan@proses_delete');

Route::post('cari-bapem','administrasi\BApemeriksaan@cari_bapem');

Route::get('BA-Kemajuan','administrasi\BAkemajuan@form');

Route::post('BA-Kemajuan','administrasi\BAkemajuan@proses');
//
Route::put('Proses-BAkem/{id}','administrasi\BAkemajuan@proses_Update');
//
Route::put('Proses-BAkem/{id}/hapus','administrasi\BAkemajuan@proses_delete');

Route::post('cari-bakem','administrasi\BAkemajuan@cari_bakem');

Route::get('BA-Penyelesaian/{id}','administrasi\BApenyelesaian@index');

Route::post('BA-Penyelesaian','administrasi\BApenyelesaian@menu_modal');

Route::get('BA-penyelesian-tambah/{id}','administrasi\BApenyelesaian@create');

Route::post('BA-penyelesian-store','administrasi\BApenyelesaian@store');

Route::get('BA-Penyelesaian-ubah/{id}/{id_spk}','administrasi\BApenyelesaian@edit');

Route::put('BA-Penyelesaian-update/{id}','administrasi\BApenyelesaian@update');

Route::put('BA-Penyelesaian-delete/{id}','administrasi\BApenyelesaian@destroy');

Route::post('cari-Penyelesaian','administrasi\BApenyelesaian@cari_penye');

Route::post('BA-Sertim','administrasi\BAsertim@IndexMenu');

Route::get('BA-Serah-Terima/{id}','administrasi\BAsertim@index');

Route::get('BA-Sertim-tambah/{id}','administrasi\BAsertim@create');

Route::post('BA-Sertim-store','administrasi\BAsertim@store');

Route::get('BA-Sertim-ubah/{id}/{id_spk}','administrasi\BAsertim@edit');

Route::put('BA-Sertim-update/{id}','administrasi\BAsertim@update');

Route::put('BA-Sertim-delete/{id}','administrasi\BAsertim@destroy');

Route::post('cari-Sertim','administrasi\BAsertim@cari_sertim');

Route::get('BA-Serah-Terima-Operasional/{id}','administrasi\BAserop@index');

Route::get('BA-Serops-tambah/{id}','administrasi\BAserop@create');

Route::post('BA-Serops-store','administrasi\BAserop@store');

Route::get('BA-Serops-ubah/{id}/{id_spk}','administrasi\BAserop@edit');

Route::put('BA-Serops-update/{id}','administrasi\BAserop@update');

Route::put('BA-Serops-delete/{id}','administrasi\BAserop@delete');

Route::post('cari-serops','administrasi\BAserop@cari');

Route::post('BA-Serah-Terima-Operasional','administrasi\BAserop@MenuIndex');

Route::get('Brifing','administrasi\Brifing@index');

Route::get('lihat-usulan-brifing/{id}', 'administrasi\Brifing@ambilEventBrifing');

Route::post('lihat-usulan-brifing-by-tgl', 'administrasi\Brifing@ambilEventBrifingByTanggal');

Route::post('store-brifing','administrasi\Brifing@store');

Route::put('delete-brifing/{id}','administrasi\Brifing@destroy');

Route::get('Peralatan','administrasi\Peralatan@index');

Route::get('tambah-peralatan','administrasi\Peralatan@create');

Route::post('store-peralatan','administrasi\Peralatan@store');

Route::get('ubah-peralatan/{id}','administrasi\Peralatan@edit');

Route::put('update-peralatan/{id}','administrasi\Peralatan@update');

Route::put('delete-peralatan/{id}','administrasi\Peralatan@delete');

Route::get('Pengumuman','administrasi\Pengumuman@index');

Route::get('tambah-pengumuman','administrasi\Pengumuman@create');

Route::post('store-pengumuman','administrasi\Pengumuman@store');

Route::get('ubah-pengumuman/{id}','administrasi\Pengumuman@edit');

Route::put('update-pengumuman/{id}','administrasi\Pengumuman@update');

Route::put('delete-pengumuman/{id}','administrasi\Pengumuman@delete');

Route::get('Pengaturan-rapat','administrasi\JenisRapat@index');

Route::post('store-jenis-rapat','administrasi\JenisRapat@store');

Route::get('edit-jenis-rapat/{id}','administrasi\JenisRapat@edit');

Route::put('update-jenis-rapat','administrasi\JenisRapat@update');

Route::put('delete-jenis-rapat/{id}','administrasi\JenisRapat@delete');

Route::post('reply-brifing', 'administrasi\Brifing@store_brifing');

Route::put('delete-reply/{id}','administrasi\Brifing@delete_brifing');


//============================================ Produksi ================================================================

Route::get('Jasa', 'produksi\Jasa@index');

Route::get('tambah-jasa', 'produksi\Jasa@create');

Route::post('store-jasa', 'produksi\Jasa@store');

Route::get('ubah-jasa/{id}', 'produksi\Jasa@edit');

Route::put('update-jasa/{id}', 'produksi\Jasa@update');

Route::put('delete-jasa/{id}', 'produksi\Jasa@destroy');

Route::post('cari-jasa', 'produksi\Jasa@Cari_jasa');

Route::get('Barang','produksi\Barang@index');

Route::get('tambah-barang','produksi\Barang@create');

Route::post('store-barang','produksi\Barang@store');

Route::get('ubah-barang/{id}','produksi\Barang@edit');

Route::put('update-barang/{id}','produksi\Barang@update');

Route::put('delete-barang/{id}','produksi\Barang@destroy');

Route::post('cari-barang','produksi\Barang@show');

Route::get('Supplier','produksi\Supplier@index');

Route::get('tambah-supplier','produksi\Supplier@create');

Route::post('store-supplier','produksi\Supplier@store');

Route::get('ubah-supplier/{id}','produksi\Supplier@edit');

Route::put('update-supplier/{id}','produksi\Supplier@update');

Route::put('hapus-supplier/{id}','produksi\Supplier@delete');

Route::get('Jual-Jasa','produksi\Jualjasa@index');

Route::get('tambah-jual-jasa','produksi\Jualjasa@create');

Route::post('store-jual-jasa','produksi\Jualjasa@store');

Route::get('ubah-jual-jasa/{id}','produksi\Jualjasa@edit');

Route::put('update-jual-jasa/{id}','produksi\Jualjasa@update');

Route::put('delete-jual-jasa/{id}','produksi\Jualjasa@delete');

Route::post('cari-jual-jasa','produksi\Jualjasa@cari_jual_jasa');

Route::get('Pembelian', 'produksi\BeliBarang@index');

Route::get('tambah-pembelian', 'produksi\BeliBarang@create');

Route::post('store-beli-barang', 'produksi\BeliBarang@store');

Route::get('ubah-pembelian/{id}', 'produksi\BeliBarang@edit');

Route::put('update-beli-barang/{id}', 'produksi\BeliBarang@update');

Route::put('hapus-pembelian/{id}', 'produksi\BeliBarang@delete');

Route::get('Penjualan','produksi\JualBarang@index');

Route::get('tambah-penjualan','produksi\JualBarang@create');

Route::post('store-penjualan','produksi\JualBarang@store');

Route::get('ubah-penjualan/{id}','produksi\JualBarang@edit');

Route::put('update-penjualan/{id}','produksi\JualBarang@update');

Route::put('hapus-penjualan/{id}','produksi\JualBarang@destory');

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

Route::get('Jadwal-Proyek','produksi\JadwalProyek@index');

Route::get('tambah-jadwal-proyek','produksi\JadwalProyek@create');

Route::post('store-jadwal-proyek','produksi\JadwalProyek@store');

Route::get('get_liftOfProyek/{id_proyek}', 'produksi\JadwalProyek@ambilDaftarJadwalProyek');

Route::get('ubah-jadwal-proyek/{id_proyek}','produksi\JadwalProyek@edit');

Route::put('update-jadwal-proyek/{id}','produksi\JadwalProyek@update');

Route::put('delete-jadwal-proyek/{id}','produksi\JadwalProyek@destroy');

Route::post('cari-jadwal-proyek','produksi\JadwalProyek@show');


Route::get('tambah-taskproyek','produksi\TaskProyek@create');

Route::post('store-taksproyek','produksi\TaskProyek@store');

Route::get('ubah-taksproyek/{id}','produksi\TaskProyek@edit');

Route::put('update-taksproyek/{id}','produksi\TaskProyek@update');

Route::put('hapus-taksproyek/{id}','produksi\TaskProyek@destroy');

Route::get('tambah-rincian-tugas','produksi\RincianTugas@create');

Route::post('store-rincian-tugas','produksi\RincianTugas@store');

Route::get('ubah-rincian-tugas/{id}','produksi\RincianTugas@edit');

Route::put('update-rincian-tugas/{id}','produksi\RincianTugas@update');

Route::put('hapus-rincian-tugas/{id}','produksi\RincianTugas@destroy');

Route::get('Progress-Proyek','produksi\ProgressProyek@index');

Route::get('Daftar-progress/{id_jadwal_proyek}','produksi\ProgressProyek@listOfProgress');

Route::post('store-progress-proyek','produksi\ProgressProyek@store');

Route::get('ubah-progress-jadwal/{id_progress_proyek}','produksi\ProgressProyek@edit');

Route::post('update-progress-proyek','produksi\ProgressProyek@update');

Route::put('hapus-progress-jadwal/{id}','produksi\ProgressProyek@destroy');

Route::get('Pemeliharaan', 'produksi\Pemeliharaan@index');

Route::get('tambah-pemeliharaan','produksi\Pemeliharaan@create');

Route::post('store-pemeliharaan','produksi\Pemeliharaan@store');

Route::get('ubah-pemeliharaan/{id}','produksi\Pemeliharaan@edit');

Route::put('update-pemeliharaan/{id}','produksi\Pemeliharaan@update');

Route::put('delete-pemeliharaan/{id}','produksi\Pemeliharaan@delete');

Route::post('cari-pemeliharaan','produksi\Pemeliharaan@show');

Route::get('tambah-jenis-proyek','produksi\JenisPemeliharaan@create');

Route::post('store-jenis-pemeliharaan', 'produksi\JenisPemeliharaan@store');

Route::get('ubah-jenis-pemeliharaan/{id}','produksi\JenisPemeliharaan@edit');

Route::put('update-jenis-pemeliharaan/{id}', 'produksi\JenisPemeliharaan@update');

Route::put('hapus-jenis-pemeliharaan/{id}', 'produksi\JenisPemeliharaan@delete');

Route::get('Progres-Pemeliharaan', 'produksi\ProgressPemeliharaan@index');

Route::get('lihat-progress/{id_pemeliharaan}','produksi\ProgressPemeliharaan@daftar_progress_pemeliharaan');

Route::post('store-progress-pemeliharaan','produksi\ProgressPemeliharaan@store');

Route::get('ubah-progress-pemeliharaan/{id}','produksi\ProgressPemeliharaan@edit');

Route::post('update-progress-pemeliharaan','produksi\ProgressPemeliharaan@update');

Route::put('hapus-progress-pemeliharaan/{id}','produksi\ProgressPemeliharaan@delete');

//================================================ HRD ===========================================================

Route::get('Karyawan','hrd\Karyawan@index');

Route::get('tambah-karyawan','hrd\Karyawan@tambah_karyawan');

Route::post('store-karyawan/hrd','hrd\Karyawan@store');

Route::get('ubah-karyawan/{id}','hrd\Karyawan@edit_karyawan');

Route::put('update-hrd-karyawan/{id}','hrd\Karyawan@update');

Route::get('hapus-karyawan/{id}','hrd\Karyawan@delete');

Route::post('cari-karyawan','hrd\Karyawan@cari');

Route::get('Rekruitmen','hrd\Loker@index');

Route::get('tambah-rekrutment','hrd\Loker@create');

Route::post('store-rekruitmen','hrd\Loker@store');

Route::get('ubah-rekruitmen/{id}','hrd\Loker@edit');

Route::put('update-rekruitmen/{id}','hrd\Loker@update');

Route::get('hapus-rekruitmen/{id}','hrd\Loker@delete');

Route::post('upload-loker','hrd\Loker@upload_image');

Route::get('detail-rekruitmen/{id}','hrd\Loker@show');

Route::post('cari-rekruitmen','hrd\Loker@search');

Route::get('Lamaran-Pekerjaan','hrd\LamaranPek@index');

Route::get('tambah-lamaran','hrd\LamaranPek@create');

Route::post('store-lamaran','hrd\LamaranPek@store');

Route::get('ubah-lamaran/{id}','hrd\LamaranPek@edit');

Route::put('update-lamaran/{id}','hrd\LamaranPek@update');

Route::put('hapus-lamaran/{id}','hrd\LamaranPek@delete');

Route::get('Seleksi','hrd\SeleksiBerkas@index');

Route::get('daftar-pelamar/{id}', 'hrd\SeleksiBerkas@show');

Route::get('Seleksi-pesarta/{id_peserta}','hrd\SeleksiBerkas@show_peserta');

Route::put('simpan-seleksi/{id_peserta}','hrd\SeleksiBerkas@save');

Route::get('Tes', 'hrd\Tes@psikotes'); // Psikotes

Route::get('jenis-psikotes', 'hrd\JenisPsikotes@index');

Route::post('store-jenis-psikotes', 'hrd\JenisPsikotes@store');

Route::get('ubah-jenis-psikotes/{id}', 'hrd\JenisPsikotes@edit');

Route::post('update-jenis-psikotes', 'hrd\JenisPsikotes@update');

Route::put('hapus-jenis-psikotes/{id}', 'hrd\JenisPsikotes@delete');

Route::post('simpan-psikotes','hrd\Psikotes@store');

Route::post('cari-loker-psikotes','hrd\Tes@search_psikotes');

Route::get('Wawancara', 'hrd\Tes@wawancara'); //Wawancara

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

Route::get('Keahlian', 'hrd\Tes@keahlian'); //Keahlian

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

Route::get('Tenaga-ahli', 'hrd\TenagaKerja@index');

Route::post('cari-sertifikasi-karyawan', 'hrd\TenagaKerja@show');

Route::get('daftar-sertifikasi/{id}','hrd\TenagaKerja@daftarSertifikasi');

Route::get('tambah-sertifikasi/{id_user}','hrd\TenagaKerja@create');

Route::post('store-sertifikasi','hrd\TenagaKerja@store');

Route::get('ubah-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@edit');

Route::put('update-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@update');

Route::put('hapus-sertifikasi/{id_sertifikasi}', 'hrd\TenagaKerja@delete');

Route::get('Periode-Kerja','hrd\PeriodeKerja@index');

Route::get('tambah-periode-kerja','hrd\PeriodeKerja@create');

Route::post('store-periode-kerja','hrd\PeriodeKerja@store');

Route::get('ubah-periode-kerja/{id}','hrd\PeriodeKerja@edit');

Route::put('update-periode-kerja/{id}','hrd\PeriodeKerja@update');

Route::put('hapus-periode-kerja/{id}','hrd\PeriodeKerja@delete');

Route::get('Kelender-Kerja','hrd\KalenderKerja@index');

Route::get('daftar-event-kalender', 'hrd\KalenderKerja@daftarEvent');

Route::get('tambah-aktifitas', 'hrd\KalenderKerja@create');

Route::post('store-kalender-kerja','hrd\KalenderKerja@store');

Route::get('ubah-kalender-kerja/{id}', 'hrd\KalenderKerja@edit');

Route::put('update-kalender-kerja/{id}','hrd\KalenderKerja@update');

Route::put('hapus-kalender-kerja/{id}','hrd\KalenderKerja@delete');

Route::get('get-event-calender','hrd\KalenderKerja@getEventKalender');

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

Route::get('SOP', 'hrd\Sop@index');

Route::get('tambah-sop', 'hrd\Sop@create');

Route::post('store-sop','hrd\Sop@store');

Route::get('ubah-sop/{id}', 'hrd\Sop@edit');

Route::put('update-sop/{id}','hrd\Sop@update');

Route::put('hapus-sop/{id}','hrd\Sop@delete');
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

Route::post('GlobalSubKategori', 'globals\KategoriJasa@getSubKategori');

Route::post('GlobalSubSubKategori', 'globals\KategoriJasa@getSubSubKategori');