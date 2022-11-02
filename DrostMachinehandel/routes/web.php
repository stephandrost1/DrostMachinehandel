<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoorraadController;
use App\Http\Controllers\LeasenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerhuurController;
use Illuminate\Support\Facades\App;

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

Route::middleware(['locale'])->group((function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/voorraad', [VoorraadController::class, 'index'])->name('voorraad');

    Route::get('/voorraad/machine', [VoorraadController::class, 'detail'])->name('machineDetail');

    Route::get('/leasen', [LeasenController::class, 'index'])->name('leasen');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    Route::post('/contact', [ContactController::class, 'submitRequest'])->name('contact');

    Route::get('/verhuur', [VerhuurController::class, 'index'])->name('verhuur');

    Route::get('/verhuurDetail', [VerhuurController::class, 'verhuurDetail'])->name('verhuurDetail');
}));

Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name("dashboard");
    Route::get('/verhuur', [DashboardController::class, "verhuur"])->name("dashboard-verhuur");
    Route::get('/messages', [DashboardController::class, "messages"])->name("dashboard-messages");
    Route::get('/analytics', [DashboardController::class, "analytics"])->name("dashboard-analytics");
    Route::get('/payments', [DashboardController::class, "payments"])->name("dashboard-payments");
    Route::get('/settings', [DashboardController::class, "settings"])->name("dashboard-settings");
    Route::get('/logout', [DashboardController::class, "logout"])->name("dashboard-logout");
});

Route::prefix('/api/v1')->middleware(['auth', 'verified'])->group(function () {
    Route::get("/vehicleViews", [DashboardApiController::class, "vehicleViews"]);
    Route::get("/vehicle/{id}", [VerhuurController::class, "getVehicleById"]);
});

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale.setting');

require __DIR__ . '/auth.php';
