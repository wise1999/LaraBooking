<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\FacilityController as FrontFacilityController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'name' => 'admin.', 'middleware' => ['role:admin']], function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.dashboard');
    Route::resource('facilities', FacilityController::class)->parameters([
        'facilities' => 'facility:slug',
    ]);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class)->parameters([
        'categories' => 'category:slug',
    ]);
    Route::resource('bookings', BookingController::class);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/facilities', [FrontFacilityController::class, 'index'])->name('facilities');
Route::get('/facility/{slug}', [FrontFacilityController::class, 'show'])->name('facility.show');
Route::post('/facility/store', [FrontFacilityController::class, 'store'])->middleware(['auth'])->name('facility.store');

require __DIR__.'/auth.php';
