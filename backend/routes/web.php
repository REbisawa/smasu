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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

//axiosルーティング
Route::resource('axios', AxiosController::class)->only(['index', 'create', 'store']);

//↓lineログインルーティング
//line認証画面
Route::get('auth/line', 'Auth\LineOAuthController@redirectToProvider')->name('line.login');
// 認証後にリダイレクトされるURL(コールバックURL)
Route::get('auth/line/callback', 'Auth\LineOAuthController@handleProviderCallback');

require __DIR__.'/auth.php';
