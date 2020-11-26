<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/create-password/{token}', 'Auth\LoginController@showPasswordForm');
Route::post('/create-password', 'Auth\LoginController@changePassword')->name('create-password');


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('clients', 'ClientController');
Route::resource('cities', 'CityController');

/*
 * Authentication Routes
 */
Auth::routes();
