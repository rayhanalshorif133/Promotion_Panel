<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PostBackController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ResponsiveTableController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrafficController;
use App\Http\Controllers\UserController;
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

        // User
        Route::name('user.')
            ->prefix('user')
            ->group(function () {
                Route::get('/index', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/view/{id}', [UserController::class, 'view'])->name('view');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
            });
            
        // Operator
        Route::name('operator.')
            ->prefix('operator')
            ->group(function () {
                Route::get('/', [OperatorController::class, 'index'])->name('index');
                Route::get('/fetch-all', [OperatorController::class, 'fetchAll'])->name('fetch-all');
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
        Route::name('campaign.')
            ->prefix('campaign')
            ->group(function () {
                Route::get('/', [CampaignController::class, 'index'])->name('index');
                Route::get('/create', [CampaignController::class, 'create'])->name('create');
                Route::get('/show/{id}', [CampaignController::class, 'show'])->name('show');
                Route::get('/edit/{id}', [CampaignController::class, 'edit'])->name('edit');
                Route::post('/store', [CampaignController::class, 'store'])->name('store');
                Route::put('/update', [CampaignController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [CampaignController::class, 'destroy'])->name('destroy');
                Route::get('/report', [CampaignController::class, 'report'])->name('report');
                Route::get('/fetch-report/{campaign_id}/{start_date}/{end_date?}', [CampaignController::class, 'campaignReport'])->name('fetch-report');
                Route::get('/fetch-report-data/{campaign_id}/{start_date}/{end_date?}', [CampaignController::class, 'campaignReportData'])->name('fetch-report-data');
            });

        // traffic
        Route::name('traffic.')
            ->prefix('traffic')
            ->group(function () {
                Route::get('/', [TrafficController::class, 'index'])->name('index');
                Route::get('/fetch/{id}', [TrafficController::class, 'fetchById'])->name('fetch-by-id');
                Route::delete('/delete/{id}', [TrafficController::class, 'destroy'])->name('destroy');
            });

        // Post Back URL
        Route::name('post-back.')
            ->prefix('post-back')
            ->group(function () {
                Route::get('/send-logs', [PostBackController::class, 'sendLogs'])->name('send-logs');
                Route::get('/received-logs', [PostBackController::class, 'receivedLogs'])->name('received-logs');
            });
    });

// traffic
Route::prefix('traffic')
    ->name('traffic.')
    ->group(function(){
    Route::get('/{campaignId}/{serviceId}/{operatorName}/{clickedID}', [TrafficController::class, 'redirect'])
        ->name('redirect');
    // post-back
    
    Route::get('/check/publisher/url/', [TrafficController::class, 'checkURL'])->name('check-url');
});


Route::get('table', [ResponsiveTableController::class, 'index'])->name('table');


