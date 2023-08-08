<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperatorController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\Operator;

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

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Auth::routes();

Route::middleware('auth')
    ->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Operator
    Route::name('operator.')
        ->prefix('operator')
        ->group(function() {
            Route::get('/', [OperatorController::class, 'index'])->name('index');
            Route::post('/store', [OperatorController::class, 'store'])->name('store');
    });

    // country
    Route::name('country.')
        ->prefix('country')
        ->group(function() {
            Route::get('/', [CountryController::class, 'index'])->name('index');
    });

    // service
    Route::name('service.')
        ->prefix('service')
        ->group(function() {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
    });

    // publisher
    Route::name('publisher.')
        ->prefix('publisher')
        ->group(function() {
            Route::get('/', [PublisherController::class, 'index'])->name('index');
    });

    // campaigns
    Route::name('campaigns.')
        ->prefix('campaigns')
        ->group(function() {
            Route::get('/', [CampaignController::class, 'index'])->name('index');
            Route::get('/report', [CampaignController::class, 'reportIndex'])->name('report.index');
    });

    // traffic
    Route::name('traffic.')
        ->prefix('traffic')
        ->group(function() {
            Route::get('/', [TrafficController::class, 'index'])->name('index');
    });
});



