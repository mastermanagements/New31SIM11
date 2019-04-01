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
    if(empty($model_superadmin = App\Model\Superadmin_ukm\U_usaha::where("id_user_ukm",Session::get('id_superadmin_ukm'))->first()))
    {
        return abort(404);
    }
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

//================================= Global Route ======================================================================
Route::get('GlobalKabupaten/{id_provinsi}','globals\ProvinsiDanKabupaten@ResponseKabupaten');