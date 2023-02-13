<?php

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
    return redirect()->route('financialIndicators.index');
});

Route::get('financial-indicators/chart', 'FinancialIndicatorController@chartFilter')->name('financialIndicators.chart');
Route::resource('financial-indicators', 'FinancialIndicatorController')->names('financialIndicators');
