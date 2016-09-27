<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//user
Route::get('/',['as'=>'user_work','uses'=>'UserController@getWork']);
Route::get('/user/login', ['as'=>'user_login',function () {
    return view('/user/login');
}]);
Route::get('/user/register',['as'=>'user_register',function () {
    return view('/user/register');
}]);
Route::post('/user/login','UserController@postLogin');
Route::post('/user/register','UserController@postRegister');
Route::get('/user/home',['as'=>'user_home',function () {
    return view('user/home');
}]);
Route::get('/user/logout',['as'=>'user_logout','uses'=>'UserController@getLogout']);
Route::get('/user/passwordreset',['as'=>'user_passwordreset', function () {
    return view('/user/passwordreset');
}]);
Route::post('/user/passwordreset','UserController@postPasswordReset');
Route::get('/user/work',['as'=>'user_work','uses'=>'UserController@getWork']);
Route::post('/user/work/{id}','UserController@postWork');

Route::get('user/info/{id}/edit', 'UserController@getInfoEdit');
Route::post('user/info/edit', 'UserController@postInfoEdit');

Route::get('/user/info/{id}','UserController@getInfo');
Route::post('/user/info/{id}','UserController@postInfo');

Route::get('/user/mywork','UserController@getMyWork');
Route::get('user/employer/info/{id}', 'UserController@getEmployerInfo');


//employer

Route::get('/employer/login',['as'=>'employer_login', function () {
    return view('/employer/login');
}]);

Route::post('/employer/login','EmployerController@postLogin');

Route::get('/employer/register',['as'=>'employer_register',function () {
    return view('/employer/register');
}]);
Route::post('/employer/register','EmployerController@postRegister');

Route::get('/employer/logout',['as'=>'employer_logout','uses'=>'EmployerController@getLogout']);

Route::get('/employer/passwordreset', ['as'=>'employer_passwordreset',function () {
    return view('/employer/passwordreset');
}]);
Route::post('/employer/passwordreset','EmployerController@postPasswordReset');

Route::get('/employer/work/publish',['as'=>'work_publish','middleware' => 'auth:employers',function () {
    return view('/employer/work/publish');
}]);
Route::post('/employer/work/publish','EmployerController@postPublish');

Route::get('/employer/work',['as'=>'employer_work','middleware' => 'auth:employers','uses'=>'EmployerController@getWork']);
Route::post('/employer/work','EmployerController@postWork');

Route::get('/employer/work/info/{id}','EmployerController@getWorkInfo');
Route::post('/employer/work/info/{question_id}','EmployerController@postAnswer');

Route::get('/employer/work/{id}/edit','EmployerController@getWorkEdit');
Route::post('/employer/work/{id}/edit','EmployerController@postWorkEdit');

Route::get('/employer/user/info/{id}','EmployerController@getUserInfo');

Route::post('employer/info/edit', 'EmployerController@postInfoEdit');
Route::get('employer/info/{id}/edit', 'EmployerController@getInfoEdit');

Route::get('/employer/info/{id}', 'EmployerController@getInfo');

Route::get('/employer/applyhandle',['as'=>'employer_apply_handle','middleware' => 'auth:employers', function () {
    return view('/employer/applyHandle');
}]);



//work
Route::get('/work/info/{id}',['as'=>'work_info','uses'=>'WorkController@getWork']);
Route::post('/work/info/{id}','WorkController@postWork');

Route::post('/work/apply/decide','WorkController@postApplyDecide');

Route::post('/work/apply/end','WorkController@postApplyEnd');

//question
Route::post('/question/{work_id}','QuestionController@postQuestion');

//comments
Route::get('/employer/comment/{work_id}','CommentController@getEmployerCommentForm');
Route::post('/employer/comment/{work_id}/{user_id}','CommentController@postEmployerCommentForm');
Route::get('/user/comment/{work_id}','CommentController@getUserCommentForm');
Route::post('/user/comment/{work_id}','CommentController@postUserCommentForm');



//admin
Route::get('/admin/login',['as'=>'admin_login','uses'=>'AdminController@getLogin']);
Route::post('/admin/login','AdminController@postLogin');
Route::get('/admin/index',['as'=>'admin_index','uses'=>'AdminController@getIndex']);
Route::get('/admin/works',['as'=>'admin_works','uses'=>'AdminController@getWorks']);
Route::get('/admin/employers',['as'=>'admin_employers','uses'=>'AdminController@getEmployers']);
Route::get('/admin/users',['as'=>'admin_users','uses'=>'AdminController@getUsers']);
Route::get('/admin/works/check',['as'=>'admin_works','uses'=>'AdminController@getWorksCheck']);
Route::post('/admin/works/check','AdminController@postWorksCheck');