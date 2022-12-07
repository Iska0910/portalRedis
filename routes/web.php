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
    return redirect(route('home'));
});

Auth::routes();

Route::get('/home', function (){
    return view ('home');
})->name('home');

Route::get('blog/workers', 'BlogStatisticsController@workersList')->name('r.blog.workers.list');
Route::get('blog/worker/{id}', 'BlogStatisticsController@workerDetail')->name('r.blog.worker.detail');

Route::get('composition/workers', 'CompositionStatisticsController@workersList')->name('r.comp.workers.list');
Route::get('composition/worker/{id}', 'CompositionStatisticsController@workerDetail')->name('r.comp.worker.detail');
