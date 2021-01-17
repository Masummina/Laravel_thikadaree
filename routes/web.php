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
Route::get('how-it-works', 'IndexController@howWork');

Route::get('/jobs', 'IndexController@jobs');
Route::get('/jobs/{parms}', 'IndexController@jobs');
Route::post('/jobs/{parms}', 'IndexController@jobs');
Route::get('/job-details/{parms}', 'IndexController@ProjectDetails');
Route::post('/job-details/{parms}', 'IndexController@ProjectDetails');

Route::get('/about', 'IndexController@about');
Route::get('/welcome', 'IndexController@welcome');

Route::post('/projects/{name}', 'IndexController@ProjectDetails');
Route::get('/projects/{name}', 'IndexController@ProjectDetails');
Route::get('/category/{cname}', 'IndexController@SingleCategory');
Route::get('/need/{name}', 'IndexController@somethingNeed');
Route::get('/project-win/{seotitle}', 'IndexController@projectwin');
Route::get('/services/{parms}', 'UserController@services');


Auth::routes();

Route::get('/home', 'UserController@index')->name('home');
Route::get('/profile', 'UserController@profile');
Route::post('/profile', 'UserController@profile');
Route::get('/post-a-project', 'UserController@PostProject');
Route::post('/post-a-project', 'UserController@PostProject');
Route::get('/MyProject', 'UserController@MyProject');
Route::get('/editprofile', 'UserController@editUserprofile');
Route::post('/editprofile', 'UserController@editUserprofile');
Route::get('/users/{name2}', 'UserController@Members');
Route::get('/users', 'UserController@Allmembers');

Route::get('/message', 'UserController@usermessage');
Route::get('/message/{user_name}/', 'UserController@usermessage');
Route::get('/message/{user_name}/{project_name}', 'UserController@usermessage');

Route::post('/message/{user_name}/', 'UserController@usermessage');
Route::post('/message/{user_name}/{project_name}', 'UserController@usermessage');


Route::get('/dashboard', 'UserController@index')->name('home');
Route::get('/edit-bid/{name}', 'UserController@edit_bid');
Route::get('/uploaddata', 'IndexController@uploaddata');
Route::post('/uploaddata', 'IndexController@uploaddata');

Route::get('/transaction', 'UserController@transaction');
Route::POST('/transaction', 'UserController@transaction');

/********************** Ajax Data *************************/
Route::get('/GetSubCategory','AjaxController@GetSubCategory');
Route::get('/GetThanaByDistrict','AjaxController@GetThanaByDistrict');

Route::get('/GetSubCategory','AjaxController@GetSubCategory');

Route::group([ 'middleware' => ['auth','admin']], function(){
	Route::get('/bem-dashboard', 'admin\AdminController@Index');
	Route::get('/bem-charge', 'admin\AdminController@manageCharges');
	Route::post('/bem-charge', 'admin\AdminController@manageCharges');
	Route::get('/bem-charge/{charge}', 'admin\AdminController@manageCharges');
    Route::post('/bem-charge/{charge}', 'admin\AdminController@manageCharges');
    
    Route::get('/bem-settings', 'admin\AdminController@manageSettings');
	Route::post('/bem-settings', 'admin\AdminController@manageSettings');
	Route::get('/bem-settings/{setting}', 'admin\AdminController@manageSettings');
	Route::post('/bem-settings/{setting}', 'admin\AdminController@manageSettings');

	Route::get('/bem-remittance', 'admin\AdminController@remittance');
	Route::get('/bem-remittance/{id}', 'admin\AdminController@remittance');
	Route::resource('/bem-users', 'admin\UserController');    
	Route::resource('/bem-transactions', 'admin\TransactionController');           
	Route::resource('/bem-categories', 'admin\CategoryController');
    Route::resource('/bem-posts', 'admin\PostController');
    Route::resource('/bem-projects', 'admin\ProjectController');
    Route::get('/download-teachers', 'admin\TeachersController@download');
    Route::resource('/setting', 'admin\SettingController');
    Route::resource('/content', 'ContentController');
  
    Route::get('/bem-notifications', 'admin\AdminController@notification');
    Route::get('/bem-notification-seen', 'admin\AdminController@notificationSeen');


});







