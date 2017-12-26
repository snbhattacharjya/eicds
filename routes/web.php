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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/start', function () {
    return view('start');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//States
Route::get('/state', 'StateController@index')->name('state.index');
Route::post('/state', 'StateController@store')->name('state.store');
//Districts
Route::get('/district', 'DistrictController@index')->name('district.index');
Route::post('/district', 'DistrictController@store')->name('district.store');
//ICDS Projects
Route::get('/icdsproject', 'IcdsProjectController@index')->name('icdsproject.index');
Route::post('/icdsproject', 'IcdsProjectController@store')->name('icdsproject.store');
//Sectors
Route::get('/sector', 'SectorController@index')->name('sector.index');
Route::post('/sector', 'SectorController@store')->name('sector.store');
//Anganwadi Centres
Route::get('/anganwadicentre', 'AnganwadiCentreController@index')->name('anganwadicentre.index');
Route::post('/anganwadicentre', 'AnganwadiCentreController@store')->name('anganwadicentre.store');

//Family Register
Route::get('/familydetail', 'FamilyDetailController@index')->name('familydetail.index');
Route::get('/familydetail/create', 'FamilyDetailController@create')->name('familydetail.create');
Route::post('/familydetail', 'FamilyDetailController@store')->name('familydetail.store');
