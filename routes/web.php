<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\GuitarController;
use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

/*Admin/staff login */
Route::get('/admin-login',function(){
  return view('admin/admin-login');
})->name('admin-login');
Route::get('/staff-login',function(){
  return view('admin/admin-login');
})->name('staff-login');


//Authenticated Admin
Route::middleware(['auth','isAdmin'])->group(function(){
  Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin-dashboard');
  Route::get('/contact', [App\Http\Controllers\AdminController::class, 'contact']);
  Route::get('/forecasting',  [App\Http\Controllers\AdminController::class, 'forecasting'])->name('forecasting');
  Route::get('/order_history',  [App\Http\Controllers\AdminController::class, 'order_history'])->name('order_history'); 
  /**ROUTE FOR FOOD MENU CRUD */
  Route::resource("/food-item", FoodItemController::class);
});

//Authenticated staff
Route::middleware('auth')->group(function(){
  Route::get('/foodorder',function(){
    return view('staff/foodorder');
  })->name('foodorder');
});

Auth::routes();

/* LARAVEL LESSON */
Route::resource('/guitars', GuitarController::class);

