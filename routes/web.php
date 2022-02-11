<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortennerController;

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
Route::get('/shortenner', [ShortennerController::class,'index'])->name('shortenner.index');
Route::get('/shortenner/add', [ShortennerController::class,'add'])->name('shortenner.create');
Route::get('/shortenner/top100', [ShortennerController::class,'top'])->name('shortenner.top');
Route::post('/shortenner', [ShortennerController::class,'shortit'])->name('shortenner.shortit');
Route::get('{code}', [ShortennerController::class,'shorted'])->name('shortenner.shorted');
