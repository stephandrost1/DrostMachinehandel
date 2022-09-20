<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoorraadController;
use App\Http\Controllers\LeasenController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/voorraad', [VoorraadController::class, 'index'])->name('voorraad');

Route::get('/api/voorraad', [VoorraadApiController::class, 'index'])->name('voorraadApi');

Route::get('/leasen', [LeasenController::class, 'index'])->name('leasen');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    // session()->put('locale', $locale);
    return redirect()->back();
})->name('locale.setting');
