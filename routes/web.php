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

// Route::get('/', function () {
//     //return view('welcome');
//     return view('Layouts/login');
// });


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/','AuthController@loginView' );
Route::get('/register','AuthController@registerView' );;
Route::post('usersProfile/register','AuthController@register' );
Route::get('/dashboard',"AuthController@@dashboard");
Route::get('/logout', "AuthController@logout");

Route::post('users/login','AuthController@login' );
