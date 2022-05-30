<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//frontend
Route::get('/', [FrontEndController::class, 'index'])->name('index');
Route::get('/gallery', [FrontEndController::class, 'gallery'])->name('gallery');
Route::post('/send/message', [FrontEndController::class, 'send_message'])->name('send.message');
Route::get('/volunteer', [FrontEndController::class, 'volunteer'])->name('volunteer');

//auth
Auth::routes();

//dashboard
Route::get('home', [HomeController::class, 'index'])->name('home');

//role protected
Route::group(['middleware' => 'checkRole'], function () {
    Route::get('settings', [HomeController::class, 'settings'])->name('settings');
    Route::post('settings/update', [HomeController::class, 'settings_update'])->name('settings.update');
    Route::get('site/banner', [HomeController::class, 'site_banner'])->name('site.banner');
    Route::post('site/banner/store', [HomeController::class, 'site_banner_store'])->name('site.banner.store');
    Route::get('site/banner/status/{id}', [HomeController::class, 'site_banner_status'])->name('site.banner.status');
    Route::get('site/banner/delete/{id}', [HomeController::class, 'site_banner_delete'])->name('site.banner.delete');
    Route::get('site/gallery', [HomeController::class, 'site_gallery'])->name('site.gallery');
    Route::post('site/gallery/store', [HomeController::class, 'site_gallery_store'])->name('site.gallery.store');
    Route::get('site/gallery/delete/{id}', [HomeController::class, 'site_gallery_delete'])->name('site.gallery.delete');
    Route::get('site/messages', [HomeController::class, 'messages'])->name('site.messages');
    Route::get('site/messages/{id}', [HomeController::class, 'messages_view'])->name('site.messages.view');
    Route::get('site/messages/delete/{id}', [HomeController::class, 'messages_delete'])->name('site.messages.delete');
    Route::get('site/logs', [HomeController::class, 'logs'])->name('site.logs');

    //users
    Route::get('users', [UserController::class, 'users'])->name('users');
    Route::get('users/create', [UserController::class, 'user_create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'user_store'])->name('users.store');
    Route::get('users/view/{id}', [UserController::class, 'users_view'])->name('users.view');
    Route::post('users/update/info', [UserController::class, 'users_update_info'])->name('users.update.info');
    Route::post('users/update/password', [UserController::class, 'users_update_password'])->name('users.update.password');
    Route::post('users/update/role', [UserController::class, 'users_update_role'])->name('users.update.role');
    Route::post('users/update/status', [UserController::class, 'users_update_status'])->name('users.update.status');
    Route::post('users/update/profile/picture', [UserController::class, 'users_update_profile_pic'])->name('users.update.profile.picture');
    Route::get('users/delete/{id}', [UserController::class, 'users_delete'])->name('users.delete');
    Route::get('users/trashed', [UserController::class, 'users_trashed'])->name('users.trashed');
    Route::get('users/delete/permanent/{id}', [UserController::class, 'users_delete_permanent'])->name('users.delete.permanent');
    Route::get('users/restore/{id}', [UserController::class, 'users_restore'])->name('users.restore');

    //funds
    Route::get('funds', [FundsController::class, 'funds'])->name('funds');
    Route::get('funds/list', [FundsController::class, 'funds_list'])->name('funds.list');
    Route::get('funds/view/{id}', [FundsController::class, 'funds_view_member'])->name('funds.view.member');
    Route::get('funds/add', [FundsController::class, 'funds_add'])->name('funds.add');
    Route::post('funds/store', [FundsController::class, 'funds_store'])->name('funds.store');
    Route::get('funds/edit/{id}', [FundsController::class, 'funds_edit'])->name('funds.edit');
    Route::post('funds/edit/', [FundsController::class, 'funds_update'])->name('funds.update');
    Route::get('funds/delete/{id}', [FundsController::class, 'funds_delete'])->name('funds.delete');

    //expense
    Route::get('expense', [ExpenseController::class, 'expense'])->name('expense');
    Route::get('expense/add', [ExpenseController::class, 'expense_add'])->name('expense.add');
    Route::post('expense/store', [ExpenseController::class, 'expense_store'])->name('expense.store');
    Route::get('expense/edit/{id}', [ExpenseController::class, 'expense_edit'])->name('expense.edit');
    Route::post('expense/edit/', [ExpenseController::class, 'expense_update'])->name('expense.update');
    Route::get('expense/delete/{id}', [ExpenseController::class, 'expense_delete'])->name('expense.delete');

    //roles
    Route::get('role', [UserController::class, 'role'])->name('role');
    Route::post('role/add', [UserController::class, 'role_add'])->name('role.add');
    Route::post('role/edit/get/date', [UserController::class, 'role_edit_data'])->name('role.edit.data');
    Route::post('role/edit', [UserController::class, 'role_edit'])->name('role.edit');
    Route::get('role/delete/{id}', [UserController::class, 'role_delete'])->name('role.delete');
});

//user profile
Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
Route::post('profile/update/info', [UserController::class, 'profile_update_info'])->name('profile.update.info');
Route::post('profile/update/profile/picture', [UserController::class, 'profile_update_profile_pic'])->name('profile.update.profile.picture');

//personal funds
Route::get('funds/view', [FundsController::class, 'funds_view_personal'])->name('funds.view.personal');
Route::get('funds/view/details/{id}', [FundsController::class, 'funds_view_details'])->name('funds.view.details');

//mail
Route::get('mail', [MailController::class, 'mail'])->name('mail');

//debug
Route::get('debug', [HomeController::class, 'debug'])->name('debug');
