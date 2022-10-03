<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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



Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
Route::group(['prefix'=> 'offers'], function(){
    //Route::get('store', [CrudController::class, 'store']);
    
        Route::get('create', [CrudController::class, 'create'])->name('offers.create');
        Route::get('all', [CrudController::class, 'getOffers'])->name('getAllOffers');
        Route::post('store', [CrudController::class, 'store'])->name('Offers.store');

        Route::get('edit/{offer_id}', [CrudController::class, 'editOffers'])->name('offers.edit');
        Route::post('update/{offer_id}', [CrudController::class, 'updateOffers'])->name('offers.update');
});
});