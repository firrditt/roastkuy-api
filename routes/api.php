<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PromoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout', [AuthController::class, 'logout'])->name('account.logout');
    Route::get('account', [AccountController::class, 'index'])->name('account.detail');
    Route::patch('account-edit', [AccountController::class, 'updateProfileData'])->name('account.edit');
    Route::get('promo', [PromoController::class, 'getAllPromos'])->name('account.promo');
    Route::get('verification-account/send', [AuthController::class, 'sendVerificationOTP'])->name('account.send');
    Route::post('verification-account', [AuthController::class, 'accountVerification'])->name('account.verification');
    Route::post('delete-account', [AccountController::class, 'deactiveAccount'])->name('account.delete');
});

Route::middleware('guest')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('account.login');
    Route::post('register', [AuthController::class, 'register'])->name('account.register');
    // Route::post('verification-account/{uuid}/send', [AuthController::class, 'sendVerification'])->name('account.verification');
    Route::get('brands', [OutletController::class, 'getAlloutlet'])->name('outlet.show');
    Route::get('outlet', [OutletController::class, 'getAll'])->name('outlet.get');
    Route::get('outlet/{slug}', [OutletController::class, 'getBySlug'])->name('outlet.slug');
    Route::get('menu/{id}', [MenuController::class, 'getMenuById'])->name('menu.id');
    Route::get('menu-detail/{id}', [MenuController::class, 'getMenuDetail'])->name('menu.complement');
    Route::get('promo-regular', [PromoController::class, 'getRegularPromos'])->name('regular.promo');
});
