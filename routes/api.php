<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/districts', 'DistrictController@getDistricts');
Route::post('/projects', 'IcdsProjectController@getProjects');
Route::post('/sectors', 'SectorController@getSectors');
Route::post('/centres', 'AnganwadiCentreController@getCentres');
Route::post('/citizen/login/otp', 'Citizen\CitizenLoginController@generateOTP');

Route::get('/generate-otp', 'FamilyDetailController@generateOTP');

Route::get('/beneficiary/state','MemberController@getStateBeneficiaries');
Route::get('/beneficiary/district','MemberController@getDistrictBeneficiaries');
