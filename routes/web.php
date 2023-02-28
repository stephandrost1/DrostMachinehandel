<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoorraadController;
use App\Http\Controllers\LeasenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealerVehicleController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\MaintenanceVehicleController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleImagesController;
use App\Http\Controllers\VerhuurController;
use App\Models\MaintenanceVehicle;
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
    Route::get('/voorraad/machine', [VoorraadController::class, 'detail'])->name('voorraad-detail');
    Route::get('/leasen', [LeasenController::class, 'index'])->name('leasen');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'submitRequest'])->name('contact');
    Route::get('/404', function () {
        return view("errors.404");
    })->name("404");
    Route::get('/500', function () {
        return view("errors.500");
    })->name("500");
    Route::prefix("/verhuur")->group(function () {
        Route::get('/', [VerhuurController::class, 'index'])->name('verhuur');
        Route::get('/detail/{id}/{name}', [VerhuurController::class, 'verhuurDetail'])->name('verhuurDetail');
    });
}));

Route::prefix("/dealer")->middleware(['locale'])->group(function () {
    Route::get('/create-account', [DashboardController::class, "dealerCreate"])->name("dealer-create");
    Route::post('/create-account', [UserController::class, 'store'])->name("dealer-create-request");
    Route::middleware(['role:Dealer|Admin', 'verified'])->group(function () {
        Route::get('/voorraad', [DealerVehicleController::class, 'show'])->name("dealer-voorraad");
        Route::get('/voorraad/machine', [DealerVehicleController::class, 'detail'])->name("dealer-voorraad-detail");
    });
});

Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/settings', [DashboardController::class, "settings"])->name("dashboard-settings");
        Route::get('/', [DashboardController::class, 'index'])->name("dashboard");
        Route::get('/verhuur', [DashboardController::class, "verhuur"])->name("dashboard-verhuur");
        Route::get('/vehicles', [DashboardController::class, "vehicles"])->name("dashboard-vehicles");
        Route::get('/dealers', [DashboardController::class, "dealerRequests"])->name("dashboard-dealers");
        Route::get('/statistics', [DashboardController::class, "statistics"])->name("dashboard-statistics");
        Route::get('/reservations', [DashboardController::class, "reservations"])->name("dashboard-reservations");
        Route::get('/maintenance/vehicles', [DashboardController::class, "maintenance"])->name("dashboard-maintenance");
    });
    Route::get('/account', [DashboardController::class, "account"])->name("dashboard-account");
    Route::get('/logout', [DashboardController::class, "logout"])->name("dashboard-logout");
});

Route::prefix('/api/v1')->middleware(['auth', 'verified'])->group(function () {
    Route::prefix("/vehicles")->group(function () {
        Route::prefix("/maintenance")->group(function () {
            Route::prefix("/action")->group(function () {
                Route::patch("/{id}", [MaintenanceVehicleController::class, "editAction"]);
                Route::delete("/{id}", [MaintenanceVehicleController::class, "deleteAction"]);
                Route::post("/", [MaintenanceVehicleController::class, "createAction"]);
            });

            Route::get("/", [MaintenanceVehicleController::class, "index"]);
            Route::post("/", [MaintenanceVehicleController::class, "create"]);
            Route::get("/{id}", [MaintenanceVehicleController::class, "show"]);
            Route::delete("/{id}", [MaintenanceVehicleController::class, "destroy"]);
            Route::patch("/{id}", [MaintenanceVehicleController::class, "update"]);
        });

        Route::prefix("/images")->group(function () {
            Route::post("/upload", [VehicleImagesController::class, "create"]);
            Route::get("/{id}", [VehicleImagesController::class, "show"]);
        });
        Route::get("/views", [VehicleController::class, "vehicleViews"]);
        Route::get("/{id}", [VehicleController::class, "show"]);
        Route::post('/', [VehicleController::class, "create"]);
        Route::delete("/{id}/delete", [VehicleController::class, "destroy"]);
        Route::patch('/{id}/update', [VehicleController::class, "update"]);
    });

    Route::prefix("/users")->group(function () {
        //GET
        Route::get("/", [UserController::class, "index"]);
        Route::get('/page/{pageId}', [UserController::class, "pager"])->where("s", "[a-zA-Z0-9]+")->defaults('s', '');

        //PATCH
        Route::patch('/{id}/activate', [UserController::class, "activate"]);
        Route::patch('/{id}/deactivate', [UserController::class, "deactivate"]);
        Route::patch('/{id}/update', [UserController::class, "update"]);
        Route::patch('dealer/{id}/update', [UserController::class, "updateDealer"]);

        //DELETE
        Route::delete('/{id}/delete', [UserController::class, "destroy"]);
    });

    Route::prefix("/dealer")->group(function () {
        Route::prefix("/vehicles")->group(function () {
            Route::get('/', [DealerVehicleController::class, "index"])->where("svm", '[a-zA-Z0-9/_-]+');
            Route::get('/fetch', [DealerVehicleController::class, "fetchVehicles"]);
            Route::patch('/{id}/update', [DealerVehicleController::class, "update"]);
            Route::delete('/{id}', [DealerVehicleController::class, "delete"]);
        });
        Route::get('/vehicle', [DealerVehicleController::class, "getById"])->where("svm", '[a-zA-Z0-9/_-]+');
    });

    Route::prefix("/reservations")->group(function () {
        Route::get('/{page}', [ReservationController::class, "index"])->where("s", "[a-zA-Z0-9]+")->defaults('s', '');
        Route::patch("/{id}/accept", [ReservationController::class, "accept"]);
        Route::delete("/{id}/delete", [ReservationController::class, "delete"]);
    });

    Route::prefix("/user")->group(function () {
        Route::get('/', [UserController::class, "index"]);
        Route::get('/{id}', [UserController::class, "show"]);
        Route::patch('/{id}/update', [UserController::class, "update"]);
    });
});

Route::prefix('/api/v2')->group(function () {
    Route::get('/vehicles', [VehicleController::class, "index"]);
    Route::get('/filters', [FilterController::class, "index"]);
    Route::get("/vehicle/{id}/images", [VehicleImagesController::class, "getByVehicleId"]);
    Route::post('/vehicle/reservation/occasions', [ReservationController::class, "storeOccasions"]);
    Route::post('/vehicle/reservation', [ReservationController::class, "store"]);
});

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale.setting');

require __DIR__ . '/auth.php';
