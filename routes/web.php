<?php

use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\PilotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', [\App\Http\Controllers\HomeController::class, 'index'])->name('admin');

Route::controller(FlightController::class)->group(function () {
    Route::get('/flights', 'index')->name('flights.index');
    Route::get('/flights/create', 'create')->name('flights.create');
    Route::post('/flights', 'store')->name('flights.store');
    Route::get('/flights/{flight}/edit', 'edit')->name('flights.edit');
    Route::post('/flights/{flight}/update', 'update')->name('flights.update');
    Route::get('/flights/{flight}/stop', 'stop')->name('flights.stop');
    Route::delete('/flights/{id}/delete', 'destroy')->name('flights.destroy');

    Route::get('/flights/today', 'flightToDay')->name('flights.today');

})->middleware('auth');

//Route::resource('flights', FlightController::class)->middleware('auth');

Route::resource('pilots', PilotController::class)->middleware('auth');
