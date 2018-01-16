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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/start', function () {
//     return view('start');
// });
Route::get('/', function () {
    return view('myindex');
});
// Route::get('/admin', function () {
//     return view('adminlte');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
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
  Route::get('/familydetail/search', 'FamilyDetailController@search')->name('familydetail.search');
  Route::post('/familydetail', 'FamilyDetailController@store')->name('familydetail.store');
  Route::get('/familydetail/{familydetail}/members', 'FamilyDetailController@showMembers')->name('familydetail.showMembers');

  //Member
  Route::post('/member', 'MemberController@store')->name('member.store');

  //Family Migration
  Route::post('/familydetail/search', 'FamilyDetailController@showImport')->name('familydetail.showImport');
  Route::post('/familydetail/migration', 'FamilyDetailController@import')->name('familydetail.import');

  //Member Migration
  Route::post('/member/search', 'MemberController@showImport')->name('member.showImport');
  Route::post('/member/migration', 'MemberController@import')->name('member.import');

  //Food Distribution
  Route::get('/fooddistribution', 'SupplementaryFoodDistributionController@index')->name('fooddistribution.index');
  Route::get('/fooddistribution/{member}/create', 'SupplementaryFoodDistributionController@create')->name('fooddistribution.create');
  Route::post('/fooddistribution', 'SupplementaryFoodDistributionController@store')->name('fooddistribution.store');

  //PreSchoolEducationRecord
  Route::get('/preschooleducation', 'PreSchoolEducationRecordController@index')->name('preschooleducation.index');
  Route::get('/preschooleducation/{member}/create', 'PreSchoolEducationRecordController@create')->name('preschooleducation.create');
  Route::post('/preschooleducation', 'PreSchoolEducationRecordController@store')->name('preschooleducation.store');

  //Preschool activity
  Route::post('/preschoolactivity', 'PreSchoolActivityController@store')->name('preschoolactivity.store');
  Route::post('/activitypreschool', 'ActivityPreSchoolController@store')->name('activitypreschool.store');

  //Immunization Record
  Route::get('/immunization', 'ImmunizationRecordController@index')->name('immunization.index');
  Route::get('/immunization/{member}/create', 'ImmunizationRecordController@create')->name('immunization.create');
  Route::post('/immunization', 'ImmunizationRecordController@store')->name('immunization.store');

  //Vaccination
  Route::post('/vaccination', 'VaccinationController@store')->name('vaccination.store');

  //Vitamin A Record
  Route::get('/vitamina', 'VitaminADoseRecordController@index')->name('vitamina.index');
  Route::get('/vitamina/{member}/create', 'VitaminADoseRecordController@create')->name('vitamina.create');
  Route::post('/vitamina', 'VitaminADoseRecordController@store')->name('vitamina.store');

  //Vitamin A Doses
  Route::post('/vitaminadose', 'VitaminADoseController@store')->name('vitaminadose.store');

  //PregnancyDeliveryRecord
  Route::get('/pregnancydelivery', 'PregnancyDeliveryRecordController@index')->name('pregnancydelivery.index');
  Route::get('/pregnancydelivery/{member}/show', 'PregnancyDeliveryRecordController@show')->name('pregnancydelivery.show');
  Route::get('/pregnancydelivery/{member}/create', 'PregnancyDeliveryRecordController@create')->name('pregnancydelivery.create');
  Route::post('/pregnancydelivery', 'PregnancyDeliveryRecordController@store')->name('pregnancydelivery.store');
  Route::delete('/pregnancydelivery/{id}/delete', 'PregnancyDeliveryRecordController@destroy')->name('pregnancydelivery.destroy');

  //Pregnancy Medical Procedure
  Route::get('/pregnancydelivery/{id}/medicalprocedure', 'PregnancyDeliveryRecordController@showMedicalProcedure')->name('pregnancydelivery.medicalprocedure');
  Route::post('/pregnancymedicalprocedure','PregnancyMedicalProcedureController@store')->name('pregnancymedicalprocedure.store');

  //Antenatal Checkup
  Route::get('/pregnancydelivery/{id}/antenatalcheckup', 'PregnancyDeliveryRecordController@showAnteNatalCheckup')->name('pregnancydelivery.antenatalcheckup');
  Route::post('/pregnancyantenatalcheckup','PregnancyAntenatalCheckupController@store')->name('pregnancyantenatalcheckup.store');

  //New Born Detail
  Route::get('/pregnancydelivery/{id}/newborn', 'PregnancyDeliveryRecordController@showNewBorn')->name('pregnancydelivery.newborn');
  Route::post('/newborn','NewBornDetailController@store')->name('newborn.store');

  //Weight Records
  Route::get('/weightrecord', 'WeightRecordController@index')->name('weightrecord.index');
  Route::get('/weightrecord/{id}/show', 'WeightRecordController@show')->name('weightrecord.show');
  Route::get('/weightrecord/{id}/create', 'WeightRecordController@create')->name('weightrecord.create');
  Route::post('/weightrecord','WeightRecordController@store')->name('weightrecord.store');
  Route::delete('/weightrecord/{id}/destroy','WeightRecordController@destroy')->name('weightrecord.destroy');

});
