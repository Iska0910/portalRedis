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

Route::get('/', function () {
    return redirect(route('r.workers.list'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('blog/workers', 'BlogStatisticsController@workersList')->name('r.workers.list');
Route::get('blog/worker/{id}', 'BlogStatisticsController@workerDetail')->name('r.worker.detail');
Route::get('blog/worker/{id}', 'BlogStatisticsController@workerDetail')->name('r.worker.detail');
Route::get('blog/worker/{id}', 'BlogStatisticsController@workerDetail')->name('r.worker.detail');
