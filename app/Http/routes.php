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

如果使用nginx配置路由出现404解决办法：
在location里面加上　try_files $uri $uri/ /index.php?$query_string;
http://blog.csdn.net/sunxiang_520/article/details/51633837
*/


Route::get('/', function () {
    return redirect('/blog');
});

Route::get('blog', 'BlogController@index');
Route::get('blog/{slug}', 'BlogController@showPost');

Route::get('admin', function () {
    return redirect('/admin/post');
});

$router->group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {
    resource('admin/post', 'PostController');
    resource('admin/tag', 'TagController');
    get('admin/upload', 'UploadController@index');
});

Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');
