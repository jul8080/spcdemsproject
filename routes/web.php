<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\SamsonEmployeeController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\ProfileSettingsController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\User\EmployeeAttendance;
use App\Http\Controllers\User\DetailController;
use App\Http\Controllers\User\EmergencyContactInformation;
use App\Http\Controllers\User\SettingsController;
use App\Http\Controllers\User\UserRoleController;
use GuzzleHttp\Middleware;
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


Route::prefix('admin')->middleware(['auth', 'isAdmin', 'PreventBackHistory'])->name('admin.')->group(function(){

    Route::controller(SamsonEmployeeController::class)->group(function()
    {
        Route::get('/dashboard', 'homePage')->name('dashboard');
        Route::get('/employee', 'employeePage')->name('employee');
        Route::get('/attendance', 'attendancePage')->name('attendance');
        Route::get('/user/edit/{id}','userEdit')->name('user.edit');



        Route::get('/employee/{id}', 'Profile')->name('profile');
        Route::post('/search/user', 'searchUser')->name('search.employee');
        Route::put('/user/store', 'userStore')->name('user.store');

        // logs api
        Route::get('/api-logs', 'employeelogs');
        Route::get('/view-log/{id}', 'viewLog');
        Route::get('/user-lists', 'users');
    });

    Route::controller(AdminProfileController::class)->group(function(){
        Route::get('/profile', 'adminProfile')->name('profile');
        Route::post('/change/photo', 'updatePhoto')->name('change.photo');
    });

    Route::controller(UserController::class)->group(function()
    {
        // Route::get('/create/employee', 'createEmployee')->name('create.employee');
        // Route::get('/create', 'create')->name('create');
        Route::post('/create/employee', 'storeEmployee')->name('store.employee');
    });
    // admin panel settings
    Route::controller(ProfileSettingsController::class)->group(function(){
        // profile info settings
        Route::get('/profile/settings', 'profileSettingsPage')->name('profile.settings');
        Route::put('/profile/edit/{id}', 'updateProfilePage')->name('update.profile');

        // personal info settings
        Route::get('/personal/info/settings', 'createOrUpdate')->name('personal.info.settings');
        Route::post('/personal/info', 'store')->name('personal.info');

        // emergency contact settings
        Route::get('/emergency/contact/settings', 'createOrInsert')->name('emergency.contact.settings');
        Route::post('/emergency/contact', 'storeInfo')->name('emergency.contact.store');

        // change password settings
        Route::get('/password/settings', 'passwordSettingsPage')->name('password.settings');
        Route::post('/password/change', 'passwordChangePage')->name('password.change');

    });

});

// user logout connot be put inside the admin middleware nor user, because it will cause error!
Route::middleware(['auth', 'PreventBackHistory'])->group(function(){

    Route::post('/logout', [UserController::class, 'userLogout'])->name('logout');

});



Route::middleware(['guest', 'PreventBackHistory'])->group(function(){

    Route::get('/login', [UserController::class, 'userLogin'])->name('login');
    Route::post('/login', [UserController::class, 'checkAttemp'])->name('check.attemp');

});



// User Controller
Route::prefix('user')->middleware(['auth', 'isUser', 'PreventBackHistory'])->name('user.')->group(function(){

    Route::controller(UserRoleController::class)->group(function()
    {
        Route::get('/dashboard', 'homePage')->name('dashboard');
        Route::get('/profile', 'userProfile')->name('profile');


        Route::post('/change/photo', 'changePhoto')->name('change.photo');
    });


    // user settings router
    Route::controller(SettingsController::class)->group(function()
    {
        Route::get('/profile/settings', 'profileSettingsPage')->name('profile.settings');
        Route::put('/profile/edit/{id}', 'updateProfilePage')->name('update.profile');

        Route::get('/password/settings', 'passwordSettingsPage')->name('password.settings');
        Route::post('/password/change', 'passwordChangePage')->name('password.change');

    });

    Route::controller(DetailController::class)->group(function(){

        Route::get('/personal/info/settings', 'createOrUpdate')->name('personal.info.settings');
        Route::post('/personal/info', 'store')->name('personal.info');

    });

    Route::controller(EmergencyContactInformation::class)->group(function(){

        Route::get('/emergency/contact/settings', 'createOrUpdate')->name('emergency.contact.settings');
        Route::post('/emergency/contact', 'store')->name('emergency.contact');


    });

    Route::controller(EmployeeAttendance::class)->group(function(){

        Route::get('/attendance', 'attendancePage')->name('attendance');
        Route::post('/attendance/store', 'storeTime')->name('store.attendance');

    });

});

Route::controller(ScannerController::class)->group(function(){

    Route::get('/scanner', 'index');
    Route::get('/scanner/logs', 'logs');
    Route::post('/scanner/store', 'store');
    Route::get('/test', 'test');

});



