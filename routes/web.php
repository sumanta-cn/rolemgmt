<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Auth::routes();

Route::get('/page-not-found', function() {
    return view('error.404');
})->name('error404');

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['middleware' => 'permission:roles'], function() {

    Route::get('/view-roles', 'HomeController@viewRoles')->name('viewroles');
    Route::post('/{roleroute}', 'HomeController@crudForRoles')->where('roleroute', 'add-roles|update-roles|delete-roles');
});

Route::group(['middleware' => 'permission:permissions'], function() {

    Route::get('/view-permissions', 'HomeController@viewPermissions')->name('viewpermissions');
    Route::post('/{permissionroute}', 'HomeController@crudForPermissions')->where('permissionroute', 'add-permissions|update-permissions|delete-permissions');
});

Route::group(['middleware' => 'permission:users'], function() {

    Route::get('/view-users', 'HomeController@viewUser')->name('viewuser');
    Route::get('/add-user-details', 'HomeController@viewUserDetails')->name('adduserdetails');
    Route::post('/add-user-details', 'HomeController@addUserDetails');
    Route::post('/update-user-details', 'HomeController@updateUserDetails');
    Route::post('/delete-user-details', 'HomeController@deleteUserDetails');
});

Route::group(['middleware' => 'permission:subjects'], function() {

    Route::get('/view-subjects', 'HomeController@viewSubjects')->name('viewsubject');
    Route::post('/{subjectsroute}', 'HomeController@crudForSubjects')->where('subjectsroute', 'add-subjects|update-subjects|delete-subjects');
});

Route::group(['middleware' => 'permission:examscedule'], function() {

    Route::get('/list-sceduled-exams', 'HomeController@viewSceduledExams')->name('listscheduledexam');
    Route::get('/schedule-exam', 'HomeController@viewSceduleExamPage')->name('scheduleanexam');
    Route::get('/get-subj-details', 'HomeController@getSubjectDetails');
    Route::post('/{scheduledexamroute}', 'HomeController@crudForScheduledExam')->where('scheduledexamroute', 'schedule-exam|update-sceduled-exam|delete-sceduled-exam');
});

Route::group(['middleware' => 'permission:exampapers'], function() {

    Route::get('/view-exams', 'UserController@viewExamList')->name('viewexams');
    Route::get('/view-exampapers/{id}', 'UserController@viewExamList')->name('viewexampapers');
    Route::get('/create-exampapers/{id}', 'UserController@viewExamPaper')->name('createexampapers');
    Route::post('/create-exampaper', 'UserController@createExamPaper');
    Route::post('/update-exampapers', 'UserController@updateExamPaper');
    Route::post('/delete-exampapers', 'UserController@deleteExamPaper');
    Route::get('/check-exampapers', 'UserController@viewCheckExamPaper')->name('checkexampaper');
});

Route::group(['middleware' => 'permission:exams'], function() {

    Route::get('/start-exam', 'StudentController@viewExamPage')->name('viewexmpage');
    Route::get('/exam-result', 'StudentController@getExamResult')->name('exmres');
});


