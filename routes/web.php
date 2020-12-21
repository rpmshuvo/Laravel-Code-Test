<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/check', function () {

    
    // return Auth::guard('user')->user()->id;
    return view('welcome');
});

Route::get('/sign-up', 'UserAuthController@registrationForm')->name('user.registrationForm');
Route::post('/sign-up', 'UserAuthController@registration')->name('user.registration');
Route::get('/login', 'UserAuthController@loginForm')->name('user.loginForm');
Route::get('', 'UserAuthController@loginForm')->name('user.loginForm');
Route::post('/login', 'UserAuthController@login')->name('user.login');
Route::get('/logout', 'UserAuthController@logout')->name('user.logout');

Route::get('/dashboard', 'UserDashboardController@dashboard')->name('user.dashboard');

// 
Route::get('/license', 'LicenseController@index')->name('license.index');
Route::post('/license', 'LicenseController@createLicense')->name('license.createLicense');
// Route::post('/license-store', 'LicenseController@storeLicense')->name('license.storeLicense');
Route::post('/license-active', 'LicenseController@activeLicense')->name('license.activeLicense');
Route::get('/license-active-form', 'LicenseController@licenseActiveForm')->name('license.licenseActiveForm')->middleware('user');

//
Route::get('/get-user-by-ajax', 'LicenseController@getUserByAjax')->name('license.getUserByAjax');


