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

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('workers', 'BlogStatisticsController@workersList')->name('workers');
    Route::get('worker/{worker}', 'BlogStatisticsController@workerDetail')->name('worker.detail');
    Route::get('category/{category}', 'CategoryStatisticsController@categoriyByBlog')->name('category.dateail');
});

Route::prefix('compositions')->name('comp.')->group(function (){
    Route::get('workers', 'CompositionStatisticsController@workersList')->name('workers');
    Route::get('worker/{id}', 'CompositionStatisticsController@workerDetail')->name('worker.detail');
    Route::get('category/{category}', 'CategoryStatisticsController@categoriyByComposition')->name('category.dateail');
});

Route::get('categories', 'CategoryStatisticsController@categoriesList')->name('categories');






