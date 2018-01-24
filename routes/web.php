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

Route::get('/login/manage', 'ManageLoginController@index')->name('managelogin.index');
Route::post('/login/central', 'ManageLoginController@loginCentral')->name('managelogin.central');
Route::post('/login/state', 'ManageLoginController@loginState')->name('managelogin.state');
Route::post('/login/district', 'ManageLoginController@loginDistrict')->name('managelogin.district');
Route::post('/login/project', 'ManageLoginController@loginProject')->name('managelogin.project');
Route::post('/login/sector', 'ManageLoginController@loginSector')->name('managelogin.sector');
Route::post('/login/centre', 'ManageLoginController@loginCentre')->name('managelogin.centre');
Route::post('/login/citizen', 'ManageLoginController@loginCitizen')->name('managelogin.citizen');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Citizens
Route::get('/citizen/login', 'Citizen\CitizenLoginController@showLoginForm')->name('citizen.login');
Route::post('/citizen/login', 'Citizen\CitizenLoginController@login')->name('citizen.login');
Route::get('/citizen/register', 'Citizen\CitizenRegisterController@showRegistrationForm')->name('citizen.register');
Route::post('/citizen/register', 'Citizen\CitizenRegisterController@register')->name('citizen.register');
Route::get('/citizen/home', 'CitizenHomeController@index')->name('citizen.home');

Route::get('/citizen/familydetails', 'CitizenHomeController@familydetails')->name('citizen.familydetails');
Route::get('/citizen/snp', 'CitizenHomeController@snp')->name('citizen.snp');
Route::get('/citizen/pregnancy', 'CitizenHomeController@pregnancy')->name('citizen.pregnancy');
Route::get('/citizen/immunization', 'CitizenHomeController@immunization')->name('citizen.immunization');
Route::get('/citizen/vitamina', 'CitizenHomeController@vitamina')->name('citizen.vitamina');
Route::get('/citizen/weightrecords', 'CitizenHomeController@weightrecords')->name('citizen.weightrecords');
Route::get('/citizen/preschool', 'CitizenHomeController@preschool')->name('citizen.preschool');
Route::get('/citizen/migrations', 'CitizenHomeController@migrations')->name('citizen.migrations');

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
  Route::get('/icdsproject/registrations', 'IcdsProjectController@showRegistrations')->name('icdsproject.registrations');
    Route::get('/icdsproject/registration/{id}', 'IcdsProjectController@showRegistrationDetail')->name('icdsproject.registration');
  Route::post('/icdsproject/registration', 'IcdsProjectController@registerCitizen')->name('icdsproject.register');
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
  Route::get('/fooddistribution/progress/monthly', 'SupplementaryFoodDistributionController@monthlyProgress')->name('fooddistribution.monthly_progress');

  //Food Types
  Route::get('/supplementaryfoodtype', 'SupplementaryFoodTypeController@index')->name('supplementaryfoodtype.index');
  Route::post('/supplementaryfoodtype', 'SupplementaryFoodTypeController@store')->name('supplementaryfoodtype.store');

  //PreSchoolEducationRecord
  Route::get('/preschooleducation', 'PreSchoolEducationRecordController@index')->name('preschooleducation.index');
  Route::get('/preschooleducation/{member}/create', 'PreSchoolEducationRecordController@create')->name('preschooleducation.create');
  Route::post('/preschooleducation', 'PreSchoolEducationRecordController@store')->name('preschooleducation.store');

  //Preschool activity
  Route::get('/preschoolactivity', 'PreSchoolActivityController@index')->name('preschoolactivity.index');
  Route::post('/preschoolactivity', 'PreSchoolActivityController@store')->name('preschoolactivity.store');

  //Activity Preschool
  Route::post('/activitypreschool', 'ActivityPreSchoolController@store')->name('activitypreschool.store');

  //Immunization Record
  Route::get('/immunization', 'ImmunizationRecordController@index')->name('immunization.index');
  Route::get('/immunization/{member}/create', 'ImmunizationRecordController@create')->name('immunization.create');
  Route::post('/immunization', 'ImmunizationRecordController@store')->name('immunization.store');

  //Vaccination
  Route::get('/vaccination', 'VaccinationController@index')->name('vaccination.index');
  Route::post('/vaccination', 'VaccinationController@store')->name('vaccination.store');

  //Vitamin A Record
  Route::get('/vitamina', 'VitaminADoseRecordController@index')->name('vitamina.index');
  Route::get('/vitamina/{member}/create', 'VitaminADoseRecordController@create')->name('vitamina.create');
  Route::post('/vitamina', 'VitaminADoseRecordController@store')->name('vitamina.store');

  //Vitamin A Doses
  Route::get('/vitaminadose', 'VitaminADoseController@index')->name('vitaminadose.index');
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

  //Medical Procedures
  Route::get('/medicalprocedure', 'MedicalProcedureController@index')->name('medicalprocedure.index');
  Route::post('/medicalprocedure','MedicalProcedureController@store')->name('medicalprocedure.store');

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
