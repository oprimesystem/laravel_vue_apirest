<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('blog',App\Http\Controllers\BlogController::class)->only(['index','store','update','show','destroy']);
//Route::resource('products',App\Http\Controllers\ProductController::class)->only(['index','store','update','show','destroy']);
Route::get('/usuarios','App\Http\Controllers\UsuarioController@index');//index
Route::get('/usuario/{id}','App\Http\Controllers\UsuarioController@show');//show
Route::post('/usuarios','App\Http\Controllers\UsuarioController@store');//store
Route::put('/usuarios/{id}','App\Http\Controllers\UsuarioController@update');//update
Route::delete('/usuarios/{id}','App\Http\Controllers\UsuarioController@destroy');//delete

/*CRUD POSTS*/
Route::get('/posts','App\Http\Controllers\PostController@index');//index post
Route::post('/posts','App\Http\Controllers\PostController@store');//store
Route::put('/posts/{id}','App\Http\Controllers\PostController@update');//update