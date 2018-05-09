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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'MainController@index')
    ->name('mainPage');

Route::get('/about/{id?}', 'MainController@about')
    ->where('id', '[0-9]+')
    ->name('aboutRoute');

//Route::redirect('/login', '/404', 302);


Route::get('/login', 'TestController@showLoginForm')
    ->name('loginRoute');
Route::post('/login', 'TestController@postingLoginData')
    ->name('loginRoutePost');

Route::match(['get', 'put', 'post'],'/login1', function () {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo 'POST';
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        echo 'GET';
    }

    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        echo 'PUT';
    }
});

Route::view('/404', '404');

/*Route::get('/about', function () {
    return 'test';
});*/


