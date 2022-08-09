<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/', [PageController::class, 'welcome']);

Route::get('KlientuSaraksts', [PageController::class, 'clientList']);

Route::get('KlientuPiegades{clientID}', [PageController::class, 'clientDeliveries']);

Route::get('Atskaite1', [PageController::class, 'report1']);

Route::get('Atskaite2', [PageController::class, 'report2']);

Route::get('Atskaite3', [PageController::class, 'report3']);

Route::post('ajaxRequest', [PageController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');
