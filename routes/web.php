<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('country');
})->name('home');

Route::prefix('country')->name('country.')->group(function () {
    Route::post('/store', [CountryController::class, 'store'])->name('store');
    Route::get('/getall', [CountryController::class, 'getall'])->name('getall');
    Route::get('/{id}/edit', [CountryController::class, 'edit'])->name('edit');
    Route::post('/update', [CountryController::class, 'update'])->name('update');
    Route::delete('/delete', [CountryController::class, 'delete'])->name('delete');
});

Route::prefix('state')->name('state.')->group(function () {
    Route::get('/', [StateController::class, 'index'])->name('index');
    Route::post('/store', [StateController::class, 'store'])->name('store');
    Route::get('/getall', [StateController::class, 'getall'])->name('getall');
    Route::get('/{id}/edit', [StateController::class, 'edit'])->name('edit');
    Route::post('/update', [StateController::class, 'update'])->name('update');
    Route::delete('/delete', [StateController::class, 'delete'])->name('delete');
});

Route::prefix('city')->name('city.')->group(function () {
    Route::get('/', [CityController::class, 'index'])->name('index');
    Route::post('/store', [CityController::class, 'store'])->name('store');
    Route::get('/getall', [CityController::class, 'getall'])->name('getall');
    Route::get('/{id}/edit', [CityController::class, 'edit'])->name('edit');
    Route::post('/update', [CityController::class, 'update'])->name('update');
    Route::delete('/delete', [CityController::class, 'delete'])->name('delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
