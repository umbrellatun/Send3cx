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
    return view('welcome');
});


$router->group(['prefix' => 'api/3cx'], function () use ($router) {
    $router->get('ind', 'CC3CXTicketController@index');
    $router->post('save', 'CC3CXTicketController@store');
});

Route::prefix('/api/3cx')->group(function () {
    Route::get('/ind', 'CC3CXTicketController@index');
    Route::post('/save', 'CC3CXTicketController@store');
});
