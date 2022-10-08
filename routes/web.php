<?php

use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Relations\RelationsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group, which
| contains the “web” middleware group. Now create something great!
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
        Route::get('delete/{offer_id}', [CrudController::class, 'deleteOffers'])->name('offers.delete');
        Route::get('edit/{offer_id}', [CrudController::class, 'editOffers'])->name('offers.edit');
        Route::post('update/{offer_id}', [CrudController::class, 'updateOffers'])->name('offers.update');
});
Route::get('video', [CrudController::class, 'getVideo'])->middleware('auth');
});
Route::get('dashboard', function (){
   return 'Not adult';
})->name('not.adult');


################ Begin Ajax routes ################
Route::group(['prefix' => 'ajaxOffers'], function(){
    Route::get('create', [OfferController::class, 'create'])->name('ajax.offers.create');;
    Route::post('store', [OfferController::class, 'store'])->name('ajax.offers.store');
    Route::get('all', [OfferController::class, 'all'])->name('ajax.offers.all');
    Route::post('delete', [OfferController::class, 'delete'])->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', [OfferController::class, 'edit'])->name('ajax.offers.edit');
    Route::post('update', [OfferController::class, 'update'])->name('ajax.offers.update');
});
################ End Ajax routes ################


################ Begin Authentication && Guards ################
Route::group(['middleware' => 'CheckAge'], function(){
Route::get('adult', [CustomAuthController::class, 'adult'])->name('adult');
});

Route::get('site', [CustomAuthController::class, 'site'])->middleware('auth:web')->name('site');
Route::get('admin', [CustomAuthController::class, 'admin'])->middleware('auth:admin')->name('admin');

Route::get('adminLogin', [CustomAuthController::class, 'adminLogin'])->name('admin.login');
Route::get('admin/login', [CustomAuthController::class, 'checkAdminLogin'])->name('check.admin.login');

################ End Authentication && Guards ################


################ Begin relations routes ######################
Route::get('hasOne', [RelationsController::class, 'hasOne']);
Route::get('hasOneReverse', [RelationsController::class, 'hasOneReveres']);

Route::get('userHasPhone', [RelationsController::class, 'userHasPhone']);
Route::get('userDontHavePhone', [RelationsController::class, 'userDontHavePhone']);
################ End relations routes ######################
