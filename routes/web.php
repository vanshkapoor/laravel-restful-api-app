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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get('/hello', function () {
    return 'welcome';
});

Route::get('/users/{id}/{name}', function($id, $name){
    return 'this is user no.'.$id.'name:'.$name;
});
*/
Route::get('/','PagesController@index');

Route::get('/about','PagesController@about');

Route::get('/services','PagesController@services');

Route::resource('posts','Postscontroller');
//the routes for the resources post that makes the routes automatically

/* Route::get('/about', function(){
    return view('pages.about');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
