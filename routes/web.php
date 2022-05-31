<?php

use App\Http\Controllers\CPUBrandController;
use App\Http\Controllers\CPUController;
use App\Http\Controllers\GlassController;
use App\Http\Controllers\ModelBrandController;
use App\Http\Controllers\ModelMaterialController;
use App\Http\Controllers\OSController;
use App\Http\Controllers\ScreenMaterialController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\UsersController;
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

Route::controller(UsersController::class)->group(function() {
    Route::get('/user', 'index');
    Route::post('/store-user', 'store');
});


Route::controller(CPUBrandController::class)->group(function() {
    Route::get('/cpubrand', 'index');
    Route::get('/cpubrand/{id}', 'show');
});

Route::controller(CPUController::class)->group(function() {
    Route::get('/cpu', 'index');
    Route::get('/cpu/{id}', 'show');
    Route::post('/store-cpu', 'store');
    Route::post('/update-cpu', 'update');
    Route::post('/delete-cpu', 'delete');
});

Route::controller(GlassController::class)->group(function() {
    Route::get('/glass', 'index');
    Route::get('/glass/{id}', 'show');
    Route::post('/store-glass', 'store');
    Route::post('/update-glass', 'update');
    Route::post('/delete-glass', 'delete');
});

Route::controller(ModelBrandController::class)->group(function() {
    Route::get('/modelbrand', 'index');
    Route::get('/modelbrand/{id}', 'show');
    Route::post('/store-modelbrand', 'store');
    Route::post('/update-modelbrand', 'update');
    Route::post('/delete-modelbrand', 'delete');
});

Route::controller(ModelMaterialController::class)->group(function() {
    Route::get('/modelmaterial', 'index');
    Route::get('/modelmaterial/{id}', 'show');
});

Route::controller(OSController::class)->group(function() {
    Route::get('/os', 'index');
    Route::get('/os/{id}', 'show');
    Route::post('/store-os', 'store');
    Route::post('/update-os', 'update');
    Route::post('/delete-os', 'delete');
});

Route::controller(ScreenMaterialController::class)->group(function() {
    Route::get('/screenmaterial', 'index');
    Route::get('/screenmaterial/{id}', 'show');
});

Route::controller(ModelController::class)->group(function() {
    Route::get('/model', 'index');
    Route::get('/model/{id}', 'show');
    Route::post('/store-model', 'store');
    Route::post('/update-model', 'update');
    Route::post('/delete-model', 'delete');
});

Route::controller(SmartphoneController::class)->group(function() {
    Route::get('/phone', 'index');
    Route::get('/phone/{id}', 'show');
    Route::post('/compare', 'compare');
});
