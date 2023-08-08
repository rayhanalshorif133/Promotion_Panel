<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('clear', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    return 'clear.!!!';
});

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Auth::routes();

Route::middleware('auth')
    ->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        // Operator
        Route::name('operator.')
            ->prefix('operator')
            ->group(function () {
                Route::get('/', [OperatorController::class, 'index'])->name('index');
                Route::get('/fetch/{id}', [OperatorController::class, 'fetchById'])->name('fetch-by-id');
                Route::post('/store', [OperatorController::class, 'store'])->name('store');
                Route::post('/update', [OperatorController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [OperatorController::class, 'destroy'])->name('destroy');
            });

        // country
        Route::name('country.')
            ->prefix('country')
            ->group(function () {
                Route::get('/', [CountryController::class, 'index'])->name('index');
                Route::get('/fetch/{id}', [CountryController::class, 'fetchById'])->name('fetch-by-id');
                Route::post('/store', [CountryController::class, 'store'])->name('store');
                Route::post('/update', [CountryController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [CountryController::class, 'destroy'])->name('destroy');
            });

        // service
        Route::name('service.')
            ->prefix('service')
            ->group(function () {
                Route::get('/', [ServiceController::class, 'index'])->name('index');
                Route::get('/fetch/{id}', [ServiceController::class, 'fetchById'])->name('fetch-by-id');
                Route::post('/store', [ServiceController::class, 'store'])->name('store');
                Route::post('/update', [ServiceController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [ServiceController::class, 'destroy'])->name('destroy');
            });

        // publisher
        Route::name('publisher.')
            ->prefix('publisher')
            ->group(function () {
                Route::get('/', [PublisherController::class, 'index'])->name('index');
                Route::get('/fetch/{id}', [PublisherController::class, 'fetchById'])->name('fetch-by-id');
                Route::post('/store', [PublisherController::class, 'store'])->name('store');
                Route::post('/update', [PublisherController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [PublisherController::class, 'destroy'])->name('destroy');
            });

        // campaigns
        Route::name('campaigns.')
            ->prefix('campaigns')
            ->group(function () {
                Route::get('/', [CampaignController::class, 'index'])->name('index');
                Route::get('/report', [CampaignController::class, 'reportIndex'])->name('report.index');
            });

        // traffic
        Route::name('traffic.')
            ->prefix('traffic')
            ->group(function () {
                Route::get('/', [TrafficController::class, 'index'])->name('index');
            });
    });
