<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\GuitarController;
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

Auth::routes();

Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin-dashboard');
Route::get('/contact', [App\Http\Controllers\AdminController::class, 'contact']);
Route::get('/forecasting',  [App\Http\Controllers\AdminController::class, 'forecasting'])->name('forecasting');
Route::get('/order_history',  [App\Http\Controllers\AdminController::class, 'order_history'])->name('order_history');

/**ROUTE FOR CRUD */
Route::resource("/food-item", FoodItemController::class);
Route::resource('/guitars', GuitarController::class);
 





/** */
Route::get('/admin-login',function(){
  return view('admin/admin-login');
})->name('admin-login');

// Route::get('/admin-dashboard',function(){
//   return view('admin/admin-dashboard');
// })->name('admin-dashboard');

Route::get('/staff-login',function(){
  return view('admin/admin-login');
})->name('staff-login');



 /* =----------------LESSONS----------------------= */
/*A route that will accept a user request for category and item as parameters */
 Route::get('/store/{category?}/{item?}',function($category=null,$item=null){
  if(isset($category)){
    
    if (isset($item)) {
      return "you are viewing the store for {$category} for {$item}";
    }
    return 'you are viewing the store for';

  }
  return 'You are viewing all instruments';
 });
