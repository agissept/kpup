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

Route::get('/','WebController@showLoginAdmin');
Route::post('/','WebController@loginAdmin');

Route::get('/loginUser','WebController@showLoginUser');
Route::post('/loginUser','WebController@loginUser');

Route::get('/index','WebController@index');
Route::post('/index','WebController@pilih');

Route::get('/logoutAdmin','WebController@logoutAdmin');
Route::get('/logoutUser','WebController@logoutUser');

Route::get('/succes','WebController@succes');

Route::get('/admin','AdminController@admin');
Route::post('/admin/login','AdminController@adminLogin');

Route::get('/admin/dashboard','AdminController@adminDashboard');
Route::post('/admin/dashboard','AdminController@adminCreate');

Route::get('/admin/dashboard/kandidat','AdminController@adminCandidate');
Route::post('/admin/dashboard/createGenerationCandidate','AdminController@createGenerationCandidate');

Route::get('/admin/dashboard/candidate','AdminController@candidate');
Route::post('/admin/dashboard/createCandidate','AdminController@createCandidate');

Route::get('/admin/dashboard/configtable','AdminController@showConfigTable');
Route::post('/admin/dashboard/configtable','AdminController@configTable');

Route::get('/admin/dashboard/angkatan','AdminController@angkatan');
Route::post('/admin/dashboard/addAngkatan','AdminController@addAngkatan');
Route::post('/admin/dashboard/angkatan/{angakatan}/edit','AdminController@editAngkatan');
Route::get('/admin/dashboard/angkatan/{angakatan}/delete','AdminController@deleteAngkatan');

Route::get('/admin/dashboard/angkatan/{angakatan}','AdminController@kelas');
Route::post('/admin/dahsboard/angkatan/{angkatan}/addKelas','AdminController@addKelas');
Route::get('/admin/dashboard/angkatan/{angakatan}/{kodeKelas}/edit','AdminController@showEditKelas');
Route::post('/admin/dashboard/angkatan/{angakatan}/{kodeKelas}/edit','AdminController@editKelas');
Route::get('/admin/dashboard/angkatan/{angakatan}/{kodeKelas}/delete','AdminController@deleteKelas');

Route::get('/admin/dashboard/angkatan/{angakatan}/{kodeKelas}','AdminController@siswa');
Route::post('/admin/dashboard/angkatan/{angakatan}/{kodeKelas}/addSiswa','AdminController@addSiswa');
Route::get('/admin/dashboard/angkatan/{angakatan}/{kodeKelas}/{nis}/edit','AdminController@showEditSiswa');
Route::post('/admin/dashboard/angkatan/{angakatan}/{kodeKelas}/{nis}/edit','AdminController@editSiswa');
Route::get('/admin/dashboard/angkatan/{angakatan}/{kodeKelas}/{nis}/delete','AdminController@deleteSiswa');

Route::get('/admin/dashboard/reset','AdminController@resetUserStatus');




