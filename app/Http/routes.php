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
在location里面加上　try_files $uri $uri/ /index.blade.php?$query_string;
http://blog.csdn.net/sunxiang_520/article/details/51633837
*/


Route::get('/', function () {
    return redirect('/blog');
});

Route::get('blog', 'BlogController@index');
Route::get('blog/{slug}', 'BlogController@showPost');

Route::get('admin', function () {
    return redirect('/admin/dashboard');
});

$router->group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {
    get('admin', function () {
        return redirect('/admin/dashboard');
    });
    get('admin/dashboard', 'DashboardController@index');

    resource('admin/post', 'PostController');
    post('admin/ajax/post/store/{id}', "PostController@ajaxStore");

    resource('admin/tag', 'TagController');

    resource('admin/category', 'CategoryController');
    get('admin/category/parent/{id}', 'CategoryController@listCategory');

    get('admin/upload', 'UploadController@index');
    post('admin/upload/ajax/file', 'UploadController@ajaxUploadFile');
    post('admin/upload/file', 'UploadController@uploadFile');
    delete('admin/upload/file', 'UploadController@deleteFile');
    post('admin/upload/folder', 'UploadController@createFolder');
    delete('admin/upload/folder', 'UploadController@deleteFolder');
});

Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');
