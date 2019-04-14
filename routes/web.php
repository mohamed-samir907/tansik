<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

# Result Routes
Route::get('/result', 'TestController@index')->name('result');
Route::post('/result', 'TestController@result');


Route::group(['middleware' => 'auth'], function() {

	Route::get('/home', 'NewTestController@index')->name('home');
	Route::post('/home/data', 'NewTestController@get_student_data')->name('get.student_data');
	Route::post('/add/ragaba', 'NewTestController@add_ragaba')->name('front.add_ragaba');
	Route::post('/edit/ragaba', 'NewTestController@edit_ragaba')->name('front.edit_ragaba');
	Route::post('/home/schools', 'NewTestController@get_schools')->name('front.get_schools');
	Route::post('/home/add/high', 'NewTestController@addHigh')->name('front.add_high');
	Route::post('/home/editStuedntData', 'NewTestController@editStuedntData')->name('front.edit_student_data');

	/*Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/home/data', 'HomeController@get_student_data')->name('get.student_data');
	Route::post('/add/ragaba', 'HomeController@add_ragaba')->name('front.add_ragaba');
	Route::post('/home/schools', 'HomeController@get_schools')->name('front.get_schools');*/

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

	# Login Routes
	Route::get('login', 'Auth\AdminAuthController@showLoginForm')->name('admin.login');
	Route::post('login', 'Auth\AdminAuthController@login')->name('admin.login');
	# Reset Password Routes
	Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.request');
	Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.email');
	Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
	Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

	Route::group(['middleware' => 'auth:admin'], function() {
		# Logout Route
		Route::post('/logout', 'Auth\AdminAuthController@logout')->name('admin.logout');

		Route::get('home', 'HomeController@index')->name('admin.home');
		Route::resource('govs', 'GovsController');
		Route::resource('edaras', 'EdarasController');
		Route::resource('sections', 'SectionsController');
		Route::resource('p-schools', 'PrepSchoolsController');
		Route::resource('s-schools', 'SecondSchoolsController');
		Route::post('students/edaras', 'StudentsController@get_edaras')->name('students.get_edaras');
		Route::post('students/sections', 'StudentsController@get_sections')->name('students.get_sections');
		Route::post('students/schools', 'StudentsController@get_schools')->name('students.get_schools');
		Route::resource('students', 'StudentsController');
		Route::resource('types', 'TypesController');
		Route::resource('ragabas', 'RagabasController');
	});

});