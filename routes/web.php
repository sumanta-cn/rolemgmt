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

Route::group(['middleware' => 'role:admin'], function() {

    Route::get('/add-roles', 'HomeController@viewRoles')->name('viewroles');
    Route::post('/add-roles', 'HomeController@addRoles');
    Route::post('/update-roles', 'HomeController@addRoles');
    Route::post('/delete-roles', 'HomeController@addRoles');

    Route::get('/add-permissions', 'HomeController@viewPermissions')->name('viewpermissions');
    Route::post('/add-permissions', 'HomeController@addPermissions');
    Route::post('/update-permissions', 'HomeController@addPermissions');
    Route::post('/delete-permissions', 'HomeController@addPermissions');

    Route::get('/add-user', 'HomeController@viewUser')->name('viewuser');
    Route::get('/add-user-details', 'HomeController@viewUserDetails')->name('adduserdetails');
    Route::post('/add-user-details', 'HomeController@addUserDetails');
    Route::post('/update-user-details', 'HomeController@updateUserDetails');
});

Route::group(['middleware' => 'role:faculty'], function() {

    Route::get('/create-exampapers', 'UserController@viewExamPaper')->name('viewexampaper');
    Route::get('/check-exampapers', 'UserController@viewCheckExamPaper')->name('checkexampaper');
});

Route::group(['middleware' => 'role:student'], function() {

    Route::get('/start-exam', 'StudentController@viewExamPage')->name('viewexmpage');
    Route::get('/exam-result', 'StudentController@getExamResult')->name('exmres');
});


