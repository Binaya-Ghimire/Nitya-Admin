<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PaymentStatusController;
use App\Http\Controllers\Admin\PaymentTypeController;
use App\Http\Controllers\Admin\DefaultRateController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Admin\SmsHistoryController;

 Route::get('dashboard',[DashboardController::class, 'index'])->name('admin-dashboard');

Route::prefix('user')->group(function() {
	Route::get('view', [UserController::class, 'index'])->name('view-users');
	Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit-user');
	Route::get('create', [UserController::class, 'create'])->name('create-user');
	Route::post('store', [UserController::class, 'store'])->name('store-user');
	Route::get('show/{user}', [UserController::class, 'show'])->name('show-user');
	Route::put('update/{user}', [UserController::class, 'update'])->name('update-user');

	// route for user bann and unbann
	Route::get('banuser/{user}', [UserController::class, 'banUser'])->name('ban-user');
	Route::get('unbanuser/{user}', [UserController::class, 'unbanUser'])->name('unban-user');
	Route::get('loginWithoutPass/{user}', [UserController::class, 'loginWithoutPass'])->name('clientLogin');

	//Route for add balance to specific user
	Route::get('add-balance/{user}', [UserController::class, 'addBlanceForm'])->name('add-user-balance'); 
	Route::put('save-balance/{user}', [UserController::class, 'addBalance'])->name('save-user-balance');

	Route::get('rate/{user}', [UserController::class, 'addRate'])->name('add-rate-per-sms');
	Route::put('store-rate/{user}', [UserController::class, 'storeRate'])->name('store-rate-per-sms');
});

Route::prefix('role')->group(function() {
	Route::get('view', [RoleController::class, 'index'])->name('view-roles');
	Route::get('create', [RoleController::class, 'create'])->name('create-role');
	Route::post('store', [RoleController::class, 'store'])->name('store-role');
	Route::get('edit/{role}', [RoleController::class, 'edit'])->name('edit-role');
	Route::put('update/{role}', [RoleController::class, 'update'])->name('update-role');
	Route::delete('delete/{role}', [RoleController::class, 'destroy'])->name('delete-role');
});

Route::prefix('payment')->group(function (){
	Route::get('view', [PaymentController::class, 'index'])->name('view-payments');
	Route::get('show/{payment}', [PaymentController::class, 'show'])->name('show-payment');
	Route::put('update/{payment}', [PaymentController::class, 'update'])->name('update-payment');

	//Route for payment report
	Route::get('payment-report',[PaymentController::class, 'paymentReport'])->name('payment-report');
	Route::post('get-report', [PaymentController::class, 'userPaymentReport'])->name('fetch-report');

	//route for balance Report
	Route::get('balance-report', [PaymentController::class, 'balanceReport'])->name('balance-report');
	Route::post('get-balance-report', [PaymentController::class, 'userBalanceReport'])->name('get-balance-report');

	//Route for   balance report by user
	Route::get('user-balance-report/{user}', [PaymentController::class, 'getBalanceReportByUser'])->name('user-balance-report');
});

//route for payment status
Route::prefix('payment-status')->group(function() {
	Route::get('view', [PaymentStatusController::class, 'index'])->name('view-payments-status');
	Route::get('create', [PaymentStatusController::class, 'create'])->name('create-payment-status');
	Route::post('store', [PaymentStatusController::class, 'store'])->name('store-payment-status');
	Route::get('edit/{paymentStatus}', [PaymentStatusController::class, 'edit'])->name('edit-payment-status');
	Route::put('update/{paymentStatus}', [PaymentStatusController::class, 'update'])->name('update-payment-status');
	Route::delete('delete/{paymentStatus}', [PaymentStatusController::class, 'destroy'])->name('delete-payment-status');
});

//route for payment types
Route::prefix('payment-types')->group(function() {
	Route::get('view', [PaymentTypeController::class, 'index'])->name('view-payment-types');
	Route::get('create', [PaymentTypeController::class, 'create'])->name('create-payment-type');
	Route::post('store', [PaymentTypeController::class, 'store'])->name('store-payment-type');
	Route::get('edit/{paymentType}', [PaymentTypeController::class, 'edit'])->name('edit-payment-type');
	Route::put('update/{paymentType}', [PaymentTypeController::class, 'update'])->name('update-payment-type');
	Route::delete('delete/{paymentType}', [PaymentTypeController::class, 'destroy'])->name('delete-payment-type');

	// Route for payment type active deactive
	Route::get('activate/{paymentType}', [PaymentTypeController::class, 'activate'])->name('activate-paymenttype');
	Route::get('deactivate/{paymentType}', [PaymentTypeController::class, 'deactivate'])->name('deactivate-paymenttype');
});

//Route for Default Rates
Route::prefix('default')->group(function (){
	Route::get('view', [DefaultRateController::class, 'index'])->name('view-default-rate');
	Route::get('create', [DefaultRateController::class, 'create'])->name('create-default-rate');
	Route::post('store', [DefaultRateController::class, 'store'])->name('store-default-rate');
	Route::get('edit/{id}',[DefaultRateController::class, 'edit'])->name('edit-default-rate');
	Route::put('update/{id}',[DefaultRateController::class, 'update'])->name('update-default-rate');
});

Route::prefix('token')->group(function() {
	Route::get('view', [TokenController::class, 'index'])->name('view-tokens');
	Route::get('create', [TokenController::class, 'create'])->name('create-token');
	Route::post('store', [TokenController::class, 'store'])->name('store-token');
	Route::get('edit/{userToken}', [TokenController::class, 'edit'])->name('edit-token');
	Route::put('update/{userToken}',[TokenController::class, 'update'])->name('update-token');
	Route::get('delete/{userToken}', [TokenController::class, 'destroy'])->name('delete-token');
});

Route::prefix('sms')->group(function (){
	Route::get('history/{user}', [SmsHistoryController::class, 'smshistory'])->name('user-sms-history');
	Route::get('view_details/{smshistory}', [SmsHistoryController::class, 'viewMessage'])->name('view_details');
});


//Route for sending sms 
Route::get('createsms', [SmsController::class, 'createSms'])->name('create.sms');
Route::post('sendsms', [SmsController::class, 'sendSms'])->name('send.sms');