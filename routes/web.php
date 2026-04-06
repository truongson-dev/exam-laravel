<?php

use App\Http\Controllers\Ptb1Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\GiaiController;
use Illuminate\Http\Request;
use App\Http\Controllers\RestaurantController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function () {
    return view('examples.hello');
});

Route::get('/hello2', [HelloController::class, 'showHello']);

// Hiển thị form và xử lý
Route::get('ptb1', [Ptb1Controller::class, 'showPtb1']);
Route::post('ptb1', [Ptb1Controller::class, 'giaiPtb1']);

Route::get('ptb1linh', [GiaiController::class, 'showPtb1Linh']);
Route::post('ptb1linh', [GiaiController::class, 'giaiPtb1Linh']);

use App\Http\Controllers\CarController;

Route::resource('cars', CarController::class);


// ---------------KIỂM TRA ĐỀ B: RESTAURANT-------------
// Home — all categories
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

// Category listing
Route::get('/category/{category}', [RestaurantController::class, 'category'])->name('restaurant.category');

// Detail page
Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurant.show');

// Create form
Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');

// Store
Route::post('/restaurant', [RestaurantController::class, 'store'])->name('restaurant.store');

// Edit form
Route::get('/restaurant/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurant.edit');

// Update
Route::put('/restaurant/{id}', [RestaurantController::class, 'update'])->name('restaurant.update');

// Delete
Route::delete('/restaurant/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.destroy');