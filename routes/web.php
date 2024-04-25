<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\GeneratedQrCodeController;
use App\Http\Controllers\Admin\CertifiedProviderController;
use App\Http\Controllers\Admin\CertifiedApplicatorController;
use App\Http\Controllers\Admin\EmailDistributionListController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\EquipmentWarrantyClaimController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\RegisteredQrCodeController;
use App\Http\Controllers\DataTableController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});
Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::middleware('admin.guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('forgot-password');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('forgot-password-email');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    /**
     * These route are protected route
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::get('/change-password', [PasswordController::class, 'create'])->name('password.create');
    Route::put('/change-password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * This route for Certified Providers
     */
    Route::resource('providers', CertifiedProviderController::class);
    
    /**
     * This route for Certified Applicators
     */
    Route::resource('applicators', CertifiedApplicatorController::class);

    Route::get('/applicators/registerequip/{id}', [CertifiedApplicatorController::class, 'applicatorRegisterEquip'])->name('applicator.registerEquip');

    Route::get('/applicators/warranty-claims/{id}', [CertifiedApplicatorController::class, 'applicatorWarrantyClaims'])->name('applicator.warranty-claims');

    /**
     * This route for Registered Equipment
     */
    Route::resource('registered-equipments', RegisteredQrCodeController::class);
    /**
     * This route for Equipment Warranty Claim
     */
    Route::resource('warranty-claims', EquipmentWarrantyClaimController::class);
    /**
     * This route for Clents
     */
    Route::resource('clents', ClientController::class);
    /**
     * This route for Clents
     */
    Route::resource('generated-qr-codes', GeneratedQrCodeController::class);
    /**
     * This route for Clents
     */
    Route::resource('email-distribution-list', EmailDistributionListController::class);

    /**
     * This route for custom datatable without yajra
     */
    Route::get('/provider-data', [DataTableController::class, 'index'])->name('provider');
});

require __DIR__ . '/artisanCommand.php';
