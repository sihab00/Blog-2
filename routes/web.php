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
// Route::group(['namespace'=>'Frontend'],function(){
// 	Route::get('/', 'frontController@index');
// 	Route::get('/contact', 'frontController@contact')->name('contact');
// });

// Route::group(['namespace'=>'Backend','prefix'=>'backend'],function(){

// 	Route::get('/', 'frontController@index');
// 	Route::get('/users', 'userController@index')->name('user');
// 	Route::get('/users/{id}', 'UserController@show')->name('user');


// 	Route::resource('post','PostController')->expect('destroy');
// });

Route::group(['middleware'=>'auth'],function(){
	Route::get('/dashboard', 'Backend\frontcontroller@dashboardShow')->name('dashboard');
	Route::resource('/categories','Backend\CategoryController');
	Route::resource('/posts','Backend\PostController');
});


Route::group(['namespace'=>'Backend'],function(){
	Route::get('/', 'frontcontroller@index');
	Route::get('/contact', 'frontcontroller@contact')->name('contact');


	Route::get('/register', 'frontcontroller@registerForm')->name('register');
	Route::post('/register', 'frontcontroller@processRegister')->name('register');

	Route::get('/verify/{token}', 'frontcontroller@verifyEmail')->name('verify');
	Route::get('/login','frontcontroller@loginForm')->name('login');
	Route::post('/login','frontcontroller@processLogin')->name('login');
	Route::get('/logout', 'frontcontroller@logout')->name('logout');

	//cetegory
	

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
