<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\App\Home\HomeController;
use App\Http\Controllers\App\HakAkses\HakAksesController;
use App\Http\Controllers\App\Todo\TodoController;
use App\Http\Controllers\App\RegisSemi\RegisSemiController;



Route::middleware(['throttle:req-limit', 'handle.inertia'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | SSO ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('sso')->group(function () {
        Route::get('/callback', [AuthController::class, 'ssoCallback'])->name('sso.callback');
    });

    /*
    |--------------------------------------------------------------------------
    | AUTH ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('/login-check', [AuthController::class, 'postLoginCheck'])->name('auth.login-check');
        Route::post('/login-post', [AuthController::class, 'postLogin'])->name('auth.login-post');

        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::get('/totp', [AuthController::class, 'totp'])->name('auth.totp');
        Route::post('/totp-post', [AuthController::class, 'postTotp'])->name('auth.totp-post');
    });

    /*
    |--------------------------------------------------------------------------
    | PROTECTED ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('check.auth')->group(function () {

        // HOME
        Route::get('/', [HomeController::class, 'index'])->name('home');

        // DOSEN
        Route::get('/dosen/home', function () {
            return inertia('app/dosen/dosen-home-page', [
                'pageName' => 'Dashboard Dosen',
            ]);
        })->name('dosen.home');

        // HAK AKSES
        Route::prefix('hak-akses')->group(function () {
            Route::get('/', [HakAksesController::class, 'index'])->name('hak-akses');
            Route::post('/change', [HakAksesController::class, 'postChange'])->name('hak-akses.change-post');
            Route::post('/delete', [HakAksesController::class, 'postDelete'])->name('hak-akses.delete-post');
            Route::post('/delete-selected', [HakAksesController::class, 'postDeleteSelected'])->name('hak-akses.delete-selected-post');
        });


        
        // TODO
        Route::prefix('todo')->group(function () {
            Route::get('/', [TodoController::class, 'index'])->name('todo');
            Route::post('/change', [TodoController::class, 'postChange'])->name('todo.change-post');
            Route::post('/delete', [TodoController::class, 'postDelete'])->name('todo.delete-post');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | LPPM - REGISTRASI SEMINAR / JURNAL
    |--------------------------------------------------------------------------
    */
 // ...
Route::get('/app/regis-semi/{id}/link-google-drive', [RegisSemiController::class, 'showInvite'])
     ->name('regis-semi.invite'); // <-- PASTIKAN NAMA INI SAMA
// ...
Route::get('/{id}/invite', [RegisSemiController::class, 'invite'])->name('invite');
// Rute untuk Detail Buku
Route::get('/app/regis-semi/{id}/detail', [RegisSemiController::class, 'show'])->name('regis-semi.detail');
Route::get('/{id}/result', [RegisSemiController::class, 'result'])->name('regis-semi.result');

Route::prefix('regis-semi')->name('regis-semi.')->group(function () {
            Route::get('/', [RegisSemiController::class, 'index'])->name('index');
            Route::post('/change', [RegisSemiController::class, 'postChange'])->name('change');
            Route::post('/delete', [RegisSemiController::class, 'postDelete'])->name('delete');
            Route::post('/delete-selected', [RegisSemiController::class, 'postDeleteSelected'])->name('delete-selected');
        });
    /*
    |--------------------------------------------------------------------------
    | PENGHARGAAN
    |--------------------------------------------------------------------------
    */
  
});