<?php

use App\Http\Controllers\Credential\CredentialController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Tg\PassBotController;
use Illuminate\Http\Request;
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

// tg pass_bot
Route::post('/passbot', PassBotController::class)->middleware(['auth-passbot',]);

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => '/sites',
        'name' => 'sites.',
    ],
    function () {
        Route::get('/', [SiteController::class, 'index'])->name('index');
        Route::post('/', [SiteController::class, 'store'])->name('store');
        Route::delete('/{site}', [SiteController::class, 'destroy'])->name('destroy');
        Route::get('/{site}', [SiteController::class, 'show'])->name('show');
        Route::patch('/{site}', [SiteController::class, 'update'])->name('update');
    }
);

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => '/sites/{site}/credentials',
        'name' => 'credentials.',
    ],
    function () {
        Route::post('/', [CredentialController::class, 'store'])->name('store');
        Route::delete('/{credential}', [CredentialController::class, 'destroy'])->name('destroy');
    }
);