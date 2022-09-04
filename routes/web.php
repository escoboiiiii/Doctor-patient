<?php

use App\Http\Controllers\DoctoreController;
use App\Http\Controllers\fontController;
use App\Http\Controllers\forgetController;
use App\Http\Controllers\patientController;
use App\Http\Controllers\socialController;
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

Route::get('/', [fontController::class, 'index' ]);
Route::get('/login-page', [fontController::class, 'login'])->name('login.page')->middleware('redirect')->middleware('doctor.redirect');
Route::post('/login-page', [fontController::class, 'login_store'])->name('login.store')->middleware('redirect');
//Patient
Route::get('/patient-register', [patientController::class, 'p_register'])->name('p.register.create')->middleware('redirect');
Route::get('/patient-dashboard', [patientController::class, 'p_dashboard'])->name('p.dashboard')->middleware('patient');
Route::post('/patient-register', [patientController::class, 'p_register_create'])->name('p.register.create');
Route::post('/patient-login', [patientController::class, 'p_login'])->name('p.login');
Route::get('/patient-logout', [patientController::class, 'p_logout'])->name('p.logout');
Route::get('/patient-password-change', [patientController::class, 'p_password'])->name('p.password');
Route::post('/patient-password-change', [patientController::class, 'p_password_change'])->name('p.password.change');
Route::get('/patient-profile-setting', [patientController::class, 'p_setting'])->name('p.setting');
Route::post('/patient-profile-setting', [patientController::class, 'p_setting_store'])->name('p.setting.store');
Route::get('/patient-account-activation/{token?}', [patientController::class, 'p_activation']);
//Doctor Route
Route::get('/doctor-register', [DoctoreController::class, 'doctor_register']) -> name('d.register')->middleware('doctor.redirect');
Route::post('/doctor-register', [DoctoreController::class, 'doctor_register_store']) -> name('d.register.store');
Route::get('/doctor-dashboard', [DoctoreController::class, 'doctor_dashboard']) -> name('d.dashboard')->middleware('doctor');
//Doctor activation
Route::get('/doctor-account-activate/{token?}', [DoctoreController::class, 'doctor_account']);
Route::get('/doctor-logout', [DoctoreController::class, 'd_logout'])->name('d.logout');
Route::get('/doctor-password-change', [DoctoreController::class, 'd_password'])->name('d.password');
Route::post('/doctor-password-change', [DoctoreController::class, 'd_password_store'])->name('d.password.store');
//Forget Password
Route::get('/forget-password', [forgetController::class, 'f_password_page'])->name('f.password.page');
Route::post('/forget-password', [forgetController::class, 'f_password_check'])->name('f.password.check');
Route::get('/forget-password-reset/{token}/{email}', [forgetController::class, 'f_password_reset'])->name('f.password.reset');
Route::post('/forget-password-reset', [forgetController::class, 'f_password_reset_store'])->name('f.password.reset.store');

//login
Route::get('/facebook-login-req', [socialController::class, 'facebook_login_req'])->name('facebook.login.req');
Route::get('/facebook-login-system', [socialController::class, 'facebook_login_system'])->name('facebook.login.system');
//github
Route::get('/github-login-req', [socialController::class, 'github_login_req'])->name('github.login.req');
Route::get('/github-login-system', [socialController::class, 'github_login_system'])->name('github.login.system');