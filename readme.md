## 基于Laravel和AdminLTE的CMS


### 安装和使用
将代码 clone 到本地之后先执行 ```npm install``` 命令安装相关依赖

gulp 和 bower 这俩货也要安装
```
npm install -g gulp
npm install gulp-rename --save
npm install -g bower
```

然后执行  ``` composer updat ``` 命令安装 PHP 相关依赖。
因为要修改数据库还要执行 ``` composer require "doctrine/dbal" ``` 安装相关依赖

执行 ``` php artisan key:generate ``` 生成一个key,并放到 config/app.php
```
     /*
     |--------------------------------------------------------------------------
     | Encryption Key
     |--------------------------------------------------------------------------
     |
     | This key is used by the Illuminate encrypter service and should be set
     | to a random, 32 character string, otherwise these encrypted strings
     | will not be safe. Please do this before deploying an application!
     |
     */

     'key' => env('APP_KEY', '9mOVonC90AZMOTcZNSgyZ3YOcmKn05CR'),

     'cipher' => 'AES-256-CBC',
 ```

****

当前阶段参考 [博客系列](http://laravelacademy.org/tutorials/blog)

#### 解決博客系列：4、创建Markdown服务 SmartyPants 找不到文件的問題 
[基于 Laravel 开发博客应用系列 —— 从测试开始（二）：使用Gulp实现自动化测试](http://laravelacademy.org/post/2249.html)
 
 > 修改 
 
 ```composer require “michelf/php-smartypants=1.6.0-beta1”```
 
 > 為
 
 ```composer require “michelf/php-smartypants=1.8.1```
 
 造成這個問題的原因應該是beta版本SmartyPants自身的問題。可以明顯看到這個版本的命名空間大小寫不統一。

#### 解決 Nginx 環境下404錯誤
參看文檔 [laravel配置路由出现404解决办法](http://blog.csdn.net/sunxiang_520/article/details/51633837)

## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
