<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoorraadController;
use App\Http\Controllers\LeasenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\DealerVoorraadController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleImagesController;
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

Route::get('/dealer/create-account', [DashboardController::class, "dealerCreate"])->name("dealer-create");
// Route::get('/login', [DashboardController::class, 'index'])->name("dealer-login");

Route::prefix('/dealer')->middleware([])->group(function () {
    Route::get('/voorraad', [DealerVoorraadController::class, 'index'])->name("dealer-voorraad");
});

Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name("dashboard");
    Route::get('/verhuur', [DashboardController::class, "verhuur"])->name("dashboard-verhuur");

    Route::post("/vehicles/images/upload", [VehicleImagesController::class, "create"]);

    Route::get('/dealers', [DashboardController::class, "dealerRequests"])->name("dashboard-dealers");
    Route::post('/dealer/create', [DealerController::class, "create"])->name("dealer-create-request");
    Route::get('/analytics', [DashboardController::class, "analytics"])->name("dashboard-analytics");
    Route::get('/payments', [DashboardController::class, "payments"])->name("dashboard-payments");
    Route::get('/settings', [DashboardController::class, "settings"])->name("dashboard-settings");
    Route::get('/logout', [DashboardController::class, "logout"])->name("dashboard-logout");
});

Route::prefix('/api/v1')->middleware(['auth', 'verified'])->group(function () {
    Route::get("/vehicleViews", [DashboardApiController::class, "vehicleViews"]);

    Route::get("/vehicle/{id}", [VehicleController::class, "show"]);
    Route::delete("/vehicle/{id}/delete", [VehicleController::class, "destroy"]);
    Route::patch('/vehicle/{id}/update', [VehicleController::class, "update"]);

    Route::get('/vehicles', [VehicleController::class, "index"]);
    Route::get('/filters', [FilterController::class, "index"]);

    Route::get('/dealers/pending', [DealerController::class, "getPending"]);
    Route::get('/dealers/active', [DealerController::class, "getActive"]);
    Route::get('/dealers/page/{pageId}', [DealerController::class, "getAll"])->where("s", "[a-zA-Z0-9]+")->defaults('s', '');
    Route::patch('/dealer/{id}/active', [DealerController::class, "active"]);
    Route::patch('/dealer/{id}/deactive', [DealerController::class, "deactive"]);
    Route::patch('/dealer/{id}/update', [DealerController::class, "update"]);
    Route::delete('/dealer/{id}/delete', [DealerController::class, "delete"]);
});

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale.setting');

require __DIR__ . '/auth.php';
