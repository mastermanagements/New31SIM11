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


Route::post('registered','Superadmin_ukm\LoginAndRegisterController@registered');