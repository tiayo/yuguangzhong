<?php

//登录相关
$this->get('login', 'Auth\LoginController@showLoginForm')->name('manage.login');
$this->post('login', 'Auth\LoginController@login')->name('manage.login');
$this->get('logout', 'Auth\LoginController@logout')->name('manage.logout');

//登陆后才可以访问
$this->group(['middleware' => 'manage_auth'], function () {
    //后台首页
    $this->get('/', 'IndexController@index')->name('manage');

    //管理员才可以操作
    $this->group(['middleware' => 'admin'], function () {
        //会员相关
        $this->get('/user/list/', 'UserController@listView')->name('user_list');
        $this->get('/user/list/{keyword}', 'UserController@listView')->name('user_search');
        $this->get('/user/update/{id}', 'UserController@updateView')->name('user_update');
        $this->post('/user/update/{id}', 'UserController@post');
        $this->get('/user/destroy/{id}', 'UserController@destroy')->name('user_destroy');

        //分类相关
        $this->get('/category/list/', 'CategoryController@listView')->name('category_list');
        $this->get('/category/list/{keyword}', 'CategoryController@listView')->name('category_search');
        $this->get('/category/add', 'CategoryController@addView')->name('category_add');
        $this->post('/category/add', 'CategoryController@post');
        $this->get('/category/update/{id}', 'CategoryController@updateView')->name('category_update');
        $this->post('/category/update/{id}', 'CategoryController@post');
        $this->get('/category/destroy/{id}', 'CategoryController@destroy')->name('category_destroy');

        //文章模块
        $this->get('/article/list/', 'ArticleController@listView')->name('article_list');
        $this->get('/article/list/{keyword}', 'ArticleController@listView')->name('article_search');
        $this->get('/article/add', 'ArticleController@addView')->name('article_add');
        $this->post('/article/add', 'ArticleController@post');
        $this->get('/article/update/{id}', 'ArticleController@updateView')->name('article_update');
        $this->post('/article/update/{id}', 'ArticleController@post');
        $this->get('/article/destroy/{id}', 'ArticleController@destroy')->name('article_destroy');
    });
});