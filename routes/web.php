<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('registerApp', function () {
    return view('user.superadmin_ukm.master.section.registered.registered');
});

Route::get('login-page', function () {
    return view('user.superadmin_ukm.master.section.registered.login');
});


Route::post('registered','Superadmin_ukm\LoginAndRegisterController@registered');

Route::post('login-page','Superadmin_ukm\LoginAndRegisterController@login');

Route::get('dashboard','Superadmin_ukm\Superadmin_UKM@index');

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

