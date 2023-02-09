<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\GuitarController;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MakeOrderController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\FoodItem_IngredientsController;

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
Route::get('create-new-user', function(){
  return view('auth/register');
})->name('create-new-user');

//Authenticated Admin
Route::middleware(['auth','isAdmin'])->group(function(){
  Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin-dashboard');
  Route::get('/contact', [App\Http\Controllers\AdminController::class, 'contact']);
  Route::get('/generate-reports',  [App\Http\Controllers\AdminController::class, 'reports'])->name('reports');
  Route::get('/order_history',  [App\Http\Controllers\AdminController::class, 'order_history'])->name('order_history');
  Route::get('/transaction_report',  [App\Http\Controllers\StaffController::class, 'transaction_report'])->name('transaction_report');
  /**ROUTE FOR FOOD MENU CRUD */
  Route::resource("/food-item", FoodItemController::class);
  Route::resource("/categories", CategoriesController::class);
  // user management by admin
  Route::resource('/manage-users', ManageUserController::class);
});

//Authenticated staff
Route::middleware('auth')->group(function(){
  Route::get('/menu', [App\Http\Controllers\StaffController::class, 'menu'])->name('menu');
  Route::get('/orders', [App\Http\Controllers\StaffController::class, 'orders'])->name('orders');
  Route::resource('/make_order', StaffController::class);
  Route::resource('/inventory', InventoryController::class);
  Route::resource('/foodItem_ingredients', FoodItem_IngredientsController::class);
});

Auth::routes();

/* LARAVEL LESSON */
Route::resource('/guitars', GuitarController::class);
