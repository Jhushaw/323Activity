<?php

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
    return view('Calculator');
});

    // Calculator routes
    
    Route::post('calculate', 'CalculatorController@calculate');
    
    Route::get('/calculator', function () {
        return view('Calculator');
    });
        
    Route::get('/calcResult', function () {
        return view('calcResult');
    });
    
    Route::get('ViewAllResults', 'CalculatorController@findAllResults');
