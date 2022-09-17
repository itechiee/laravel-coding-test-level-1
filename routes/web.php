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

Route::group(['as' => 'web.events.'], function ()
{
    Route::get('events/create', 'EventController@create')->name('create')->middleware('auth');
    Route::get('events', 'EventController@index')->name('list');
    // Route::get('events/active-events', 'EventController@activeEvents')->name('active-events');
    Route::get('events/{id}', 'EventController@getEventById')->name('event-by-id');
    // Route::post('events', 'EventController@create')->name('create');
    Route::get('events/{id}/edit', 'EventController@edit')->name('edit');
    Route::post('events/{id}/update', 'EventController@update')->name('update');
    // Route::delete('events/{id}', 'EventController@destroy')->name('delete');

    
    Route::post('events/store', 'EventController@store')->name('store');
});
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mail', 'EventController@mailSend')->name('mail');