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

// Public routes
Route::get('/', 'HomeController@index');
Route::group(['middleware' => ['web', 'activity']], function () {
    Route::get('/home', 'WelcomeController@welcome')->name('home');
});

// Auth scaffolding route includes
Auth::routes();

// Authenticated user routes
Route::middleware(['web', 'auth', 'activity'])->group(function () {
    Route::resource('accounts', 'AccountsController');
//    Route::resource('billing', 'BillingController');
    Route::resource('gateways', 'GatewaysController');
    Route::resource('recipients', 'RecipientsController');
    Route::resource('routers', 'RoutersController');
    Route::resource('messages', 'MessagesController');
    Route::resource('sources', 'SourcesController');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

Route::group(['middleware' => ['web', 'activity']], function () {
    Route::get('/', 'WelcomeController@welcome')->name('welcome');
});

// Admin Routes
Route::group(['middleware' => ['auth', 'web', 'activity', 'role:admin'], 'namespace' => '\App\Http\Controllers'], function () {
    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
    ]);
    Route::post('search-users', '\App\Http\Controllers\UsersManagementController@search')->name('search-users');
    //Route::get('/users', 'UsersManagementController@index');
    //Route::get('/users/{id}', 'AccountsController@index');
    //Route::get('/users/create', 'AccountsController@index');
    //Route::get('/users/{id}/edit', 'AccountsController@index');
});

Route::group(['prefix' => 'activity', 'namespace' => 'jeremykenedy\LaravelLogger\App\Http\Controllers', 'middleware' => ['web', 'auth', 'activity']], function () {

    // Dashboards
    Route::get('/', 'LaravelLoggerController@showAccessLog')->name('activity');
    Route::get('/cleared', ['uses' => 'LaravelLoggerController@showClearedActivityLog'])->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', 'LaravelLoggerController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', 'LaravelLoggerController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', ['uses' => 'LaravelLoggerController@clearActivityLog'])->name('clear-activity');
    Route::delete('/destroy-activity', ['uses' => 'LaravelLoggerController@destroyActivityLog'])->name('destroy-activity');
    Route::post('/restore-log', ['uses' => 'LaravelLoggerController@restoreClearedActivityLog'])->name('restore-activity');
});

// Message Routes
Route::group(['middleware' => ['auth', 'web', 'activity'], 'namespace' => '\App\Http\Controllers'], function () {
    Route::resource('messages', 'MessagesController', [
        'names' => [
            'index'   => 'messages',
            'destroy' => 'message.destroy',
        ],
    ]);
    Route::post('search-messages', '\App\Http\Controllers\MessagesController@search')->name('search-messages');
});
