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

 
Route::get('/', 'IndexController@index');

Route::get('/projects', 'IndexController@projects');

Route::get('/about', 'IndexController@about');
Route::get('/welcome', 'IndexController@welcome');
Route::get('/projects/{name}', 'IndexController@ProjectDetails');
Route::post('/projects/{name}', 'IndexController@ProjectDetails');
Route::get('/category/{cname}', 'IndexController@SingleCategory');
Route::get('/project-win', 'ShuvoController@projectwin');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile');
Route::get('/post-a-project', 'HomeController@PostProject');
Route::post('/post-a-project', 'HomeController@PostProject');
Route::get('/MyProject', 'HomeController@MyProject');
Route::get('/editprofile', 'HomeController@editUserprofile');
Route::post('/editprofile', 'HomeController@editUserprofile');
Route::get('/users/{name2}', 'HomeController@Members');
Route::get('/users', 'HomeController@Allmembers');
Route::get('/message/{id}', 'HomeController@usermessage');
Route::post('/message/{id}', 'HomeController@usermessage');
Route::get('/dashboard', 'HomeController@index')->name('home');







